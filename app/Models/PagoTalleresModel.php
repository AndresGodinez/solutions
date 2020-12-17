<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
date_default_timezone_set("America/Mexico_City");

class PagoTalleresModel extends ModelBase
{
    public static function insert_load_claims($data, $date)
    {
        $table = date("Y")."_".date("n", strtotime($data[24]))."_claims_aprobados";

        // precondiciones 
        $clasificacion = "Sin clasificacion";
        $total_approved_parts = 0;

        if(!empty($data[1]))
        {
            $data[1] = strtoupper($data[1]);
            $data[1] = utf8_encode($data[1]);
            
            if($data[1] == "CON GARANTIA")
            {
                $clasificacion = "COMERCIAL WARRANTIES";
            }
            
            if($data[1] == "EN PROMOCIÓN")
            {
                $clasificacion = "CNX";
            }

            if($data[1] == "SERVICIO CON CARGO" || $data[1] == "SERVICIO CON CARGO Y PIEZA EN GARANTIA")
            {
                $clasificacion = "NEG RENTABLE";

                $taller = DB::table('talleres')
                    ->where('talleres.tipo', 'not like', 'MODULO%')
                    ->where('talleres.taller', $data[25])
                    ->get();

                if(count($taller) > 0)
                {
                    $clasificacion = "OOW TALLERES";
                }

            }

            if($data[1] == "CON GARANTIA EXTENDIDA")
            {
                $clasificacion = "EXTENDED WARRANTIES";
            }

            if($data[1] == "CONCESIÓN")
            {
                $clasificacion = "ATT A DISTRIBUIDOR";
            }

            if($data[1] == "CORTESÍA")
            {
                $clasificacion = "COMERCIAL WARRANTIES";
            }

            // Caso Cambio de producto (714)
            if($data[27] == "714")
            {
                $clasificacion = "PRODUCT EXCHANGE";
            }

            // Caso UTB Demostración de uso y manejo (702)
            if($data[27] == "702")
            {
                $clasificacion = "UTB";
            }

            // Caso (706) Cambio / Ajuste de espreas or Caso (704) conexión miniSplit or Caso (703) conexión básica
            if($data[27] == "706" || $data[27] == "704" || $data[27] == "703")
            {
                $clasificacion = "CNX";
            }
        }

        $data[1] = utf8_decode($data[1]);

        $exist_claim = DB::table($table)
                        ->where($table.'.claim', $data[23])
                        ->get();

        if(count($exist_claim) == 0)
        {
            // Insertamos en la tabla ligera
            DB::table($table)->insert(
                ['dispatch' => (empty($data[0]) ? "" : utf8_encode($data[0])),
                'tipo_servicio' => (empty($data[1]) ? "" : utf8_encode($data[1])),
                'repeat_repair' => (empty($data[2]) ? "" : ($data[2] == 'X' ? 'SI' : 'NO')),
                'serie' => (empty($data[3]) ? "" : utf8_encode($data[3])),
                'modelo' => (empty($data[4]) ? "" : utf8_encode($data[4])),
                'dispatch_created_by_user_name' => (empty($data[5]) ? "" : utf8_encode($data[5])),
                'dispatch_created_by' => (empty($data[6]) ? "" : utf8_encode($data[6])),
                'service_req_date' => (empty($data[7]) ? "" : date("Y-m-d", strtotime($data[7]))),
                'cust_complaint' => (empty($data[8]) ? "" : utf8_encode($data[8])),
                'work_performed' => (empty($data[9]) ? "" : utf8_encode($data[9])),
                'serv_complete_date' => (empty($data[10]) ? "" : date("Y-m-d", strtotime($data[10]))),
                'prod_descripcion' => (empty($data[11]) ? "" : utf8_encode($data[11])),
                'technician_id' => (empty($data[12]) ? "" : utf8_encode($data[12])),
                'zone_number' => (empty($data[13]) ? "" : utf8_encode($data[13])),
                'marca' => (empty($data[14]) ? "" : utf8_encode($data[14])),
                'muebleria' => (empty($data[15]) ? "" : utf8_encode($data[15])),
                'fecha_compra' => (empty($data[16]) ? "" : date("Y-m-d", strtotime($data[16]))),
                'cliente_nombre' => (empty($data[17]) ? "" : utf8_encode($data[17])),
                'cliente_direccion' => (empty($data[18]) ? "" : utf8_encode($data[18])),
                'cliente_ciudad' => (empty($data[19]) ? "" : utf8_encode($data[19])),
                'cliente_estado' => (empty($data[20]) ? "" : utf8_encode($data[20])),
                'cliente_cp' => (empty($data[21]) ? "" : utf8_encode($data[21])),
                'cliente_telefono' => (empty($data[22]) ? "" : utf8_encode($data[22])),
                'claim' => (empty($data[23]) ? "" : utf8_encode($data[23])),
                'claim_app_date' => (empty($data[24]) ? "" : date("Y-m-d", strtotime($data[24]))),
                'taller' => (empty($data[25]) ? "" : utf8_encode($data[25])),
                'reference' => (empty($data[26]) ? "" : utf8_encode($data[26])),
                'extra_status' => (empty($data[27]) ? "" : utf8_encode($data[27])),
                'total_approved_claim_amount' => (empty($data[28]) ? "" : utf8_encode($data[28])),
                'date' => $date,
                'clasificacion' => $clasificacion,
                'total_approved_parts' => $total_approved_parts]
            );

            // Despues insertamos en la tabla pesada (old table "claims_aprobados")
            DB::table('claims_aprobados')->insert(
                ['dispatch' => (empty($data[0]) ? "" : utf8_encode($data[0])),
                'tipo_servicio' => (empty($data[1]) ? "" : utf8_encode($data[1])),
                'repeat_repair' => (empty($data[2]) ? "" : ($data[2] == 'X' ? 'SI' : 'NO')),
                'serie' => (empty($data[3]) ? "" : utf8_encode($data[3])),
                'modelo' => (empty($data[4]) ? "" : utf8_encode($data[4])),
                'dispatch_created_by_user_name' => (empty($data[5]) ? "" : utf8_encode($data[5])),
                'dispatch_created_by' => (empty($data[6]) ? "" : utf8_encode($data[6])),
                'service_req_date' => (empty($data[7]) ? "" : date("Y-m-d", strtotime($data[7]))),
                'cust_complaint' => (empty($data[8]) ? "" : utf8_encode($data[8])),
                'work_performed' => (empty($data[9]) ? "" : utf8_encode($data[9])),
                'serv_complete_date' => (empty($data[10]) ? "" : date("Y-m-d", strtotime($data[10]))),
                'prod_descripcion' => (empty($data[11]) ? "" : utf8_encode($data[11])),
                'technician_id' => (empty($data[12]) ? "" : utf8_encode($data[12])),
                'zone_number' => (empty($data[13]) ? "" : utf8_encode($data[13])),
                'marca' => (empty($data[14]) ? "" : utf8_encode($data[14])),
                'muebleria' => (empty($data[15]) ? "" : utf8_encode($data[15])),
                'fecha_compra' => (empty($data[16]) ? "" : date("Y-m-d", strtotime($data[16]))),
                'cliente_nombre' => (empty($data[17]) ? "" : utf8_encode($data[17])),
                'cliente_direccion' => (empty($data[18]) ? "" : utf8_encode($data[18])),
                'cliente_ciudad' => (empty($data[19]) ? "" : utf8_encode($data[19])),
                'cliente_estado' => (empty($data[20]) ? "" : utf8_encode($data[20])),
                'cliente_cp' => (empty($data[21]) ? "" : utf8_encode($data[21])),
                'cliente_telefono' => (empty($data[22]) ? "" : utf8_encode($data[22])),
                'claim' => (empty($data[23]) ? "" : utf8_encode($data[23])),
                'claim_app_date' => (empty($data[24]) ? "" : date("Y-m-d", strtotime($data[24]))),
                'taller' => (empty($data[25]) ? "" : utf8_encode($data[25])),
                'reference' => (empty($data[26]) ? "" : utf8_encode($data[26])),
                'extra_status' => (empty($data[27]) ? "" : utf8_encode($data[27])),
                'total_approved_claim_amount' => (empty($data[28]) ? "" : utf8_encode($data[28])),
                'date' => $date,
                'clasificacion' => $clasificacion,
                'total_approved_parts' => $total_approved_parts]
            );
        }
        else
        {
            // Si ya existe el registro solo lo actualizamos en la tabla ligera.
            DB::table($table)
                ->where($table.'.claim', $data[23])
                ->update(['extra_status' => (empty($data[27]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[27]))),
                        'total_approved_claim_amount' => (empty($data[28]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[28]))),
                        'date' => $date,
                        'clasificacion' => $clasificacion,
                        'total_approved_parts' => $total_approved_parts]);

            // Si ya existe el registro tambien lo actualizamos en la tabla pesada (old table "claims_aprobados").
            DB::table('claims_aprobados')
                ->where('claims_aprobados.claim', $data[23])
                ->update(['extra_status' => (empty($data[27]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[27]))),
                        'total_approved_claim_amount' => (empty($data[28]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[28]))),
                        'date' => $date,
                        'clasificacion' => $clasificacion,
                        'total_approved_parts' => $total_approved_parts]);     
        }
    }

    public static function insert_load_prorrateo($data, $date)
    {
        $costo_prorrateo = 0;
        // preguntamos que exista el claim
        $exist_claim = DB::table('claims_aprobados_prorrateo')
                        ->where('claims_aprobados_prorrateo.claim', $data[0])
                        ->get();

        // Consultamos el costo del material.
        $mat_costo = DB::connection('reforig_logistica')
                        ->table('materiales_costo')
                        ->where('materiales_costo.material', $data[2])
                        ->get();

        if(isset($mat_costo[0]->costo) && ($mat_costo[0]->costo) > 0)
        {
            $costo_x_pza = $mat_costo[0]->costo;            
        }
        else
        {
            $costo_x_pza = 0;
        }
        
        if($costo_x_pza > 0)
        {   
            $costo_prorrateo = $costo_x_pza * str_replace(" UN", "", $data[4]);
        }

        if(count($exist_claim) == 0)
        {
            DB::table('claims_aprobados_prorrateo')->insert(
                ['claim' => (empty($data[0]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[0]))),
                'np' => (empty($data[2]) ? "" : PagoTalleresModel::clean_string(utf8_encode($data[2]))),
                'cantidad' => (empty($data[4]) ? "" : PagoTalleresModel::clean_string(utf8_encode(str_replace(" UN", "", $data[4])))),
                'date' => $date,
                'costo_prorrateo' => $costo_prorrateo]
            );
        }
        else
        {
            DB::table('claims_aprobados_prorrateo')
                ->where('claims_aprobados_prorrateo.claim', $data[0])
                ->where('claims_aprobados_prorrateo.np', $data[2])
                ->update(['cantidad' => (empty($data[4]) ? "" : PagoTalleresModel::clean_string(utf8_encode(str_replace(" UN", "", $data[4])))),
                        'date' => $date,
                        'costo_prorrateo' => $costo_prorrateo]);     
        }
    }

    public static function insert_load_pago_a_talleres($data, $date)
    {
        
        // Insertamos en la tabla ligera
        $status_fact = "RECIBIDA";
        $factrecibida = 1;
        DB::table('pagotaller')->insert(
            ['taller' => (empty($data[0]) ? "" : $data[0]),
            'vendor' => (empty($data[1]) ? "" : $data[1]),
            'referencia' => (empty($data[2]) ? "" : $data[2]),
            'fecha' => (empty($data[3]) ? "" : date("Y-m-d", strtotime($data[3]))),
            'importe' => (empty($data[4]) ? "" : $data[4]),
            'iva' => (empty($data[5]) ? "" : $data[5]),
            'glaccount' => (empty($data[6]) ? "" : $data[6]),
            'importe2' => (empty($data[7]) ? "" : $data[7]),
            'cc' => (empty($data[8]) ? "" : $data[8]),
            'status' => (empty($data[9]) ? "" : $data[9]),
            'status_fact' => $status_fact,
            'factrecibida' => $factrecibida]
        );
    }

    public static function insert_load_total_approved_parts($data, $date)
    {

        $year = date("Y");
        $total_approved_parts = 0;

        $costo_prorrateo = DB::table('claims_aprobados_prorrateo')
                        ->where('claims_aprobados_prorrateo.claim', $data[0])
                        ->get();
        
        if(count($costo_prorrateo) > 0)
        {
            foreach ($costo_prorrateo as $costo_prorrateo) 
            {
                $total_approved_parts = $total_approved_parts + $costo_prorrateo->costo_prorrateo;                
            }
        }

        for($i = 1; $i <= 12; $i++)
        {
            $table = $year.'_'.$i.'_claims_aprobados';
            
            if(Schema::hasTable($table)) 
            {
                DB::table($table)
                    ->where($table.'.claim', $data[0])
                    ->update(['total_approved_parts' => $total_approved_parts]);  
            } 
        }
    }

    public static function create_table_if_not_exist()
    {
        $year = date("Y");
        $months = 12;
        for($i = 01; $i <= $months; $i++) 
        {
            if(!Schema::hasTable($year.'_'.$i.'_claims_aprobados')) 
            {
                Schema::create($year.'_'.$i.'_claims_aprobados', function($table){
                    $table->increments('id');
                    $table->text('taller')->nullable();
                    $table->text('tipo_servicio')->nullable();
                    $table->text('repeat_repair')->nullable();
                    $table->text('claim')->nullable();
                    $table->text('reference')->nullable();
                    $table->text('unit')->nullable();
                    $table->text('dispatch')->nullable();
                    $table->text('zone_number')->nullable();
                    $table->text('technician_id')->nullable();
                    $table->text('marca')->nullable();
                    $table->text('customer_install')->nullable();
                    $table->text('auth')->nullable();
                    $table->text('contract')->nullable();
                    $table->text('cliente_apellido')->nullable();
                    $table->text('cliente_nombre')->nullable();
                    $table->text('cliente_direccion')->nullable();
                    $table->text('cliente_ciudad')->nullable();
                    $table->text('cliente_estado')->nullable();
                    $table->text('cliente_cp')->nullable();
                    $table->text('cliente_telefono')->nullable();
                    $table->text('serie')->nullable();
                    $table->text('modelo')->nullable();
                    $table->text('prod_descripcion')->nullable();
                    $table->text('muebleria')->nullable();
                    $table->text('voltaje')->nullable();
                    $table->text('presion_w')->nullable();
                    $table->date('fecha_compra')->nullable();
                    $table->date('service_req_date')->nullable();
                    $table->date('serv_complete_date')->nullable();
                    $table->text('service_code')->nullable();
                    $table->date('claim_app_date')->nullable();
                    $table->text('cust_complaint')->nullable();
                    $table->text('work_performed')->nullable();
                    $table->text('total_approved_parts')->nullable();
                    $table->text('total_approved_labor')->nullable();
                    $table->text('travel_approved')->nullable();
                    $table->text('total_approved_tax')->nullable();
                    $table->text('total_approved_claim_amount')->nullable();
                    $table->text('part_1_description')->nullable();
                    $table->text('part_1')->nullable();
                    $table->text('part_1_price')->nullable();
                    $table->text('part_1_qty')->nullable();
                    $table->text('contract_part_1')->nullable();
                    $table->text('part_2_description')->nullable();
                    $table->text('part_2')->nullable();
                    $table->text('part_2_price')->nullable();
                    $table->text('part_2_qty')->nullable();
                    $table->text('contract_part_2')->nullable();
                    $table->text('part_3_description')->nullable();
                    $table->text('part_3')->nullable();
                    $table->text('part_3_price')->nullable();
                    $table->text('part_3_qty')->nullable();
                    $table->text('contract_part_3')->nullable();
                    $table->text('part_4_description')->nullable();
                    $table->text('part_4')->nullable();
                    $table->text('part_4_price')->nullable();
                    $table->text('part_4_qty')->nullable();
                    $table->text('contract_part_4')->nullable();
                    $table->text('part_5_description')->nullable();
                    $table->text('part_5')->nullable();
                    $table->text('part_5_price')->nullable();
                    $table->text('part_5_qty')->nullable();
                    $table->text('contract_part_5')->nullable();
                    $table->text('part_6_description')->nullable();
                    $table->text('part_6')->nullable();
                    $table->text('part_6_price')->nullable();
                    $table->text('part_6_qty')->nullable();
                    $table->text('contract_part_6')->nullable();
                    $table->text('part_7_description')->nullable();
                    $table->text('part_7')->nullable();
                    $table->text('part_7_price')->nullable();
                    $table->text('part_7_qty')->nullable();
                    $table->text('contract_part_7')->nullable();
                    $table->text('part_8_description')->nullable();
                    $table->text('part_8')->nullable();
                    $table->text('part_8_price')->nullable();
                    $table->text('part_8_qty')->nullable();
                    $table->text('contract_part_8')->nullable();
                    $table->text('part_9_description')->nullable();
                    $table->text('part_9')->nullable();
                    $table->text('part_9_price')->nullable();
                    $table->text('part_9_qty')->nullable();
                    $table->text('contract_part_9')->nullable();
                    $table->text('part_10_description')->nullable();
                    $table->text('part_10')->nullable();
                    $table->text('part_10_price')->nullable();
                    $table->text('part_10_qty')->nullable();
                    $table->text('contract_part_10')->nullable();
                    $table->text('dispatch_created_by')->nullable();
                    $table->text('dispatch_created_by_user_name')->nullable();
                    $table->text('osd')->nullable();
                    $table->text('manufactured_date')->nullable();
                    $table->text('service_coded_by')->nullable();
                    $table->text('fecha_sub')->nullable();
                    $table->text('borrar')->nullable();
                    $table->text('cuota_oow')->nullable();
                    $table->text('cc')->nullable();
                    $table->text('tipocc')->nullable();
                    $table->text('clasificacion')->nullable();
                    $table->text('date')->nullable();
                    $table->text('extra_status')->nullable();
                });
            }  
        }
    }

    public static function get_all_reports()
    {
        $data = TicketsAbiertosModel::select('claims_reports.*')
                        ->from('claims_reports')
                        ->get();

        return $data;
    }

    // Recepción facturas.
    public static function taller_exist($taller)
    {
        $valid = false;

        $data = DB::table('talleres')
                    ->select('talleres.taller')
                    ->where('taller', $taller)
                    ->get();

        if(count($data) > 0)
        {
            $valid = true;
        }

        return $valid;
    }


    public static function is_admin($user)
    {
        $valid = false;

        $data = DB::table('pagotaller_admin')
                    ->select('pagotaller_admin.user')
                    ->where('user', $user)
                    ->get();

        if(count($data) > 0)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function get_data_info_taller($taller)
    {
        // Obtenemos la información del taller.
        $data = DB::table('talleres')
                    ->select('talleres.taller', 'talleres.nombre', 'talleres.ciudad', 'talleres.estado', 'usuarios.mail')
                    ->where('taller', $taller)
                    ->leftJoin('usuarios', 'usuarios.username', '=', 'talleres.taller')
                    ->get();

        return $data;
    }

    public static function get_data_facts_pendientes($taller)
    {
        $data = DB::table('pagotaller')
                    ->select('pagotaller.*')
                    ->where('taller', $taller)
                    ->where('status_fact', 'RECIBIDA')
                    ->whereNotNull('factrecibida')
                    ->orderBy('fecha', 'ASC')
                    ->get();

        return $data;
    }

    public static function get_data_facts_pendientes_aceptadas($taller)
    {
        $data = DB::table('pagotaller')
                    ->select('pagotaller.*')
                    ->where('taller', $taller)
                    ->where('status_fact', 'ACEPTADO')
                    ->whereNotNull('factrecibida')
                    ->orderBy('fecha', 'ASC')
                    ->get();

        return $data;
    }

    public static function get_data_recepcion_facturas_report($from, $to)
    {
        $status_fact = 'CAPTURADA';
        $data = DB::table('pagotaller')
                ->select('pagotaller.*', 'talleres.*')
                ->leftJoin('talleres', 'talleres.taller', '=', 'pagotaller.taller')
                ->whereNotNull('factrecibida')
                ->where('pagotaller.fecharecepcion', '>=', $from)
                ->where('pagotaller.fecharecepcion', '<=', $to)
                ->where('status_fact', $status_fact)
                ->orderBy('pagotaller.taller', 'ASC')
                ->orderBy('pagotaller.referencia', 'ASC')
                ->get();

        return $data;
    }

    public static function get_data_recepcion_facturas_report_aceptadas($from, $to)
    {
        $status_fact = 'ACEPTADO';
        $data = DB::table('pagotaller')
                ->select('pagotaller.*', 'talleres.*')
                ->leftJoin('talleres', 'talleres.taller', '=', 'pagotaller.taller')
                ->whereNotNull('factrecibida')
                ->where('pagotaller.fecharecepcion', '>=', $from)
                ->where('pagotaller.fecharecepcion', '<=', $to)
                ->where('status_fact', $status_fact)
                ->orderBy('pagotaller.taller', 'ASC')
                ->orderBy('pagotaller.referencia', 'ASC')
                ->get();

        return $data;
    }

    public static function get_data_recepcion_facturas_report_taller($taller, $from, $to)
    {
        
        $status_fact = 'CAPTURADA';
        $data = DB::table('pagotaller')
                ->select('pagotaller.*', 'talleres.*')
                ->leftJoin('talleres', 'talleres.taller', '=', 'pagotaller.taller')
                ->where('pagotaller.taller', $taller)
                ->whereNotNull('factrecibida')
                ->where('pagotaller.fecharecepcion', '>=', $from)
                ->where('pagotaller.fecharecepcion', '<=', $to)
                ->where('status_fact', $status_fact)
                ->orderBy('pagotaller.taller', 'ASC')
                ->orderBy('pagotaller.referencia', 'ASC')
                ->get();


        return $data;
    }

    public static function get_data_recepcion_facturas_report_taller_aceptadas($taller, $from, $to)
    {
        
        $status_fact = 'ACEPTADO';
        $data = DB::table('pagotaller')
                ->select('pagotaller.*', 'talleres.*')
                ->leftJoin('talleres', 'talleres.taller', '=', 'pagotaller.taller')
                ->where('pagotaller.taller', $taller)
                ->whereNotNull('factrecibida')
                ->where('pagotaller.fecharecepcion', '>=', $from)
                ->where('pagotaller.fecharecepcion', '<=', $to)
                ->where('status_fact', $status_fact)
                ->orderBy('pagotaller.taller', 'ASC')
                ->orderBy('pagotaller.referencia', 'ASC')
                ->get();


        return $data;
    }

    public static function get_data_facturas_report_taller($user)
    {
        $data = DB::table('pagotaller')
                ->select('pagotaller.*', 'talleres.*')
                ->leftJoin('talleres', 'talleres.taller', '=', 'pagotaller.taller')
                ->where('pagotaller.taller', $user)
                ->whereNotNull('factrecibida')
                ->orderBy('pagotaller.taller', 'ASC')
                ->orderBy('pagotaller.referencia', 'ASC')
                ->get();

        return $data;
    }

    public static function clean_string($string)
    {
        return trim(strip_tags($string));
    }

    public static function update_pagoataller_admin($request)
    {
        $factrecibida = 1;
        $fecharecepcion = date('Y-m-d');
        $status_fact = 'CAPTURADA';
        $valid = false;
        
        DB::table('pagotaller')
                ->where('pagotaller.taller', $request->ipt_taller)
                ->where('pagotaller.referencia', $request->ipt_referencia)
                ->update(['factrecibida' => (empty($factrecibida) ? "" : PagoTalleresModel::clean_string(utf8_encode($factrecibida))),
                        'fecharecepcion' => (empty($fecharecepcion) ? "" : PagoTalleresModel::clean_string(utf8_encode($fecharecepcion))),
                        'numfact' => (empty($request->ipt_no_factura) ? "" : PagoTalleresModel::clean_string(utf8_encode($request->ipt_no_factura))),
                        'status_fact' => (empty($request->ipt_no_factura) ? "" : PagoTalleresModel::clean_string(utf8_encode($request->ipt_no_factura))),]);
        $valid = true;
    }

    public static function update_pagoataller_taller($request, $xml, $pdf)
    {
        $factrecibida = 1;
        $electronica = 1;
        $fecharecepcion = date('Y-m-d');
        $status_fact = 'CAPTURADA';
        $valid = false;
        
        DB::table('pagotaller')
                ->where('pagotaller.taller', $request->ipt_taller)
                ->where('pagotaller.referencia', $request->ipt_referencia)
                ->update(['factrecibida' => (empty($factrecibida) ? "" : PagoTalleresModel::clean_string(utf8_encode($factrecibida))),
                        'fecharecepcion' => (empty($fecharecepcion) ? "" : PagoTalleresModel::clean_string(utf8_encode($fecharecepcion))),
                        'numfact' => (empty($request->ipt_no_factura) ? "" : PagoTalleresModel::clean_string(utf8_encode($request->ipt_no_factura))),
                        'electronica' => (empty($electronica) ? "" : PagoTalleresModel::clean_string(utf8_encode($electronica))),
                        'status_fact' => (empty($request->ipt_no_factura) ? "" : PagoTalleresModel::clean_string(utf8_encode($request->ipt_no_factura))),
                        'xml' => $xml,
                        'pdf' => $pdf]);

        $valid = true;
    }

    public static function get_data_facts_pendientes_claims($data_facts_pendientes)
    {
        $send_data = array();

        foreach ($data_facts_pendientes as $data_facts_pendientes) 
        {
            $i = 0;
            $data = DB::table('claims_aprobados')
                    ->select('claims_aprobados.dispatch', 
                                'claims_aprobados.claim_app_date', 
                                'claims_aprobados.total_approved_claim_amount', 
                                'claims_aprobados.claim',
                                'claims_aprobados.reference')
                    ->where('claims_aprobados.taller', $data_facts_pendientes->taller)
                    ->where('claims_aprobados.reference', $data_facts_pendientes->referencia)
                    ->get();

            foreach ($data as $data) 
            {
                $send_data[$data_facts_pendientes->referencia][$i]['dispatch']                      = $data->dispatch;
                $send_data[$data_facts_pendientes->referencia][$i]['claim_app_date']                = $data->claim_app_date;
                $send_data[$data_facts_pendientes->referencia][$i]['total_approved_claim_amount']   = $data->total_approved_claim_amount;
                $send_data[$data_facts_pendientes->referencia][$i]['claim']                         = $data->claim;
                $send_data[$data_facts_pendientes->referencia][$i]['reference']                     = $data->reference;
                $i++;
            }
        }

        return $send_data;
    }
}
