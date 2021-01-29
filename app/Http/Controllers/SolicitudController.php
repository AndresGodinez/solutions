<?php

namespace App\Http\Controllers;


use App\Models\DetalleSolicitud;
use App\Models\DispatchAbiertos;
use App\Models\DocumentosAyuda;
use App\Models\LineaProducto;
use App\Models\Menu;
use App\Models\ModoFallas;
use App\Models\PreguntaSolicitud;
use App\Models\RespuestaSolicitud;
use App\Models\RevisionIngenieria;
use App\Models\Solicitud;
use App\Models\TipoAyuda;
use App\Models\TipoInformacion;
use Illuminate\Support\Str;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use function report;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = TipoInformacion::all();
        $mode_fail = ModoFallas::all();
        $line = LineaProducto::all();
        $questions = PreguntaSolicitud::all();
        $document = TipoAyuda::all();
        $region = Session::get('contry');
        $username = Session::get('username');
        
        $data_us = DB::table('usuarios')
                        ->leftJoin('wpx_menu_contry', 'wpx_menu_contry.id', '=', 'usuarios.id_contry')
                        ->select('usuarios.id_contry', 'wpx_menu_contry.short_name', 'wpx_menu_contry.id')
                        ->where('usuarios.username', $username)
                        ->get();
        
        if ($data_us[0]->short_name != 'MX') {
            $dispatch = $data_us[0]->short_name . '0000000';
        } else {
            $dispatch = '';
        }

        $user = Session::get('username');
        $items = Menu::getMenu2($user);

        return view("pages.solicitud.create", ["mode_fail" => $mode_fail,
            "information" => $information,
            "line" => $line,
            "questions" => $questions,
            "document" => $document,
            'region' => Session::get('region'),
            'dispatch' => $dispatch,
            'items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){

        $user_name = Session::get('username');
        $data_us = DB::table('usuarios')
                        ->leftJoin('wpx_menu_contry', 'wpx_menu_contry.id', '=', 'usuarios.id_contry')
                        ->select('usuarios.id_contry', 'wpx_menu_contry.short_name', 'wpx_menu_contry.id')
                        ->where('usuarios.username', $user_name)
                        ->get();

        $email_request = Session::get('mail');

        if ($data_us[0]->short_name != 'MX') {
            $rowSelect = Solicitud::select('id_sol')->where('dispatch', 'like', '%' . $data_us[0]->short_name . '%')->get();
            $count = count($rowSelect) + 1;
            $countSize = strlen($count);
            $dispatch = $data_us[0]->short_name . str_pad($count, (10 - $countSize), "0", STR_PAD_LEFT);
        } else {
            $dispatch = $request->dispatch;
        }


        $req = new Solicitud;
        $req->dispatch = $dispatch;
        $req->modelo = $request->model;
        $req->id_falla = $request->fail;
        $req->serie = $request->serie;
        $req->descripcion_problema = $request->problem;
        $req->linea_producto = $request->line;
        $req->comentario = empty($request->comment) ? '' : $request->comment;
        $req->ruta ='';
        $req->informacion = $request->information;
        $req->telefono = $request->phone;
        $req->categoria = '';
        $req->nombre_tecnico = $request->name;
        $req->timestamps = false;
        $req->os_cca = (isset($request->os_cca) ? $request->os_cca : "N/A");
        $req->user = Session::get('username');
        $req->save();

        $id_sol = $req->id_sol;

        $image = $request->file('file');
        
        if (!empty($image)) 
        {
            $new_name = Str::uuid().'.' . $image->getClientOriginalExtension();
            $image->storeAS('dispatch/' . $id_sol . '/', $new_name);
        } 
        else 
        { 
            $new_name = '';
        }

        Solicitud::where('id_sol', $id_sol)->update(['ruta' => $new_name]);

        $now = new \DateTime();
        $req_detail = new DetalleSolicitud;
        $req_detail->id_sol = $id_sol;
        $req_detail->fecha_envio = $now->format('Y-m-d H:i:s');
        $req_detail->status = "ABIERTO";
        $req_detail->usuario = Session::get('username');
        $req_detail->responsable = "";
        $req_detail->save();
       
        $this->data_questions = json_decode($request->_questions, true);

        try
        {
            if($this->data_questions)
            {    
                foreach ($this->data_questions as $key => $question) 
                {
                    $this->id_pregunta = (string) $question["id_pregunta"];
                    $this->answer = "answer" . $this->id_pregunta;
                    $route = '';

                    $answerModel = new RespuestaSolicitud;
                    $answerModel->id_solicitud = $id_sol;
                    $answerModel->id_pregunta = $question["id_pregunta"];
                    $answerModel->respuesta = $request[$this->answer];

                    $file = $request['file'.$this->id_pregunta];
                    
                    if($file) 
                    {
                        $route = DocumentoController::moveFile($id_sol,$file);
                    }

                    $answerModel->ruta = $route;
                    $answerModel->timestamps = false;
                    $answerModel->save();
                }
            }

            // Send Email to Request user.
            $to = $email_request;
            $title = "Whirlpool Service";
            $subject = "Solicitudes a Ingenieria | Folio No. ".$id_sol;
            $e_message = '
                        <p style="color: #393939; font-size: 14px;">
                            Por este medio te informamos que la solicitud a Ingeniería que realizaste ha sido <strong>Generada Correctamente</strong>, para mas información te invitamos a darle seguimiento a la misma en Centro de Soluciones con el No. de Folio: <strong>'.$id_sol.'</strong>, esto en el apartado de Solicitudes a Ingeniería.
                        </p>
                        <p style="color: #393939; font-size: 14px;">
                            Recuerda que el medio oficial de comunicacion es a traves del Centro de Soluciones.
                        </p>
                        <p style="color: #393939; font-size: 14px;">
                            Orden de servicio: '.$req->dispatch.'
                        </p>
                        ';
            //this->send_mail_php($to, $subject, $e_message, $title);

            return response()->json(['ok' => 'success', 'message' => 'Solicitud Creada Correctamente', 'dispatch'=>$dispatch]);
        } catch (\Exception $e) {
            report($e);
        }
    }

    public function descargar($id){
        $solicitud = Solicitud::where('id_sol', $id)->first();


            return Storage::download('dispatch/'.$id.'/'.$solicitud->ruta, $solicitud->ruta);

    }

    public function saved(Request $request)
    {
        $now = new \DateTime();
        $req = new Solicitud;
        $req->dispatch = $request->dispatch;
        $req->modelo = $request->model;
        $req->id_falla = $request->fail;
        $req->serie = $request->serie;
        $req->descripcion_problema = $request->problem;
        $req->linea_producto = $request->line;
        $req->comentario = "SALVADO";

        $req->informacion = $request->information;
        $req->telefono = $request->phone;
        $req->categoria = '';
        $req->nombre_tecnico = $request->name;
        $req->timestamps = false;
        $req->save();

        $id_sol = $req->id_sol;

        $req_rev = new RevisionIngenieria;
        $req_rev->idsol = $id_sol;
        $req_rev->comentarios = "SALVADO";
        $req_rev->fecha_comentario = $now->format('Y-m-d H:i:s');
        $req_rev->timestamps = false;
        $req_rev->save();

        $req_detail = new DetalleSolicitud;
        $req_detail->id_sol = $id_sol;
        $req_detail->fecha_envio = $now->format('Y-m-d H:i:s');
        $req_detail->status = "SALVADO";
        $req_detail->usuario = Session::get('username');
        $req_detail->responsable = "SALVADO";
        $req_detail->fecha_cerrada = $now->format('Y-m-d H:i:s');
        $req_detail->save();

        return response()->json(['ok' => 'true', 'message' => 'Solicitud Salvada Correctamente']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Returns  the questions  related to the fail mode
     * @param  \Illuminate\Http\Request  $request
     */
    public function questions(Request $request)
    {
        if (!empty($request->id_fail) && !empty($request->id_line) && !empty($request->id_info)) {
            $questions = PreguntaSolicitud::select('id_pregunta', 'pregunta', DB::raw('tipo + 0 as tipo'), 'tooltip')
                ->where('id_fallo', $request->id_fail)
                ->where('id_lineaproducto', $request->id_line)
                ->where('id_tiposolicitud', $request->id_info)
                ->get();
            if (count($questions) > 0) {
                return response()->json(['ok' => true, 'html' => $questions]);
            } else {
                return response()->json(['ok' => false, 'html' => '']);
            }
        } else {
            return response()->json(['ok' => false, 'html' => '']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = Solicitud::find($id);
        $aux = DispatchAbiertos::where('dispatch', $solicitud->dispatch)->select('brand')->get();
        if (count($aux) > 0) {
            $solicitud->brand = $aux[0]['brand'];
        } else { $solicitud->brand = '';}
        $information = TipoInformacion::all();
        $mode_fail = ModoFallas::all();
        $line = LineaProducto::all();
        $questions = DB::table('respuestas_solicitud')
            ->join('preguntas_solicitud', 'respuestas_solicitud.id_pregunta', '=', 'preguntas_solicitud.id_pregunta')
            ->join('solicitud_ingenieria', 'respuestas_solicitud.id_solicitud', '=', 'solicitud_ingenieria.id_sol')
            ->select('preguntas_solicitud.pregunta', 'respuestas_solicitud.respuesta', 'respuestas_solicitud.ruta',DB::raw("CONCAT(id_solicitud,'/',preguntas_solicitud.id_pregunta) AS path"))
            ->where('solicitud_ingenieria.id_sol', '=', $solicitud->id_sol)
            ->get();

        foreach ($questions as $value) {
            $mime = DocumentoController::mimeType($value->ruta);
            $value->mimeType = $mime;
            $result = explode('/', $mime);
            $value->tipo =  $result[0];
        }

        $document = TipoAyuda::all();
        $revision = RevisionIngenieria::where('idsol', $id)->get();
        $user = Session::get('username');
        $depto = Session::get('depto');
        $items = Menu::getMenu2($user);


        // Code added by Noé Delgado <noe_delgado_munoz_proceti@whirlpool.com>
        // Traemos todas las solicitudes que se han generado por la serie de la solicitud que se este consultando.

        $closed_cases = array();
        $closed_cases = DB::table('detalle_solicitud')
                                ->leftjoin('solicitud_ingenieria', 'solicitud_ingenieria.id_sol', '=', 'detalle_solicitud.id_sol')
                                ->select('solicitud_ingenieria.id_sol', 'solicitud_ingenieria.serie', 'solicitud_ingenieria.dispatch', 'detalle_solicitud.status')
                                ->where('solicitud_ingenieria.serie', '=' , $solicitud->serie)
                                ->get();

        // Verificamos si Ingenieria contesto esta solicitud.
         $sol_ing_csat = DB::table('sol_ing_csat')
            ->select('sol_ing_csat.ing_q1', 'sol_ing_csat.ing_q2', 'sol_ing_csat.ing_q3', 'sol_ing_csat.ing_usr_agnt')
            ->where('sol_ing_csat.id_sol', '=', $solicitud->id_sol)
            ->whereNotNull('sol_ing_csat.ing_usr_agnt')
            ->get();

        return view("pages.solicitud.view", ['items' => $items,
            "mode_fail" => $mode_fail,
            "information" => $information,
            "line" => $line,
            "questions" => $questions,
            "document" => $document,
            "solicitud" => [$solicitud],
            "revision" => $revision,
            "closed_cases" => $closed_cases,
            "depto" => $depto,
            "sol_ing_csat" => $sol_ing_csat,
            "id" => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        if (!empty($request->dispatch)) {
            $data = DispatchAbiertos::validate($request->dispatch);
            $array = array();
            if (count($data) > 0) {
                if(!$data['valid'])
                return response()->json(['ok' => false, 'data_search' => '', 'message' => $data['validMessage']]);

                $array['modelo'] = $data[0]->model_number;
                $array['serie'] = $data[0]->serial_number;
                $array['marca'] = $data[0]->brand;
                $array['descripcion_problema'] = $data[0]->problem_description;
                return response()->json(['ok' => true, 'data_search' => $array]);
            } else {
                return response()->json(['ok' => false, 'data_search' => '']);
            }
        } else {
            return response()->json(['ok' => false, 'data_search' => '']);
        }
    }
    
    public function infoHelpDocuments(Request $request)
    {
        if (!empty($request->model)) {
            $document = DocumentosAyuda::where('modelo', 'like', '%' . $request->model . '%')->get();
            if (count($document) > 0) {
                return response()->json(['ok' => true, 'html' => view("pages.solicitud.info-help-documents", ['document' => $document])->render()]);
            } else {
                return response()->json(['ok' => false, 'html' => '']);
            }
        } else {
            return response()->json(['ok' => false, 'html' => '']);
        }
    }

    public function infoSolvedCases(Request $request)
    {
        $url = config('pages.globals.url');
        if (!empty($request->model)) {
            $faqs = DB::table('solicitud_ingenieria')
            // ->join('preguntas_solicitud', 'respuestas_solicitud.id_pregunta', '=', 'preguntas_solicitud.id_pregunta')
            // ->join('solicitud_ingenieria', 'respuestas_solicitud.id_solicitud', '=', 'solicitud_ingenieria.id_sol')
                ->select('solicitud_ingenieria.*')
                ->where('solicitud_ingenieria.modelo', 'like', '%' . $request->model . '%')
                ->select('solicitud_ingenieria.id_sol')
                ->distinct()
                ->get();

            if (count($faqs) > 0) {
                return response()->json(['ok' => true, 'html' => view("pages.solicitud.info-solved-cases", ['faqs' => $faqs])->render()]);
            } else {
                return response()->json(['ok' => false, 'html' => '']);
            }
        } else {
            return response()->json(['ok' => false, 'html' => '']);
        }
    }

    // Send mail.
    public function send_mail_php($to, $subject, $e_message, $title)
    {
        $base_url = "https://soluciones.refaccionoriginal.com/lar/";
        if(!isset($to))
        {
            $to = 'noe_delgado_munoz_proceti@whirlpool.com';
        }
        $Bcc = 'noe_delgado_munoz_proceti@whirlpool.com';
        $f_title = 'Whirlpool Service';
        $f_mail = 'no-responder-service@whirlpool.com';
        $header = 'MIME-Version: 1.0' . "\r\n";
        $header .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $header .= 'From: '.$f_title.' <'.$f_mail.'>' . "\r\n";
        $header .= 'Bcc: '.$Bcc. "\r\n";

        $body_message = $e_message;


        $email_template = file_get_contents("D:/inetpub/wwwroot/soluciones/wpx_includes/mailing/email_template.html");
        $body_message = str_replace(array("{base_url}",
                          "{body_message}",
                          "{title}"
                          ),
                        array($base_url,
                          $body_message,
                          $title
                          ),
                        $email_template
                        );

        $send_email = mail(filter_var($to, FILTER_SANITIZE_EMAIL), $subject, $body_message, $header);
    }

}
