<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadStockFinalRequest;
use App\Models\Menu;
use App\Models\AlcoparModel;
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

class AlcoparController extends Controller
{
    public $dirupload =  "\\storage\\app\\";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function reving()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_rev_ing_alta();
        return view("Alcopar.reving", compact('get_records'));
    }

    public function revingedit(Request $request)
    {
        
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_rev_ing_alta_edit($request->id);  
        $id = $request->id;      
        $request->session()->put(['alcopar_id'=>$id]);
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['partes']))]);
        #$request->session()->put(['x'=>'b']);
        ##echo session('x');                
        return view("Alcopar.revingedit", compact('get_records','id'));
    }

    //POST
    public function procesa(Request $request)
    {
        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);
        $request->session()->put(['asigna'=>trim(strtoupper($_POST["asigna"]))]);
        $request->session()->put(['tipo_material'=>trim(strtoupper($_POST["tipo_material"]))]);
        $request->session()->put(['familia'=>trim(strtoupper($_POST["familia"]))]);
        $request->session()->put(['marca1'=>trim(strtoupper($_POST["marca1"]))]);
        
        $request->session()->put(['categoria'=>trim(strtoupper($_POST["categoria"]))]);
        
        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);
        $request->session()->put(['descripcion'=>trim(strtoupper($_POST["comentario"]))]);
       
        $alcopar_id=session('alcopar_id');
        
        $descripcion=session('descripcion');
        
        $tipo_material = session('tipo_material');
        $marca = session('marca1');
        $categoria = session('categoria');
        $familia = session('familia');
        $categoria_extra = session('categoria_extra');


        $datos = [];
        
        if($descripcion<>''){            
            $datos['descripcion'] =$descripcion;  
        }
        
        if($familia == ''){
            $familia = 0;
        }

        $nomenclatura = $tipo_material.$categoria.$familia.$marca.$categoria_extra;

        $datos = array('tipo_material' => $tipo_material,
        'categoria' => $categoria,
        'familia' => $familia,
        'marca' => $marca, 
        'tipo_extra' => $categoria_extra, 
        'nomenclatura_service' => $nomenclatura);
        AlcoparModel::updateProcesa('updatePartes',$alcopar_id, $datos);  
        
        
        //print_r($_REQUEST);
        
        //http://127.0.0.1:8000/alcopar/reving/edit/35193
        if(isset($_REQUEST['grabar'])){
            AlcoparModel::procesaaceptar();      
            echo "<script>window.location = './?success=1'</script>";
        }
        else if(isset($_REQUEST['cancelar'])) {
            AlcoparModel::cancelar2();                      
            echo "<script>window.location = './?success=1'</script>";
        }
        else if(isset($_REQUEST['rechazar'])) {            
             echo "<script>window.location = './procesarechazar'</script>";            
        }
        
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignar();          
            echo "<script>window.location = './?success=1'</script>";              
        }
    }

    public function procesarechazar1(Request $request){
        $request->session()->put(['razon'=>trim(strtoupper($_POST["rechazo"]))]);
        $v = AlcoparModel::rechazar(); 
        if(!$v){
            echo "<script>window.location = './procesarechazar3'</script>";       
        }else{
            echo "<script>window.location = './alcopar/factible'</script>";       
        }
    }

    public function procesarechazar(){
        
        $get_records = AlcoparModel::getprocesorechazar();
        $nombre  = Auth::user()->nombre;
        $alcopar_id=session('alcopar_id');        
        $alcopar=session('alcopar');
        $alcopar_nivel=session('alcopar_nivel');
        $comentario=session('comentario');

        return view("Alcopar.procesarechazar", compact('get_records','nombre','alcopar_id','alcopar','alcopar_nivel','comentario'));
    }

    public function procesarechazar3(){
        
        $get_records = AlcoparModel::getprocesorechazar();
        $nombre  = Auth::user()->nombre;
        $alcopar_id=session('alcopar_id');        
        $alcopar=session('alcopar');
        $alcopar_nivel=session('alcopar_nivel');
        $comentario=session('comentario');

        return view("Alcopar.procesarechazar3", compact('get_records','nombre','alcopar_id','alcopar','alcopar_nivel','comentario'));
    }

    public function procesarechazar4(Request $request){
        $request->session()->put(['existe'=>trim(strtoupper($_POST["existe"]))]);
        $request->session()->put(['tipo'=>trim(strtoupper($_POST["tipo"]))]);
        $request->session()->put(['sustituto'=>trim(strtoupper($_POST["sustituto"]))]);
        
        $v = AlcoparModel::rechazar2(); 
        if($v){
            echo "<script>window.location = './?success=1'</script>";       
        }else{
            echo "<script>window.location = './'</script>";
        }
        
        
    }


    //get jquery
    public function getCategoriaJquery(Request $request)
    {       
        $get_records = AlcoparModel::getCategoria($request->id);  
        print_r($get_records);
    }
    public function getFamiliaJquery(Request $request)
    {       
        $get_records = AlcoparModel::getFamilia($request->id);
        print_r($get_records);
    }
    public function getCategoriaExtraJquery(Request $request)
    {       
        $get_records = AlcoparModel::getCategoriaExtra($request->id);
        print_r($get_records);
    }

    // factible
    public function factible()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_factible();
        return view("Alcopar.factible", compact('get_records'));
    }
    public function factibledit(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_factible_edit($request->id);  
        $id = $request->id;      
        
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['partes']))]);
        #$request->session()->put(['x'=>'b']);
        ##echo session('x');                
        return view("Alcopar.factibledit", compact('get_records','id'));
    }

    //POST
    public function procesafactible(Request $request)
    {

        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);
        $request->session()->put(['asigna'=>trim(strtoupper($_POST["asigna"]))]);
        $request->session()->put(['costo'=>trim(strtoupper($_POST["costo"]))]);
        
        
        $alcopar_id=session('alcopar_id');
        $pieza=session('pieza_alcopar');


        DB::table('alcopar_partes')
            ->where('id', $alcopar_id)
            ->update([
               'costo_pieza' => $_POST["costo"]
        ]);

        AlcoparModel::updateProcesaa($pieza);  
        
        
        if(isset($_REQUEST['grabar'])){
            AlcoparModel::procesaaceptarfac();      
            echo "<script>window.location = './?success=1'</script>";
        }      
        else if(isset($_REQUEST['rechazar'])) {            
             echo "<script>window.location = './procesarechazar'</script>";            
        }        
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignarfac();          
            echo "<script>window.location = './?success=1'</script>";              
        }
    }


    public function procesarechazarfac(){
        
        $get_records = AlcoparModel::getprocesorechazar();
        $nombre  = Auth::user()->nombre;
        $alcopar_id=session('alcopar_id');        
        $alcopar=session('alcopar');
        $alcopar_nivel=session('alcopar_nivel');
        $comentario=session('comentario');

        return view("Alcopar.procesarechazarfac", compact('get_records','nombre','alcopar_id','alcopar','alcopar_nivel','comentario'));
    }

    public function procesarechazarfac1(Request $request){
        $request->session()->put(['rechazo'=>trim(strtoupper($_POST["rechazo"]))]);
        AlcoparModel::rechazarfac();         
        echo "<script>window.location = './?success=1'</script>";               

    }

    public function procesarechazarfac3(){
        
        $get_records = AlcoparModel::getprocesorechazar();
        $nombre  = Auth::user()->nombre;
        $alcopar_id=session('alcopar_id');        
        $alcopar=session('alcopar');
        $alcopar_nivel=session('alcopar_nivel');
        $comentario=session('comentario');

        return view("Alcopar.procesarechazarfac3", compact('get_records','nombre','alcopar_id','alcopar','alcopar_nivel','comentario'));
    }


    public function altamaterial()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $nombre  = Auth::user()->nombre;
        $get_records = AlcoparModel::get_material_alta();
        //$get_records = '';
        return view("Alcopar.altamaterial", compact('get_records','nombre','user'));
    }

    public function altamaterialupdate(Request $request){
        $username       = Auth::user()->username;
        $mail  =          Auth::user()->mail;
        $depto  =          Auth::user()->depto;
        
        $request->session()->put(['motivo'=>trim(strtoupper($_POST["motivo"]))]);
        $request->session()->put(['parte'=>trim(strtoupper($_POST["parte"]))]);


        $descripcion = strtoupper($_POST["descripcion"]);
        $descripcion = str_replace("'", "", $descripcion);
        $descripcion = str_replace(",", "", $descripcion);
        $descripcion = str_replace('"', '', $descripcion);

        $modelo = strtoupper($_POST["modelo"]);
        $taller = strtoupper($_POST["taller"]);
        $dispatch = strtoupper($_POST["dispatch"]);
        $donde = strtoupper($_POST["donde"]);
        $otro = strtoupper($_POST["otro"]);
        $tipo_material = strtoupper($_POST["tipo_material"]);
        $categoria = strtoupper($_POST["categoria"]);
        $familia = strtoupper($_POST["familia"]);
        $marca1 = strtoupper($_POST["marca1"]);
        $marca2 = strtoupper($_POST["marca2"]);
        $categoria_extra = strtoupper($_POST["categoria_extra"]);
        $motivo = session('motivo');
        
        $v = AlcoparModel::altamaterial(
            $username,
            $mail,
            $depto,
            $descripcion,
            $modelo,
            $taller,
            $dispatch,
            $donde,
            $otro,
            $tipo_material,
            $categoria,
            $familia,
            $marca1,
            $marca2,
            $categoria_extra,
            $motivo        
        );

        
        if($v){
            //AlcoparModel::procesaaceptarfac();      
            echo "<script>window.location = '../altamaterial?success=1'</script>";
        }      
        else{
            echo "<script>window.location = '../altamaterial/existente'</script>";              
        }

    }


    public function altamaterialexistente(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $nombre  = Auth::user()->nombre;
        $get_records = AlcoparModel::materialexistente();

        $request->session()->put(['id'=>$get_records['partes']["id"]]);
        //$get_records = '';
        return view("Alcopar.altamaterialexistente", compact('get_records','nombre','user'));
    }

    public function altamaterialexistentesave(Request $request)
    {                       
        if(isset($_REQUEST['grabar'])){        
            AlcoparModel::altamaterialexistentegrabar();
        }        
        else if(isset($_REQUEST['agrega'])) {
            AlcoparModel::altamaterialexistenteagregar();            
        }
        echo "<script>window.location = './altamaterial'</script>";    
        
    }


    public function classat(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_classat();
        return view("Alcopar.classat", compact('get_records'));
    }
    
    public function classatedit(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_factible_edit($request->id);  
        $id = $request->id;      
        $request->session()->put(['alcopar_id'=>$id]);
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['partes']))]);
        #$request->session()->put(['x'=>'b']);
        ##echo session('x');                
        return view("Alcopar.classatedit", compact('get_records','id'));
    }

    public function clasificacionconsulta(){
        $clasificacion=$_GET['clasif'];

        $row2 = AlcoparModel::query()->selectRaw('id_clasificacion')
            ->from('alcopar_clasificacion_sat')
            ->whereRaw("id_clasificacion = '" . $clasificacion."'")
            ->get();

        $row = $row2->count();                
        if($row == 0 ){
            echo "<script languaje='javascript'>alert('CLASIFICACION NO EXISTE EN BD'); 
            window.close();  
            window.opener.document.getElementById('clasif').value = '';
            window.opener.document.getElementById('clasif').focus();
            </script>";
        }
        else{
            echo "<script languaje='javascript'> window.close();</script>";
        }
    }


    public function classatguardar(Request $request){
        $alcopar_id=session('alcopar_id');
        $comentario=$_POST['comentario'];
        $username = Auth::user()->username;
        $clasificacion = $_POST['clasif'];        
        $datos  = [
            'clasif_sat_user' => $username,
            'comentario_clasif_sat'=>$comentario,
            'codigo_clasif_sat' => $clasificacion,
            'clas_sat_status' => 'CLASIFICACION AGREGADA'
        ];        
        AlcoparModel::updateProcesaGeneral('alcopar_partes','id',$alcopar_id,$datos);
        echo "<script>window.location = './?success=1'</script>";
    }



    public function precio(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_precio();
        return view("Alcopar.precio", compact('get_records'));
    }
    
    public function precioedit(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_factible_edit($request->id);  
        $id = $request->id;      
        $request->session()->put(['alcopar_id'=>$id]);
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['partes']))]);
        #$request->session()->put(['x'=>'b']);
        ##echo session('x');                
        return view("Alcopar.precioedit", compact('get_records','id'));
    }

    public function precioprocess(Request $request)
    {                       
        if(isset($_REQUEST['grabar'])){                             
            $alcopar_id=session('alcopar_id');
            $comentario=$_POST['comentario'];
            $username = Auth::user()->username;                  
            $datos  = [
                'status'=>'PENDIENTE PRECIO OOW', 
                'fechaprecio'=>date('Ymd'), 
                'precio'=>'0', 
                'oow'=>'1', 
                'ventas'=>$username, 
                'comentario_precio'=>$comentario 
            ];        
            AlcoparModel::updateProcesaGeneral('alcopar_partes','id',$alcopar_id,$datos);
            echo "<script>window.location = './?success=1'</script>";
        }        
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignarprecio();            
            echo "<script>window.location = './?success=1'</script>";
        }                
    }
   



    public function oow(Request $request)
    {
        set_time_limit(0);
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_oow();
        //print_r($get_records);
        return view("Alcopar.oow", compact('get_records'));
    }
    
    public function oowedit(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_factible_edit($request->id);  
        $id = $request->id;      
        $request->session()->put(['alcopar_id'=>$id]);
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['partes']))]);
        #$request->session()->put(['x'=>'b']);
        ##echo session('x');                
        return view("Alcopar.oowedit", compact('get_records','id'));
    }

    public function oowprocess(Request $request)
    {                       
        if(isset($_REQUEST['grabar'])){                             
            $alcopar_id=session('alcopar_id');
            $comentario=$_POST['comentario'];
            $username = Auth::user()->username;                  
            $datos  = [
                'status'=>'ALTA COMPLETADA', 
                'fechaoow'=>date('Ymd'), 
                'oow'=>'0', 
                'oow_user'=>$username, 
                'comentario_oow'=>$comentario
            ];        
            AlcoparModel::updateProcesaGeneral('alcopar_partes','id',$alcopar_id,$datos);
            echo "<script>window.location = './?success=1'</script>";
        }        
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignaroow();            
            echo "<script>window.location = './?success=1'</script>";
        }                
    }

}

