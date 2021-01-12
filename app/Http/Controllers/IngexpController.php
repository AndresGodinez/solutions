<?php

namespace App\Http\Controllers;

use App\IngLinea;
use App\IngTipo;
use App\Models\IngexpModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function compact;
use function dd;
use function response;
use function view;

date_default_timezone_set("America/Mexico_City");

class IngexpController extends Controller
{
    public $dirupload = "\\storage\\app\\";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cargar()
    {

        $user = Auth::user()->username;
        $id_region = Auth::user()->id_region;
        $get_records = IngexpModel::get_records();
        return view("Ingexp.cargar", compact('get_records'));
    }


    public function cargarpost(Request $request)
    {
        $file = $request->file('uploadedfile');
        $user = Auth::user()->username;

        IngexpModel::cargar($_POST, $user, $_FILES, $file);

        $urldirv = url('/ingexp/cargar?success=1');
        return redirect($urldirv);

    }

    public function cargarpostedit(Request $request)
    {
        $file = $request->file('uploadedfile');
        $user = Auth::user()->username;

        IngexpModel::cargaredit($_POST, $user, $_FILES, $file);

        $urldirv = url('/ingexp/editar/'.$request->get('id').'?success=1');
        return redirect($urldirv);

    }


    public function editar()
    {
        $user = Auth::user()->username;
        $id_region = Auth::user()->id_region;


        $tipo = false;
        $linea = false;

        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
        }
        if (isset($_GET['linea'])) {
            $linea = $_GET['linea'];
        }
        $get_records = IngexpModel::get_list($tipo, $linea);

        $datos = IngexpModel::get_records();
        return view("Ingexp.editar", compact('get_records', 'datos'));
    }


    public function buscar(Request $request)
    {
        $get_records = IngexpModel::get_list($request);

        $lineas = IngLinea::get();
        $tipos = IngTipo::get();

        return view("Ingexp.buscar", compact('get_records', 'lineas', 'tipos'));
    }


    public function editardetail(Request $request)
    {
        $user = Auth::user()->username;
        $id_region = Auth::user()->id_region;
        $get_records = IngexpModel::get_edit($request->id);
        $id = $request->id;
        $get_records_dt = IngexpModel::get_records();
        return view("Ingexp.editardetail", compact('get_records', 'id', 'get_records_dt'));
    }


    public function visor(Request $request)
    {

        $id = $request->id;
        $archivo_carga = IngexpModel::visor($id);
        $archivo_carga = '/public/'.$archivo_carga[0]['archivo_carga'];

        if (!Storage::exists($archivo_carga)){
            return view('Bag.file_not_found');
        }

        $o_en = file_get_contents(storage_path().'/app/'.$archivo_carga);
        $d = base64_encode($o_en);

        $path = storage_path('app/'.$archivo_carga);




        ini_set('display_errors', 1);

        if ($archivo_carga) {

            $tipo = explode('.', $archivo_carga);
            $tipo = strtolower($tipo[1]);
            //echo $tipo;
            switch ($tipo) {
                case 'pdf':
                case 'pptx':
                case 'doc':
                case 'docx':
                case 'xls':
                case 'xlsx':
                case 'txt':
                case 'rar':
                    return Storage::response($archivo_carga);

                case 'zip':
                    return response()->download($path);
                case 'png':
                case 'jpg':
                case 'jpeg':
                    echo '<img src="data:image/png;base64, '.$d.'"  />';
                    die();
                    break;
                case 'avi':
                case 'mp4':
                case 'wmv':
                case 'mov':
                    ?>
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Ver Video - <?php echo $archivo_carga ?></title>

                        <style>
                            .video-container {
                                padding-bottom: 56.25%;
                                height: 0;
                                overflow: hidden;
                                position: relative;
                            }

                            .frame {
                                position: absolute;
                                height: 100%;
                                width: 100%;
                                top: 0;
                                left: 0;
                            }
                        </style>
                    </head>

                    <body>
                    <div class="video-container">
                        <video class="frame" autoplay controls controlsList="nodownload">
                            <source type="video/webm" src="data:video/webm;base64, <?= $d ?>">
                            <source type="video/mp4" src="data:video/mp4;base64, <?= $d ?>">
                        </video>


                    </div>
                    </div>

                    </body>
                    </html>
                    <?php
                    die();
                    break;

                default:
                    # code...
                    break;
            }


        }
    }


    public function confirmarpago(Request $request)
    {
        $confirmarpago = [];
        if (isset($request->id) && isset($request->token)) {

            $v = DB::query()->selectRaw('email,fecha_expire,status,nombre_del_dueno')
                ->from('ing_solicitaracceso')
                ->whereRaw("status = 1 and id ='".$request->id."' and _token='".$request->token."'")
                ->get();;

            if (count($v) > 0) {
                $confirmarpago['nombre'] = $v[0]->nombre_del_dueno;
                $confirmarpago['id'] = $request->id;
                return view("Ingexp.confirmarpago", compact('confirmarpago'));
            } else {
                return redirect('ingexp/solicitaracceso');
            }

        } else {
            return redirect('ingexp/solicitaracceso');
        }

    }

    public function confirmarpagopost(Request $request)
    {
        DB::table('ing_solicitaracceso')
            ->where('id', $_POST['id'])
            ->update(
                [
                    'status' => 2,
                    'recibodepago' => $_POST['recibodepago']
                ]
            );
    }

    public function solicitaracceso(Request $request)
    {

        if (isset($_GET['logout'])) {
            $request->session()->forget('sol_acceso_token');
            $request->session()->forget('sol_acceso_nombre');
            $request->session()->forget('sol_acceso_login');
        }
        $modo = 'registro';
        return view("Ingexp.solicitaracceso", compact('modo'));
    }

    public function solicitaracceso_login(Request $request)
    {
        $modo = 'login';
        return view("Ingexp.solicitaracceso", compact('modo'));
    }

    public function cargardetallessolicitud(Request $request)
    {

        $data = IngexpModel::get_solictud($request->id);
        return view("Ingexp.cargardetallesuser", compact('data'));
    }

    public function changeestatussolicitud()
    {
        if (isset($_POST['statuschange'])) {

            if ($_POST['statuschange'] == 3) {
                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                $password = "";
                //Reconstruimos la contraseña segun la longitud que se quiera
                for ($i = 0; $i < 9; $i++) {
                    $password .= substr($str, rand(0, 62), 1);
                }


                DB::table('ing_solicitaracceso')
                    ->where('id', $_POST['id'])
                    ->update(['password' => $password, 'status' => $_POST['statuschange']]);

                $datau = DB::query()->selectRaw('email,fecha_expire,status,nombre_del_dueno,_token,id,password')
                    ->from('ing_solicitaracceso')
                    ->whereRaw("id ='".$_POST['id']."'")
                    ->get();
            } else {
                if ($_POST['statuschange'] == 4) {
                    DB::table('ing_solicitaracceso')
                        ->where('id', $_POST['id'])
                        ->update(['status' => $_POST['statuschange'], 'motivo_rechazo' => $_POST['motivorechazo']]);
                    $datau = DB::query()->selectRaw('email,fecha_expire,status,nombre_del_dueno,_token,id,password')
                        ->from('ing_solicitaracceso')
                        ->whereRaw("id ='".$_POST['id']."'")
                        ->get();
                } else {
                    DB::table('ing_solicitaracceso')
                        ->where('id', $_POST['id'])
                        ->update(
                            ['status' => $_POST['statuschange']]);
                    $datau = DB::query()->selectRaw('email,fecha_expire,status,nombre_del_dueno,_token,id,password')
                        ->from('ing_solicitaracceso')
                        ->whereRaw("id ='".$_POST['id']."'")
                        ->get();
                }
            }
            if ($_POST['statuschange'] == 1) {
                $email_message = "
                        <html>
                        <head>
                        <title>E-Mail HTML</title>
                        </head>
                        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

                        <style>

                    body, P.msoNormal, LI.msoNormal
                    {
                    background-position: top;
                    margin-left:  1em;
                    margin-top: 1em;
                    font-family: 'Arial';
                    font-size:   9pt;
                    color:    '000000';
                    }

                    table
                    {
                    font-family: 'Arial';
                    font-size:   9pt;

                    }
                    </style>

                        <body>
                        <p>Hola ".$datau[0]->nombre_del_dueno."</p>
                        <br>
                        <p>Por este medio te informamos que el link abajo debe ser usado para comprobar el pago.<br> </p>
                        <p></p>
                        <p></p>
                        <br>

                        <p><a href=\"{{url('ingexp/confirmarpago')}}/".$datau[0]->id."/".$datau[0]->_token."\">Confirmar Pago</a></p>

                    ";

                $to = $datau[0]->email;
                $subject = 'Solicitud de pago, WHIRLPOOL.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers."Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers."From:Whirlpool Service<no-responder@whirlpool.com>\r\n";
                $mail_sent = @mail($to, $subject, $email_message, $headers);
            }

            if ($_POST['statuschange'] == 3) {
                $email_message = "
                        <html>
                        <head>
                        <title>E-Mail HTML</title>
                        </head>
                        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

                        <style>

                    body, P.msoNormal, LI.msoNormal
                    {
                    background-position: top;
                    margin-left:  1em;
                    margin-top: 1em;
                    font-family: 'Arial';
                    font-size:   9pt;
                    color:    '000000';
                    }

                    table
                    {
                    font-family: 'Arial';
                    font-size:   9pt;

                    }
                    </style>

                        <body>
                        <p>Hola ".$datau[0]->nombre_del_dueno."</p>
                        <br>
                        <p>Login: ".$datau[0]->email."<br> </p>
                        <p>Password: ".$password." <br> </p>
                        <p></p>
                        <p></p>
                        <br>

                        <p><a href=\"{{url('ingexp/solicitaracceso')}}\">Entrar</a></p>

                    ";

                $to = $datau[0]->email;
                $subject = 'Bienvenido, datos de acceso.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers."Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers."From:Whirlpool Service<no-responder@whirlpool.com>\r\n";
                $mail_sent = @mail($to, $subject, $email_message, $headers);

                echo $password;
            }

            if ($_POST['statuschange'] == 5) {
                $email_message = "
                        <html>
                        <head>
                        <title>E-Mail HTML</title>
                        </head>
                        <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

                        <style>

                    body, P.msoNormal, LI.msoNormal
                    {
                    background-position: top;
                    margin-left:  1em;
                    margin-top: 1em;
                    font-family: 'Arial';
                    font-size:   9pt;
                    color:    '000000';
                    }

                    table
                    {
                    font-family: 'Arial';
                    font-size:   9pt;

                    }
                    </style>

                        <body>
                        <p>Hola ".$datau[0]->nombre_del_dueno."</p>
                        <br>
                        <p>Solicitud rechazada.  </p>
                        <p>Motivo: ".$_POST['motivorechazo']." <br> </p>
                        <p></p>
                        <p></p>
                        <br>

                        <p><a href=\"{{url('ingexp/solicitaracceso')}}\">Entrar</a></p>

                    ";

                $to = $datau[0]->email;
                $subject = 'Bienvenido, datos de acceso.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers."Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers."From:Whirlpool Service<no-responder@whirlpool.com>\r\n";
                $mail_sent = @mail($to, $subject, $email_message, $headers);

                echo $password;
            }


        }

        if (isset($_POST['fechaexpira'])) {

            $_POST['fechaexpira'] = explode('/', $_POST['fechaexpira']);
            $_POST['fechaexpira'] = $_POST['fechaexpira'][2].$_POST['fechaexpira'][1].$_POST['fechaexpira'][0];
            DB::table('ing_solicitaracceso')
                ->where('id', $_POST['id'])
                ->update(['fecha_expire' => $_POST['fechaexpira']]);
        }

        if (isset($_POST['password'])) {
            DB::table('ing_solicitaracceso')
                ->where('id', $_POST['id'])
                ->update(['password' => $_POST['password']]);
        }
    }

    public function acceso(Request $request)
    {


        $valid = @session('sol_acceso_token');
        if ($valid != '') {


            $tipo = false;
            $linea = false;

            if (isset($_GET['tipo'])) {
                $tipo = $_GET['tipo'];
            }
            if (isset($_GET['linea'])) {
                $linea = $_GET['linea'];
            }
            $get_records = IngexpModel::get_list($tipo, $linea);

            $datos = IngexpModel::get_records();
            return view("Ingexp.acceso", compact('get_records', 'datos'));

        } else {
            return redirect('ingexp/solicitaracceso');
        }


    }


    public function solicitaracceso_procesar(Request $request)
    {
        $get_records = IngexpModel::solicitaracceso($_POST);
        echo $get_records;
    }

    public function solicitaraccesologin(Request $request)
    {
        $get_records = IngexpModel::solicitaracceso_login($_POST);
        if ($get_records['status'] == 'si') {
            $request->session()->put(['sol_acceso_login' => trim(strtoupper($_POST["login"]))]);
            $request->session()->put(['sol_acceso_token' => trim(strtoupper($_POST["_token"]))]);
            $request->session()->put(['sol_acceso_nombre' => trim(strtoupper($get_records["nombre"]))]);
        }
        return response()->json($get_records);
    }


    public function listadeacceso()
    {
        $user = Auth::user()->username;
        $id_region = Auth::user()->id_region;
        $get_records = IngexpModel::get_listadesolicitud();
        return view("Ingexp.listadeacceso", compact('get_records'));
    }
}

