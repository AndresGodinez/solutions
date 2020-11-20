<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadStockFinalRequest;
use App\Models\Menu;
use App\Models\IngexpModel;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use function compact;
use function date;
//use Symfony\Component\HttpFoundation\Session\Session;
use Session;
use Illuminate\Support\Facades\DB;


date_default_timezone_set("America/Mexico_City");

class IngexpController extends Controller
{
    public $dirupload =  "\\storage\\app\\";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function cargar()
    {

        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = IngexpModel::get_records();
        return view("Ingexp.cargar", compact('get_records'));
    }


    public function cargarpost(Request $request)
    {
        $file = $request->file('uploadedfile');        
        $user       = Auth::user()->username;        

        IngexpModel::cargar($_POST,$user,$_FILES,$file);

        $urldirv = url('/ingexp/cargar?success=1');
        echo "<script>window.location = '".$urldirv."'</script>";
        
    }

    public function cargarpostedit(Request $request)
    {
        $file = $request->file('uploadedfile');        
        $user       = Auth::user()->username;        

        IngexpModel::cargaredit($_POST,$user,$_FILES,$file);

        $urldirv = url('/ingexp/editar/');
        echo "<script>window.location = '".$urldirv."/".$_POST['id']."?success=1'</script>";
        
    }


    public function editar()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        
        
        $tipo = false;
        $linea = false;

        if(isset($_GET['tipo'])){
            $tipo = $_GET['tipo'];
        }
        if(isset($_GET['linea'])){
            $linea = $_GET['linea'];
        }
        $get_records = IngexpModel::get_list($tipo, $linea); 

        $datos = IngexpModel::get_records();               
        return view("Ingexp.editar", compact('get_records','datos'));
    }



    public function buscar()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        
        
        $tipo = false;
        $linea = false;

        if(isset($_GET['tipo'])){
            $tipo = $_GET['tipo'];
        }
        if(isset($_GET['linea'])){
            $linea = $_GET['linea'];
        }
        $get_records = IngexpModel::get_list($tipo, $linea); 
        
        $datos = IngexpModel::get_records();               
        return view("Ingexp.buscar", compact('get_records','datos'));
    }

    
    public function editardetail(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = IngexpModel::get_edit($request->id);  
        $id = $request->id;      
        $get_records_dt = IngexpModel::get_records();       
        return view("Ingexp.editardetail", compact('get_records','id','get_records_dt'));
    }


    public function visor(Request $request)
    {    
        
        $id = $request->id;      
        $archivo_carga = IngexpModel::visor($id);       
        $archivo_carga = $archivo_carga[0]['archivo_carga'];

        
        $o_en = file_get_contents(storage_path().'/app/'.$archivo_carga);        
        $d = base64_encode($o_en);
        
        $path = storage_path('/app/'.$archivo_carga);

        ini_set('display_errors', 1);
        
        if($archivo_carga){

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
                case 'zip':                     
                    return response()->download($path);
                    die();
                    break;
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
                            <title>Ver Video - <?php echo $archivo_carga?></title>

                        <style>
                        .video-container {
                        padding-bottom:56.25%;
                        height:0; overflow: hidden;
                        position: relative;
                        }
                        
                        .frame {
                        position: absolute;
                        height:100%;
                        width:100%;
                        top:0;
                        left:0;
                        }
                        </style>
                        </head>

                        <body>
                        <div class="video-container">
                        <video class="frame"  autoplay controls controlsList="nodownload">
                            <!-- <source src="<?=$path?>" type="video/mp4">                              -->
                            <source type="video/webm" src="data:video/webm;base64, <?=$d?>">
	                        <source type="video/mp4" src="data:video/mp4;base64, <?=$d?>">
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



    public function solicitaracceso(Request $request){    
        $modo = 'registro';
        return view("Ingexp.solicitaracceso", compact('modo'));
    }
    public function solicitaracceso_login(Request $request){        
        $modo = 'login';
        return view("Ingexp.solicitaracceso", compact('modo'));
    }

    public function cargardetallessolicitud(Request $request){

        $data = IngexpModel::get_solictud($request->id);
        return view("Ingexp.cargardetallesuser", compact('data'));
    }

    public function changeestatussolicitud(){
        if($_POST['statuschange']){
            DB::table('ing_solicitaracceso')
            ->where('id', $_POST['id'])
            ->update(['status' => $_POST['statuschange']]);
        }
    }

    public function acceso()
    {

                
        $tipo = false;
        $linea = false;

        if(isset($_GET['tipo'])){
            $tipo = $_GET['tipo'];
        }
        if(isset($_GET['linea'])){
            $linea = $_GET['linea'];
        }
        $get_records = IngexpModel::get_list($tipo, $linea); 

        $datos = IngexpModel::get_records();               
        return view("Ingexp.acceso", compact('get_records','datos'));
    }


    public function solicitaracceso_procesar(Request $request){             
        $get_records = IngexpModel::solicitaracceso($_POST); 
        echo $get_records;
    }


    public function listadeacceso(){
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = IngexpModel::get_listadesolicitud();
        return view("Ingexp.listadeacceso", compact('get_records'));
    }
}

