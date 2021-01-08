<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;

date_default_timezone_set("America/Mexico_City");

class TicketsAbiertosModel extends ModelBase
{
   

    public static function get_records_by_id($id)
    {
        
        $data = TicketsAbiertosModel::select('stock_gral_serv.*')
                        ->from('stock_gral_serv')
                        ->where('id', $id)
                        ->get();

        return $data;
    }

    public static function insert_load_data_guias($data, $username, $date)
    {
        /*DB::table('tickets_abiertos_guias')->insert(
            ['document' => (empty($data[1]) ? NULL : $data[1]),
            'material' => (empty($data[2]) ? NULL : $data[2]),
            'delivery' => (empty($data[3]) ? NULL : $data[3]),
            'po' => (empty($data[4]) ? NULL : $data[4]),
            'status' => (empty($data[5]) ? NULL : $data[5]),
            'sold_to' => (empty($data[6]) ? NULL : $data[6]),
            'doc_date' => (empty($data[7]) ? NULL : $data[7]),
            'sorg' => (empty($data[8]) ? NULL : $data[8]),
            'dc' => (empty($data[9]) ? NULL : $data[9]),
            'dv' => (empty($data[10]) ? NULL : $data[10]),
            'saty' => (empty($data[11]) ? NULL : $data[11]),
            'created_by' => (empty($data[12]) ? NULL : $data[12]),
            'item' => (empty($data[13]) ? NULL : $data[13]),
            'plnt' => (empty($data[14]) ? NULL : $data[14]),
            'delive' => (empty($data[15]) ? NULL : $data[15]),
            'qty' => (empty($data[16]) ? NULL : $data[16]),
            'qty1' => (empty($data[17]) ? NULL : $data[17]),
            'freight' => (empty($data[18]) ? NULL : $data[18]),
            'handling_unit' => (empty($data[19]) ? NULL : $data[19]),
            'invoice' => (empty($data[20]) ? NULL : $data[20]),
            'inv_ch' => (empty($data[21]) ? NULL : $data[21]),
            'qty3' => (empty($data[22]) ? NULL : $data[22]),
            'ship_city' => (empty($data[23]) ? NULL : $data[23]),
            'ship_date' => (empty($data[24]) ? NULL : $data[24]),
            'ship_fax' => (empty($data[25]) ? NULL : $data[25]),
            'ship_name' => (empty($data[26]) ? NULL : $data[26]),
            'shi' => (empty($data[27]) ? NULL : $data[27]),
            'ship_street' => (empty($data[28]) ? NULL : $data[28]),
            'ship_tel' => (empty($data[29]) ? NULL : $data[29]),
            'ship' => (empty($data[30]) ? NULL : $data[30]),
            'sold_city' => (empty($data[31]) ? NULL : $data[31]),
            'sold_fax' => (empty($data[32]) ? NULL : $data[32]),
            'sold_name' => (empty($data[33]) ? NULL : $data[33]),
            'sol' => (empty($data[34]) ? NULL : $data[34]),
            'sold_street' => (empty($data[35]) ? NULL : $data[35]),
            'sold_tel' => (empty($data[36]) ? NULL : $data[36]),
            'sold' => (empty($data[37]) ? NULL : $data[37]),
            'stock' => (empty($data[38]) ? NULL : $data[38]),
            'tracking_number' => (empty($data[39]) ? NULL : $data[39]),
            'pck_delivery' => (empty($data[40]) ? NULL : $data[40]),
            'pck_name' => (empty($data[41]) ? NULL : $data[41]),
            'weight' => (empty($data[42]) ? NULL : $data[42]),
            'carr_id' => (empty($data[43]) ? NULL : $data[43]),
            'uploaded_by' => $username,
            'uploaded_at' => $date]);*/

            DB::table('tickets_abiertos_guias')->insert(
                ['document' => (empty($data[0]) ? NULL : $data[0]),
                'tracking_number' => (empty($data[38]) ? NULL : $data[38]),
                'uploaded_by' => $username,
                'uploaded_at' => $date]);

            DB::table('tickets_servicios_abiertos')
                ->where('ped_resrv', $data[0])
                ->update(['guia' => (empty($data[38]) ? NULL : $data[38])]);
    }

    public static function insert_load_data_pedidos($data, $username, $date)
    {
        /*DB::table('tickets_abiertos_pedidos')->insert(
            ['document' => (empty($data[1]) ? '0' : $data[1]),
            'po' => (empty($data[3]) ? NULL : $data[3]),
            'doc_date' => (empty($data[4]) ? NULL : $data[4]),
            'saty' => (empty($data[5]) ? NULL : $data[5]),
            'created' => (empty($data[6]) ? NULL : $data[6]),
            'sold_to' => (empty($data[7]) ? NULL : $data[7]),
            'name' => (empty($data[8]) ? NULL : $data[8]),
            'net_value' => (empty($data[9]) ? NULL : $data[9]),
            'status' => (empty($data[10]) ? NULL : $data[10]),
            'dbi' => (empty($data[11]) ? NULL : $data[11]),
            'uploaded_by' => $username,
            'uploaded_at' => $date]);*/

            DB::table('tickets_abiertos_pedidos')->insert(
            ['document' => (empty($data[0]) ? '0' : $data[0]),
            'po' => (empty($data[1]) ? NULL : $data[1]),
            'doc_date' => (empty($data[2]) ? NULL : $data[2]),
            'status' => (empty($data[8]) ? NULL : $data[8]),
            'uploaded_by' => $username,
            'uploaded_at' => $date]);
    }

    public static function insert_load_data_reservas($data, $username, $date)
    {
        /*DB::table('tickets_abiertos_reservas')->insert(
            ['reserv_no' => (empty($data[1]) ? '0' : $data[1]),
            'itm' => (empty($data[2]) ? NULL : $data[2]),
            'date' => (empty($data[3]) ? NULL : $data[3]),
            'mvt' => (empty($data[4]) ? NULL : $data[4]),
            'material' => (empty($data[5]) ? NULL : $data[5]),
            'material_descrp' => (empty($data[6]) ? NULL : $data[6]),
            'req_qty' => (empty($data[7]) ? NULL : $data[7]),
            'recipient' => (empty($data[8]) ? NULL : substr(trim($data[8]), 0, -2)),
            'plnt' => (empty($data[9]) ? NULL : $data[9]),
            'user' => (empty($data[10]) ? NULL : $data[10]),
            'dc' => (empty($data[11]) ? NULL : $data[11]),
            'rct' => (empty($data[12]) ? NULL : $data[12]),
            'del' => (empty($data[13]) ? NULL : $data[13]),
            'rst' => (empty($data[14]) ? NULL : $data[14]),
            'mvt2' => (empty($data[15]) ? NULL : $data[15]),
            'fls' => (empty($data[16]) ? NULL : $data[16]),
            'cost' => (empty($data[17]) ? NULL : $data[17]),
            'uploaded_at' => $date,
            'uploaded_by' => $username]);*/

        DB::table('tickets_abiertos_reservas')->insert(
            ['reserv_no' => (empty($data[0]) ? '0' : $data[0]),
            'date' => (empty($data[2]) ? NULL : $data[2]),
            'recipient' => (empty($data[7]) ? NULL : substr(trim($data[7]), 0, -2)),
            'del' => (empty($data[12]) ? NULL : $data[12]),
            'uploaded_at' => $date,
            'uploaded_by' => $username]);
    }

    public static function insert_load_data_pex($data, $username, $date)
    {
        /*DB::table('tickets_abiertos_pex')->insert(
            ['ticket' => (empty($data[1]) ? '0' : $data[1]),
            'ticket1' => (empty($data[2]) ? NULL : $data[2]),
            'id_serie' => (empty($data[4]) ? NULL : $data[4]),
            'descrp_trabajo' => NULL,
            'estado' => (empty($data[6]) ? NULL : TicketsAbiertosModel::clean_acentos($data[6])),
            'cc' => (empty($data[7]) ? NULL : $data[7]),
            'creado_el' => NULL,
            'creado_por' => NULL,
            'blank' => NULL,
            'producto_registrado' => NULL,
            'blank2' => NULL,
            'modelo_producto' => (empty($data[13]) ? NULL : $data[13]),
            'muebleria' => NULL,
            'sucursal' => NULL,
            'fecha_compra' => NULL,
            'marca_producto' => NULL,
            'tickets_relacionados' => (empty($data[18]) ? NULL : $data[18]),
            'blank3' => NULL,
            'estado_ubicacion_servicio' => NULL,
            'ciudad' => NULL,
            'zfecha_emision_acp' => (empty($data[22]) ? NULL : $data[22]),
            yes 'zfolio_acp' => (empty($data[23]) ? NULL : $data[23]),
            'zmodelonp_acp' => (empty($data[24]) ? NULL : $data[24]),
            'zid_taller' => (empty($data[25]) ? NULL : $data[25]),
            'justificacion' => NULL,
            'categoria_causa' => NULL,
            'categoria_resol' => NULL,
            'metodo_cambio' => NULL,
            'creado_el2' => NULL,
            'creado_por2' => NULL,
            'blank4' => NULL,
            'pedido_reserva' => NULL,
            yes 'estado2' => (empty($data[34]) ? NULL : $data[34]),
            'justificacion_cancelacion' => NULL,
            'justificacion_rechazo' => NULL,
            'razones_rechazo' => NULL,
            'fecha_rechazo' => ((empty($data[38]) || $data[38] == "#") ? NULL : $data[38]),
            'fecha_cancelacion' => ((empty($data[39]) || $data[39] == "#")? NULL : $data[39]),
            'equipos_tecnicos' => (empty($data[40]) ? NULL : $data[40]),
            'blank5' => (empty($data[41]) ? NULL : $data[41]),
            'gerente' => (empty($data[42]) ? NULL : $data[42]),
            'blank6' => (empty($data[43]) ? NULL : $data[43]),
            'tecnico_serv_cabecera' => (empty($data[44]) ? NULL : $data[44]),
            'blank7' => (empty($data[45]) ? NULL : $data[45]),
            'zona' => (empty($data[46]) ? NULL : $data[46]),
            'categoria_taller' => (empty($data[47]) ? NULL : $data[47]),
            'aprobador' => (empty($data[48]) ? NULL : $data[48]),
            'blank8' => (empty($data[49]) ? NULL : $data[49]),
            'updated_at' => $date,
            'updated_by' => $username]);*/
            
            DB::table('tickets_abiertos_pex')->insert(
                ['ticket' => (empty($data[0]) ? '0' : $data[0]),
                'ticket1' => (empty($data[1]) ? NULL : $data[1]),
                'zfolio_acp' => (empty($data[22]) ? NULL : $data[22]),
                'estado2' => (empty($data[33]) ? NULL : TicketsAbiertosModel::clean_acentos($data[33])),
                'blank3' => (empty($data[18]) ? NULL : $data[18]),
                'updated_at' => $date,
                'updated_by' => $username]);
    }

    public static function insert_load_data_tickets($data, $username, $date)
    {
        $data_x = TicketsAbiertosModel::select("tickets_abiertos.ticket")
                     ->from('tickets_abiertos')
                            ->where('ticket', $data[1])
                            ->get();
        
        if(count($data_x) == 0)
        {
            /*DB::table('tickets_abiertos')->insert(
                ['ticket' => (empty($data[1]) ? NULL : $data[1]),
                'ticket_id' => (empty($data[2]) ? 0 : $data[2]),
                'categoria_producto' => (empty($data[3]) ? NULL : $data[3]),
                'id_serie' => (empty($data[4]) ? NULL : $data[4]),
                'descrip_trabajo' => (empty($data[5]) ? NULL : $data[5]),
                'estado' => (empty($data[6]) ? NULL : $data[6]),
                'cc' => (empty($data[7]) ? NULL : $data[7]),
                'creado_el' => (empty($data[8]) ? NULL : $data[8]),
                'creado_por' => (empty($data[9]) ? NULL : $data[9]),
                'blank' => (empty($data[10]) ? NULL : $data[10]),
                'producto_registrado' => (empty($data[11]) ? NULL : $data[11]),
                'blank2' => (empty($data[12]) ? NULL : $data[12]),
                'modelo' => (empty($data[13]) ? NULL : $data[13]),
                'muebleria' => (empty($data[14]) ? NULL : $data[14]),
                'sucursal' => ((empty($data[15]) || $data[15] == "#") ? NULL : $data[15]),
                'fecha_compra' => ((empty($data[16]) || $data[16] == "#") ? NULL : $data[16]),
                'marca' => (empty($data[17]) ? NULL : $data[17]),
                'tickets_relacionados' => (empty($data[18]) ? NULL : $data[18]),
                'blank3' => (empty($data[19]) ? NULL : $data[19]),
                'estado_ubicacion' => (empty($data[20]) ? NULL : $data[20]),
                'ciudad' => ((empty($data[21]) || $data[21] == "#") ? NULL : $data[21]),
                'zfecha_emision_acp' => (empty($data[22]) ? NULL : $data[22]),
                'zfolio_acp' => (empty($data[23]) ? NULL : $data[23]),
                'zmodelo_acp' => (empty($data[24]) ? NULL : $data[24]),
                'zid_taller' => (empty($data[25]) ? NULL : $data[25]),
                'justificacion_autorizacion' => (empty($data[26]) ? NULL : $data[26]),
                'categoria_causa' => (empty($data[27]) ? NULL : $data[27]),
                'categoria_solucion' => (empty($data[28]) ? NULL : $data[28]),
                'metodo_cambio' => (empty($data[29]) ? NULL : $data[29]),
                'creado_el2' => (empty($data[30]) ? NULL : $data[30]),
                'creado_por2' => (empty($data[31]) ? NULL : $data[31]),
                'blank4' => (empty($data[32]) ? NULL : $data[32]),
                'pedido_reserva' => (empty($data[33]) ? NULL : $data[33]),
                'estado2' => (empty($data[34]) ? NULL : $data[34]),
                'justificacion_cancelacion' => (empty($data[35]) ? NULL : $data[35]),
                'justificacion_rechazo' => ((empty($data[36]) || $data[36] == "#") ? NULL : $data[36]),
                'razones_rechazo' => (empty($data[37]) ? NULL : $data[37]),
                'fecha_rechazo' => ((empty($data[38]) || $data[38] == "#") ? NULL : $data[38]),
                'fecha_cancelacion' => ((empty($data[39]) || $data[39] == "#")? NULL : $data[39]),
                'equipos_tecnicos' => (empty($data[40]) ? NULL : $data[40]),
                'blank5' => (empty($data[41]) ? NULL : $data[41]),
                'gerente' => (empty($data[42]) ? NULL : $data[42]),
                'tecnico_serv_cabecera' => (empty($data[43]) ? NULL : $data[43]),
                'blank6' => (empty($data[44]) ? NULL : $data[44]),
                'zona' => (empty($data[45]) ? NULL : $data[45]),
                'categoria_taller' => (empty($data[46]) ? NULL : $data[46]),
                'aprobador' => (empty($data[47]) ? NULL : $data[47]),
                'blank7' => (empty($data[48]) ? NULL : $data[48]),
                'updated_at' => $date,
                'updated_by' => $username]);*/
                
                DB::table('tickets_abiertos')->insert(
                ['ticket' => (empty($data[1]) ? 0 : $data[1]),
                'estado2' => (empty($data[34]) ? NULL : $data[34]),
                'blank3' => (empty($data[19]) ? NULL : $data[19]),
                'updated_at' => $date,
                'updated_by' => $username]);
        }
        else
        {
            DB::table('tickets_abiertos')
                ->where('ticket', $data[1])
                ->update(['estado2' => (empty($data[34]) ? NULL : $data[34]),
                'updated_at' => $date,
                'updated_by' => $username]);
        }
    }

    public static function insert_load_data_tickets_sa($data, $username, $date)
    {
        $main_status = "SIN STATUS";
        $valid = true;
        $dias_abierto = NULL;
        $rango_dias = NULL;
        $taller = NULL;
        $zona = NULL;
        $supervisor = NULL;
        $acp = NULL;
        $ing = NULL;
        $ped_resrv = NULL;
        $ped_resrv_fecha = NULL;
        $ped_resrv_dias = NULL;
        $fecha_promesa = NULL;
        $guia = NULL;
        $n_pedidos_abiertos = NULL;

        // Caso No.1
        // PEX.
        if($valid)
        {
            $data_acp = TicketsAbiertosModel::select('tickets_abiertos_pex.estado2', 'tickets_abiertos_pex.zfolio_acp', 'tickets_abiertos_pex.blank3')
                            ->from('tickets_abiertos_pex')
                            ->where('tickets_abiertos_pex.ticket1', $data[1])
                            ->get();

            if($valid)
            {
                if((isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "Completado")
                    || (isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "En proceso logistico"))
                {
                    // CASE 01: Cambio Físico autorizado
                    // El status debe de ser Cerrado y que existe en los registros de PEX.
                    $main_status = 'Cambio Físico autorizado';
                    $valid =  false;
                    $acp = $data_acp[0]->blank3; 
                }
            }

            if($valid)
            {
                if((isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "Pendiente por autorizar"))
                {
                    // CASE 02: Cambio Físico pendiente por autorizar
                    // El status debe de ser 'En proceso logístico, completado o cerrado' y que existe en los registros de PEX.
                    $main_status = 'Cambio Físico pendiente por autorizar';
                    $valid =  false;
                    $acp = $data_acp[0]->blank3;
                }
            }

            if($valid)
            {
                if((isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "Cancelado") 
                    || (isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "Rechazado")
                    || (isset($data_acp[0]->estado2) && $data_acp[0]->estado2 == "Incompleto"))
                {
                    // CASE 03: Cambio Físico Rechazado/Can/Inc
                    // El status debe de ser 'En proceso logístico, completado o cerrado' y que existe en los registros de PEX.
                    $main_status = 'Cambio Físico Rechazado/Can/Inc';
                    $valid =  false;
                    $acp = $data_acp[0]->blank3;
                }
            }
        }

        // Caso No. 2
        // Pedidos
        if($valid)
        {
            $data_pedido = TicketsAbiertosModel::select('tickets_abiertos_pedidos.document',
                                        'tickets_abiertos_pedidos.po',
                                        'tickets_abiertos_pedidos.status',
                                        'tickets_abiertos_pedidos.doc_date',
                                        'tickets_abiertos_guias.tracking_number')
                                ->from('tickets_abiertos_pedidos')
                                ->leftJoin('tickets_abiertos_guias', 'tickets_abiertos_pedidos.document', '=', 'tickets_abiertos_guias.document')
                                ->where('tickets_abiertos_pedidos.po', $data[1])
                                ->get();

            if($valid)
            {
                if(((isset($data_pedido[0]->po) && is_numeric($data_pedido[0]->po)) && !empty($data_pedido[0]->po)) 
                    && (isset($data_pedido[0]->status) && $data_pedido[0]->status == 'Completed'))
                {
                    // CASE 04: Pedido Enviado
                    // Debe de contener PO y ademas Status Completed en relacion al ticket.
                    $main_status = 'Pedido Enviado';
                    $valid =  false;
                    $ped_resrv = $data_pedido[0]->document;
                    $ped_resrv_fecha = $data_pedido[0]->doc_date;

                    $date_one = new DateTime($ped_resrv_fecha);
                    $date_two = new DateTime(date("Y-m-d"));
                    $diff = $date_one->diff($date_two);
                    $ped_resrv_dias = $diff->days;
                    $guia = $data_pedido[0]->tracking_number;
                }
            }

            if($valid)
            {
                if(((isset($data_pedido[0]->po) && is_numeric($data_pedido[0]->po)) && !empty($data_pedido[0]->po)) 
                    && (isset($data_pedido[0]->status) && $data_pedido[0]->status != 'Completed'))
                {
                    // CASE 05: Pendiente por refacción
                    // Debe de contener PO y ademas Status diferente a Completed en relacion al ticket.
                    $main_status = 'Pendiente por refacción';
                    $valid =  false;
                    $ped_resrv = $data_pedido[0]->document;
                    $ped_resrv_fecha = $data_pedido[0]->doc_date;

                    $date_one = new DateTime($ped_resrv_fecha);
                    $date_two = new DateTime(date("Y-m-d"));
                    $diff = $date_one->diff($date_two);
                    $ped_resrv_dias = $diff->days;
                    $guia = $data_pedido[0]->tracking_number;
                }
            }
        }

        // Caso No. 3
        // Reservas
        if($valid)
        {
            $data_pedido = TicketsAbiertosModel::select('tickets_abiertos_reservas.reserv_no',
                                        'tickets_abiertos_reservas.del',
                                        'tickets_abiertos_reservas.recipient',
                                        'tickets_abiertos_reservas.date')
                                ->from('tickets_abiertos_reservas')
                                ->where('tickets_abiertos_reservas.recipient', $data[1])
                                ->get();
            
            if(isset($data_pedido[0]->recipient) && !empty($data_pedido[0]->recipient))
            {
                $ped_resrv = (isset($data_pedido[0]->reserv_no) ? $data_pedido[0]->reserv_no : NULL);
                $ped_resrv_fecha = (isset($data_pedido[0]->date) ? $data_pedido[0]->date : NULL);
                $date_one = new DateTime($ped_resrv_fecha);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                $ped_resrv_dias = $diff->days;
                $valid_reserva = true;

                foreach ($data_pedido as $data_pedido) 
                {
                    if($data_pedido->del != 'X')
                    {
                        $valid_reserva = false;
                    }   
                }

                if($valid_reserva)
                {
                    // CASE 06: Pedido Enviado
                    // Debe de tener en todos los reg 'X' col del
                    $main_status = 'Reserva completada';
                    $valid =  false;
                }
                else
                {
                    // CASE 05: Pendiente por refacción
                    // Debe de por lo menos no tener en todos los reg 'X' col del
                    $main_status = 'Pendiente por refacción';
                    $valid =  false;
                }
            }
        }

        // Case No. 4
        // Pendiente alta de Parte
        // Pendiente por definir****
        // CASE 06:
        

        // Case No. 5
        // Pendiente por Ingenieria
        if($valid)
        {
            $data_ing = TicketsAbiertosModel::select('tickets_abiertos.estado2', 'tickets_abiertos.blank3')
                            ->from('tickets_abiertos')
                            ->where('tickets_abiertos.ticket', $data[1])
                            ->get(); 

            if(isset($data_ing[0]->estado2) && $data_ing[0]->estado2 != 'Completado')
            {
                // CASE 07: Pendiente por Ingenieria
                // Debe contener estatus diferente a Completed.
                $main_status = 'Pendiente por Ingenieria';
                $ing = $data_ing[0]->blank3;
                $valid =  false;
            }
        }

        // Case No. 6
        // Programado para Visita
        if($valid)
        {
            if(!empty($data[18]))
            {
                $date_one = new DateTime($data[18]);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                
                if($date_one >= $date_two)
                {
                    if($diff->days >= 0)
                    {
                        // CASE 08: Programado para Visita
                        // La fecha debe de ser igual o mayor a today.
                        $main_status = 'Programado para Visita';
                        $valid =  false;
                    }
                }    
            }
        }

        // Case No. 7
        // Sin asignación
        if($valid)
        {
            if(!empty($data[14]) && $data[14] == 'Sin asignar')
            {
                // CASE 09: Sin asignación
                // La columna de los tecnicos debe de ser 'Sin asignar'.
                $main_status = 'Sin asignación';
                $valid =  false;
            }
            elseif(!empty($data[14]) && $data[14] == 'Sin asignar')
            {
                // CASE 10: Estatus Vencido
                // La columna de los tecnicos debe de ser diferente a 'Sin asignar'.
                $main_status = 'Sin asignación';
                $valid =  false;   
            }
        }

        // Calculo dias abierto.
        $date_one = new DateTime($data[5]);
        $date_two = new DateTime(date("Y-m-d"));
        $diff = $date_one->diff($date_two);
        $dias_abierto = $diff->days;

        // Calculo rango dias.
        if($dias_abierto <= 7)
        {
            $rango_dias = '0 a 7 días';
        }
        elseif($dias_abierto > 7 && $dias_abierto <= 14)
        {
            $rango_dias = '8 a 14 días';
        }
        elseif($dias_abierto > 14 && $dias_abierto <= 21)
        {
            $rango_dias = '15 a 21 días';
        }
        elseif($dias_abierto > 21 && $dias_abierto <= 30)
        {
            $rango_dias = '22 a 30 días';
        }
        elseif($dias_abierto > 30)
        {
            $rango_dias = '+30 días';
        }

        // Calculamos el taller.
        $data_for_taller = TicketsAbiertosModel::select('talleres.taller', 'talleres.zona', 'talleres.subzona', 'talleres.supervisor')
                                ->from('talleres')
                                ->where('talleres.taller', $data[13])
                                ->get();

        $taller = (isset($data_for_taller[0]->taller) ? $data_for_taller[0]->taller : NULL);

        // Calculamos zona.
        $zona = (isset($data_for_taller[0]->subzona) ? $data_for_taller[0]->subzona : NULL);

        // Calculamos supervisor.
        $supervisor = (isset($data_for_taller[0]->supervisor) ? $data_for_taller[0]->supervisor : NULL); 

        $data_x = TicketsAbiertosModel::select("tickets_servicios_abiertos.ticket_id")
                     ->from('tickets_servicios_abiertos')
                            ->where('ticket_id', $data[1])
                            ->get();

        if(count($data_x) == 0)
        {
            DB::table('tickets_servicios_abiertos')->insert(
                ['ticket_id' => (empty($data[1]) ? NULL : $data[1]),
                'tipo_pago' => (empty($data[8]) ? NULL : $data[8]),
                'estado' => (empty($data[3]) ? NULL : $data[3]),
                'sub_estado' => (empty($data[4]) ? NULL : $data[4]),
                'fecha' => (empty($data[5]) ? NULL : $data[5]),
                'dias_abierto' => $dias_abierto,
                'rango_dias' => $rango_dias,
                'taller' => $taller,
                'zona' => $zona,
                'supervisor' => ($supervisor == 'vcode' ? 'Sin asignar' : $supervisor),
                'fecha_programacion' => (empty($data[18]) ? NULL : $data[18]),
                'status_cs' => $main_status,
                'acp' => $acp,
                'ing' => $ing,
                'ped_resrv' => $ped_resrv,
                'ped_resrv_fecha' => $ped_resrv_fecha,
                'ped_resrv_dias' => $ped_resrv_dias,
                'technician_id' => (empty($data[14]) ? NULL : $data[14]),
                'muebleria' => (empty($data[19]) ? NULL : $data[19]),
                'guia' => $guia,
                'n_pedidos_abiertos' => $n_pedidos_abiertos,
                'uploaded_at' => $date,
                'uploaded_by' => $username]);
        }
        else
        {
            DB::table('tickets_servicios_abiertos')
                ->where('ticket_id', $data[1])
                ->update(['tipo_pago' => (empty($data[8]) ? NULL : $data[8]),
                'estado' => (empty($data[3]) ? NULL : $data[3]),
                'sub_estado' => (empty($data[4]) ? NULL : $data[4]),
                'fecha' => (empty($data[5]) ? NULL : $data[5]),
                'dias_abierto' => $dias_abierto,
                'rango_dias' => $rango_dias,
                'taller' => $taller,
                'zona' => $zona,
                'supervisor' => ($supervisor == 'vcode' ? 'Sin asignar' : $supervisor),
                'fecha_programacion' => (empty($data[18]) ? NULL : $data[18]),
                'status_cs' => $main_status,
                'acp' => $acp,
                'ing' => $ing,
                'ped_resrv' => $ped_resrv,
                'ped_resrv_fecha' => $ped_resrv_fecha,
                'ped_resrv_dias' => $ped_resrv_dias,
                'technician_id' => (empty($data[14]) ? NULL : $data[14]),
                'muebleria' => (empty($data[19]) ? NULL : $data[19]),
                'guia' => $guia,
                'n_pedidos_abiertos' => $n_pedidos_abiertos,
                'uploaded_at' => $date,
                'uploaded_by' => $username]); 
        }
    }

    public static function truncate_table($table_name)
    {
        DB::table($table_name)->truncate();
    }

    public static function check_is_acp($ticket_id)
    {
        $data = TicketsAbiertosModel::select("tickets_abiertos_pex.ticket1")
                     ->from('tickets_abiertos_pex')
                            ->where('ticket1', $ticket_id)
                            ->get();
        return $data;
    }

    public static function download_report_all_db()
    {
        $result = array();

        $data = TicketsAbiertosModel::select('tickets_servicios_abiertos.*')
                                        ->from('tickets_servicios_abiertos')
                                        ->get();
        $n = 0;
        foreach ($data as $data) 
        {
            $result[$n]['ticket_id'] = $data->ticket_id;
            $result[$n]['tipo_pago'] = $data->tipo_pago;
            $result[$n]['estado'] = $data->estado;
            $result[$n]['sub_estado'] = $data->sub_estado;
            $result[$n]['fecha'] = $data->fecha;
            $result[$n]['dias_abierto'] = $data->dias_abierto;
            $result[$n]['rango_dias'] = $data->rango_dias;
            $result[$n]['taller'] = $data->taller;
            $result[$n]['zona'] = $data->zona;
            $result[$n]['supervisor'] = $data->supervisor;
            $result[$n]['fecha_programacion'] = $data->fecha_programacion;
            $result[$n]['status_cs'] = $data->status_cs;
            $result[$n]['acp'] = $data->acp;
            $result[$n]['ing'] = $data->ing;
            $result[$n]['ped_resrv'] = $data->ped_resrv;
            $result[$n]['ped_resrv_fecha'] = $data->ped_resrv_fecha;
            $result[$n]['ped_resrv_dias'] = $data->ped_resrv_dias;
            $result[$n]['technician_id'] = $data->technician_id;
            $result[$n]['muebleria'] = $data->muebleria;
            $result[$n]['guia'] = $data->guia;
            $result[$n]['n_pedidos_abiertos'] = $data->n_pedidos_abiertos;
            $result[$n]['uploaded_at'] = $data->uploaded_at;
            $result[$n]['uploaded_by'] = $data->uploaded_by;
            $n++;
        }

        return $result;
    }

    public static function download_report_taller_db($taller)
    {
        $result = array();

        $data = TicketsAbiertosModel::select('tickets_servicios_abiertos.*')
                                        ->from('tickets_servicios_abiertos')
                                        ->where('tickets_servicios_abiertos.taller', $taller)
                                        ->get();
        $n = 0;
        foreach ($data as $data) 
        {
            $result[$n]['ticket_id'] = $data->ticket_id;
            $result[$n]['tipo_pago'] = $data->tipo_pago;
            $result[$n]['estado'] = $data->estado;
            $result[$n]['sub_estado'] = $data->sub_estado;
            $result[$n]['fecha'] = $data->fecha;
            $result[$n]['dias_abierto'] = $data->dias_abierto;
            $result[$n]['rango_dias'] = $data->rango_dias;
            $result[$n]['taller'] = $data->taller;
            $result[$n]['zona'] = $data->zona;
            $result[$n]['supervisor'] = $data->supervisor;
            $result[$n]['fecha_programacion'] = $data->fecha_programacion;
            $result[$n]['status_cs'] = $data->status_cs;
            $result[$n]['acp'] = $data->acp;
            $result[$n]['ing'] = $data->ing;
            $result[$n]['ped_resrv'] = $data->ped_resrv;
            $result[$n]['ped_resrv_fecha'] = $data->ped_resrv_fecha;
            $result[$n]['ped_resrv_dias'] = $data->ped_resrv_dias;
            $result[$n]['technician_id'] = $data->technician_id;
            $result[$n]['muebleria'] = $data->muebleria;
            $result[$n]['guia'] = $data->guia;
            $result[$n]['n_pedidos_abiertos'] = $data->n_pedidos_abiertos;
            $result[$n]['uploaded_at'] = $data->uploaded_at;
            $result[$n]['uploaded_by'] = $data->uploaded_by;
            $n++;
        }

        return $result;
    }

    public static function download_report_antiguedad_db($antiguedad)
    {
        $result = array();

        $data = TicketsAbiertosModel::select('tickets_servicios_abiertos.*')
                                        ->from('tickets_servicios_abiertos')
                                        ->where('tickets_servicios_abiertos.rango_dias', $antiguedad)
                                        ->get();
        $n = 0;
        foreach ($data as $data) 
        {
            $result[$n]['ticket_id'] = $data->ticket_id;
            $result[$n]['tipo_pago'] = $data->tipo_pago;
            $result[$n]['estado'] = $data->estado;
            $result[$n]['sub_estado'] = $data->sub_estado;
            $result[$n]['fecha'] = $data->fecha;
            $result[$n]['dias_abierto'] = $data->dias_abierto;
            $result[$n]['rango_dias'] = $data->rango_dias;
            $result[$n]['taller'] = $data->taller;
            $result[$n]['zona'] = $data->zona;
            $result[$n]['supervisor'] = $data->supervisor;
            $result[$n]['fecha_programacion'] = $data->fecha_programacion;
            $result[$n]['status_cs'] = $data->status_cs;
            $result[$n]['acp'] = $data->acp;
            $result[$n]['ing'] = $data->ing;
            $result[$n]['ped_resrv'] = $data->ped_resrv;
            $result[$n]['ped_resrv_fecha'] = $data->ped_resrv_fecha;
            $result[$n]['ped_resrv_dias'] = $data->ped_resrv_dias;
            $result[$n]['technician_id'] = $data->technician_id;
            $result[$n]['muebleria'] = $data->muebleria;
            $result[$n]['guia'] = $data->guia;
            $result[$n]['n_pedidos_abiertos'] = $data->n_pedidos_abiertos;
            $result[$n]['uploaded_at'] = $data->uploaded_at;
            $result[$n]['uploaded_by'] = $data->uploaded_by;
            $n++;
        }

        return $result;
    }

    public static function clean_acentos($string)
    {
        $string = str_replace("á", "a", $string);
        $string = str_replace("Á", "A", $string);
        $string = str_replace("é", "e", $string);
        $string = str_replace("É", "E", $string);
        $string = str_replace("í", "i", $string);
        $string = str_replace("Í", "I", $string);
        $string = str_replace("ó", "o", $string);
        $string = str_replace("Ó", "O", $string);
        $string = str_replace("ú", "u", $string);
        $string = str_replace("Ú", "u", $string);

        return $string;
    }

    public static function select_log($date)
    {
        $valid = false;

        $data = TicketsAbiertosModel::select("tickets_log.date")
                    ->from('tickets_log')
                    ->where('date', $date)
                    ->get();

        if(count($data) > 0)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function insert_log($date, $username)
    {
         DB::table('tickets_log')->insert(
                ['date' => $date,
                'user' => $username]);
    }

    public static function process_tickets_servicios_abiertos($file, $username){


        $handle = fopen($file, "r+");
            $start = 0;
            
            $date_today = date("Y-m-d");

            if(!self::select_log($date_today))
            {
                self::insert_log($date_today, $username);
                self::truncate_table("tickets_servicios_abiertos");
            }  

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[1]))
                    {
                        self::insert_load_data_tickets_sa($data, $username, date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
    }
}
