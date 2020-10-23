<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Void_;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set("America/Mexico_City");

class AlcoparModel extends ModelBase
{
    // Stock Inicial
    public static function get_rev_ing_alta()
    {

        $data = [];
        $return = [];
        // Records for Managers.

        $data = AlcoparModel::query()->selectRaw('
        id,
        parte,
        descripcion,
        modelo,
        fecha,
        DATEDIFF(CURDATE(),fecha) as \'dias\', 
        DATEDIFF(CURDATE(),fecha) as \'dias2\',
        datediff(curdate(),fechafactible) as dias3,
        taller,
        dispatch,
        username, 
        status,
        motivo')
            ->from('alcopar_partes')
            ->whereRaw('reving =1 or alta=1 ORDER BY FIELD (motivo,\'PROYECTOS, STOCK INICIAL\',\'PROYECTOS, STOCK FINAL\') ASC, fecha ASC')
            ->get();

        foreach ($data as $k => $row) {

            $username_alcopar = $row['username'];
            $row1 = AlcoparModel::query()->selectRaw('nombre')->from('usuarios')->whereRaw(' username=\'' . $username_alcopar . '\'')->get();
            $nombre_usuario = @$row1[0]['nombre'];
            $id = $row['id'];

            $row2 = AlcoparModel::query()->selectRaw('DATEDIFF(CURDATE(),fecha_asignacion) as \'dias\', modulo_act')
                ->from('alcopar_partes_historial')->whereRaw("alcopar_id='" . $id . "' ORDER BY fecha_asignacion DESC")->get();

            $dias = @$row2[0]['dias'];
            $modulo_act = @$row2[0]['modulo_act'];
            if ($row['status'] == 'RECHAZADA') {
                $dias2 = $row['dias3'];
            } else {
                $dias2 = $row['dias'];
            }

            $return[$k]['id'] = $row['id'];
            $return[$k]['parte'] = $row['parte'];
            $return[$k]['descripcion'] = $row['descripcion'];
            $return[$k]['modelo'] = $row['modelo'];
            $return[$k]['fecha'] = $row['fecha'];
            $return[$k]['dias2'] = $row['dias2'];

            if ($dias <> '' and $modulo_act == 'REV INGENIERIA') {
                $return[$k]['diasd'] = $dias;
            } else {
                $return[$k]['diasd'] = $dias2;
            }
            $return[$k]['taller'] = $row['taller'];
            $return[$k]['dispatch'] = $row['dispatch'];
            $return[$k]['nombre_usuario'] = $nombre_usuario;
            $return[$k]['status'] = $row['status'];
            $return[$k]['motivo'] = $row['motivo'];
        }


        return $return;
    }

    public static function get_factible()
    {

        $data = [];
        $return = [];
        // Records for Managers.

        $data = AlcoparModel::query()->selectRaw('
        id,
        parte,
        descripcion,
        modelo,
        fecha,
        DATEDIFF(CURDATE(),fechareving) as \'dias\', 
        DATEDIFF(CURDATE(),fecha) as \'dias2\',        
        motivo')
            ->from('alcopar_partes')
            ->whereRaw('factible =1 or costo=1 ORDER BY FIELD (motivo,\'PROYECTOS, STOCK INICIAL\',\'PROYECTOS, STOCK FINAL\') ASC,fecha ASC')
            ->get();

        foreach ($data as $k => $row) {

            $id = $row['id'];

            $row2 = AlcoparModel::query()->selectRaw('DATEDIFF(CURDATE(),fecha_asignacion) as \'dias\', modulo_act')
                ->from('alcopar_partes_historial')->whereRaw("alcopar_id='" . $id . "' ORDER BY fecha_asignacion DESC")->get();

            $dias = @$row2[0]['dias'];
            $modulo_act = @$row2[0]['modulo_act'];

            $return[$k]['id'] = $row['id'];
            $return[$k]['parte'] = $row['parte'];
            $return[$k]['descripcion'] = $row['descripcion'];
            $return[$k]['modelo'] = $row['modelo'];
            $return[$k]['fecha'] = $row['fecha'];
            $return[$k]['dias2'] = $row['dias2'];
            $return[$k]['dias'] = $row['dias'];
            if ($dias <> '' and $modulo_act == 'REV MATERIALES') {
                $return[$k]['diasd'] = $dias;
            } else {
                $return[$k]['diasd'] = $row['dias'];
            }
            $return[$k]['taller'] = $row['taller'];
            $return[$k]['dispatch'] = $row['dispatch'];

            $return[$k]['status'] = $row['status'];
            $return[$k]['motivo'] = $row['motivo'];
        }


        return $return;
    }

    public static function get_factible_edit($alcopar_id)
    {
        $data = [];

        $row = AlcoparModel::query()->selectRaw('
        alcopar_partes.id,
            alcopar_partes.parte,
            alcopar_partes.modelo,
            alcopar_partes.dispatch,
            alcopar_partes.descripcion,
            alcopar_partes.taller,
            alcopar_partes.status,
            alcopar_partes.pregunta,
            alcopar_partes.otros,
            alcopar_partes.comentario_reving,
            alcopar_partes.username,
            alcopar_partes.motivo,
            alcopar_partes.tipo_material as alcopar_tipo_material,
            alcopar_partes.categoria as alcopar_categoria,
            alcopar_partes.familia as alcopar_familia,
            alcopar_partes.marca as alcopar_marca,
            alcopar_partes.tipo_extra as alcopar_tipo_extra,
            alcopar_categoria.categoria,
            alcopar_tipo_extra.tipo_extra,
            alcopar_familia.familia,
            alcopar_marca.marca,
            alcopar_tipo_material.tipo_material,
            alcopar_tipo_material.id_tipo_material
        ')
            ->from('alcopar_partes')
            ->leftJoin('alcopar_categoria', 'alcopar_partes.categoria', '=', 'alcopar_categoria.id_categoria')
            ->leftJoin('alcopar_familia', 'alcopar_partes.familia', '=', 'alcopar_familia.id_familia')
            ->leftJoin('alcopar_marca', 'alcopar_partes.marca', '=', 'alcopar_marca.id')
            ->leftJoin('alcopar_tipo_extra', 'alcopar_partes.tipo_extra', '=', 'alcopar_tipo_extra.id')
            ->leftJoin('alcopar_tipo_material', 'alcopar_partes.tipo_material', '=', 'alcopar_tipo_material.id_tipo_material')
            ->whereRaw(' alcopar_partes.id = ' . $alcopar_id)
            ->get();

        $status = $row[0]['status'];
        $parte = $row[0]['parte'];
        $descripcion = $row[0]['descripcion'];
        $motivo = $row[0]['motivo'];
        $username_alcopar = $row[0]['username'];



        $row1 = AlcoparModel::query()->selectRaw('nombre')
            ->from('usuarios')
            ->whereRaw('username = \'' . $username_alcopar . '\'')
            ->get();
        $nombre_usuario = $row1[0]['nombre'];


        $row2 = AlcoparModel::query()->selectRaw('id,alcopar_id,comentarios,fecha_asignacion,usuario,modulo_ant,modulo_act')
            ->from('alcopar_partes_historial')
            ->whereRaw('alcopar_id = ' . $alcopar_id)
            ->get();

        $row2Count = $row2->count();

        $tipo = AlcoparModel::query()->selectRaw('id_tipo_material,tipo_material')
            ->from('alcopar_tipo_material')
            ->get();

        $categoria = AlcoparModel::query()->selectRaw('id,id_categoria,categoria')
            ->from('alcopar_categoria')
            ->get();

        $familia = AlcoparModel::query()->selectRaw('id,id_familia,familia,id_categoria')
            ->from('alcopar_familia')
            ->get();

        $marca = AlcoparModel::query()->selectRaw('id,id_marca,marca,id_tipo_material')
            ->from('alcopar_marca')
            ->get();

        if(isset($row[0])){
            if($row[0]['alcopar_tipo_material']!= ''){        
                $extra = AlcoparModel::query()->selectRaw('id,tipo_extra,id_tipo_material')
                ->from('alcopar_tipo_extra')
                ->whereRaw('id_tipo_material = ' . $row[0]['alcopar_tipo_material'])
                ->get();
            }
            else{
                $extra = array();    
            }
        }else{
            $extra = array();
        }        

        $data['row'] = $row;
        $data['row1'] = $row1;
        $data['row2'] = $row2Count;
        $data['tipo'] = $tipo;
        $data['categoria'] = $categoria;
        $data['familia'] = $familia;
        $data['extra'] = $extra;

        $data['marca'] = $marca;
        $data['nombre_usuario'] = $nombre_usuario;

        return $data;
    }


    public static function get_rev_ing_alta_edit($alcopar_id)
    {
        $data = [];

        $row = AlcoparModel::query()->selectRaw('
        alcopar_partes.id,
            alcopar_partes.parte,
            alcopar_partes.comentario,
            alcopar_partes.modelo,
            alcopar_partes.dispatch,
            alcopar_partes.descripcion,
            alcopar_partes.taller,
            alcopar_partes.status,
            alcopar_partes.pregunta,
            alcopar_partes.otros,
            alcopar_partes.username,
            alcopar_partes.motivo,
            alcopar_partes.tipo_material as alcopar_tipo_material,
            alcopar_partes.categoria as alcopar_categoria,
            alcopar_partes.familia as alcopar_familia,
            alcopar_partes.marca as alcopar_marca,
            alcopar_partes.tipo_extra as alcopar_tipo_extra,
            alcopar_categoria.categoria,
            alcopar_tipo_extra.tipo_extra,
            alcopar_familia.familia,
            alcopar_marca.marca,
            alcopar_tipo_material.tipo_material,
            alcopar_tipo_material.id_tipo_material
        ')
            ->from('alcopar_partes')
            ->leftJoin('alcopar_categoria', 'alcopar_partes.categoria', '=', 'alcopar_categoria.id_categoria')
            ->leftJoin('alcopar_familia', 'alcopar_partes.familia', '=', 'alcopar_familia.id_familia')
            ->leftJoin('alcopar_marca', 'alcopar_partes.marca', '=', 'alcopar_marca.id')
            ->leftJoin('alcopar_tipo_extra', 'alcopar_partes.tipo_extra', '=', 'alcopar_tipo_extra.id')
            ->leftJoin('alcopar_tipo_material', 'alcopar_partes.tipo_material', '=', 'alcopar_tipo_material.id_tipo_material')
            ->whereRaw(' alcopar_partes.id = ' . $alcopar_id)
            ->get();

        $status = $row[0]['status'];
        $parte = $row[0]['parte'];
        $descripcion = $row[0]['descripcion'];
        $motivo = $row[0]['motivo'];
        $username_alcopar = $row[0]['username'];


        $row1 = AlcoparModel::query()->selectRaw('nombre')
            ->from('usuarios')
            ->whereRaw('username = \'' . $username_alcopar . '\'')
            ->get();
        $nombre_usuario = $row1[0]['nombre'];


        $row2 = AlcoparModel::query()->selectRaw('id,alcopar_id,comentarios,fecha_asignacion,usuario,modulo_ant,modulo_act')
            ->from('alcopar_partes_historial')
            ->whereRaw('alcopar_id = ' . $alcopar_id)
            ->get();

        $row2Count = $row2->count();

        $tipo = AlcoparModel::query()->selectRaw('id_tipo_material,tipo_material')
            ->from('alcopar_tipo_material')
            ->get();

        $categoria = AlcoparModel::query()->selectRaw('id,id_categoria,categoria')
            ->from('alcopar_categoria')
            ->get();

        $familia = AlcoparModel::query()->selectRaw('id,id_familia,familia,id_categoria')
            ->from('alcopar_familia')
            ->get();

        $marca = AlcoparModel::query()->selectRaw('id,id_marca,marca,id_tipo_material')
            ->from('alcopar_marca')
            ->get();
        

        if(isset($row[0])){
            if($row[0]['alcopar_tipo_material']!= ''){        
                $extra = AlcoparModel::query()->selectRaw('id,tipo_extra,id_tipo_material')
                ->from('alcopar_tipo_extra')
                ->whereRaw('id_tipo_material = ' . $row[0]['alcopar_tipo_material'])
                ->get();
            }
            else{
                $extra = array();    
            }
        }else{
            $extra = array();
        }              

        $data['row'] = $row;
        $data['row1'] = $row1;
        $data['row2'] = $row2Count;
        $data['tipo'] = $tipo;
        $data['categoria'] = $categoria;
        $data['familia'] = $familia;
        $data['extra'] = $extra;

        $data['marca'] = $marca;
        $data['nombre_usuario'] = $nombre_usuario;

        return $data;
    }

    public static function get_all_records_pending_list($id_region)
    {

        // Users for MX
        if ($id_region == 1) {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_mex', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for CAM
        if ($id_region == 2) {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_cam', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for AND
        if ($id_region == 3) {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_and', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for CAR
        if ($id_region == 4) {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_car', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        return $data;
    }

    public static function get_records_by_id($id)
    {

        $data = StocksModel::select('stock_gral_serv.*')
            ->from('stock_gral_serv')
            ->where('id', $id)
            ->get();

        return $data;
    }

    public static function getCategoria($id)
    {
        $tipo_material = $id;
        //$categoria='01';
        $rows = AlcoparModel::query()->selectRaw('id,categoria,id_categoria')->from('alcopar_categoria')->get();
        $html = '<option value="0">Seleccionar Categoria...</option>';
        foreach ($rows as $row) {
            if ($tipo_material == 2) {
                if ($row['id'] >= 6) {
                    $html .= '<option value="' . $row['id_categoria'] . '">' . $row['categoria'] . '</option>';
                }
            } else {
                if ($row['id'] < 6) {
                    $html .= '<option value="' . $row['id_categoria'] . '">' . $row['categoria'] . '</option>';
                }
            }
        }
        return $html;
    }
    public static function getFamilia($id)
    {
        $categoria = $id;
        if ($categoria >= 6) {
            $rows = AlcoparModel::query()->selectRaw('id_familia, familia ')->from('alcopar_familia')->get();
        } else {
            $rows = AlcoparModel::query()->selectRaw('id_familia, familia ')->from('alcopar_familia')->whereRaw("id_categoria = '$categoria'")->get();
        }

        $html = "<option value=''>Seleccionar Familia...</option>";

        foreach ($rows as $row) {
            $html .= "<option value='" . $row['id_familia'] . "'>" . $row['familia'] . "</option>";
        }

        return $html;
    }
    public static function getCategoriaExtra($id)
    {
        $tipo_material = $id;
        if ($tipo_material == 3) {
            $rows = AlcoparModel::query()->selectRaw('id, tipo_extra')->from('alcopar_tipo_extra')->whereRaw("id_tipo_material = 3")->get();
        } else {
            if ($tipo_material == 1 || $tipo_material == 2 || $tipo_material == 4 || $tipo_material == 5) {
                $rows = AlcoparModel::query()->selectRaw('id, tipo_extra')->from('alcopar_tipo_extra')->whereRaw("id_tipo_material = 1")->get();
            } else {
                $rows = AlcoparModel::query()->selectRaw('id, tipo_extra')->from('alcopar_tipo_extra')->get();
            }
        }
        $html = "<option value='0'>Seleccionar Categoria Extra</option>";
        foreach ($rows as $row) {
            $html .= "<option value='" . $row['id'] . "'>" . $row['tipo_extra'] . "</option>";
        }
        return $html;
    }

    public static function updateProcesa($tipo, $pk, $datos)
    {
        if ($tipo == 'updatePartes') {
            DB::table('alcopar_partes')
                ->where('id', $pk)
                ->update($datos);
        }
    }


    public static function updateProcesaGeneral($table,$pk, $alcopar_id, $datos)
    {
                            
            DB::table($table)
                ->where($pk, $alcopar_id)
                ->update($datos);        
    }

    public static function updateProcesaa($pieza)
    {
        $rows = AlcoparModel::query()
            ->selectRaw('material,costo')
            ->from('reforig_logistica.materiales_costo')->whereRaw("material = '" . $pieza . "'")->get();
        $num_rows = $rows->count();

        if ($num_rows >= 1) {
            DB::table('reforig_logistica.materiales_costo')
                ->where('material', $pieza)
                ->update(['costostd' => session('costo'), 'costo' => session('costo')]);
        } else {
            DB::table('reforig_logistica.materiales_costo')->insert(
                [
                    'material' => $pieza,
                    'costostd' => session('costo'),
                    'per' => '1',
                    'costo' => session('costo')
                ]
            );
        }
    }



    public static function procesaaceptar()
    {
        date_default_timezone_set("America/Mexico_City");
        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentario = session('comentario');
        $username = session('username');
        $descripcion = session('descripcion');

        $rows = AlcoparModel::query()
            ->selectRaw('codigo_clasif_sat, clasif_sat, left(nomenclatura_service,7) as nomenclatura')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();

        $result = $rows[0];


        $clasif_sat = $result['codigo_clasif_sat'];
        $nomenclatura_service = $result['nomenclatura'];


        if ($clasif_sat <> '') {
            if ($clasif_sat == '00000000') {
                $datos = array(
                    'descripcion' => $descripcion,
                    'fechareving' => date('Ymd'),
                    'reving' => 0,
                    'factible' => 1,
                    'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                    'ing' => $username,
                    'comentario_reving' => $comentario,
                    'nomenclatura_service' => $nomenclatura_service
                );
                DB::table('alcopar_partes')
                    ->where('id', $alcopar_id)
                    ->update($datos);
            } else {
                $datos = array(
                    'descripcion' => $descripcion,
                    'fechareving' => date('Ymd'),
                    'reving' => 0,
                    'factible' => 1,
                    'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                    'ing' => $username,
                    'comentario_reving' => $comentario,
                    'clasif_sat' => '0'
                );
                DB::table('alcopar_partes')
                    ->where('id', $alcopar_id)
                    ->update($datos);
            }
        } else {
            $datos = array(
                'descripcion' => $descripcion,
                'fechareving' => date('Ymd'),
                'reving' => 0,
                'factible' => 1,
                'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                'ing' => $username,
                'comentario_reving' => $comentario,
                'clas_sat_status' => 'PENDIENTE CLASIFICACION SAT',
                'clasif_sat' => '1'
            );
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update($datos);
        }

        return true;
    }


    public static function procesaaceptarfac()
    {

        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentario = session('comentario');
        $username = session('username');
        
        

        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,motivo,username,parte,dispatch,tipo_material')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();

        $row = $rows[0];
        
        $descripcion = $row['descripcion'];
        $motivo = $row['motivo'];
        $username_alcopar = $row['username'];
        $parte = $row['parte'];
        //$flag=$row['pedido_flag'];
        $dispatch = $row['dispatch'];
        $tipo_material = $row['tipo_material'];

        if ($tipo_material <> '2') {

            $datos = array(
                'status' => 'PRECIO DE LISTA POR ASIGNAR',
                'fechafactible' => date('Ymd'),
                'costo' => '0',
                'fechacosto' => date('Ymd'),
                'factible' => '0',
                'precio' => '1',
                'materiales' => $username,
                'comentario_mat' => 'SE AUTORIZA REV MATERIALES Y ALTA DE COSTO'
            );
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update($datos);
        } else {
            $datos = array(
                'status' => 'PENDIENTE PRECIO OOW',
                'oow' => '1',
                'fechafactible' => date('Ymd'),
                'fechacosto' => date('Ymd'),
                'factible' => '0',
                'materiales' => $username,
                'comentario_mat' => 'SE AUTORIZA REV MATERIALES Y ALTA DE COSTO'
            );
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update($datos);
        }

        if ($motivo == 'PROYECTOS, STOCK INICIAL') {

            DB::table('stock_inicial')
                ->where('no_parte', $parte)
                ->update(['activo' => 1, 'fecha_carga' => date('Ymd')]);


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
                <p>Por este medio te informamos que se ha creado una nueva solicitudes de stock inicial.<br> </p>
                <p>Favor de revisarla.<br> </p>
                <p>No. Parte " . $parte . "</p>
                <p></p>
                <p></p>
                
            ";


            $to = 'noe_delgado_munoz_proceti@whirlpool.com';
            $subject = 'Nuevas Solicitudes Stock Inicial.';
            $type = "Content-type: text/html\r\n";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";
            $headers = $headers . "Bcc: <noe_delgado_munoz_proceti@whirlpool.com>\r\n";

            $mail_sent = @mail($to, $subject, $email_message, $headers);
        } elseif ($motivo == 'PROYECTOS, STOCK FINAL') {
            DB::table('stock_final')
                ->where('no_parte', $parte)
                ->update(['activo' => 1, 'fecha_carga' => date('Ymd')]);

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
                <p>Por este medio te informamos que se han creado nuevas solicitudes de stock final.<br> </p>
                <p>Favor de revisarlas.<br> </p>
                <p></p>
                <p></p>
                
            ";


            $to = 'noe_delgado_munoz_proceti@whirlpool.com';
            $subject = 'Nuevas Solicitudes Stock Final.';
            $type = "Content-type: text/html\r\n";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";
            $headers = $headers . "Bcc: <noe_delgado_munoz_proceti@whirlpool.com>\r\n";

            $mail_sent = @mail($to, $subject, $email_message, $headers);
        } else {
                echo $alcopar_id;
                $rows = AlcoparModel::query()
                    ->selectRaw("GROUP_CONCAT( mail SEPARATOR ', ') as mail3")
                    ->from('alcopar_partes_mail')->whereRaw("idalcopar = " . $alcopar_id)->get();
                    
                $num_rows = $rows->count();                
                if($num_rows > 0){
                
                $row2 = $rows[0];
                
                $mail3 = $row2['mail3'];
                
                
                $rows = AlcoparModel::query()
                    ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
                    ->from('alcopar_partes')
                    ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                    ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                    ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')
                    ->whereRaw("alcopar_partes.id = '" . $alcopar_id . "'")->get();

                $row = $rows[0];


                $mail = $row['mail'];
                $mail2 = $row['mail2'];



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
                        <p>Por este medio te informamos que el n&uacute;mero de parte solicitado ya cuenta con Costo</p>
                        <p>Por lo que si fue solicitado para un servicio en garant&iacute;a, el pedido o la reserva ya puede ser colocado en SAP.</p>
                        <p></p>   
                        <br>
                        <p>De ser requerida para un Servicio con Cargo, en m&aacute;ximo tres d&iacute;as h&aacute;biles quedar&aacute; colocado el precio.</p>
                        <p></p>
                        <br>
                        INFORMACION DE LA SOLICITUD
                        <p></p>
                        N&uacute;mero de Parte : " . $parte . "<br>
                        Descripci&oacute;n : " . $descripcion . "<br>	
                        Dispatch : " . $dispatch . "<br>
                        Comentarios : " . $motivo . "<br>
                        <p></p>
                        <p>";

                $to = $mail . "," . $mail2 . "," . $mail3;
                $subject = 'Alta de Parte lista para pedidos de garantia.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

                $mail_sent = @mail($to, $subject, $email_message, $headers);
            }
        }
    }


    public static function reasignarfac()
    {
        

        $nombre = session('nombre');
        $username = session('username');
        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentarios = session('comentario');
        $asigna = session('asigna');

        //REVING
        if ($asigna == 'FACTIBLE') {            
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'reving' => 1, 'factible' => 0, 'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE'
                    )
                );
                
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV MATERIALES',
                    'modulo_act' => 'REV INGENIERIA'
                ]
            );
        } elseif ($asigna == 'ALTA') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PARTE AUTORIZADA POR DARSE DE ALTA EN SAP', 'factible' => 0, 'alta' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA SAP'
                ]
            );
        } elseif ($asigna == 'COSTO') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'COSTO ESTANDAR POR ASIGNAR', 'factible' => 0, 'costo' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA COSTO'
                ]
            );
        } elseif ($asigna == 'PRECIO') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PRECIO DE LISTA POR ASIGNAR', 'factible' => 0, 'precio' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA PRECIO'
                ]
            );
        } elseif ($asigna == 'OOW') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PENDIENTE PRECIO OOW', 'factible' => 0, 'oow' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV MATERIALES',
                    'modulo_act' => 'ALTA OOW'
                ]
            );
        }
    }




    public static function cancelar2()
    {
        $nombre = Auth::user()->nombre;
        $username = Auth::user()->username;

        $alcopar = Auth::user()->alcopar;
        $alcopar_nivel = Auth::user()->alcopar_nivel;

        $alcopar_id = session('alcopar_id');


        $comentarios = session('comentario');

        $datos = array(
            'fechareving' => date('Ymd'),
            'reving' => 0,
            'status' => 'CANCELADA',
            'comentario' => 'CANCELADA POR NUMERO DE PARTE INCORRECTO',
            'comentario_reving' => $comentarios,
            'ing' => $username
        );
        DB::table('alcopar_partes')
            ->where('id', $alcopar_id)
            ->update($datos);


        //RUTINA MAIL


        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller, username, parte, comentario,comentario_reving,descripcion,taller')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();

        $row = $rows[0];


        $descripcion = $row['descripcion'];
        $motivo = $row['motivo'];
        $username_alcopar = $row['username'];
        $parte = $row['parte'];
        $motivo_cancelacion = $row['comentario'];
        $comentario_cancelacion = $row['comentario_reving'];
        $descripcion = $row['descripcion'];
        $taller = $row['taller'];

        $dispatch = $row['dispatch'];

        if ($taller == '') {
            $rows = AlcoparModel::query()
                ->selectRaw('usuarios.mail')
                ->from('alcopar_partes')
                ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
                ->whereRaw('alcopar_partes.parte = \'' . $parte . '\'')
                ->get();
            $row = $rows[0];
            $mail = $row['mail'];
            $mail2 = '';
        } else {

            $rows = AlcoparModel::query()
                ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
                ->from('alcopar_partes')
                ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')
                ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
                ->whereRaw('alcopar_partes.parte = \'' . $parte . '\'')
                ->get();
            $row = $rows[0];
            $mail = $row['mail'];
            $mail2 = $row['mail2'];
        }



        $rows = AlcoparModel::query()
            ->selectRaw('usuarios.username')
            ->from('alcopar_partes')
            ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
            ->leftJoin('usuarios', 'talleres.supervisor', '=', 'usuarios.nombre')
            ->whereRaw('alcopar_partes.parte = \'' . $parte . '\'')
            ->get();
        $row_sql = $rows[0];

        $descripcion_pedido = $descripcion . ',' . $comentario_cancelacion;


        DB::table('pedido_alta')
            ->leftJoin('pedido_detalle', 'pedido_alta.idpedido', '=', 'pedido_detalle.idpedido')
            ->whereRaw("pedido_detalle.numparte='" . $parte . "' AND pedido_alta.pedido_status NOT IN ('PEDIDO COLOCADO', 'RECHAZAR TALLER', 'RECHAZAR A TALLER')")
            ->update(
                array(
                    'pedido_alta.pedido_status' => 'REVISION SUPERVISOR',
                    'pedido_alta.pedido_substatus' => 'ALTA DE PARTE',
                    'pedido_alta.pedido_responsable' => '\'' . $row_sql['username'] . '\'',
                    'pedido_detalle.descripcion' => '\'' . $descripcion_pedido . '\''
                )
            );








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
                N&uacute;mero de Parte : " . $parte . "<br>
                Descripci&oacute;n : " . $descripcion . "<br>	
                Comentarios : " . $motivo . "<br>
                Dispatch : " . $dispatch . "<br>
                <p></p>
                Motivo de la cancelacion : " . $motivo_cancelacion . "<br>
                Comentario Ingenieria : " . $comentario_cancelacion . "<br>
                <p>
            ";


        $to = $mail . "," . $mail2;
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
                N&uacute;mero de Parte : " . $parte . "<br>
                Descripci&oacute;n : " . $descripcion . "<br>   
                Comentarios : " . $motivo . "<br>
                Dispatch : " . $dispatch . "<br>
                <p></p>
                Motivo de la cancelacion : " . $motivo_cancelacion . "<br>
                Comentario Ingenieria : " . $comentario_cancelacion . "<br>
                <p>
            ";


        $to = "noedelgadomunoz@gmail.com,lucy_rangel_jinzai@whirlpool.com," . $mail . "," . $mail2;
        $subject = 'Alta de Parte Cancelada por Ingenieria.';
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

        $mail_sent = @mail($to, $subject, $email_message, $headers);
    }
    public static function rechazarfac()
    {

        $nombre = session('nombre');
        $razon = session('rechazo');
        $username = session('username');
        $comentario = session('comentario');

        $alcopar_id = session('alcopar_id');

        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        // if($alcopar=='NO')
        // {
        // header("location:/main/admin.php");
        // }

        // if($alcopar_nivel==0)
        // {
        // header("location:/main/admin.php");
        // } 
        $datos = [
            'fechafactible' => date('Ymd'),
            'factible' => '0',
            'reving' => '1',
            'status' => 'RECHAZADA',
            'comentario' => $razon,
            'materiales' => $username,
            'comentario_mat' => $comentario
        ];
        DB::table('alcopar_partes')
            ->where('id', $alcopar_id)
            ->update($datos);

        //RUTINA MAIL

        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller,modelo, username, parte, comentario,comentario_reving,descripcion,clasif_sat,nomenclatura_service')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();

        $row = $rows[0];

        $descripcion = $row['descripcion'];
        $motivo = $row['motivo'];
        $modelo = $row['modelo'];
        $dispatch = $row['dispatch'];
        $username_alcopar = $row['username'];
        $parte = $row['parte'];
        $taller = $row['taller'];
        $clasif_sat = $row['clasif_sat'];
        $nomenclatura_service = $row['nomenclatura_service'];

        $nueva_nomenclatura = $nomenclatura_service . '-00000000';


        if ($clasif_sat == '1') {



            $datos = [
                'clasif_sat' => '0',
                'fecha_clasif_sat' => date('Ymd'),
                'comentario_clasif_sat' => 'No se clasificó numero de parte por rechazo de Materiales',
                'codigo_clasif_sat' => '00000000',
                'nomenclatura_service' => $nueva_nomenclatura
            ];
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update($datos);
        }

        // if ($taller ==''){


        //     $rows = AlcoparModel::query()
        // ->selectRaw('usuarios.mail ') 
        // ->from('alcopar_partes')
        // ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')        
        // ->whereRaw("alcopar_partes.parte = '".$parte."'")->get();   

        //     $row = $rows[0];
        //     $mail=$row['mail'];
        // }
        // else{

        $rows = AlcoparModel::query()
            ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
            ->from('alcopar_partes')
            ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
            ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
            ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')
            ->whereRaw("alcopar_partes.parte = '" . $parte . "'")->get();

        $row = $rows[0];
        $mail = $row['mail'];
        $mail2 = $row['mail2'];
        // }


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
            <p>Por este medio te informamos que la solictud de Alta de Parte ha sido rechazada.<br> </p>
            <p></p>
            <p></p>
            <br>
            INFORMACION DE LA SOLICITUD
            <p></p>
            N&uacute;mero de Parte : " . $parte . "<br>
            Descripci&oacute;n : " . $descripcion . "<br>
            Modelo : " . $modelo . "<br>
            Taller : " . $taller . "<br>
            Dispatch : " . $dispatch . "<br>	
            Comentarios : " . $comentario . "<br>
            <p></p>
            <p></p>
            Motivo del Rechazo : " . $razon . "<br>
            <p>
        ";


        $to = $mail . "," . $mail2;
        $subject = 'Alta de Parte Rechazada por Materiales.';
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

        $mail_sent = @mail($to, $subject, $email_message, $headers);
    }
    public static function rechazar()
    {
        $nombre = session('nombre');
        $razon = session('razon');
        $username = session('username');
        $comentario = session('comentario');

        $alcopar_id = session('alcopar_id');

        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');

        if ($razon == "EL NUM DE PARTE CUENTA CON SUSTITUTO") {
            return false;
            //header ("location:/alcopar/reving/procesarechazar3.php");
        } else {
            $datos = array(
                'fechareving' => date('Ymd'),
                'reving' => 0,
                'status' => 'RECHAZADA',
                'comentario' => $razon,
                'ing' => $username,
                'comentario_reving' => $comentario

            );

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update($datos);

            $rows = AlcoparModel::query()->selectRaw('descripcion,motivo,modelo,taller,dispatch,username,parte')
                ->from('alcopar_partes')->whereRaw("id = '" . $alcopar_id . "'")->get();

            $row = $rows[0];
            $descripcion = $row['descripcion'];
            $motivo = $row['motivo'];
            $modelo = $row['modelo'];
            $taller = $row['taller'];
            $dispatch = $row['dispatch'];
            $username_alcopar = $row['username'];
            $parte = $row['parte'];

            //PARTE PEDIDO
            //$flag=$row['pedido_flag'];
            $descripcion2 = $descripcion . ',' . $comentario;

            //PARTE PEDIDO
            /*if($razon=='EL NUM DE PARTE ESTA OBSOLETO'){
                mysql_query("UPDATE pedido_alta LEFT JOIN pedido_detalle ON pedido_alta.idpedido = pedido_detalle.idpedido SET pedido_alta.pedido_status='REVISION SUPERVISOR', pedido_alta.pedido_substatus='POSIBLE CAMBIO DE PRODUCTO', pedido_alta.supervisor_fecha2=curdate(),pedido_detalle.descripcion='".$descripcion2."', pedido_alta.pedido_responsable='".$username_alcopar."', status_acp='1' WHERE  pedido_detalle.numparte='".$parte."' AND pedido_alta.pedido_status NOT IN ('PEDIDO COLOCADO', 'RECHAZAR TALLER', 'RECHAZAR A TALLER')") or die (mysql_error());*/
            if ($motivo == 'PROYECTOS, STOCK INICIAL') {

                DB::table('stock_inicial')
                    ->where('no_parte', $parte)
                    ->update([
                        'activo' => 1, 'fecha_carga' => date('Ymd')
                    ]);


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
                        <p>Por este medio te informamos que se ha creado una nueva solicitudes de stock inicial.<br> </p>
                        <p>Favor de revisarla.<br> </p>
                        <p>No. Parte " . $parte . "</p>
                        <p></p>
                        <p></p>
                        
                    ";


                $to = 'paola_vicente_teknna@whirlpool.com';
                $subject = 'Nuevas Solicitudes Stock Inicial.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";
                $headers = $headers . "Bcc: <noe_delgado_munoz_proceti@whirlpool.com>\r\n";

                $mail_sent = @mail($to, $subject, $email_message, $headers);
            } elseif ($motivo == 'PROYECTOS, STOCK FINAL') {
                DB::table('stock_final')
                    ->where('no_parte', $parte)
                    ->update([
                        'activo' => 1, 'fecha_carga' => date('Ymd')
                    ]);

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
                        <p>Por este medio te informamos que se han creado nuevas solicitudes de stock final.<br> </p>
                        <p>Favor de revisarlas.<br> </p>
                        <p></p>
                        <p></p>
                        
                    ";


                $to = 'paola_vicente_teknna@whirlpool.com';
                $subject = 'Nuevas Solicitudes Stock Final.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";
                $headers = $headers . "Bcc: <paola_vicente_teknna@whirlpool.com>\r\n";

                $mail_sent = @mail($to, $subject, $email_message, $headers);
            }


            if ($taller == '') {
                $rows = AlcoparModel::query()->selectRaw('usuarios.mail ')
                    ->from('alcopar_partes')
                    ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
                    ->whereRaw("alcopar_partes.parte = '" . $parte . "'")->get();
                $row = $rows[0];
                $mail = $row['mail'];
            } else {

                $rows = AlcoparModel::query()->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
                    ->from('alcopar_partes')
                    ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                    ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                    ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')
                    ->whereRaw("alcopar_partes.parte = '" . $parte . "'")->get();
                $row = $rows[0];
                $mail = $row['mail'];
                $mail2 = $row['mail2'];
            }

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
                        <p>Por este medio te informamos que la solictud de Alta de Parte ha sido rechazada.<br> </p>
                        <p></p>
                        <p></p>
                        <br>
                        INFORMACION DE LA SOLICITUD
                        <p></p>
                        N&uacute;mero de Parte : " . $parte . "<br>
                        Descripci&oacute;n : " . $descripcion . "<br>	
                        Motivo : " . $motivo . "<br>
                        Modelo : " . $modelo . "<br>
                        Taller : " . $taller . "<br>
                        Dispatch : " . $dispatch . "<br>
                        Comentarios : " . $comentario . "<br>
                        <p></p>
                        Motivo del Rechazo : " . $razon . "<br>
                        <p>
                    ";

            $to = $mail . "," . $mail2;
            $subject = 'Alta de Parte Rechazada por Ingenieria.';
            $type = "Content-type: text/html\r\n";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers = $headers . "From:Whirlpool Service<no-responder@whirlpool.com>\r\n";

            $mail_sent = @mail($to, $subject, $email_message, $headers);

            return true;
        }
    }

    public static function rechazar2()
    {
        

        $nombre = Auth::user()->nombre;
        $username = Auth::user()->username;

        $alcopar = Auth::user()->alcopar;
        $alcopar_nivel = Auth::user()->alcopar_nivel;
        $depto = Auth::user()->depto;


        $existe = session('existe');
        $sustituto = session('sustituto');
        $tipo = session('tipo');
        $comentario = session('comentario');

        $alcopar_id = session('alcopar_id');



        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller, username, parte, comentario,comentario_reving,descripcion,taller')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();
        $row = $rows[0];

        $parte = $row['parte'];
        $fecha = $row['fecha'];
        $descripcion = $row['descripcion'];
        $modelo = $row['modelo'];
        $username_alcopar = $row['username'];
        $motivo = $row['motivo'];
        $dispatch = $row['dispatch'];
        $taller = $row['taller'];
        $tipo_material = $row['tipo_material'];
        $categoria = $row['categoria'];
        $familia = $row['familia'];
        $marca = $row['marca'];
        $tipo_extra = $row['tipo_extra'];
        $nomenclatura = $row['nomenclatura_service'];

        try{
            if ($tipo == 'ALTERNO') {

                $rows = AlcoparModel::query()
                    ->selectRaw('id ')
                    ->from('altapartes')
                    ->limit(1)
                    ->orderBy('id', 'desc')
                    ->get();
                $row = $rows[0];
                $resulta = $row['id'] + 1;
               

                DB::table('altapartes')->insert(
                    [
                        'id' => $resulta,
                        'fecha' => date('Ymd'),
                        'parte' => $parte,
                        'sust' => $sustituto,
                        'username' => $username,
                        'motivo' => 'REVISION SUSTITUTO',
                        'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                        'sustituto' => '1',
                        'depto' => $depto,
                        'modelo' => $modelo,
                        'taller' => $taller,
                        'descripcion' => $descripcion,
                        'dispatch' => $dispatch
                    ]
                );

                $rows = AlcoparModel::query()
                    ->selectRaw('id as alcopar_id')
                    ->from('altapartes')->whereRaw("id = " . $resulta)->get();
                $row = $rows[0];
                $_SESSION['alcopar_id'] = $row['alcopar_id'];

                // echo " 
                // <script language='JavaScript'> 
                // window.open( 'https://soluciones.refaccionoriginal.com/altapartes/revsust/procesarechazar.php')
                // </script>";
                
                if ($existe == "SI") {

                    $rows = AlcoparModel::query()
                        ->selectRaw('material,costo')
                        ->from('reforig_logistica.materiales_costo')->whereRaw("material = '" . $sustituto . "'")->get();
                    $num_rows = $rows->count();



                    if ($num_rows > 0) {
                        $result = $rows[0];
                        if ($result['costo'] == '0.00') {

                            $rows = AlcoparModel::query()
                                ->selectRaw('MAX(id) AS id ')
                                ->from('alcopar_partes')->get();

                            $row = $rows[0];
                            $resulta = $row['id'] + 1;


                            DB::table('alcopar_partes')->insert(
                                [
                                    'id' => $resulta,
                                    'fecha' => $fecha,
                                    'parte' => $sustituto,
                                    'sust' => '',
                                    'depto' => $depto,
                                    'descripcion' => $descripcion,
                                    'modelo' => $modelo,
                                    'username' => $username_alcopar,
                                    'motivo' => $motivo,
                                    'dispatch' => $dispatch,
                                    'taller' => $taller,
                                    'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                                    'reving' => '0',
                                    'otros' => 'Otros',
                                    'comentario_reving' => 'SE GENERÓ PARTE POR RECHAZO DE SUSTITUTO Y NO CUENTA CON COSTO',
                                    'ing' => $username,
                                    'fechareving' => date('Ymd'),
                                    'factible'  => '1',
                                    //'pedido_flag' =>$pedido_flag,
                                    'tipo_material' => $tipo_material,
                                    'categoria' => $categoria,
                                    'familia' => $familia,
                                    'marca' => $marca,
                                    'tipo_extra' => $tipo_extra,
                                    'nomenclatura_service' => $nomenclatura,
                                    'clas_sat_status' => 'PENDIENTE CLASIFICACION SAT',
                                    'clasif_sat' => '1'
                                ]
                            );


                            DB::table('alcopar_partes')
                                ->where('id', $alcopar_id)
                                ->update([
                                    'sust' => '$sustituto',
                                    'fechareving' => date('Ymd'),
                                    'reving' => 0,
                                    'status' => 'RECHAZADA',
                                    'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                    'ing' => $username,
                                    'comentario_reving' => $comentario,
                                    'tipo' => $tipo
                                ]);

                            $descripcion_pedido = $descripcion . ',' . 'SE RECHAZÓ SOLICITUD DE ALTA DE PARTE DEBIDO A QUE CUENTA CON SUSTITUTO ALTERNO';
                        } else {
                            $rows = AlcoparModel::query()
                                ->selectRaw('usuarios.username')
                                ->from('alcopar_partes')
                                ->leftJoin('talleres', ' alcopar_partes.taller', '=', 'talleres.taller')
                                ->leftJoin('usuarios', ' talleres.supervisor', '=', 'usuarios.nombre')
                                ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                                ->get();
                            $row_sql = $rows[0];

                            DB::table('alcopar_partes')
                                ->where('id', $alcopar_id)
                                ->update([
                                    'sust' => $sustituto,
                                    'fechareving' => date('Ymd'),
                                    'reving' => 0,
                                    'status' => 'RECHAZADA',
                                    'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                    'ing' => $username,
                                    'comentario_reving' => $comentario,
                                    'tipo' => $tipo
                                ]);
                        }
                    } else {
                        
                        $rows = AlcoparModel::query()
                            ->selectRaw('MAX(id) AS id ')
                            ->from('alcopar_partes')->get();
                        $row = $rows[0];
                        $resulta = $row['id'] + 1;


                        DB::table('alcopar_partes')->insert(
                            [
                                'id' => $resulta,
                                'fecha' => $fecha,
                                'parte' => $sustituto,
                                'sust' => '',
                                'depto' => $depto,
                                'descripcion' => $descripcion,
                                'modelo' => $modelo,
                                'username' => $username_alcopar,
                                'motivo' => $motivo,
                                'dispatch' => $dispatch,
                                'taller' => $taller,
                                'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                                'reving' => '0',
                                'otros' => 'Otros',
                                'comentario_reving' => 'SE GENERÓ PARTE POR RECHAZO DE SUSTITUTO Y NO CUENTA CON COSTO',
                                'ing' => $username,
                                'fechareving' => date('Ymd'),
                                'factible'  => '1',
                                //'pedido_flag' =>$pedido_flag,
                                'tipo_material' => $tipo_material,
                                'categoria' => $categoria,
                                'familia' => $familia,
                                'marca' => $marca,
                                'tipo_extra' => $tipo_extra,
                                'nomenclatura_service' => $nomenclatura,
                                'clas_sat_status' => 'PENDIENTE CLASIFICACION SAT',
                                'clasif_sat' => '1'
                            ]
                        );
                        DB::table('alcopar_partes')
                            ->where('id', $alcopar_id)
                            ->update([
                                'sust' => $sustituto,
                                'fechareving' => date('Ymd'),
                                'reving' => 0,
                                'status' => 'RECHAZADA',
                                'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                'ing' => $username,
                                'comentario_reving' => $comentario,
                                'tipo' => $tipo
                            ]);
                    }
                } else {
                    DB::table('alcopar_partes')
                        ->where('id', $alcopar_id)
                        ->update([
                            'sust' => $sustituto,
                            'fechareving' => date('Ymd'),
                            'reving' => 0,
                            'status' => 'RECHAZADA',
                            'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                            'ing' => $username,
                            'comentario_reving' => $comentario,
                            'tipo' => $tipo
                        ]);



                    $rows = AlcoparModel::query()
                        ->selectRaw('descripcion,dispatch, motivo,taller, username, parte, comentario,comentario_reving,descripcion,taller')
                        ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();
                    $row = $rows[0];

                    $fecha = $row['fecha'];
                    $descripcion = $row['descripcion'];
                    $modelo = $row['modelo'];
                    $username_alcopar = $row['username'];
                    $motivo = $row['motivo'];
                    $dispatch = $row['dispatch'];
                    $taller = $row['taller'];



                    $rows = AlcoparModel::query()
                        ->selectRaw('MAX(id) AS id ')
                        ->from('alcopar_partes')->get();
                    $row = $rows[0];
                    $resulta = $row['id'] + 1;


                    DB::table('alcopar_partes')->insert(
                        [
                            'id' => $resulta,
                            'fecha' => $fecha,
                            'parte' => $sustituto,
                            'sust' => '',
                            'depto' => $depto,
                            'descripcion' => $descripcion,
                            'modelo' => $modelo,
                            'username' => $username_alcopar,
                            'motivo' => $motivo,
                            'dispatch' => $dispatch,
                            'taller' => $taller,
                            'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                            'reving' => '1',
                            'otros' => 'Otros',
                            'tipo_material' => $tipo_material,
                            'categoria' => $categoria,
                            'familia' => $familia,
                            'marca' => $marca,
                            'tipo_extra' => $tipo_extra,
                            'nomenclatura_service' => $nomenclatura
                        ]
                    );
                }
            } else {
                $rows = AlcoparModel::query()
                    ->selectRaw('MAX(id) AS id ')
                    ->from('altapartes')->get();
                $row = $rows[0];
                $resulta = $row['id'] + 1;

                DB::table('altapartes')->insert(
                    [
                        'id' => $resulta,
                        'fecha' => date('Ymd'),
                        'parte' => $parte,
                        'sust' => $sustituto,
                        'username' => $username,
                        'motivo' => 'REVISION SUSTITUTO',
                        'status' => 'CERRADO',
                        'comentario' => 'PARTE CUENTA CON SUSTITUTO DIRECTO',
                        'sustituto' => '0',
                        'depto' => $depto,
                        'modelo' => $modelo,
                        'taller' => $taller,
                        'descripcion' => $descripcion,
                        'dispatch' => $dispatch,
                        'fechasust' => date('Ymd'),
                        'ingeniero' => $username
                    ]
                );


                if ($existe == "SI") {
                    $rows = AlcoparModel::query()
                        ->selectRaw('material,costo')
                        ->from('reforig_logistica.materiales_costo')->whereRaw("material = '" . $sustituto . "'")->get();
                    $num_rows = $rows->count();

                    if ($num_rows > 0) {
                        $result = $rows[0];
                        if ($result['costo'] == '0.00') {
                            $rows = AlcoparModel::query()
                                ->selectRaw('MAX(id) AS id ')
                                ->from('altapartes')->get();
                            $row = $rows[0];
                            $resulta = $row['id'] + 1;


                            DB::table('alcopar_partes')->insert(
                                [
                                    'id' => $resulta,
                                    'fecha' => $fecha,
                                    'parte' => $sustituto,
                                    'sust' => '',
                                    'depto' => $depto,
                                    'descripcion' => $descripcion,
                                    'modelo' => $modelo,
                                    'username' => $username_alcopar,
                                    'motivo' => $motivo,
                                    'dispatch' => $dispatch,
                                    'taller' => $taller,
                                    'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                                    'reving' => '0',
                                    'otros' => 'Otros',
                                    'comentario_reving' => 'SE GENERÓ PARTE POR RECHAZO DE SUSTITUTO Y NO CUENTA CON COSTO',
                                    'ing' => $username,
                                    'fechareving' => date('Ymd'),
                                    'factible'  => '1',
                                    //'pedido_flag' =>$pedido_flag,
                                    'tipo_material' => $tipo_material,
                                    'categoria' => $categoria,
                                    'familia' => $familia,
                                    'marca' => $marca,
                                    'tipo_extra' => $tipo_extra,
                                    'nomenclatura_service' => $nomenclatura,
                                    'clas_sat_status' => 'PENDIENTE CLASIFICACION SAT',
                                    'clasif_sat' => '1'
                                ]
                            );


                            DB::table('alcopar_partes')
                                ->where('id', $alcopar_id)
                                ->update([
                                    'sust' => '$sustituto',
                                    'fechareving' => date('Ymd'),
                                    'reving' => 0,
                                    'status' => 'RECHAZADA',
                                    'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                    'ing' => $username,
                                    'comentario_reving' => $comentario,
                                    'tipo' => $tipo
                                ]);

                            $descripcion_pedido = $descripcion . ',' . 'SE RECHAZÓ SOLICITUD DE ALTA DE PARTE DEBIDO A QUE CUENTA CON SUSTITUTO ALTERNO';
                        } else {
                            $rows = AlcoparModel::query()
                                ->selectRaw('usuarios.username')
                                ->from('alcopar_partes')
                                ->leftJoin('talleres', ' alcopar_partes.taller', '=', 'talleres.taller')
                                ->leftJoin('usuarios', ' talleres.supervisor', '=', 'usuarios.nombre')
                                ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                                ->get();
                            $row_sql = $rows[0];

                            DB::table('alcopar_partes')
                                ->where('id', $alcopar_id)
                                ->update([
                                    'sust' => $sustituto,
                                    'fechareving' => date('Ymd'),
                                    'reving' => 0,
                                    'status' => 'RECHAZADA',
                                    'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                    'ing' => $username,
                                    'comentario_reving' => $comentario,
                                    'tipo' => $tipo
                                ]);
                        }
                    } else {
                        $rows = AlcoparModel::query()
                            ->selectRaw('MAX(id) AS id ')
                            ->from('alcopar_partes')->get();
                        $row = $rows[0];
                        $resulta = $row['id'] + 1;


                        DB::table('alcopar_partes')->insert(
                            [
                                'id' => $resulta,
                                'fecha' => $fecha,
                                'parte' => $sustituto,
                                'sust' => '',
                                'depto' => $depto,
                                'descripcion' => $descripcion,
                                'modelo' => $modelo,
                                'username' => $username_alcopar,
                                'motivo' => $motivo,
                                'dispatch' => $dispatch,
                                'taller' => $taller,
                                'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO',
                                'reving' => '0',
                                'otros' => 'Otros',
                                'comentario_reving' => 'SE GENERÓ PARTE POR RECHAZO DE SUSTITUTO Y NO CUENTA CON COSTO',
                                'ing' => $username,
                                'fechareving' => date('Ymd'),
                                'factible'  => '1',
                                //'pedido_flag' =>$pedido_flag,
                                'tipo_material' => $tipo_material,
                                'categoria' => $categoria,
                                'familia' => $familia,
                                'marca' => $marca,
                                'tipo_extra' => $tipo_extra,
                                'nomenclatura_service' => $nomenclatura,
                                'clas_sat_status' => 'PENDIENTE CLASIFICACION SAT',
                                'clasif_sat' => '1'
                            ]
                        );
                        DB::table('alcopar_partes')
                            ->where('id', $alcopar_id)
                            ->update([
                                'sust' => $sustituto,
                                'fechareving' => date('Ymd'),
                                'reving' => 0,
                                'status' => 'RECHAZADA',
                                'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                                'ing' => $username,
                                'comentario_reving' => $comentario,
                                'tipo' => $tipo
                            ]);
                    }
                } else {
                    DB::table('alcopar_partes')
                        ->where('id', $alcopar_id)
                        ->update([
                            'sust' => $sustituto,
                            'fechareving' => date('Ymd'),
                            'reving' => 0,
                            'status' => 'RECHAZADA',
                            'comentario' => 'EL MATERIAL CUENTA CON SUSTITUTO',
                            'ing' => $username,
                            'comentario_reving' => $comentario,
                            'tipo' => $tipo
                        ]);



                    $rows = AlcoparModel::query()
                        ->selectRaw('descripcion,dispatch, motivo,taller, username, parte, comentario,comentario_reving,descripcion,taller')
                        ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();
                    $row = $rows[0];

                    $fecha = $row['fecha'];
                    $descripcion = $row['descripcion'];
                    $modelo = $row['modelo'];
                    $username_alcopar = $row['username'];
                    $motivo = $row['motivo'];
                    $dispatch = $row['dispatch'];
                    $taller = $row['taller'];



                    $rows = AlcoparModel::query()
                        ->selectRaw('MAX(id) AS id ')
                        ->from('alcopar_partes')->get();
                    $row = $rows[0];
                    $resulta = $row['id'] + 1;


                    DB::table('alcopar_partes')->insert(
                        [
                            'id' => $resulta,
                            'fecha' => $fecha,
                            'parte' => $sustituto,
                            'sust' => '',
                            'depto' => $depto,
                            'descripcion' => $descripcion,
                            'modelo' => $modelo,
                            'username' => $username_alcopar,
                            'motivo' => $motivo,
                            'dispatch' => $dispatch,
                            'taller' => $taller,
                            'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                            'reving' => '1',
                            'otros' => 'Otros',
                            'tipo_material' => $tipo_material,
                            'categoria' => $categoria,
                            'familia' => $familia,
                            'marca' => $marca,
                            'tipo_extra' => $tipo_extra,
                            'nomenclatura_service' => $nomenclatura
                        ]
                    );
                }
            }
        }
        catch (Exception $e) {
            return "error";
        }

        //if($pedido_flag==''){
        //RUTINA MAIL

        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller, username, parte, comentario,comentario_reving,descripcion,taller')
            ->from('alcopar_partes')->whereRaw("id = " . $alcopar_id)->get();
        $row = $rows[0];
        $descripcion = $row['descripcion'];
        $motivo = $row['motivo'];
        $username_alcopar = $row['username'];
        $taller = $row['taller'];


        if ($taller == '') {
            $rows = AlcoparModel::query()
                ->selectRaw('a.mail,  ing.mail AS mail2')
                ->from('alcopar_partes')
                ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                ->leftJoin('usuarios as ing', 'alcopar_partes.ing', '=', 'ing.username')

                ->whereRaw("alcopar_partes.parte = '" . $sustituto . "'")->get();
            $row = $rows[0];
            $mail = $row['mail'];
            $mail2 = $row['mail2'];
        } else {
            $rows = AlcoparModel::query()
                ->selectRaw('a.mail,  ing.mail AS mail2')
                ->from('alcopar_partes')
                ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                ->leftJoin('usuarios as b', 'talleres.supervisor', '=', 'b.nombre')
                ->leftJoin('usuarios as ing', 'alcopar_partes.ing', '=', 'ing.username')
                ->whereRaw("alcopar_partes.parte = '" . $sustituto . "'")->get();
            $row = $rows[0];

            $mail = $row['mail'];
            $mail2 = $row['mail2'];
            $mail3 = $row['mail3'];
        }

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
            <p>Por este medio te informamos que la solictud de Alta de Parte ha sido rechazada</p>
            <p>debido a que el material cuenta con el n&uacute;mero de sustituto " . $sustituto . "</p>
            <br>
            <p></p>
            <p>Se gener&oacute; de forma autom&aacute;tica una nueva solicitud de alta para este n&uacute;mero </p>
            <p>de parte, y tan pronto se complete el proceso se te notificar&aacute; por correo electr&oacute;nico</p>
            <br>
            INFORMACION DE LA NUEVA SOLICITUD
            <p></p>
            N&uacute;mero de Parte : " . $sustituto . "<br>
            Descripci&oacute;n : " . $descripcion . "<br>	
            Comentarios : " . $comentario . "<br>
            Dispatch : " . $dispatch . "<br>
            <p></p>
            Motivo del Rechazo : EL MATERIAL CUENTA CON SUSTITUTO<br>
            <p>
            ";
        $to = $mail . "," . $mail2 . "," . $mail3;
        $subject = 'Alta de Parte Cancelada por Ingenieria.';
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";

        $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers . "From:Whirlpool Service<no-responder@whirlpool.com>\r\n";

        $mail_sent = @mail($to, $subject, $email_message, $headers);

        return true;
    }

    public static function reasignar()
    {

        $nombre = session('nombre');
        $username = session('username');
        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentarios = session('comentario');
        $asigna = session('asigna');

        //REVING
        if ($asigna == 'REVMAT') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'reving' => 0, 'factible' => 1, 'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO'
                    )
                );

            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'REV MATERIALES'
                ]
            );
        } elseif ($asigna == 'ALTA') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PARTE AUTORIZADA POR DARSE DE ALTA EN SAP', 'reving' => 0, 'alta' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA SAP'
                ]
            );
        } elseif ($asigna == 'COSTO') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'COSTO ESTANDAR POR ASIGNAR', 'reving' => 0, 'costo' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA COSTO'
                ]
            );
        } elseif ($asigna == 'PRECIO') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PRECIO DE LISTA POR ASIGNAR', 'reving' => 0, 'precio' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA PRECIO'
                ]
            );
        } elseif ($asigna == 'OOW') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PENDIENTE PRECIO OOW', 'reving' => 0, 'oow' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'REV INGENIERIA',
                    'modulo_act' => 'ALTA OOW'
                ]
            );
        }
    }



    public static function getprocesorechazar()
    {


        $data = [];

        $row1 = AlcoparModel::query()->selectRaw(' id,
        parte,
        modelo,
        dispatch,
        descripcion,
        taller,
        status,
        pregunta,
        otros,
        username,
        motivo,
        tipo_material,
        categoria,
        familia,
        marca
        tipo_extra')
            ->from('alcopar_partes')
            ->whereRaw('id = \'' . session('alcopar_id') . '\'')
            ->get();

        $data['row'] = $row1[0];

        $username_alcopar = $row1[0]['username'];

        $row1 = AlcoparModel::query()->selectRaw('username')
            ->from('usuarios')
            ->whereRaw('username = \'' . $username_alcopar . '\'')
            ->get();

        $data['nombre'] = $row1[0]['nombre_usuario'];

        return $data;
    }

    public static function get_material_alta()
    {
        $data = [];

        $rows = AlcoparModel::query()
            ->selectRaw('id_tipo_material,tipo_material')
            ->from('alcopar_tipo_material')
            ->get();
        $data['tipomaterial'] = $rows;

        $rows = AlcoparModel::query()
            ->selectRaw('id_categoria,categoria')
            ->from('alcopar_categoria')
            ->get();
        $data['categoria'] = $rows;

        $rows = AlcoparModel::query()
            ->selectRaw('id,marca')
            ->from('alcopar_marca')
            ->get();
        $data['marca'] = $rows;

        return $data;
    }

    public static function altamaterial($username,$mail,$depto,$descripcion,$modelo,$taller,$dispatch,$donde,$otro,$tipo_material,$categoria,$familia,$marca1,$marca2,$categoria_extra,$motivo)
    {
        $parte= session("parte");        
        $rows = AlcoparModel::query()
        ->selectRaw('parte, status')
        ->from('alcopar_partes')
        ->whereRaw("parte='" . $parte . "'")
        ->get();
        
        $renglones = $rows->count();
        

        if ($donde == 0) {
            $donde = 'Del Explosionado';
        } elseif ($donde == 1) {
            $donde = 'Solicitud de Ingenieria (Ing me lo dio)';
        } elseif ($donde == 2) {
            $donde = 'Sustitutos de Centro de Soluciones';
        } elseif ($donde == 3) {
            $donde = 'Zpricep / Sustituto en SAP';
        } elseif ($donde == 4) {
            $donde = 'Part Smart';
        } elseif ($donde == 5) {
            $donde = 'Otros';
        }
        if ($tipo_material == '1' or $tipo_material == '3') {
            $marca = $marca1;
        } elseif ($tipo_material == '4') {
            $marca = $marca2;
            $categoria_extra = '0';
        } else {
            $marca = '0';
            $categoria_extra = '0';
        }


        $concatenate = $tipo_material . $categoria . $familia . $marca . $categoria_extra;

        if ($renglones == 0) {

            $rows = AlcoparModel::query()
                ->selectRaw('MAX(id) AS id ')
                ->from('alcopar_partes')->get();
            $row = $rows[0];
            $resulta = $row['id'] + 1;


            DB::table('alcopar_partes')->insert(
                [
                    'id'=>$resulta,
                    'fecha'=>date('Ymd'),
                    'parte'=>$parte,
                    'sust'=>'',
                    'depto'=>$depto,
                    'descripcion'=>$descripcion,
                    'pregunta'=>$donde,
                    'otros'=>$otro,
                    'modelo'=>$modelo,
                    'username'=>$username,
                    'motivo'=>$motivo,
                    'status'=>'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                    'reving'=>'1',
                    'taller'=>$taller,
                    'dispatch'=>$dispatch,
                    'tipo_material'=>$tipo_material,
                    'categoria'=>$categoria,
                    'familia' => $familia,
                    'marca'=>$marca,
                    'tipo_extra' => $categoria_extra,
                    'nomenclatura_service' => $concatenate
                ]
            );
                      

            if ($taller == '') {
                $rows = AlcoparModel::query()
                ->selectRaw('usuarios.mail')
                ->from('alcopar_partes')
                ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
                ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                ->get();

                $row = $rows[0];                              
                $mail = $row['mail'];

            } else {

                $rows = AlcoparModel::query()
                ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
                ->from('alcopar_partes')
                ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')

                ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                ->get();

                $row = $rows[0];                                              
                $mail = $row['mail'];
                $mail2 = $row['mail2'];
            }
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
            <p>Por este medio te informamos que se ha dado seguimiento al proceso de Alta de Parte.<br> </p>
            <p></p>
            <p></p>
            <br>
            INFORMACION DE LA SOLICITUD
            <p></p>
            N&uacute;mero de Parte : " . $parte . "<br>
            Descripci&oacute;n : " . $descripcion . "<br>
            Modelo : " . $modelo . "<br>
            Taller : " . $taller . "<br>
            Dispatch : " . $dispatch . "<br>

            Comentarios : " . $motivo . "<br>
            <p></p>
            <p>
            ";
            if(isset($mail2)){
                $to = $mail . "," . $mail2;
            }else{
                $to = $mail;
            }
            
            $subject = 'Proceso de Alta de Parte ha Iniciado.';
            $type = "Content-type: text/html\r\n";
            $headers = "MIME-Version: 1.0 \r\n";
            $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

            $mail_sent = @mail($to, $subject, $email_message, $headers);

            return true;
        } else {
            $row1 = $rows[0];        
            $status = $row1['status'];
            if ($status == 'CANCELADA') {


                $rows = AlcoparModel::query()
                ->selectRaw('MAX(id) AS id ')
                ->from('alcopar_partes')->get();
                $row = $rows[0];
                $resulta = $row['id'] + 1;


                DB::table('alcopar_partes')->insert(
                    [
                        'id'=>$resulta,
                        'fecha'=>date('Ymd'),
                        'parte'=>$parte,
                        'sust'=>'',
                        'depto'=>$depto,
                        'descripcion'=>$descripcion,
                        'pregunta'=>$donde,
                        'otros'=>$otro,
                        'modelo'=>$modelo,
                        'username'=>$username,
                        'motivo'=>$motivo,
                        'status'=>'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                        'reving'=>'1',
                        'taller'=>$taller,
                        'dispatch'=>$dispatch,
                        'tipo_material'=>$tipo_material,
                        'categoria'=>$categoria,
                        'familia' => $familia,
                        'marca'=>$marca,
                        'tipo_extra' => $categoria_extra,
                        'nomenclatura_service' => $concatenate
                    ]
                );                        

                if ($taller == '') {
                    $rows = AlcoparModel::query()
                    ->selectRaw('usuarios.mail')
                    ->from('alcopar_partes')
                    ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
                    ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                    ->get();    
                    $row = $rows[0];                              
                    $mail = $row['mail'];    
                } else {    
                    $rows = AlcoparModel::query()
                    ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
                    ->from('alcopar_partes')
                    ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
                    ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
                    ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')    
                    ->whereRaw("alcopar_partes.parte = '" . $parte . "'")
                    ->get();
    
                    $row = $rows[0];                                              
                    $mail = $row['mail'];
                    $mail2 = $row['mail2'];
                }

                
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
                <p>Por este medio te informamos que se ha dado seguimiento al proceso de Alta de Parte.<br> </p>
                <p></p>
                <p></p>
                <br>
                INFORMACION DE LA SOLICITUD
                <p></p>
                N&uacute;mero de Parte : " . $parte . "<br>
                Descripci&oacute;n : " . $descripcion . "<br>
                Modelo : " . $modelo . "<br>
                Taller : " . $taller . "<br>
                Dispatch : " . $dispatch . "<br>
                Comentarios : " . $motivo . "<br>
                <p></p>
                <p>
                ";

                if(isset($mail2)){
                    $to = $mail . "," . $mail2;
                }else{
                    $to = $mail;
                }
                $subject = 'Proceso de Alta de Parte ha Iniciado.';
                $type = "Content-type: text/html\r\n";
                $headers = "MIME-Version: 1.0 \r\n";
                $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
                $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

                $mail_sent = @mail($to, $subject, $email_message, $headers);
                return true;
            } else {
                //material existente
                return false;
            }
        }
    }

    public static function materialexistente(){
        $data = [];
        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller,modelo, username, parte, comentario,comentario_reving,descripcion,clasif_sat,nomenclatura_service,fecha,status')
            ->from('alcopar_partes')->whereRaw("parte = '" . session('parte')."'")->get();

        $data['partes'] = $rows[0];
           
        $rows = AlcoparModel::query()
        ->selectRaw('descripcion,dispatch, motivo,taller,modelo, username, parte, comentario,comentario_reving,descripcion,clasif_sat,nomenclatura_service,fecha,status')
        ->from('alcopar_partes')->whereRaw("parte = '" . $rows[0]['']."'")->get();

        $data['row1'] = $rows->count();
        $data['row2'] = $rows[0];
        
        return $data;        
    }
    public static function altamaterialexistentegrabar(){
        $username = Auth::user()->username;                            
        $motivo= session('motivo');
        $depto = Auth::user()->depto;          
        $rows = AlcoparModel::query()
            ->selectRaw('MAX(id) AS id ')
            ->from('altapartes')->get();
        $row1 = $rows[0];
        $resulta = $row1['id'] + 1;


        $rows = AlcoparModel::query()
            ->selectRaw('descripcion,dispatch, motivo,taller,modelo, username, parte, comentario,comentario_reving,descripcion,clasif_sat,nomenclatura_service')
            ->from('alcopar_partes')->whereRaw("parte = '" . session('parte')."'")->get();

        $row = $rows[0];

        $descripcion=$row['descripcion'];
        $modelo=$row['modelo'];
        $taller=$row['taller'];
        $dispatch=$row['dispatch'];

        DB::table('altapartes')->insert(
            [
                'id'=>$resulta,
                'fecha'=>date('Ymd'),
                'parte'=>session('parte'),
                'sust'=>'',
                'depto'=>$depto,
                'taller'=>$taller,
                'dispatch'=>$dispatch,
                'descripcion'=>$descripcion,
                'modelo'=>$modelo,
                'username'=>$username,
                'motivo'=>$motivo,
                'status'=>'EN REVISION DE LA INFORMACION DEL NUM DE PARTE',
                'reving'=>'1'
            ]
        );
            

        if ($taller == '') {
            $rows = AlcoparModel::query()
            ->selectRaw('usuarios.mail')
            ->from('alcopar_partes')
            ->leftJoin('usuarios', 'alcopar_partes.username', '=', 'usuarios.username')
            ->whereRaw("alcopar_partes.parte = '" . session('parte') . "'")
            ->get();    
            $row = $rows[0];                              
            $mail = $row['mail'];    
        } else {    
            $rows = AlcoparModel::query()
            ->selectRaw('talleres.supervisor, a.mail, b.mail AS mail2')
            ->from('alcopar_partes')
            ->leftJoin('usuarios AS a', 'alcopar_partes.username', '=', 'a.username')
            ->leftJoin('talleres', 'alcopar_partes.taller', '=', 'talleres.taller')
            ->leftJoin('usuarios AS b', 'talleres.supervisor', '=', 'b.nombre')    
            ->whereRaw("alcopar_partes.parte = '" . session('parte') . "'")
            ->get();

            $row = $rows[0];                                              
            $mail = $row['mail'];
            $mail2 = $row['mail2'];
        }
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
            <p>Por este medio te informamos que se ha dado seguimiento al proceso de Alta de Parte.<br> </p>
            <p></p>
            <p></p>
            <br>
            INFORMACION DE LA SOLICITUD
            <p></p>
            N&uacute;mero de Parte : ".session('parte')."<br>
            Descripci&oacute;n : ".$descripcion."<br>
            Modelo : ".$modelo."<br>
            Taller : ".$taller."<br>
            Dispatch : ".$dispatch."<br>
            
            Comentarios : ".$motivo."<br>
            <p></p>
            <p>
        ";

        $to = $mail . "," . $mail2;
        $subject = 'Proceso de Alta de Parte ha Iniciado.'; 
        $type = "Content-type: text/html\r\n";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers = $headers."Content-type: text/html;charset=iso-8859-1\r\n";
        $headers = $headers."From: Whirlpool Service<no-responder@whirlpool.com>\r\n";

        $mail_sent = @mail( $to, $subject,$email_message, $headers);

    }
    public static function altamaterialexistenteagregar(){
        $mail = Auth::user()->mail;             
        $id_alcopar=session('id');                
        DB::table('alcopar_partes_mail')->insert(
            [
                'idalcopar'=>$id_alcopar,
                'mail'=>$mail               
            ]
        );                      
    }    


    public static function get_classat()
    {

        $data = [];
        $return = [];
        // Records for Managers.


        $data = AlcoparModel::query()->selectRaw('
        id,
        parte,
        descripcion,
        modelo,
        fecha,
        DATEDIFF(CURDATE(),fechareving) as \'dias\', 
        DATEDIFF(CURDATE(),fecha) as \'dias2\',        
        motivo')
            ->from('alcopar_partes')
            ->whereRaw('clasif_sat =1 or costo=1 ORDER BY FIELD (motivo,\'PROYECTOS, STOCK INICIAL\',\'PROYECTOS, STOCK FINAL\') ASC,fecha ASC')
            ->get();

        foreach ($data as $k => $row) {

            $id = $row['id'];

            $row2 = AlcoparModel::query()->selectRaw('DATEDIFF(CURDATE(),fecha_asignacion) as \'dias\', modulo_act')
                ->from('alcopar_partes_historial')->whereRaw("alcopar_id='" . $id . "' ORDER BY fecha_asignacion DESC")->get();

            $dias = @$row2[0]['dias'];
            $modulo_act = @$row2[0]['modulo_act'];

            $return[$k]['id'] = $row['id'];
            $return[$k]['parte'] = $row['parte'];
            $return[$k]['descripcion'] = $row['descripcion'];
            $return[$k]['modelo'] = $row['modelo'];
            $return[$k]['fecha'] = $row['fecha'];
            $return[$k]['dias2'] = $row['dias2'];
            $return[$k]['dias'] = $row['dias'];
            if ($dias <> '' and $modulo_act == 'REV MATERIALES') {
                $return[$k]['diasd'] = $dias;
            } else {
                $return[$k]['diasd'] = $row['dias'];
            }
            $return[$k]['taller'] = $row['taller'];
            $return[$k]['dispatch'] = $row['dispatch'];

            $return[$k]['status'] = $row['status'];
            $return[$k]['motivo'] = $row['motivo'];
        }


        return $return;
    }    
    






    public static function get_precio()
    {
        


        

        $data = [];
        $return = [];
        // Records for Managers.

        $data = AlcoparModel::query()->selectRaw('
                    alcopar_partes.id,
                    parte, 
                    descripcion, 
                    modelo ,
                    fecha, 
                    DATEDIFF(CURDATE(),fechacosto) as \'dias\', 
                    DATEDIFF(CURDATE(),fecha) as \'dias4\', 
                    DATEDIFF(CURDATE(),fechafactible) as \'dias2\', 
                    precio, 
                    factible, 
                    alta, costo ,
                    alcopar_categoria.categoria,
                    alcopar_tipo_extra.tipo_extra,
                    alcopar_familia.familia,
                    alcopar_marca.marca,
                    alcopar_tipo_material.tipo_material')
            ->from('alcopar_partes')
            ->leftJoin('alcopar_categoria', 'alcopar_partes.categoria', '=', 'alcopar_categoria.id_categoria')
            ->leftJoin('alcopar_familia' , 'alcopar_partes.familia','=', 'alcopar_familia.id_familia')
            ->leftJoin('alcopar_marca' , 'alcopar_partes.marca','=', 'alcopar_marca.id')
            ->leftJoin('alcopar_tipo_extra', 'alcopar_partes.tipo_extra', '=', 'alcopar_tipo_extra.id')
            ->leftJoin('alcopar_tipo_material', 'alcopar_partes.tipo_material', '=', 'alcopar_tipo_material.id_tipo_material')
            ->whereRaw('precio =1 ORDER BY  FIELD (motivo,\'PROYECTOS, STOCK INICIAL\',\'PROYECTOS, STOCK FINAL\') ASC, fecha ASC')
            ->get();

        foreach ($data as $k => $row) {

            $id = $row['id'];

            $row2 = AlcoparModel::query()->selectRaw('DATEDIFF(CURDATE(),fecha_asignacion) as \'dias3\', modulo_act')
                ->from('alcopar_partes_historial')->whereRaw("alcopar_id='" . $id . "' ORDER BY fecha_asignacion DESC")->get();
            
            $dias3 = @$row2[0]['dias'];
            $modulo_act = @$row2[0]['modulo_act'];
            

            $return[$k]['id'] = $row['id'];
            $return[$k]['parte'] = $row['parte'];
            $return[$k]['descripcion'] = $row['descripcion'];
            $return[$k]['modelo'] = $row['modelo'];
            $return[$k]['fecha'] = $row['fecha'];
            $return[$k]['dias4'] = $row['dias4'];
            $return[$k]['dias'] = $row['dias'];
            $return[$k]['tipo_extra'] = $row['tipo_extra'];
            if($dias3<>'' and $modulo_act=='ALTA PRECIO'){
                $return[$k]['diasd'] = $dias3;

             }
             else{
                $return[$k]['diasd'] = $row['dias2'];
             }            
            $return[$k]['taller'] = $row['taller'];
            $return[$k]['dispatch'] = $row['dispatch'];
            $return[$k]['status'] = $row['status'];
            $return[$k]['motivo'] = $row['motivo'];

            $return[$k]['tipo_material'] = $row['tipo_material'];
            $return[$k]['categoria'] = $row['categoria'];
            $return[$k]['familia'] = $row['familia'];
            $return[$k]['marca'] = $row['marca'];       
        }


        return $return;
    }


    public static function get_oow()
    {
        
        $data = [];
        $return = [];
        // Records for Managers.


        $data = AlcoparModel::query()->selectRaw('
        id,
        parte,
        descripcion,
        modelo,
        fecha,
        DATEDIFF(CURDATE(),fechareving) as \'dias\', 
        DATEDIFF(CURDATE(),fecha) as \'dias2\',        
        motivo')
            ->from('alcopar_partes')
            ->whereRaw('oow =1 ORDER BY FIELD (motivo,\'PROYECTOS, STOCK INICIAL\',\'PROYECTOS, STOCK FINAL\') ASC,fecha ASC')
            //->limit(50)
            ->get();

        foreach ($data as $k => $row) {

            $id = $row['id'];

            $row2 = AlcoparModel::query()->selectRaw('DATEDIFF(CURDATE(),fecha_asignacion) as \'dias\', modulo_act')
                ->from('alcopar_partes_historial')->whereRaw("alcopar_id='" . $id . "' ORDER BY fecha_asignacion DESC")->get();

            $dias = @$row2[0]['dias'];
            $modulo_act = @$row2[0]['modulo_act'];

            $return[$k]['id'] = $row['id'];
            $return[$k]['parte'] = $row['parte'];
            $return[$k]['descripcion'] = $row['descripcion'];
            $return[$k]['modelo'] = $row['modelo'];
            $return[$k]['fecha'] = $row['fecha'];
            $return[$k]['dias2'] = $row['dias2'];
            $return[$k]['dias'] = $row['dias'];
            if ($dias <> '' and  $modulo_act=='ALTA OOW') {
                $return[$k]['diasd'] = $dias;
            } else {
                $return[$k]['diasd'] = $row['dias'];
            }
            $return[$k]['taller'] = $row['taller'];
            $return[$k]['dispatch'] = $row['dispatch'];

            $return[$k]['status'] = $row['status'];
            $return[$k]['motivo'] = $row['motivo'];
        }


        return $return;
    }   


    public static function reasignaroow()
    {

        $nombre = session('nombre');
        $username = session('username');
        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentarios = session('comentario');
        $asigna = session('asigna');
      
        //REVING
        if ($asigna == 'REVMAT') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'factible' => 1, 'oow' => 0, 'reving' => 0, 'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO'
                    )
                );

            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'REV MATERIALES'
                ]
            );
        } 
        elseif ($asigna == 'REVING') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE', 
                        'oow' => 0, 'reving' => 1,  'factible' => 0
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'REV INGENIERIA'
                ]
            );
        }
        elseif ($asigna == 'ALTA') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PARTE AUTORIZADA POR DARSE DE ALTA EN SAP', 
                        'oow' => 0, 'alta' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'ALTA SAP'
                ]
            );
        } elseif ($asigna == 'COSTO') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'COSTO ESTANDAR POR ASIGNAR', 'oow' => 0, 'costo' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'ALTA COSTO'
                ]
            );
        } elseif ($asigna == 'PRECIO') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PRECIO DE LISTA POR ASIGNAR', 'oow' => 0, 'precio' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'ALTA PRECIO'
                ]
            );
        } elseif ($asigna == 'OOW') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PENDIENTE PRECIO OOW', 'oow' => 0, 'oow' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA OOW',
                    'modulo_act' => 'ALTA OOW'
                ]
            );
        }
    }


    public static function reasignarprecio()
    {

        $nombre = session('nombre');
        $username = session('username');
        $alcopar_id = session('alcopar_id');
        $alcopar = session('alcopar');
        $alcopar_nivel = session('alcopar_nivel');
        $comentarios = session('comentario');
        $asigna = session('asigna');

        //REVING
        if ($asigna == 'REVMAT') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'reving' => 0, 'factible' => 1 , 'precio' => 0, 'status' => 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO'
                    )
                );

            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'REV MATERIALES'
                ]
            );
        } 
        elseif ($asigna == 'REVING') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE', 
                        'precio' => 0, 'factible' => 0, 'reving' => 1
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'REV INGENIERIA'
                ]
            );
        }
        elseif ($asigna == 'ALTA') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PARTE AUTORIZADA POR DARSE DE ALTA EN SAP', 
                        'precio' => 0, 'alta' => 1, 'factible' => 0, 'reving' => 0
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'ALTA SAP'
                ]
            );
        } elseif ($asigna == 'COSTO') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'COSTO ESTANDAR POR ASIGNAR', 'precio' => 0, 'costo' => 1, 'factible' => 0, 'reving' => 0
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'ALTA COSTO'
                ]
            );
        } elseif ($asigna == 'PRECIO') {
            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PRECIO DE LISTA POR ASIGNAR', 'precio' => 1, 'factible' => 0, 'reving' => 0
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'ALTA PRECIO'
                ]
            );
        } elseif ($asigna == 'OOW') {

            DB::table('alcopar_partes')
                ->where('id', $alcopar_id)
                ->update(
                    array(
                        'status' => 'PENDIENTE PRECIO OOW', 'precio' => 0, 'oow' => 1, 'factible' => 0, 'reving' => 0
                    )
                );
            DB::table('alcopar_partes_historial')->insert(
                [
                    'alcopar_id' => $alcopar_id,
                    'comentarios' => $comentarios,
                    'fecha_asignacion' => date('Ymd'),
                    'usuario' => $username,
                    'modulo_ant' => 'ALTA PRECIO',
                    'modulo_act' => 'ALTA OOW'
                ]
            );
        }
    }

    public static function historial($id){
        $rows = AlcoparModel::query()->selectRaw('comentarios, fecha_asignacion, usuario, modulo_ant, modulo_act')
        ->from('alcopar_partes_historial')->whereRaw("alcopar_id = '$id'  ORDER BY fecha_asignacion DESC")->get();
        return $rows;
    }


}
