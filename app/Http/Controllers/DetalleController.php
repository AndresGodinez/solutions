<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\DetalleSolicitud;
use App\Models\SubTipoInformacion;
use App\Models\TipoInformacion;
use App\Models\Region;
use App\Models\LineaProducto;
use App\Models\RevisionIngenieria;
use App\Models\SolIngCsat;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DocumentoController;
use Illuminate\Support\Str;

use Session;
use DB;

date_default_timezone_set("America/Mexico_City");

class DetalleController extends Controller
{
    public function index()
	{
        $user = Session::get('username');
        $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $user)
                    ->get();
                    
        $filter = [];
        if($depto[0]->depto == 'TALLER') {
            $filter[] = ['detalle_solicitud.usuario', '=', session('username')];
        }

        $details = Solicitud::consulta()->where($filter)->get();

            foreach ($details as $row)
            {
                $creacion=$row->fecha_envio;
                $cerrada=$row->fecha_cerrada;
                $rechazada=$row->fecha_rechazada;
                $status=$row->status;
                $row->ruta = 'detalle';

                switch($status){
                    case 'RECHAZADA':
                        $resta=strtotime($rechazada) - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                        $row->ruta = 'solicitud';
                    break;
                    case 'CERRADA':
                        $resta=strtotime($cerrada) - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                        $row->ruta = 'solicitud';
                    break;
                    case 'EN REVISION';
                        if(Session::get('depto') != 'TALLER')
                            $row->ruta = 'detalle';
                    break;
                    default:
                        $resta=strtotime('now') - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                    break;
                }
            }

            $information = TipoInformacion::all();
            $regions = Region::all();
            $line = LineaProducto::all();
            $username = Session::get('username');
            $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $username)
                    ->get();
            $items = Menu::getMenu2($username);
            $type_slct = "";
		return view("pages.detallesolicitud.index", ['details' => $details, "information" => $information, "line" => $line, "username" => $username, "depto" => $depto[0]->depto, 'items' => $items,'regions'=>$regions, "type_slct" => $type_slct]);
    }


    // Condition for cerradas rechazadas exeptions.!
    public function cerradas_rechazadas()
    {
        $user = Session::get('username');
        $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $user)
                    ->get();

        if($depto[0]->depto == 'TALLER') { 
            $user = session('username');
            $details = Solicitud::consulta()->whereRaw('detalle_solicitud.usuario = "'.$user.'" AND (detalle_solicitud.status = "CERRADA" OR detalle_solicitud.status = "RECHAZADA"  OR detalle_solicitud.status = "SALVADO")')->get();
        }
        else
        {
            $details = Solicitud::consulta()->where('detalle_solicitud.status', '=', 'CERRADA')
                                            ->orWhere('detalle_solicitud.status', '=', 'RECHAZADA')
                                            ->orWhere('detalle_solicitud.status', '=', 'SALVADO')->get();
        }

            foreach ($details as $row)
            {
                $creacion=$row->fecha_envio;
                $cerrada=$row->fecha_cerrada;
                $rechazada=$row->fecha_rechazada;
                $status=$row->status;
                $row->ruta = 'detalle';

                switch($status){
                    case 'RECHAZADA':
                        $resta=strtotime($rechazada) - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                        $row->ruta = 'solicitud';
                    break;
                    case 'CERRADA':
                        $resta=strtotime($cerrada) - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                        $row->ruta = 'solicitud';
                    break;
                    case 'EN REVISION';
                        if(Session::get('depto') != 'TALLER')
                            $row->ruta = 'detalle';
                    break;
                    default:
                        $resta=strtotime('now') - strtotime($creacion);
                        $dia=intval($resta/60/60/24);
                        $row->dia = $dia;
                    break;
                }
            }

            $information = TipoInformacion::all();
            $regions = Region::all();
            $line = LineaProducto::all();
            $username = Session::get('username');
            $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $username)
                    ->get();
            $items = Menu::getMenu2($username);
            $type_slct = "cerradas_rechazadas";

        return view("pages.detallesolicitud.index", ['details' => $details, "information" => $information, "line" => $line, "username" => $username, "depto" => $depto[0]->depto, 'items' => $items,'regions'=>$regions, "type_slct" => $type_slct]);
    }


    // Condition for abiertas en revision exeptions.!
    public function abiertas_en_revision()
    {
        $user = Session::get('username');
        $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $user)
                    ->get();

        if($depto[0]->depto == 'TALLER') { 
            $user = session('username');
            $details = Solicitud::consulta()->whereRaw('detalle_solicitud.usuario = "'.$user.'" AND (detalle_solicitud.status = "ABIERTO" OR detalle_solicitud.status = "EN REVISION")')->get();
        }
        else
        {
            $details = Solicitud::consulta()->where('detalle_solicitud.status', '=', 'ABIERTO')
                                            ->orWhere('detalle_solicitud.status', '=', 'EN REVISION')->get();
        }

        foreach ($details as $row)
        {
            $creacion=$row->fecha_envio;
            $cerrada=$row->fecha_cerrada;
            $rechazada=$row->fecha_rechazada;
            $status=$row->status;
            $row->ruta = 'detalle';

            switch($status){
                case 'RECHAZADA':
                    $resta=strtotime($rechazada) - strtotime($creacion);
                    $dia=intval($resta/60/60/24);
                    $row->dia = $dia;
                    $row->ruta = 'solicitud';
                break;
                case 'CERRADA':
                    $resta=strtotime($cerrada) - strtotime($creacion);
                    $dia=intval($resta/60/60/24);
                    $row->dia = $dia;
                    $row->ruta = 'solicitud';
                break;
                case 'EN REVISION';
                    if(Session::get('depto') != 'TALLER')
                        $row->ruta = 'detalle';
                break;
                default:
                    $resta=strtotime('now') - strtotime($creacion);
                    $dia=intval($resta/60/60/24);
                    $row->dia = $dia;
                break;
            }
        }

        $information = TipoInformacion::all();
        $regions = Region::all();
        $line = LineaProducto::all();
        $username = Session::get('username');
        $depto = DB::table('usuarios')
                ->select('usuarios.depto')
                ->where('username', $username)
                ->get();
        $items = Menu::getMenu2($username);
        $type_slct = "abiertas_en_revision";

        return view("pages.detallesolicitud.index", ['details' => $details, "information" => $information, "line" => $line, "username" => $username, "depto" => $depto[0]->depto, 'items' => $items,'regions'=>$regions, "type_slct" => $type_slct]);
    }

    public function detail($id_sol)
	{
        
        $detail = Solicitud::where('id_sol', $id_sol)->first();
        $information = TipoInformacion::all();
        $line = LineaProducto::all();
        $subtype = SubTipoInformacion::where('id_tipo', $detail->informacion)->get();
        $user = Session::get('username');
        
        $depto = DB::table('usuarios')
                    ->select('usuarios.depto')
                    ->where('username', $user)
                    ->get();

        $view = ($depto[0]->depto != 'TALLER') ? 'show' : 'showtaller' ; 
        $revision = ($depto[0]->depto == 'TALLER') ? RevisionIngenieria::where('idsol', $detail->id_sol)->get() : '';
        $questions = DB::table('respuestas_solicitud')
        ->join('preguntas_solicitud', 'respuestas_solicitud.id_pregunta', '=', 'preguntas_solicitud.id_pregunta')
        ->join('solicitud_ingenieria', 'respuestas_solicitud.id_solicitud', '=', 'solicitud_ingenieria.id_sol')
        ->select('preguntas_solicitud.pregunta', 'respuestas_solicitud.respuesta', 'respuestas_solicitud.ruta',DB::raw("CONCAT(id_solicitud,'/',preguntas_solicitud.id_pregunta) AS path"))
        ->where('solicitud_ingenieria.id_sol', '=', $detail->id_sol)
        ->get();


        // Consultar la información de que status esta la solicitud.
        $detail_status = Solicitud::join('detalle_solicitud', 'solicitud_ingenieria.id_sol', '=', 'detalle_solicitud.id_sol')
            ->select('detalle_solicitud.id_sol', 'detalle_solicitud.status')
            ->where('solicitud_ingenieria.id_sol', $id_sol)->first();
        
        // Validamos si esta abierto y al ingresar el ingeniero se debe de poner el update de que esta EN REVISION.
        if($detail_status->status == "ABIERTO" && $depto[0]->depto == "INGENIERIA")
        { 
            DetalleSolicitud::where('id_sol', $detail_status->id_sol)->update(['status' => 'EN REVISION', 'responsable' => $user, 'fecha_revision' => date('Y-m-d H:i:s')]);
        }

        // Code added by Noé Delgado <noe_delgado_munoz_proceti@whirlpool.com>
        // Traemos todas las solicitudes que se han generado por la serie de la solicitud que se este consultando.

        $closed_cases = array();
       
        if($detail_status->status == "EN REVISION" || $detail_status->status == "CERRADA")
        {
            $closed_cases = DB::table('detalle_solicitud')
                                    ->leftjoin('solicitud_ingenieria', 'solicitud_ingenieria.id_sol', '=', 'detalle_solicitud.id_sol')
                                    ->select('solicitud_ingenieria.id_sol', 'solicitud_ingenieria.serie', 'solicitud_ingenieria.dispatch', 'detalle_solicitud.status')
                                    ->where('solicitud_ingenieria.serie', '=' , $detail->serie)
                                    ->get();
        }

        foreach ($questions as $value) 
        {
            $mime = DocumentoController::mimeType($value->ruta);
            $value->mimeType = $mime;
            $result = explode('/', $mime);
            $value->tipo =  $result[0];
        }

		return view("pages.detallesolicitud.$view", ['questions'=> $questions, "detail" => $detail, "subtype" => $subtype, "information" => $information, "line" => $line, "revision" => $revision, "closed_cases" => $closed_cases]);
    }

    // Funcion para contestar las solicitudes a Ing.
    public function quests_ing(Request $request)
    {
        $ok = "success";
        $message = "¡Evaluación enviada correctamente!";

        if(empty($request->ipt_q1))
        {
            $ok = "";
            $message = "Por favor ingresa una opción de la a) -> b) sobre la información de Ingeniería.";
        }
        elseif(empty($request->ipt_q3))
        {
            $ok = "";
            $message = "Por favor ingresa una opción de Si/No sobre recomendar este servicio.";
        }
    
        if(!empty($ok))
        {
            DB::table('sol_ing_csat')->where('id_sol', $request->id_request)->update(['tall_q1' => $request->ipt_q1, 
                                                                            'tall_q2' => $request->ipt_q2,
                                                                            'tall_usr_agnt' => Session::get('username'),
                                                                            'update_date' => date('Y-m-d H:i:s')]);
        }

        return response()->json([ 'ok' => $ok, 'message' => $message]);
    }

    public function create(Request $request)
    {
        if(!empty($request->id_request))
        {
            $image = $request->file('file');

			if( !empty($image) )
			{
                $new_name = Str::uuid().'.' . $image->getClientOriginalExtension();
                $image->storeAS('dispatch/' . $request->id_request . '/', $new_name);

			}else{ $new_name = ''; }

            //$now = new \DateTime();
            $req = new RevisionIngenieria;
            $req->idsol 				= $request->id_request;
            $req->comentarios 			= $request->comments;
            $req->ruta 					= $new_name;
            $req->fecha_comentario 		= date('Y-m-d H:i:s');
            $req->timestamps = false;
            $req->save();

            $answer = new SolIngCsat;
            $answer->id_sol         =  $request->id_request;
            $answer->ing_q1         =  $request->ipt_q1;
            $answer->ing_q2         =  $request->ipt_q2;
            $answer->ing_q3         =  $request->ipt_q3;
            $answer->ing_usr_agnt   = Session::get('username');
            $answer->update_date    = date('Y-m-d H:i:s');
            $answer->timestamps = false;
            $answer->save();

            Solicitud::where('id_sol', $request->id_request)->where('dispatch', $request->dispatch)->update(['linea_producto' => $request->line, 'informacion' => $request->information, 'id_sub_tipo' => $request->subtype]);

            DetalleSolicitud::where('id_sol', $request->id_request)->update(['status' => 'CERRADA', 'fecha_cerrada' => date('Y-m-d H:i:s')]);

            $email_request = DB::table('detalle_solicitud')
                        ->leftjoin('usuarios', 'usuarios.username', '=', 'detalle_solicitud.usuario')
                        ->select('usuarios.mail')
                        ->where('detalle_solicitud.id_sol', '=', $request->id_request)
                        ->get();                                 

           // (new MailController)->send($request->dispatch);

            // Send email to request user.
            $to = $email_request[0]->mail;
            $title = "Whirlpool Service";
            $subject = "Solicitudes a Ingenieria | Folio No. ".$request->id_request;
            $e_message = '
                        <p style="color: #393939; font-size: 14px;">
                            Por este medio te informamos que la solicitud a Ingeniería que realizaste ha sido <strong>Contestada</strong>, para mas información te invitamos a darle seguimiento a la misma en Centro de Soluciones con el No. de Folio: <strong>'.$request->id_request.'</strong>. <br />
                            1) Para revisar los comentarios ingresa primero a Centro de Soluciones e Inicia sesión.
                            2) Ingresa a la siguiente liga: <a href="https://soluciones.refaccionoriginal.com/solicitudes-a-ingenieria/solicitud/show/'.$request->id_request.'">https://soluciones.refaccionoriginal.com/solicitudes-a-ingenieria/solicitud/show/'.$request->id_request.'</a>
                        </p>
                        <p style="color: #393939; font-size: 14px;">
                            Recuerda que el medio oficial de comunicacion es a traves del Centro de Soluciones. 
                        </p>
                        <p style="color: #393939; font-size: 14px;">    
                            Orden de servicio: '.$request->dispatch.'
                        </p>    
                        ';

            $this->send_mail_php($to, $subject, $e_message, $title);

            return response()->json([ 'ok' => 'success', 'message' => 'Contestado correctamente' ]);
        }
        else
        {
            return response()->json([ 'ok' => 'error', 'message' => 'Solicitud no encontrada' ]);
        }
    }

    public function descargar($id)
    {
        $ingeneria = RevisionIngenieria::where('idsol', $id)->first();
        return Storage::download('dispatch/'.$id.'/'.$ingeneria->ruta,$ingeneria->ruta);
    }

    public function taller(Request $request)
    {
        //$now = new \DateTime();
        SolIngCsat::where('id_sol', $request->id_request)
        ->update(['tall_q1' => $request->ipt_q1, 'tall_q2' => $request->ipt_q2]);

        //DetalleSolicitud::where('id_sol', $request->id_request)->update(['status' => 'CERRADA', 'fecha_cerrada' => date('Y-m-d H:i:s')]);

        return response()->json([ 'ok' => 'success', 'message' => 'Contestado correctamente' ]);
    }

    public function rechazar(Request $request)
    {
         $email_request = DB::table('detalle_solicitud')
                        ->leftjoin('usuarios', 'usuarios.username', '=', 'detalle_solicitud.usuario')
                        ->select('usuarios.mail')
                        ->where('detalle_solicitud.id_sol', '=', $request->id_request)
                        ->get();

        $to = $email_request[0]->mail;
        $title = "Whirlpool Service";
        $subject = "Solicitudes a Ingenieria | Folio No. ".$request->id_request;
        $e_message = '
                    <p style="color: #393939; font-size: 14px;">
                        Por este medio te informamos que la solicitud a Ingeniería que realizaste ha sido <strong>Rechazada</strong>, para mas información te invitamos a darle seguimiento a la misma en Centro de Soluciones con el No. de Folio: <strong>'.$request->id_request.'</strong>. <br />
                        1) Para revisar los comentarios ingresa primero a Centro de Soluciones e Inicia sesión.
                        2) Ingresa a la siguiente liga: <a href="https://soluciones.refaccionoriginal.com/solicitudes-a-ingenieria/solicitud/show/'.$request->id_request.'">https://soluciones.refaccionoriginal.com/solicitudes-a-ingenieria/solicitud/show/'.$request->id_request.'</a>
                    </p>
                    <p style="color: #393939; font-size: 14px;">
                        Recuerda que el medio oficial de comunicacion es a traves del Centro de Soluciones. 
                    </p>
                    <p style="color: #393939; font-size: 14px;">    
                        Orden de servicio: '.$request->dispatch.'
                    </p>    
                    ';

        $this->send_mail_php($to, $subject, $e_message, $title);
        DetalleSolicitud::where('id_sol', $request->id_request)->update(['status' => 'RECHAZADA','fecha_rechazada' => date('Y-m-d H:i:s')]);
        return response()->json([ 'ok' => 'success', 'message' => 'Contestado correctamente' ]);
    }

    public function subtypeChange(Request $request)
    {
        $subtype = SubTipoInformacion::where('id_tipo', $request->information)->get();
        if( count($subtype) > 0)
        {
            $html = '<option> Seleccione </option>';
            foreach($subtype as $subtype)
            {
                $html .= '<option value="'.$subtype->id.'">'.$subtype->sub_tipo.'</option>';
            }
            return response()->json(['ok' => true,'html' => $html]);
        }
        else
        {
            $html = '<option> Sin datos </option>';
            return response()->json(['ok' => true,'html' => $html]);
        }
    }
    public function filters(Request $request)
    {
        $filterOne = "";
        $filterTwo = "";
        $filterThree = "";
        $filterFour = "";
        $filterFive = "";
        $filterDispatch = "";

        if($request->dispatch != '')
        {
            $filterDispatch = "solicitud_ingenieria.dispatch = '".$request->dispatch."'";      
            $filter = $filterDispatch." AND ";
        }
        else
        {
            if($request->region != '')
            {
                $prefix_contry = DB::table('wpx_menu_contry')
                        ->select('wpx_menu_contry.short_name')
                        ->where('id', $request->region)
                        ->get();

                $filterOne = 'solicitud_ingenieria.dispatch like "%'.$prefix_contry[0]->short_name.'%"';
            }
            if($request->information != '' )
            {
                $filterTwo = 'solicitud_ingenieria.informacion = '.$request->information;
            }
            if($request->line != '' )
            {
                $filterThree = 'solicitud_ingenieria.linea_producto = '.$request->line;
            }
            if($request->user != '' )
            {
                $filterFour = 'detalle_solicitud.usuario = "'.$request->user.'"';
            }
            if(Session::get('depto') == 'TALLER')
            {
                $filterFive = 'AND (detalle_solicitud.usuario = "'.session('username').'")';
            }
            
            $filter =   (empty($filterOne) ? $filterOne : $filterOne." AND ").
                        (empty($filterTwo) ? $filterTwo : $filterTwo." AND ").
                        (empty($filterThree) ? $filterThree : $filterThree." AND ").
                        (empty($filterFour) ? $filterFour : $filterFour." AND ");
        }
    
        if(!empty($filter))
        {
            $filter = '('.$filter.' detalle_solicitud.fecha_envio > "2016-01-01 00:00:00" ) AND ';
        }
        else
        {
            $filterFive = '';
        }


        if($request->type_slct == "cerradas_rechazadas")
        {
            $query = $filter.' (detalle_solicitud.status = "CERRADA" OR detalle_solicitud.status = "RECHAZADA"  OR detalle_solicitud.status = "SALVADO") '.$filterFive;
        }
        elseif($request->type_slct == "abiertas_en_revision")
        {
            $query = $filter.' (detalle_solicitud.status = "ABIERTO" OR detalle_solicitud.status = "EN REVISION") '.$filterFive;
        }
        else
        {
            $query = $filter.' '.$filterFive;    
        }

        $details = Solicitud::consulta()->whereRaw($query)->get();
        
        $i=0;
        foreach ($details as $row)
        {
            $creacion=$row->fecha_envio;
            $cerrada=$row->fecha_cerrada;
            $rechazada=$row->fecha_rechazada;
            $status=$row->status;
            if($status=='RECHAZADA'){
                $resta=strtotime($rechazada) - strtotime($creacion);
                $dia=intval($resta/60/60/24);
                $details[$i]->dia = $dia;
            }
            elseif($status=='CERRADA'){
                $resta=strtotime($cerrada) - strtotime($creacion);
                $dia=intval($resta/60/60/24);
                $details[$i]->dia = $dia;
            }
            else{
                $resta=strtotime('now') - strtotime($creacion);
                $dia=intval($resta/60/60/24);
                $details[$i]->dia = $dia;
            }
            $i = $i+1;
        }
        $html = '<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">';
        $html .= '  <thead>';
        $html .= '      <tr>';
        $html .= '          <th>SOLICITUD</th>';
        $html .= '          <th>DISPATCH</th>';
        $html .= '          <th>MODELO</th>';
        $html .= '          <th>SERIE</th>';
        $html .= '          <th>DESCRIPCION DEL PROBLEMA</th>';
        $html .= '          <th>LINEA DE PRODUCTO</th>';
        $html .= '          <th>FECHA CREACION</th>';
        $html .= '          <th>ANTIGUEDAD</th>';
        $html .= '          <th>ESTATUS</th>';
        $html .= '          <th>INGENIERO</th>';
        $html .= '          </tr>';
        $html .= '          </thead>';
        $html .= '<tbody>';
        foreach ($details as $detail){
        $html .= '   <tr>';
        $html .= '       <td>'.$detail->id_sol.'</td>';
        $html .= '       <td><a href="'.url('solicitudes-a-ingenieria/detalle/show').'/'.$detail->id_sol.'">'.$detail->dispatch.'</a></td>';
        $html .= '       <td>'.$detail->modelo.'</td>';
        $html .= '       <td>'.$detail->serie.'</td>';
        $html .= '       <td>'.$detail->descripcion_problema.'</td>';
        $html .= '       <td>'.$detail->linea.'</td>';
        $html .= '       <td>'.$detail->fecha_envio.'</td>';
        $html .= '       <td>'.$detail->dia.'</td>';
        $html .= '       <td>'.$detail->status.'</td>';
        $html .= '       <td>'.$detail->nombre.'</td>';
        $html .= '   </tr>';
        }
        $html .= '</tbody>';
        
        return response()->json(['ok' => true,'html' => $html, 'detalle' => $details]);
    }

    // Send mail.
    public function send_mail_php($to, $subject, $e_message, $title)
    {
        $base_url = "https://soluciones.refaccionoriginal.com/solicitudes-a-ingenieria/";
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
        
        $email_template = "<!DOCTYPE html>
                            <html>
                            <head>
                                <meta charset='utf-8' />
                                <meta name='viewport' content='width=device-width' />
                                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                                
                                <title>".$title."</title>
                                <style>
                                    body {
                                        font-family: Arial !important;
                                    }
                                </style>
                            </head>
                            <body style='margin: 0; min-width: 100% !important; padding: 0;'>
                                <table width='100%' border='0' cellpadding='0' cellspacing='0' style='font-family: Arial; font-size: 14px; font-weight: normal;'>
                                    <tr>
                                        <td>
                                            <table align='center' cellpadding='0' cellspacing='0' border='0' style='background: #FFFFFF; border: 1px solid #F1F1F1; color: #393939; font-family: Arial; font-size: 12px; margin: auto; max-width: 600px; padding: 15px; width: 100%;'>
                                                <tr>
                                                    <td style='text-align: left; background: #FFFFFF; padding-top: 30px;'>
                                                        <h1 style='color: #393939; margin-bottom: 0; margin-top: 0; padding-bottom: 25px; text-align: center;'>
                                                            <img src='https://www.google.com/a/whirlpool.com/images/logo.gif?alpha=1&service=google_default' alt='WHIRLPOOL' style='display: inline-block; width: 220px; '/>
                                                        </h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div style='color: #393939; font-family: Tahoma; font-size: 12px; padding: 10px 15px; text-align: left;'>
                                                            ".$body_message."
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style='text-align: center;'>
                                                        <p style='color: #393939; font-family: Tahoma; font-size: 10px; padding: 10px 15px; text-align: center;'>
                                                            <strong style='color: #393939;'>
                                                                &copy; 
                                                                <a href='{base_url}' target='_blank' style='color: #393939;'>
                                                                    Whirlpool.com
                                                                </a>
                                                            </strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </body>
                            </html>";

        $body_message = $email_template;

        $send_email = mail(filter_var($to, FILTER_SANITIZE_EMAIL), $subject, $body_message, $header);
    }
}
