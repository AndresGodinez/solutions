<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadStockFinalRequest;
use App\Models\Menu;
use App\Models\AlcoparModel;
use App\Usuario;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function compact;
use function date;
//use Symfony\Component\HttpFoundation\Session\Session;
use Session;
use Illuminate\Support\Facades\DB;
use function header;
use function ini_set;
use function set_time_limit;
use function view;


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
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['parte']))]);
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

        $request->session()->put(['categoria_extra'=>trim(strtoupper($_POST["categoria_extra"]))]);


        $request->session()->put(['familia'=>trim(strtoupper($_POST["familia"]))]);
        $request->session()->put(['marca1'=>trim(strtoupper($_POST["marca1"]))]);

        $request->session()->put(['categoria'=>trim(strtoupper($_POST["categoria"]))]);

        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);

        $request->session()->put(['descripcion'=>trim(strtoupper($_POST["descripcion"]))]);

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




        if(isset($_REQUEST['grabar'])){
            $nomenclatura = $tipo_material.$categoria.$familia.$marca.$categoria_extra;

            $datos = array('tipo_material' => $tipo_material,
            'categoria' => $categoria,
            'familia' => $familia,
            'marca' => $marca,
            'tipo_extra' => $categoria_extra,
            'nomenclatura_service' => $nomenclatura);
            AlcoparModel::updateProcesa('updatePartes',$alcopar_id, $datos);

            AlcoparModel::procesaaceptar();
            $urldirv = url('/alcopar/reving?success=1');


            echo "<script>window.location = '".$urldirv."'</script>";

        }
        else if(isset($_REQUEST['cancelar'])) {
            AlcoparModel::cancelar2();
            $urldirv = url('/alcopar/reving?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
        else if(isset($_REQUEST['rechazar'])) {

            $urldirv = url('/alcopar/reving/procesarechazar');
            echo "<script>window.location = '".$urldirv."'</script>";
        }

        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignar();
            $urldirv = url('/alcopar/reving?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
    }

    public function procesarechazar1(Request $request){
        $request->session()->put(['razon'=>trim(strtoupper($_POST["rechazo"]))]);
        $v = AlcoparModel::rechazar();
        if(!$v){

            $urldirv = url('/alcopar/reving/procesarechazar3');
            echo "<script>window.location = '".$urldirv."'</script>";
        }else{

            $urldirv = url('/alcopar/reving?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
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

        try{
            $v = AlcoparModel::rechazar2();
            if($v){

                $urldirv = url('/alcopar/reving/?success=1');
                echo "<script>window.location = '".$urldirv."'</script>";
            }else{
                echo "<script>window.location = './'</script>";
            }
        }catch(Exception $e){
            $urldirv = url('/alcopar/reving/?error=1');
            echo "<script>window.location = '".$urldirv."'</script>";
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

        $request->session()->put(['alcopar_id'=>$id]);
        $request->session()->put(['pieza_alcopar'=>trim(strtoupper($get_records['row'][0]['parte']))]);
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
            $urldirv = url('/alcopar/factible/?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
        else if(isset($_REQUEST['rechazar'])) {

            $urldirv = url('/alcopar/factible/procesarechazar');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignarfac();

            $urldirv = url('/alcopar/factible/?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
    }


    public function procesarechazarfac(){

        $get_records = AlcoparModel::getprocesorechazar();
        $nombre  = Auth::user()->nombre;
        print_r($nombre);
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
    public function  altamaterialupdate_addcorreo (Request $request){
        $username       = Auth::user()->username;
        $mail  =          Auth::user()->mail;
        $depto  =          Auth::user()->depto;
        $id_alcopar=session('id');

        DB::table('alcopar_partes_mail')->insert(
            [
                'idalcopar'=>$id_alcopar,
                'mail'=>$mail
            ]
        );

        $urldirv = url('/alcopar/altamaterial?success=1');

        echo "<script language='JavaScript'>
                alert('Fuiste agregado a la lista para recibir correo cuando se termine el proceso de alta de parte');
                window.location = '".$urldirv."';
            </script>";

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

            $urldirv = url('/alcopar/altamaterial?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
        else{
            $urldirv = url('/alcopar/altamaterial/existente');
            echo "<script>window.location = '".$urldirv."'</script>";
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


        $urldirv = url('/alcopar/altamaterial');
        echo "<script>window.location = '".$urldirv."'</script>";

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
            'clasif_sat'=>0,

            // 'precio'=>'1',
            // 'costo'=>'0',
            // 'factible'=>'0',

            'clasif_sat_user' => $username,
            'comentario_clasif_sat'=>$comentario,
            'codigo_clasif_sat' => $clasificacion,
            'clas_sat_status' => 'CLASIFICACION AGREGADA'
        ];
        AlcoparModel::updateProcesaGeneral('alcopar_partes','id',$alcopar_id,$datos);
        $urldirv = url('/alcopar/classat?success=1');
        echo "<script>window.location = '".$urldirv."'</script>";

    }



    public function precio(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::get_precio();
        return view("Alcopar.precio", compact('get_records'));
    }

    public function descargaPrecio(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=Reporte de precios.xls');

        $getRecords = AlcoparModel::get_precio();

        return view('Alcopar.download', compact('getRecords'));

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
        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);
        $request->session()->put(['asigna'=>trim(strtoupper($_POST["asigna"]))]);
        //$request->session()->put(['costo'=>trim(strtoupper($_POST["costo"]))]);
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

            $urldirv = url('/alcopar/precio?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignarprecio();
            $urldirv = url('/alcopar/precio?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
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
        $request->session()->put(['comentario'=>trim(strtoupper($_POST["comentario"]))]);
        $request->session()->put(['asigna'=>trim(strtoupper($_POST["asigna"]))]);
        //$request->session()->put(['costo'=>trim(strtoupper($_POST["costo"]))]);

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
            $urldirv = url('/alcopar/oow?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";

        }
        else if(isset($_REQUEST['reasignar'])) {
            AlcoparModel::reasignaroow();
            $urldirv = url('/alcopar/oow?success=1');
            echo "<script>window.location = '".$urldirv."'</script>";
        }
    }

    public function reportalcopardescarga(){
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        return view("Alcopar.reportalcopardescarga");
    }

    public function reportalcopar(Request $request){
        ini_set('memory_limit', '-1');
        if (!!$request->get('modelo')){
            $row = AlcoparModel::query()->selectRaw('
        alcopar_partes.id,
                alcopar_partes.fecha,
                alcopar_partes.parte,
                alcopar_partes.`status`,
                comentario AS substatus,
                descripcion,
                modelo,
                taller,
                dispatch,
                sust,
                username,
                motivo,
                depto,
                ing,
                comentario_reving,
                IF(DATEDIFF(alcopar_partes.fechareving,
                            alcopar_partes.fecha) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechareving,
                            alcopar_partes.fecha)) AS tiempo_reving,
                alcopar_partes.fechareving,
                materiales,
                comentario_mat,
                IF(DATEDIFF(alcopar_partes.fechafactible,
                            alcopar_partes.fechareving) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechafactible,
                            alcopar_partes.fechareving)) AS tiempo_factible,
                alcopar_partes.fechafactible,
                ing2,
                comentario_alta,
                IF(DATEDIFF(alcopar_partes.fechaalta,
                            alcopar_partes.fechafactible) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaalta,
                            alcopar_partes.fechafactible)) AS tiempo_alta,
                alcopar_partes.fechaalta,
                mat2,
                comentario_costo,
                IF(DATEDIFF(alcopar_partes.fechacosto,
                            alcopar_partes.fechaalta) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechacosto,
                            alcopar_partes.fechaalta)) AS tiempo_costo,
                alcopar_partes.fechacosto,
                ventas,
                comentario_precio,
                IF(DATEDIFF(alcopar_partes.fechaprecio,
                            alcopar_partes.fechacosto) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaprecio,
                            alcopar_partes.fechacosto)) AS tiempo_precio,
                alcopar_partes.fechaprecio,
                oow_user,
                comentario_oow,
                IF(DATEDIFF(alcopar_partes.fechaoow,
                            alcopar_partes.fechaprecio) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaoow,
                            alcopar_partes.fechaprecio)) AS tiempo_oow,
                alcopar_partes.fechaoow,
                alcopar_partes.clas_sat_status,
                alcopar_partes.clasif_sat_user,
                IF(DATEDIFF(alcopar_partes.fecha_clasif_sat,
                            alcopar_partes.fechafactible) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fecha_clasif_sat,
                            alcopar_partes.fechafactible)) AS tiempo_clasificacion_sat,

                pregunta,
                otros,
                tipo,
                alcopar_tipo_material.tipo_material,
                alcopar_categoria.categoria,
                alcopar_familia.familia,
                alcopar_marca.marca,
                alcopar_tipo_extra.tipo_extra,
                alcopar_partes.codigo_clasif_sat,
                alcopar_partes.nomenclatura_service')
                ->from('alcopar_partes')
                ->leftJoin('alcopar_categoria', 'alcopar_partes.categoria', '=', 'alcopar_categoria.id_categoria')
                ->leftJoin('alcopar_familia', 'alcopar_partes.familia', '=', 'alcopar_familia.id_familia')
                ->leftJoin('alcopar_marca', 'alcopar_partes.marca', '=', 'alcopar_marca.id')
                ->leftJoin('alcopar_tipo_extra', 'alcopar_partes.tipo_extra', '=', 'alcopar_tipo_extra.id')
                ->leftJoin('alcopar_tipo_material', 'alcopar_partes.tipo_material', '=', 'alcopar_tipo_material.id_tipo_material')
                ->where('alcopar_partes.modelo', $request->get('modelo'))
                // ->limit(10)
                ->get();
        }else{
            $row = AlcoparModel::query()->selectRaw('
        alcopar_partes.id,
                alcopar_partes.fecha,
                alcopar_partes.parte,
                alcopar_partes.`status`,
                comentario AS substatus,
                descripcion,
                modelo,
                taller,
                dispatch,
                sust,
                username,
                motivo,
                depto,
                ing,
                comentario_reving,
                IF(DATEDIFF(alcopar_partes.fechareving,
                            alcopar_partes.fecha) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechareving,
                            alcopar_partes.fecha)) AS tiempo_reving,
                alcopar_partes.fechareving,
                materiales,
                comentario_mat,
                IF(DATEDIFF(alcopar_partes.fechafactible,
                            alcopar_partes.fechareving) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechafactible,
                            alcopar_partes.fechareving)) AS tiempo_factible,
                alcopar_partes.fechafactible,
                ing2,
                comentario_alta,
                IF(DATEDIFF(alcopar_partes.fechaalta,
                            alcopar_partes.fechafactible) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaalta,
                            alcopar_partes.fechafactible)) AS tiempo_alta,
                alcopar_partes.fechaalta,
                mat2,
                comentario_costo,
                IF(DATEDIFF(alcopar_partes.fechacosto,
                            alcopar_partes.fechaalta) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechacosto,
                            alcopar_partes.fechaalta)) AS tiempo_costo,
                alcopar_partes.fechacosto,
                ventas,
                comentario_precio,
                IF(DATEDIFF(alcopar_partes.fechaprecio,
                            alcopar_partes.fechacosto) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaprecio,
                            alcopar_partes.fechacosto)) AS tiempo_precio,
                alcopar_partes.fechaprecio,
                oow_user,
                comentario_oow,
                IF(DATEDIFF(alcopar_partes.fechaoow,
                            alcopar_partes.fechaprecio) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fechaoow,
                            alcopar_partes.fechaprecio)) AS tiempo_oow,
                alcopar_partes.fechaoow,
                alcopar_partes.clas_sat_status,
                alcopar_partes.clasif_sat_user,
                IF(DATEDIFF(alcopar_partes.fecha_clasif_sat,
                            alcopar_partes.fechafactible) < 0,
                    0,
                    DATEDIFF(alcopar_partes.fecha_clasif_sat,
                            alcopar_partes.fechafactible)) AS tiempo_clasificacion_sat,

                pregunta,
                otros,
                tipo,
                alcopar_tipo_material.tipo_material,
                alcopar_categoria.categoria,
                alcopar_familia.familia,
                alcopar_marca.marca,
                alcopar_tipo_extra.tipo_extra,
                alcopar_partes.codigo_clasif_sat,
                alcopar_partes.nomenclatura_service')
                ->from('alcopar_partes')
                ->leftJoin('alcopar_categoria', 'alcopar_partes.categoria', '=', 'alcopar_categoria.id_categoria')
                ->leftJoin('alcopar_familia', 'alcopar_partes.familia', '=', 'alcopar_familia.id_familia')
                ->leftJoin('alcopar_marca', 'alcopar_partes.marca', '=', 'alcopar_marca.id')
                ->leftJoin('alcopar_tipo_extra', 'alcopar_partes.tipo_extra', '=', 'alcopar_tipo_extra.id')
                ->leftJoin('alcopar_tipo_material', 'alcopar_partes.tipo_material', '=', 'alcopar_tipo_material.id_tipo_material')
                ->get();
        }

        if (!$row->count()){
            throw ValidationException::withMessages(['No existen datos para descargar']);
        }

        $row2Count = $row->count();


            echo "<pre>";
            $return = '';
            if($row2Count>0){
                $return .= '<table border=1>
                <tr>
                    <th style="color:rgb(255,255,255);background-color:#000066;">id</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">fecha</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">parte</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">status</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">substatus</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">descripcion</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">modelo</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">taller</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">dispatch</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">sust</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">username</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">motivo</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> depto</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> ing</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">comentario_reving</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tiempo_reving</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">fechareving</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">materiales</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> comentario_mat</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> tiempo_factible</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">fechafactible</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> ing2</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> comentario_alta</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> tiempo_alta</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">fechaalta</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> mat2</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> comentario_costo</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> tiempo_costo</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> fechacosto</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> ventas</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> comentario_precio</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tiempo_precio </th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">fechaprecio</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">oow_user</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> comentario_oow</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> tiempo_oow</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> fechaoow</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">clas_sat_status</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">clasif_sat_user</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tiempo_clasificacion_sat</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">pregunta</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">otros</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tipo</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tipo_material</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> categoria</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> familia</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;"> marca</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">tipo_extra</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">codigo_clasif_sat</th>
                    <th style="color:rgb(255,255,255);background-color:#000066;">nomenclatura_service</th>
                </tr>
                ';
                foreach($row as $v){
                    $return .= '<tr>
                    <td>'.$v['id'].'</td>
                    <td>'.$v['fecha'].'</td>
                    <td>'.$v['parte'].'</td>
                    <td>'.$v['status'].'</td>
                    <td>'.$v['substatus'].'</td>
                    <td>'.$v['descripcion'].'</td>
                    <td>'.$v['modelo'].'</td>
                    <td>'.$v['taller'].'</td>
                    <td>'.$v['dispatch'].'</td>
                    <td>'.$v['sust'].'</td>
                    <td>'.$v['username'].'</td>
                    <td>'.$v['motivo'].'</td>
                    <td>'.$v[' depto'].'</td>
                    <td>'.$v[' ing'].'</td>
                    <td>'.$v['comentario_reving'].'</td>
                    <td>'.$v['tiempo_reving'].'</td>
                    <td>'.$v['fechareving'].'</td>
                    <td>'.$v['materiales'].'</td>
                    <td>'.$v[' comentario_mat'].'</td>
                    <td>'.$v[' tiempo_factible'].'</td>
                    <td>'.$v['fechafactible'].'</td>
                    <td>'.$v[' ing2'].'</td>
                    <td>'.$v[' comentario_alta'].'</td>
                    <td>'.$v[' tiempo_alta'].'</td>';

                    // if($v['fechaalta'] = '0000-00-00'){
                    //     $return .= '<td>'.$v['fechaalta'].'</td>';
                    // }else if($v['fechaalta'] = '0'){
                    //     $return .= '<td>'.$v['fechaalta'].'</td>';
                    // }else{
                    //     $return .= '<td>'.htmlspecialchars(date('d/m/Y H:i:s',$v['fechaalta']));
                    // }
                    $return .= '<td>'.$v['fechaalta'].'</td>';
                    //$return .= '<td>'.htmlspecialchars(date('d/m/Y H:i:s',$v['fechaalta']));

                    $return .= '<td>'.$v[' mat2'].'</td>
                    <td>'.$v[' comentario_costo'].'</td>
                    <td>'.$v[' tiempo_costo'].'</td>
                    <td>'.$v[' fechacosto'].'</td>
                    <td>'.$v[' ventas'].'</td>
                    <td>'.$v[' comentario_precio'].'</td>
                    <td>'.$v['tiempo_precio '].'</td>
                    <td>'.$v['fechaprecio'].'</td>
                    <td>'.$v['oow_user'].'</td>
                    <td>'.$v[' comentario_oow'].'</td>
                    <td>'.$v[' tiempo_oow'].'</td>
                    <td>'.$v[' fechaoow'].'</td>
                    <td>'.$v['clas_sat_status'].'</td>
                    <td>'.$v['clasif_sat_user'].'</td>
                    <td>'.$v['tiempo_clasificacion_sat'].'</td>
                    <td>'.$v['pregunta'].'</td>
                    <td>'.$v['otros'].'</td>
                    <td>'.$v['tipo'].'</td>
                    <td>'.$v['tipo_material'].'</td>
                    <td>'.$v[' categoria'].'</td>
                    <td>'.$v[' familia'].'</td>
                    <td>'.$v[' marca'].'</td>
                    <td>'.$v['tipo_extra'].'</td>
                    <td>'.$v['codigo_clasif_sat'].'</td>
                    <td>'.$v['nomenclatura_service'].'</td>
                    </tr>
                    ';

                }
                $return .= '</table>';


            }
            #Cambiando el content-type mÃ¡s las <table> se pueden exportar formatos como csv
            header("Content-Type: application/vnd.ms-excel");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=alcopar_partes.xls");
            echo $return;
    }

    public function historial(Request $request){
        echo "<table style='width:100%;'>
            <tr>
                <td colspan='4' style='color:#999999;font-weight:bold; border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>
                    COMENTARIOS
                </td>
            </tr>

        <th style='font-weight:bold; background-color:#999999;border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>COMENTARIOS:</th>
        <th style='font-weight:bold; background-color:#999999;border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>FECHA DE ASIGNACION</th>
        <th style='font-weight:bold; background-color:#999999;border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>USUARIO:</th>
        <th style='font-weight:bold; background-color:#999999;border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>MODULO ANTERIOR:</th>
        <th style='font-weight:bold; background-color:#999999;border-bottom:2px solid;border-bottom-color:#999999;text-align:center;font-size:12px'>MODULO ACTUAL:</th>";

        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = AlcoparModel::historial($request->id);
        foreach($get_records as $row){
                echo "<tr>";
                echo "
                        <td style='color:#999999;font-size:12px; text-align:left; border-bottom:1px solid; border-bottom-color:#999999;'>" . $row['comentarios'] . "</td>
                        <td style='color:#999999;font-size:12px; text-align:left; border-bottom:1px solid; border-bottom-color:#999999;'>" . $row['fecha_asignacion'] . "</td>
                        <td style='color:#999999;font-size:12px; text-align:left; border-bottom:1px solid; border-bottom-color:#999999;'>" .$row['usuario']. "</td>
                        <td style='color:#999999;font-size:12px; text-align:left; border-bottom:1px solid; border-bottom-color:#999999;'>" .$row['modulo_ant']. "</td>
                        <td style='color:#999999;font-size:12px; text-align:left; border-bottom:1px solid; border-bottom-color:#999999;'>" .$row['modulo_act']. "</td>
                    </tr>";
            }
            echo "</table>";

    }


    public function testmail(Request $request){


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
                <p></p>
                <p>Por este medio te informamos que la solictud de alta de parte ha sido CANCELADA y se agregó a tu bandeja de pedidos la solicitud por motivo de cancelación de alta de parte.<br> </p>
                <p></p>
                <p></p>
                <br>
                INFORMACION DE LA SOLICITUD
                <p></p>
                N&uacute;mero de Parte : <br>
                Descripci&oacute;n : <br>
                Comentarios : <br>
                Dispatch : <br>
                <p></p>
                Motivo de la cancelacion : <br>
                Comentario Ingenieria : <br>
                <p>
            ";


        $to = $request->mail;
        $subject = 'Alta de Parte Cancelada por Ingenieria.';
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";


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
                <p></p>
                <p>Por este medio te informamos que la solictud de Alta de Parte ha sido cancelada.<br> </p>
                <p></p>
                <p></p>
                <br>
                INFORMACION DE LA SOLICITUD
                <p></p>
                N&uacute;mero de Parte : <br>
                Descripci&oacute;n :<br>
                Comentarios :<br>
                Dispatch :<br>
                <p></p>
                Motivo de la cancelacion : <br>
                Comentario Ingenieria : <br>
                <p>
            ";


        $to = $request->mail;
        $subject = 'Alta de Parte Cancelada por Ingenieria.';
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

        mail($to, $subject, $email_message, $headers);

    }

}

