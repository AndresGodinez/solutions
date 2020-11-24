<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

date_default_timezone_set("America/Mexico_City");

class StocksModel extends ModelBase
{
    // Stock Inicial
    public static function get_all_records($user, $id_region)
    {
        $data = [];
        // Records for Managers.
        if ($user == "munoznd") {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->get();
        } else {
            // Users for MX
            if ($id_region == 1) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_mex', 1)
                    ->get();
            }

            // Users for CAM
            if ($id_region == 2) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_cam', 1)
                    ->get();
            }

            // Users for AND
            if ($id_region == 3) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_and', 1)
                    ->get();
            }

            // Users for CAR
            if ($id_region == 4) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_car', 1)
                    ->get();
            }
        }

        return $data;
    }



    public static function get_all_records_nueva($user, $id_region)
    {
        $columnasactivas = [
'id',            'material',
            'descripcion',
            'tipo_status',
            'precio_usd',
            'sir',
            'fcr',
            'proyecto',
            'proveedor',
            'ots',
            'obs',
            'modelo',
            'cant_pza_sku',
            'garantia_years',
            'tipo_uso',
            'tipo_mat',
            'cat',
            'fam',
            'marca',
            'commodity',
            'mex1',
            'mex_fecha_embarque',
            'mex_vva',
            'guat2',
            'guat_fecha_embarque',
            'guat_vva',
            'hond3',
            'hond_fecha_embarque',
            'hond_vva',
            'repd4',
            'repd_fecha_embarque',
            'repd_vva',
            'hait5',
            'hait_fecha_embarque',
            'hait_vva',
            'arub6',
            'arub_fecha_embarque',
            'arub_vva',
            'salv7',
            'salv_fecha_embarque',
            'salv_vva',
            'nica8',
            'nica_fecha_embarque',
            'nica_vva',
            'cr9',
            'cr_fecha_embarque',
            'cr_vva',
            'pana10',
            'pana_fecha_embarque',
            'pana',
            'angu11',
            'angu_fecha_embarque',
            'angu_vva',
            'baha12',
            'baha_fecha_embarque',
            'baha_vva',
            'beli13',
            'beli_fecha_embarque',
            'beli_vva',
            'berm14',
            'berm_fecha_embarque',
            'berm_vva',
            'caym15',
            'caym_fecha_embarque',
            'caym_vva',
            'guya16',
            'guya_fecha_embarque',
            'guya_vva',
            'suri17',
            'suri_fecha_embarque',
            'suri_vva',
            'turk18',
            'turk_fecha_embarque',
            'turk_vva',
            'brit19',
            'brit_fecha_embarque',
            'brit_vva',
            'maar20',
            'maar_fecha_embarque',
            'maar_vva',
            'saba21',
            'saba_fecha_embarque',
            'saba_vva',
            'anti22',
            'anti_fecha_embarque',
            'anti_vva',
            'mons23',
            'mons_fecha_embarque',
            'mons_vva',
            'kitt24',
            'kitt_fecha_embarque',
            'kitt_vva',
            'bart25',
            'bart_fecha_embarque',
            'bart_vva',
            'marti26',
            'marti_fecha_embarque',
            'marti_vva',
            'trin27',
            'trin_fecha_embarque',
            'trin_vva',
            'jama28',
            'jama_fecha_embarque',
            'jama_vva',
            'barb29',
            'barb_fecha_embarque',
            'barb_vva',
            'bona30',
            'bona_fecha_embarque',
            'bona_vva',
            'cura31',
            'cura_fecha_embarque',
            'cura_vva',
            'col32',
            'col_fecha_embarque',
            'col_vva',
            'ven33',
            'ven_fecha_embarque',
            'ven_vva',
            'ecu34',
            'ecu_fecha_embarque',
            'ecu_vva',
            'ptor35',
            'ptor_fecha_embarque',
            'ptor_vva',
            'croi36',
            'croi_fecha_embarque',
            'croi_vva',
            'thom37',
            'thom_fecha_embarque',
            'thom_vva',
            'jhon38',
            'jhon_fecha_embarque',
            'jhon_vva',
            'virg39',
            'virg_fecha_embarque',
            'virg_vva',
            'domi40',
            'domi_fecha_embarque',
            'domi_vva',
            'gren41',
            'gren_fecha_embarque',
            'gren_vva',
            'luci42',
            'luci_fecha_embarque',
            'luci_vva',
            'vinc43',
            'vinc_fecha_embarque',
            'vinc_vva',
            'fren44',
            'fren_fecha_embarque',
            'fren_vva',
            'mart45',
            'mart_fecha_embarque',
            'mart_vva',
            'guad46',
            'guad_fecha_embarque',
            'guad_vva',
            'reun47',
            'reun_fecha_embarque',
            'reun_vva',
            'newc48',
            'newc_fecha_embarque',
            'new_vva',
            'peru49',
            'peru_fecha_embarque',
            'peru_vva',
            'comentarios_ing'];
        $data = [];
        // Records for Managers.
        if ($user == "munoznd") {
            $data = StocksModel::select(
                $columnasactivas
            )
                ->from('stock_gral_serv')
                ->get();
        } else {
            // Users for MX
            if ($id_region == 1) {
                $data = StocksModel::select( $columnasactivas
                )
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_mex', 1)
                    ->get();
            }

            // Users for CAM
            if ($id_region == 2) {
                $data = StocksModel::select($columnasactivas
                )
                    ->from('stock_gral_serv')
                    
                    ->where('stock_gral_serv.reg_cam', 1)
                    ->get();
            }

            // Users for AND
            if ($id_region == 3) {
                $data = StocksModel::select($columnasactivas
                )
                    ->from('stock_gral_serv')
                    
                    ->where('stock_gral_serv.reg_and', 1)
                    ->get();
            }

            // Users for CAR
            if ($id_region == 4) {
                $data = StocksModel::select($columnasactivas
                )
                    ->from('stock_gral_serv')
                   
                    ->where('stock_gral_serv.reg_car', 1)
                    ->get();
            }
        }

        return $data;
    }



    public static function get_all_records_desc($user, $id_region)
    {
        $data = [];
        // Records for Managers.
        if ($user == "munoznd") {
            $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                ->from('stock_gral_serv')
                ->get();
        } else {
            // Users for MX
            if ($id_region == 1) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_mex', 1)
                    ->get();
            }

            // Users for CAM
            if ($id_region == 2) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_cam', 1)
                    ->get();
            }

            // Users for AND
            if ($id_region == 3) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_and', 1)
                    ->get();
            }

            // Users for CAR
            if ($id_region == 4) {
                $data = StocksModel::select('stock_gral_serv.id', 'stock_gral_serv.material', 'stock_gral_serv.descripcion', 'stock_gral_serv.modelo', 'stock_gral_serv.proyecto', 'stock_gral_serv.proveedor', 'stock_gral_serv.user_carga', 'stock_gral_serv.created_at', 'stock_gral_serv.ok')
                    ->from('stock_gral_serv')
                    ->where('stock_gral_serv.reg_car', 1)
                    ->get();
            }
        }

        return $data;
    }

    public static function get_all_records_pending_list($id_region)
    {
        $columnasactivas = [
'id',            'material',
            'descripcion',
            'tipo_status',
            'precio_usd',
            'sir',
            'fcr',
            'proyecto',
            'proveedor',
            'ots',
            'obs',
            'modelo',
            'cant_pza_sku',
            'garantia_years',
            'tipo_uso',
            'tipo_mat',
            'cat',
            'fam',
            'marca',
            'commodity',
            'mex1',
            'mex_fecha_embarque',
            'mex_vva',
            'guat2',
            'guat_fecha_embarque',
            'guat_vva',
            'hond3',
            'hond_fecha_embarque',
            'hond_vva',
            'repd4',
            'repd_fecha_embarque',
            'repd_vva',
            'hait5',
            'hait_fecha_embarque',
            'hait_vva',
            'arub6',
            'arub_fecha_embarque',
            'arub_vva',
            'salv7',
            'salv_fecha_embarque',
            'salv_vva',
            'nica8',
            'nica_fecha_embarque',
            'nica_vva',
            'cr9',
            'cr_fecha_embarque',
            'cr_vva',
            'pana10',
            'pana_fecha_embarque',
            'pana',
            'angu11',
            'angu_fecha_embarque',
            'angu_vva',
            'baha12',
            'baha_fecha_embarque',
            'baha_vva',
            'beli13',
            'beli_fecha_embarque',
            'beli_vva',
            'berm14',
            'berm_fecha_embarque',
            'berm_vva',
            'caym15',
            'caym_fecha_embarque',
            'caym_vva',
            'guya16',
            'guya_fecha_embarque',
            'guya_vva',
            'suri17',
            'suri_fecha_embarque',
            'suri_vva',
            'turk18',
            'turk_fecha_embarque',
            'turk_vva',
            'brit19',
            'brit_fecha_embarque',
            'brit_vva',
            'maar20',
            'maar_fecha_embarque',
            'maar_vva',
            'saba21',
            'saba_fecha_embarque',
            'saba_vva',
            'anti22',
            'anti_fecha_embarque',
            'anti_vva',
            'mons23',
            'mons_fecha_embarque',
            'mons_vva',
            'kitt24',
            'kitt_fecha_embarque',
            'kitt_vva',
            'bart25',
            'bart_fecha_embarque',
            'bart_vva',
            'marti26',
            'marti_fecha_embarque',
            'marti_vva',
            'trin27',
            'trin_fecha_embarque',
            'trin_vva',
            'jama28',
            'jama_fecha_embarque',
            'jama_vva',
            'barb29',
            'barb_fecha_embarque',
            'barb_vva',
            'bona30',
            'bona_fecha_embarque',
            'bona_vva',
            'cura31',
            'cura_fecha_embarque',
            'cura_vva',
            'col32',
            'col_fecha_embarque',
            'col_vva',
            'ven33',
            'ven_fecha_embarque',
            'ven_vva',
            'ecu34',
            'ecu_fecha_embarque',
            'ecu_vva',
            'ptor35',
            'ptor_fecha_embarque',
            'ptor_vva',
            'croi36',
            'croi_fecha_embarque',
            'croi_vva',
            'thom37',
            'thom_fecha_embarque',
            'thom_vva',
            'jhon38',
            'jhon_fecha_embarque',
            'jhon_vva',
            'virg39',
            'virg_fecha_embarque',
            'virg_vva',
            'domi40',
            'domi_fecha_embarque',
            'domi_vva',
            'gren41',
            'gren_fecha_embarque',
            'gren_vva',
            'luci42',
            'luci_fecha_embarque',
            'luci_vva',
            'vinc43',
            'vinc_fecha_embarque',
            'vinc_vva',
            'fren44',
            'fren_fecha_embarque',
            'fren_vva',
            'mart45',
            'mart_fecha_embarque',
            'mart_vva',
            'guad46',
            'guad_fecha_embarque',
            'guad_vva',
            'reun47',
            'reun_fecha_embarque',
            'reun_vva',
            'newc48',
            'newc_fecha_embarque',
            'new_vva',
            'peru49',
            'peru_fecha_embarque',
            'peru_vva',
            'comentarios_ing',
            'user_carga', 
            'created_at'
        ];
        $data = [];
        

        // Users for MX
        if ($id_region == 1) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_mex', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for CAM
        if ($id_region == 2) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_cam', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for AND
        if ($id_region == 3) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv')
                ->where('stock_gral_serv.reg_and', 1)
                ->where('stock_gral_serv.ok', 0)
                ->get();
        }

        // Users for CAR
        if ($id_region == 4) {
            $data = StocksModel::select($columnasactivas)
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

    public static function get_records_by_id_isc($id)
    {

        $data = StocksModel::select('stock_gral_serv_isc.*')
            ->from('stock_gral_serv_isc')
            ->where('folio', $id)
            ->get();

        $final_data = array();
        $countRegion1 = 0;
        $countRegion2 = 0;
        $countRegion3 = 0;
        $countRegion4 = 0;

        foreach ($data as $data) {
            if ($data->region == 1) {
                $final_data[0][$countRegion1]['po'] = $data->po;
                $final_data[0][$countRegion1]['comentarios'] = $data->comentarios;
                $final_data[0][$countRegion1]['region'] = $data->region;
                $final_data[0][$countRegion1]['user'] = $data->user;
                $final_data[0][$countRegion1]['created_at'] = $data->created_at;
                $countRegion1++;
            } elseif ($data->region == 2) {
                $final_data[1][$countRegion2]['po'] = $data->po;
                $final_data[1][$countRegion2]['comentarios'] = $data->comentarios;
                $final_data[1][$countRegion2]['region'] = $data->region;
                $final_data[1][$countRegion2]['user'] = $data->user;
                $final_data[1][$countRegion2]['created_at'] = $data->created_at;
                $countRegion2++;
            } elseif ($data->region == 3) {
                $final_data[2][$countRegion3]['po'] = $data->po;
                $final_data[2][$countRegion3]['comentarios'] = $data->comentarios;
                $final_data[2][$countRegion3]['region'] = $data->region;
                $final_data[2][$countRegion3]['user'] = $data->user;
                $final_data[2][$countRegion3]['created_at'] = $data->created_at;
                $countRegion3++;
            } elseif ($data->region == 4) {
                $final_data[3][$countRegion4]['po'] = $data->po;
                $final_data[3][$countRegion4]['comentarios'] = $data->comentarios;
                $final_data[3][$countRegion4]['region'] = $data->region;
                $final_data[3][$countRegion4]['user'] = $data->user;
                $final_data[3][$countRegion4]['created_at'] = $data->created_at;
                $countRegion4++;
            }
        }

        $final_data[4][0]['countRegion1'] = $countRegion1;
        $final_data[4][0]['countRegion2'] = $countRegion2;
        $final_data[4][0]['countRegion3'] = $countRegion3;
        $final_data[4][0]['countRegion4'] = $countRegion4;

        return $final_data;
    }

    public static function update_stocks_iniciales_isc($folio, $material, $modelo, $po, $comentarios, $username, $date, $region)
    {
        DB::table('stock_gral_serv_isc')->insert(
            [
                'folio'        => $folio,
                'material'      => $material,
                'modelo'        => $modelo,
                'po'            => $po,
                'comentarios'   => $comentarios,
                'user'          => $username,
                'created_at'    => $date,
                'region'        => $region
            ]
        );

        switch ($region) {
            case 1:
                // MX
                DB::table('stock_gral_serv')
                    ->where('id', $folio)
                    ->update(['reg_mex_po'        => 1]);
                break;

            case 2:
                // CAM
                DB::table('stock_gral_serv')
                    ->where('id', $folio)
                    ->update(['reg_cam_po'        => 1]);
                break;

            case 3:
                // AND
                DB::table('stock_gral_serv')
                    ->where('id', $folio)
                    ->update(['reg_and_po'        => 1]);
                break;

            case 4:
                // CAR
                DB::table('stock_gral_serv')
                    ->where('id', $folio)
                    ->update(['reg_car_po'        => 1]);
                break;

            default:
                break;
        }


        // Validamos si todas las POs estan OK para cerrar el Stock Inicial como COMPLETADO.
        $data = StocksModel::select('stock_gral_serv.reg_mex', 'stock_gral_serv.reg_mex_po', 'stock_gral_serv.reg_cam', 'stock_gral_serv.reg_cam_po', 'stock_gral_serv.reg_and', 'stock_gral_serv.reg_and_po', 'stock_gral_serv.reg_car', 'stock_gral_serv.reg_car_po')
            ->from('stock_gral_serv')
            ->where('id', $folio)
            ->get();

        $its_ok = true;
        foreach ($data as $data) {
            if ($data->reg_mex == 1) {
                if ($data->reg_mex_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_cam == 1) {
                if ($data->reg_cam_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_and == 1) {
                if ($data->reg_and_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_car == 1) {
                if ($data->reg_car_po == 0) {
                    $its_ok = false;
                }
            }
        }

        if ($its_ok) {
            DB::table('stock_gral_serv')
                ->where('id', $folio)
                ->update(['ok'        => 1]);
        }
    }

    public static function insert_load($data, $username, $date)
    {
        $id_region_one = 0;
        $id_region_two = 0;
        $id_region_three = 0;
        $id_region_four = 0;
        // echo "<pre>";
        // print_r($data);
        // return;
        //die();
        if ($data[19] == 1) {
            // mex1
            $id_region_one = 1;
        }
        if ($data[22] == 1) {
            // guat2
            $id_region_two = 1;
        }
        if ($data[25] == 1) {
            // hond3
            $id_region_two = 1;
        }
        if ($data[28] == 1) {
            // repd4
            $id_region_four = 1;
        }
        if ($data[31] == 1) {
            // hait5
            $id_region_four = 1;
        }
        if ($data[34] == 1) {
            // arub6
            $id_region_four = 1;
        }
        if ($data[37] == 1) {
            // salv7
            $id_region_two = 1;
        }
        if ($data[40] == 1) {
            // nica8
            $id_region_two = 1;
        }
        if ($data[43] == 1) {
            // cr9
            $id_region_two = 1;
        }
        if ($data[46] == 1) {
            // pana10
            $id_region_two = 1;
        }
        if ($data[49] == 1) {
            // angu11
            $id_region_four = 1;
        }
        if ($data[52] == 1) {
            // baha12
            $id_region_four = 1;
        }
        if ($data[55] == 1) {
            // beli13
            $id_region_two = 1;
        }
        if ($data[58] == 1) {
            // berm14
            $id_region_four = 1;
        }
        if ($data[61] == 1) {
            // caym15
            $id_region_four = 1;
        }
        if ($data[64] == 1) {
            // guya16
            $id_region_four = 1;
        }
        if ($data[67] == 1) {
            // suri17
            $id_region_four = 1;
        }
        if ($data[70] == 1) {
            // turk18
            $id_region_four = 1;
        }
        if ($data[73] == 1) {
            // brit19
            $id_region_four = 1;
        }
        if ($data[76] == 1) {
            // maar20
            $id_region_four = 1;
        }
        if ($data[79] == 1) {
            // saba21
            $id_region_four = 1;
        }
        if ($data[82] == 1) {
            // anti22
            $id_region_four = 1;
        }
        if ($data[85] == 1) {
            // mons23
            $id_region_four = 1;
        }
        if ($data[88] == 1) {
            // kitt24
            $id_region_four = 1;
        }
        if ($data[91] == 1) {
            // bart25
            $id_region_four = 1;
        }
        if ($data[94] == 1) {
            // marti26
            $id_region_four = 1;
        }
        if ($data[97] == 1) {
            // trin27
            $id_region_four = 1;
        }
        if ($data[100] == 1) {
            // jama28
            $id_region_four = 1;
        }
        if ($data[103] == 1) {
            // barb29
            $id_region_four = 1;
        }
        if ($data[106] == 1) {
            // bona30
            $id_region_four = 1;
        }
        if ($data[109] == 1) {
            // cura31
            $id_region_four = 1;
        }
        if ($data[112] == 1) {
            // col32
            $id_region_three = 1;
        }
        if ($data[115] == 1) {
            // ven33
            $id_region_three = 1;
        }
        if ($data[118] == 1) {
            // ecu34
            $id_region_three = 1;
        }
        if ($data[121] == 1) {
            // ptor35
            $id_region_four = 1;
        }
        if ($data[124] == 1) {
            // croi36
            $id_region_four = 1;
        }
        if ($data[127] == 1) {
            // thom37
            $id_region_four = 1;
        }
        if ($data[130] == 1) {
            // jhon38
            $id_region_four = 1;
        }
        if ($data[133] == 1) {
            // virg39
            $id_region_four = 1;
        }
        if ($data[136] == 1) {
            // domi40
            $id_region_four = 1;
        }
        if ($data[139] == 1) {
            // gren41
            $id_region_four = 1;
        }
        if ($data[142] == 1) {
            // luci42
            $id_region_four = 1;
        }
        if ($data[145] == 1) {
            // vinc43
            $id_region_four = 1;
        }
        if ($data[148] == 1) {
            // fren44
            $id_region_four = 1;
        }
        if ($data[151] == 1) {
            // mart45
            $id_region_four = 1;
        }
        if ($data[154] == 1) {
            // guad46
            $id_region_four = 1;
        }
        if ($data[157] == 1) {
            // reun47
            $id_region_four = 1;
        }
        if ($data[160] == 1) {
            // newc48
            $id_region_four = 1;
        }
        if ($data[163] == 1) {
            // peru49
            $id_region_three = 1;
        }

        DB::table('stock_gral_serv')->insert(
            [
                'material' => $data[0],
                'descripcion' => $data[1],
                'tipo_status' => $data[2],
                'precio_usd' => $data[3],
                'sir' => $data[4],
                'fcr' => $data[5],
                'proyecto' => $data[6],
                'proveedor' => $data[7],
                'ots' => (empty($data[8]) ? NULL : $data[8]),
                'obs' => (empty($data[9]) ? NULL : $data[9]),
                'modelo' => (empty($data[10]) ? NULL : $data[10]),
                'cant_pza_sku' => (empty($data[11]) ? NULL : $data[11]),
                'garantia_years' => (empty($data[12]) ? NULL : $data[12]),
                'tipo_uso' => (empty($data[13]) ? NULL : $data[13]),
                'tipo_mat' => (empty($data[14]) ? NULL : $data[14]),
                'cat' => (empty($data[15]) ? NULL : $data[15]),
                'fam' => (empty($data[16]) ? NULL : $data[16]),
                'marca' => (empty($data[17]) ? NULL : $data[17]),
                'commodity' => (empty($data[18]) ? NULL : $data[18]),
                'mex1' => (empty($data[19]) ? NULL : $data[19]),
                'mex_fecha_embarque' => (empty($data[20]) ? NULL : $data[20]),
                'mex_vva' => (empty($data[21]) ? NULL : $data[21]),
                'guat2' => (empty($data[22]) ? NULL : $data[22]),
                'guat_fecha_embarque' => (empty($data[23]) ? NULL : $data[23]),
                'guat_vva' => (empty($data[24]) ? NULL : $data[24]),
                'hond3' => (empty($data[25]) ? NULL : $data[25]),
                'hond_fecha_embarque' => (empty($data[26]) ? NULL : $data[26]),
                'hond_vva' => (empty($data[27]) ? NULL : $data[27]),
                'repd4' => (empty($data[28]) ? NULL : $data[28]),
                'repd_fecha_embarque' => (empty($data[29]) ? NULL : $data[29]),
                'repd_vva' => (empty($data[30]) ? NULL : $data[30]),
                'hait5' => (empty($data[31]) ? NULL : $data[31]),
                'hait_fecha_embarque' => (empty($data[32]) ? NULL : $data[32]),
                'hait_vva' => (empty($data[33]) ? NULL : $data[33]),
                'arub6' => (empty($data[34]) ? NULL : $data[34]),
                'arub_fecha_embarque' => (empty($data[35]) ? NULL : $data[35]),
                'arub_vva' => (empty($data[36]) ? NULL : $data[36]),
                'salv7' => (empty($data[37]) ? NULL : $data[37]),
                'salv_fecha_embarque' => (empty($data[38]) ? NULL : $data[38]),
                'salv_vva' => (empty($data[39]) ? NULL : $data[39]),
                'nica8' => (empty($data[40]) ? NULL : $data[40]),
                'nica_fecha_embarque' => (empty($data[41]) ? NULL : $data[41]),
                'nica_vva' => (empty($data[42]) ? NULL : $data[42]),
                'cr9' => (empty($data[43]) ? NULL : $data[43]),
                'cr_fecha_embarque' => (empty($data[44]) ? NULL : $data[44]),
                'cr_vva' => (empty($data[45]) ? NULL : $data[45]),
                'pana10' => (empty($data[46]) ? NULL : $data[46]),
                'pana_fecha_embarque' => (empty($data[47]) ? NULL : $data[47]),
                'pana' => (empty($data[48]) ? NULL : $data[48]),
                'angu11' => (empty($data[49]) ? NULL : $data[49]),
                'angu_fecha_embarque' => (empty($data[50]) ? NULL : $data[50]),
                'angu_vva' => (empty($data[51]) ? NULL : $data[51]),
                'baha12' => (empty($data[52]) ? NULL : $data[52]),
                'baha_fecha_embarque' => (empty($data[53]) ? NULL : $data[53]),
                'baha_vva' => (empty($data[54]) ? NULL : $data[54]),
                'beli13' => (empty($data[55]) ? NULL : $data[55]),
                'beli_fecha_embarque' => (empty($data[56]) ? NULL : $data[56]),
                'beli_vva' => (empty($data[57]) ? NULL : $data[57]),
                'berm14' => (empty($data[58]) ? NULL : $data[58]),
                'berm_fecha_embarque' => (empty($data[59]) ? NULL : $data[59]),
                'berm_vva' => (empty($data[60]) ? NULL : $data[60]),
                'caym15' => (empty($data[61]) ? NULL : $data[61]),
                'caym_fecha_embarque' => (empty($data[62]) ? NULL : $data[62]),
                'caym_vva' => (empty($data[63]) ? NULL : $data[63]),
                'guya16' => (empty($data[64]) ? NULL : $data[64]),
                'guya_fecha_embarque' => (empty($data[65]) ? NULL : $data[65]),
                'guya_vva' => (empty($data[66]) ? NULL : $data[66]),
                'suri17' => (empty($data[67]) ? NULL : $data[67]),
                'suri_fecha_embarque' => (empty($data[68]) ? NULL : $data[68]),
                'suri_vva' => (empty($data[69]) ? NULL : $data[69]),
                'turk18' => (empty($data[70]) ? NULL : $data[70]),
                'turk_fecha_embarque' => (empty($data[71]) ? NULL : $data[71]),
                'turk_vva' => (empty($data[72]) ? NULL : $data[72]),
                'brit19' => (empty($data[73]) ? NULL : $data[73]),
                'brit_fecha_embarque' => (empty($data[74]) ? NULL : $data[74]),
                'brit_vva' => (empty($data[75]) ? NULL : $data[75]),
                'maar20' => (empty($data[76]) ? NULL : $data[76]),
                'maar_fecha_embarque' => (empty($data[77]) ? NULL : $data[77]),
                'maar_vva' => (empty($data[78]) ? NULL : $data[78]),
                'saba21' => (empty($data[79]) ? NULL : $data[79]),
                'saba_fecha_embarque' => (empty($data[80]) ? NULL : $data[80]),
                'saba_vva' => (empty($data[81]) ? NULL : $data[81]),
                'anti22' => (empty($data[82]) ? NULL : $data[82]),
                'anti_fecha_embarque' => (empty($data[83]) ? NULL : $data[83]),
                'anti_vva' => (empty($data[84]) ? NULL : $data[84]),
                'mons23' => (empty($data[85]) ? NULL : $data[85]),
                'mons_fecha_embarque' => (empty($data[86]) ? NULL : $data[86]),
                'mons_vva' => (empty($data[87]) ? NULL : $data[87]),
                'kitt24' => (empty($data[88]) ? NULL : $data[88]),
                'kitt_fecha_embarque' => (empty($data[89]) ? NULL : $data[89]),
                'kitt_vva' => (empty($data[90]) ? NULL : $data[90]),
                'bart25' => (empty($data[91]) ? NULL : $data[91]),
                'bart_fecha_embarque' => (empty($data[92]) ? NULL : $data[92]),
                'bart_vva' => (empty($data[93]) ? NULL : $data[93]),
                'marti26' => (empty($data[94]) ? NULL : $data[94]),
                'marti_fecha_embarque' => (empty($data[95]) ? NULL : $data[95]),
                'marti_vva' => (empty($data[96]) ? NULL : $data[96]),
                'trin27' => (empty($data[97]) ? NULL : $data[97]),
                'trin_fecha_embarque' => (empty($data[98]) ? NULL : $data[98]),
                'trin_vva' => (empty($data[99]) ? NULL : $data[99]),
                'jama28' => (empty($data[100]) ? NULL : $data[100]),
                'jama_fecha_embarque' => (empty($data[101]) ? NULL : $data[101]),
                'jama_vva' => (empty($data[102]) ? NULL : $data[102]),
                'barb29' => (empty($data[103]) ? NULL : $data[103]),
                'barb_fecha_embarque' => (empty($data[104]) ? NULL : $data[104]),
                'barb_vva' => (empty($data[105]) ? NULL : $data[105]),
                'bona30' => (empty($data[106]) ? NULL : $data[106]),
                'bona_fecha_embarque' => (empty($data[107]) ? NULL : $data[107]),
                'bona_vva' => (empty($data[108]) ? NULL : $data[108]),
                'cura31' => (empty($data[109]) ? NULL : $data[109]),
                'cura_fecha_embarque' => (empty($data[110]) ? NULL : $data[110]),
                'cura_vva' => (empty($data[111]) ? NULL : $data[111]),
                'col32' => (empty($data[112]) ? NULL : $data[112]),
                'col_fecha_embarque' => (empty($data[113]) ? NULL : $data[113]),
                'col_vva' => (empty($data[114]) ? NULL : $data[114]),
                'ven33' => (empty($data[115]) ? NULL : $data[115]),
                'ven_fecha_embarque' => (empty($data[116]) ? NULL : $data[116]),
                'ven_vva' => (empty($data[117]) ? NULL : $data[117]),
                'ecu34' => (empty($data[118]) ? NULL : $data[118]),
                'ecu_fecha_embarque' => (empty($data[119]) ? NULL : $data[119]),
                'ecu_vva' => (empty($data[120]) ? NULL : $data[120]),
                'ptor35' => (empty($data[121]) ? NULL : $data[121]),
                'ptor_fecha_embarque' => (empty($data[122]) ? NULL : $data[122]),
                'ptor_vva' => (empty($data[123]) ? NULL : $data[123]),
                'croi36' => (empty($data[124]) ? NULL : $data[124]),
                'croi_fecha_embarque' => (empty($data[125]) ? NULL : $data[125]),
                'croi_vva' => (empty($data[126]) ? NULL : $data[126]),
                'thom37' => (empty($data[127]) ? NULL : $data[127]),
                'thom_fecha_embarque' => (empty($data[128]) ? NULL : $data[128]),
                'thom_vva' => (empty($data[129]) ? NULL : $data[129]),
                'jhon38' => (empty($data[130]) ? NULL : $data[130]),
                'jhon_fecha_embarque' => (empty($data[131]) ? NULL : $data[131]),
                'jhon_vva' => (empty($data[132]) ? NULL : $data[132]),
                'virg39' => (empty($data[133]) ? NULL : $data[133]),
                'virg_fecha_embarque' => (empty($data[134]) ? NULL : $data[134]),
                'virg_vva' => (empty($data[135]) ? NULL : $data[135]),
                'domi40' => (empty($data[136]) ? NULL : $data[136]),
                'domi_fecha_embarque' => (empty($data[137]) ? NULL : $data[137]),
                'domi_vva' => (empty($data[138]) ? NULL : $data[138]),
                'gren41' => (empty($data[139]) ? NULL : $data[139]),
                'gren_fecha_embarque' => (empty($data[140]) ? NULL : $data[140]),
                'gren_vva' => (empty($data[141]) ? NULL : $data[141]),
                'luci42' => (empty($data[142]) ? NULL : $data[142]),
                'luci_fecha_embarque' => (empty($data[143]) ? NULL : $data[143]),
                'luci_vva' => (empty($data[144]) ? NULL : $data[144]),
                'vinc43' => (empty($data[145]) ? NULL : $data[145]),
                'vinc_fecha_embarque' => (empty($data[146]) ? NULL : $data[146]),
                'vinc_vva' => (empty($data[147]) ? NULL : $data[147]),
                'fren44' => (empty($data[148]) ? NULL : $data[148]),
                'fren_fecha_embarque' => (empty($data[149]) ? NULL : $data[149]),
                'fren_vva' => (empty($data[150]) ? NULL : $data[150]),
                'mart45' => (empty($data[151]) ? NULL : $data[151]),
                'mart_fecha_embarque' => (empty($data[152]) ? NULL : $data[152]),
                'mart_vva' => (empty($data[153]) ? NULL : $data[153]),
                'guad46' => (empty($data[154]) ? NULL : $data[154]),
                'guad_fecha_embarque' => (empty($data[155]) ? NULL : $data[155]),
                'guad_vva' => (empty($data[156]) ? NULL : $data[156]),
                'reun47' => (empty($data[157]) ? NULL : $data[157]),
                'reun_fecha_embarque' => (empty($data[158]) ? NULL : $data[158]),
                'reun_vva' => (empty($data[159]) ? NULL : $data[159]),
                'newc48' => (empty($data[160]) ? NULL : $data[160]),
                'newc_fecha_embarque' => (empty($data[161]) ? NULL : $data[161]),
                'new_vva' => (empty($data[162]) ? NULL : $data[162]),
                'peru49' => (empty($data[163]) ? NULL : $data[163]),
                'peru_fecha_embarque' => (empty($data[164]) ? NULL : $data[164]),
                'peru_vva' => (empty($data[165]) ? NULL : $data[165]),
                'comentarios_ing' => (empty($data[166]) ? NULL : $data[166]),
                'user_carga' => $username,
                'created_at' => $date,
                'reg_mex' => $id_region_one,
                'reg_cam' => $id_region_two,
                'reg_and' => $id_region_three,
                'reg_car' => $id_region_four
            ]
        );
        // echo "<pre>";
        // print_r($data);
        // return;

        // if(empty($data[8]) || $data[8] == ''){
        //     $data[8] = Null;
        // }else{
        //     //echo date('Ymd',$data[8]);
        //     $data[8] = trim($data[8]);
        //     $ddate = explode('/',$data[8]);

        //     $data[8] = $ddate[2].'-'.$ddate[1].'-'.$ddate[0];
        // }

        // DB::table('stock_gral_serv')->insert(
        // [
        //     'material' => $data[0],
        //     'descripcion' => $data[1],
        //     'tipo_status' => $data[2],
        //     'precio_usd' => $data[3],
        //     'sir' => $data[4],
        //     'proyecto' => $data[5],
        //     'cat' => $data[6],
        //     'proveedor' => $data[7],
        //     'ots' => (empty($data[8]) ? NULL : $data[8]),                
        //     'modelo' => (empty($data[9]) ? NULL : $data[9]),
        //     'cant_pza_sku' => (empty($data[10]) ? NULL : $data[10]),
        //     'garantia_years' => (empty($data[11]) ? NULL : $data[11]),
        //     'tipo_uso' => (empty($data[13]) ? NULL : $data[13]),
        //     'user_carga' => $username,
        //     'created_at' => $date,
        //     'reg_mex' => 1
        // ]);

        // Damos de alta la refacción en alta de partes.
        DB::table('alcopar_partes')->insert(
            [
                'fecha'            => $date,
                'parte'             => $data[0],
                'descripcion'       => $data[1],
                'modelo'            => $data[10],
                'username'          => $username,
                'depto'             => 'INGENIERIA',
                'motivo'            => 'CARGA AUT. STOCK INICIAL',
                'status'            => 'STOCK INICIAL',
                'ing'               => $username,
                'fechareving'       => $date,
                'reving'            => 0,
                'comentario_reving' => 'STOCK INICIAL',
                'costo'             => 1
            ]
        );
    }

    // Stock Final
    public static function get_all_records_stocks_final($user, $id_region)
    {
        $columnasactivas = [
'id',            'material',
            'descripcion',
            'tipo_status',
            'precio_usd',
            'sir',
            'fcr',
            'proyecto',
            'proveedor',
            'ots',
            'obs',
            'modelo',
            'cant_pza_sku',
            'garantia_years',
            'tipo_uso',
            'tipo_mat',
            'cat',
            'fam',
            'marca',
            'commodity',
            'mex1',
            'mex_fecha_embarque',
            'mex_vva',
            'guat2',
            'guat_fecha_embarque',
            'guat_vva',
            'hond3',
            'hond_fecha_embarque',
            'hond_vva',
            'repd4',
            'repd_fecha_embarque',
            'repd_vva',
            'hait5',
            'hait_fecha_embarque',
            'hait_vva',
            'arub6',
            'arub_fecha_embarque',
            'arub_vva',
            'salv7',
            'salv_fecha_embarque',
            'salv_vva',
            'nica8',
            'nica_fecha_embarque',
            'nica_vva',
            'cr9',
            'cr_fecha_embarque',
            'cr_vva',
            'pana10',
            'pana_fecha_embarque',
            'pana',
            'angu11',
            'angu_fecha_embarque',
            'angu_vva',
            'baha12',
            'baha_fecha_embarque',
            'baha_vva',
            'beli13',
            'beli_fecha_embarque',
            'beli_vva',
            'berm14',
            'berm_fecha_embarque',
            'berm_vva',
            'caym15',
            'caym_fecha_embarque',
            'caym_vva',
            'guya16',
            'guya_fecha_embarque',
            'guya_vva',
            'suri17',
            'suri_fecha_embarque',
            'suri_vva',
            'turk18',
            'turk_fecha_embarque',
            'turk_vva',
            'brit19',
            'brit_fecha_embarque',
            'brit_vva',
            'maar20',
            'maar_fecha_embarque',
            'maar_vva',
            'saba21',
            'saba_fecha_embarque',
            'saba_vva',
            'anti22',
            'anti_fecha_embarque',
            'anti_vva',
            'mons23',
            'mons_fecha_embarque',
            'mons_vva',
            'kitt24',
            'kitt_fecha_embarque',
            'kitt_vva',
            'bart25',
            'bart_fecha_embarque',
            'bart_vva',
            'marti26',
            'marti_fecha_embarque',
            'marti_vva',
            'trin27',
            'trin_fecha_embarque',
            'trin_vva',
            'jama28',
            'jama_fecha_embarque',
            'jama_vva',
            'barb29',
            'barb_fecha_embarque',
            'barb_vva',
            'bona30',
            'bona_fecha_embarque',
            'bona_vva',
            'cura31',
            'cura_fecha_embarque',
            'cura_vva',
            'col32',
            'col_fecha_embarque',
            'col_vva',
            'ven33',
            'ven_fecha_embarque',
            'ven_vva',
            'ecu34',
            'ecu_fecha_embarque',
            'ecu_vva',
            'ptor35',
            'ptor_fecha_embarque',
            'ptor_vva',
            'croi36',
            'croi_fecha_embarque',
            'croi_vva',
            'thom37',
            'thom_fecha_embarque',
            'thom_vva',
            'jhon38',
            'jhon_fecha_embarque',
            'jhon_vva',
            'virg39',
            'virg_fecha_embarque',
            'virg_vva',
            'domi40',
            'domi_fecha_embarque',
            'domi_vva',
            'gren41',
            'gren_fecha_embarque',
            'gren_vva',
            'luci42',
            'luci_fecha_embarque',
            'luci_vva',
            'vinc43',
            'vinc_fecha_embarque',
            'vinc_vva',
            'fren44',
            'fren_fecha_embarque',
            'fren_vva',
            'mart45',
            'mart_fecha_embarque',
            'mart_vva',
            'guad46',
            'guad_fecha_embarque',
            'guad_vva',
            'reun47',
            'reun_fecha_embarque',
            'reun_vva',
            'newc48',
            'newc_fecha_embarque',
            'new_vva',
            'peru49',
            'peru_fecha_embarque',
            'peru_vva',
            'comentarios_ing',
            'user_carga', 
            'created_at'];
        $data = [];
        // Records for Managers.
        if ($user == "munoznd") {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv_final')
                ->get();
        } else {
            // Users for MX
            if ($id_region == 1) {
                $data = StocksModel::select($columnasactivas)
                    ->from('stock_gral_serv_final')
                    ->where('stock_gral_serv_final.reg_mex', 1)
                    ->get();
            }

            // Users for CAM
            if ($id_region == 2) {
                $data = StocksModel::select($columnasactivas)
                    ->from('stock_gral_serv_final')
                    ->where('stock_gral_serv_final.reg_cam', 1)
                    ->get();
            }

            // Users for AND
            if ($id_region == 3) {
                $data = StocksModel::select($columnasactivas)
                    ->from('stock_gral_serv_final')
                    ->where('stock_gral_serv_final.reg_and', 1)
                    ->get();
            }

            // Users for CAR
            if ($id_region == 4) {
                $data = StocksModel::select($columnasactivas)
                    ->from('stock_gral_serv_final')
                    ->where('stock_gral_serv_final.reg_car', 1)
                    ->get();
            }
        }

        return $data;
    }

    public static function get_all_records_pending_list_stocks_final($id_region)
    {


        $columnasactivas = [
'id',            'material',
            'descripcion',
            'tipo_status',
            'precio_usd',
            'sir',
            'fcr',
            'proyecto',
            'proveedor',
            'ots',
            'obs',
            'modelo',
            'cant_pza_sku',
            'garantia_years',
            'tipo_uso',
            'tipo_mat',
            'cat',
            'fam',
            'marca',
            'commodity',
            'mex1',
            'mex_fecha_embarque',
            'mex_vva',
            'guat2',
            'guat_fecha_embarque',
            'guat_vva',
            'hond3',
            'hond_fecha_embarque',
            'hond_vva',
            'repd4',
            'repd_fecha_embarque',
            'repd_vva',
            'hait5',
            'hait_fecha_embarque',
            'hait_vva',
            'arub6',
            'arub_fecha_embarque',
            'arub_vva',
            'salv7',
            'salv_fecha_embarque',
            'salv_vva',
            'nica8',
            'nica_fecha_embarque',
            'nica_vva',
            'cr9',
            'cr_fecha_embarque',
            'cr_vva',
            'pana10',
            'pana_fecha_embarque',
            'pana',
            'angu11',
            'angu_fecha_embarque',
            'angu_vva',
            'baha12',
            'baha_fecha_embarque',
            'baha_vva',
            'beli13',
            'beli_fecha_embarque',
            'beli_vva',
            'berm14',
            'berm_fecha_embarque',
            'berm_vva',
            'caym15',
            'caym_fecha_embarque',
            'caym_vva',
            'guya16',
            'guya_fecha_embarque',
            'guya_vva',
            'suri17',
            'suri_fecha_embarque',
            'suri_vva',
            'turk18',
            'turk_fecha_embarque',
            'turk_vva',
            'brit19',
            'brit_fecha_embarque',
            'brit_vva',
            'maar20',
            'maar_fecha_embarque',
            'maar_vva',
            'saba21',
            'saba_fecha_embarque',
            'saba_vva',
            'anti22',
            'anti_fecha_embarque',
            'anti_vva',
            'mons23',
            'mons_fecha_embarque',
            'mons_vva',
            'kitt24',
            'kitt_fecha_embarque',
            'kitt_vva',
            'bart25',
            'bart_fecha_embarque',
            'bart_vva',
            'marti26',
            'marti_fecha_embarque',
            'marti_vva',
            'trin27',
            'trin_fecha_embarque',
            'trin_vva',
            'jama28',
            'jama_fecha_embarque',
            'jama_vva',
            'barb29',
            'barb_fecha_embarque',
            'barb_vva',
            'bona30',
            'bona_fecha_embarque',
            'bona_vva',
            'cura31',
            'cura_fecha_embarque',
            'cura_vva',
            'col32',
            'col_fecha_embarque',
            'col_vva',
            'ven33',
            'ven_fecha_embarque',
            'ven_vva',
            'ecu34',
            'ecu_fecha_embarque',
            'ecu_vva',
            'ptor35',
            'ptor_fecha_embarque',
            'ptor_vva',
            'croi36',
            'croi_fecha_embarque',
            'croi_vva',
            'thom37',
            'thom_fecha_embarque',
            'thom_vva',
            'jhon38',
            'jhon_fecha_embarque',
            'jhon_vva',
            'virg39',
            'virg_fecha_embarque',
            'virg_vva',
            'domi40',
            'domi_fecha_embarque',
            'domi_vva',
            'gren41',
            'gren_fecha_embarque',
            'gren_vva',
            'luci42',
            'luci_fecha_embarque',
            'luci_vva',
            'vinc43',
            'vinc_fecha_embarque',
            'vinc_vva',
            'fren44',
            'fren_fecha_embarque',
            'fren_vva',
            'mart45',
            'mart_fecha_embarque',
            'mart_vva',
            'guad46',
            'guad_fecha_embarque',
            'guad_vva',
            'reun47',
            'reun_fecha_embarque',
            'reun_vva',
            'newc48',
            'newc_fecha_embarque',
            'new_vva',
            'peru49',
            'peru_fecha_embarque',
            'peru_vva',
            'comentarios_ing',
            'user_carga', 
            'created_at'];
        $data = [];
        
            // Users for MX
        if ($id_region == 1) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv_final')
                ->where('stock_gral_serv_final.reg_mex', 1)
                ->where('stock_gral_serv_final.ok', 0)
                ->get();
        }

        // Users for CAM
        if ($id_region == 2) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv_final')
                ->where('stock_gral_serv_final.reg_cam', 1)
                ->where('stock_gral_serv_final.ok', 0)
                ->get();
        }

        // Users for AND
        if ($id_region == 3) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv_final')
                ->where('stock_gral_serv_final.reg_and', 1)
                ->where('stock_gral_serv_final.ok', 0)
                ->get();
        }

        // Users for CAR
        if ($id_region == 4) {
            $data = StocksModel::select($columnasactivas)
                ->from('stock_gral_serv_final')
                ->where('stock_gral_serv_final.reg_car', 1)
                ->where('stock_gral_serv_final.ok', 0)
                ->get();
        }

        return $data;
    }

    public static function get_records_by_id_stocks_final($id)
    {

        $data = StocksModel::select('stock_gral_serv_final.*')
            ->from('stock_gral_serv_final')
            ->where('id', $id)
            ->get();

        return $data;
    }

    public static function get_records_by_id_isc_stocks_final($id)
    {

        $data = StocksModel::select('stock_gral_serv_isc_final.*')
            ->from('stock_gral_serv_isc_final')
            ->where('folio', $id)
            ->get();

        $final_data = array();
        $countRegion1 = 0;
        $countRegion2 = 0;
        $countRegion3 = 0;
        $countRegion4 = 0;

        foreach ($data as $data) {
            if ($data->region == 1) {
                $final_data[0][$countRegion1]['po'] = $data->po;
                $final_data[0][$countRegion1]['comentarios'] = $data->comentarios;
                $final_data[0][$countRegion1]['region'] = $data->region;
                $final_data[0][$countRegion1]['user'] = $data->user;
                $final_data[0][$countRegion1]['created_at'] = $data->created_at;
                $countRegion1++;
            } elseif ($data->region == 2) {
                $final_data[1][$countRegion2]['po'] = $data->po;
                $final_data[1][$countRegion2]['comentarios'] = $data->comentarios;
                $final_data[1][$countRegion2]['region'] = $data->region;
                $final_data[1][$countRegion2]['user'] = $data->user;
                $final_data[1][$countRegion2]['created_at'] = $data->created_at;
                $countRegion2++;
            } elseif ($data->region == 3) {
                $final_data[2][$countRegion3]['po'] = $data->po;
                $final_data[2][$countRegion3]['comentarios'] = $data->comentarios;
                $final_data[2][$countRegion3]['region'] = $data->region;
                $final_data[2][$countRegion3]['user'] = $data->user;
                $final_data[2][$countRegion3]['created_at'] = $data->created_at;
                $countRegion3++;
            } elseif ($data->region == 4) {
                $final_data[3][$countRegion4]['po'] = $data->po;
                $final_data[3][$countRegion4]['comentarios'] = $data->comentarios;
                $final_data[3][$countRegion4]['region'] = $data->region;
                $final_data[3][$countRegion4]['user'] = $data->user;
                $final_data[3][$countRegion4]['created_at'] = $data->created_at;
                $countRegion4++;
            }
        }

        $final_data[4][0]['countRegion1'] = $countRegion1;
        $final_data[4][0]['countRegion2'] = $countRegion2;
        $final_data[4][0]['countRegion3'] = $countRegion3;
        $final_data[4][0]['countRegion4'] = $countRegion4;

        return $final_data;
    }

    public static function update_stocks_final_isc($folio, $material, $modelo, $po, $comentarios, $username, $date, $region)
    {
        DB::table('stock_gral_serv_isc_final')->insert(
            [
                'folio'        => $folio,
                'material'      => $material,
                'modelo'        => $modelo,
                'po'            => $po,
                'comentarios'   => $comentarios,
                'user'          => $username,
                'created_at'    => $date,
                'region'        => $region
            ]
        );

        switch ($region) {
            case 1:
                // MX
                DB::table('stock_gral_serv_final')
                    ->where('id', $folio)
                    ->update(['reg_mex_po'        => 1]);
                break;

            case 2:
                // CAM
                DB::table('stock_gral_serv_final')
                    ->where('id', $folio)
                    ->update(['reg_cam_po'        => 1]);
                break;

            case 3:
                // AND
                DB::table('stock_gral_serv_final')
                    ->where('id', $folio)
                    ->update(['reg_and_po'        => 1]);
                break;

            case 4:
                // CAR
                DB::table('stock_gral_serv_final')
                    ->where('id', $folio)
                    ->update(['reg_car_po'        => 1]);
                break;

            default:
                break;
        }


        // Validamos si todas las POs estan OK para cerrar el Stock Inicial como COMPLETADO.
        $data = StocksModel::select('stock_gral_serv_final.reg_mex', 'stock_gral_serv_final.reg_mex_po', 'stock_gral_serv_final.reg_cam', 'stock_gral_serv_final.reg_cam_po', 'stock_gral_serv_final.reg_and', 'stock_gral_serv_final.reg_and_po', 'stock_gral_serv_final.reg_car', 'stock_gral_serv_final.reg_car_po')
            ->from('stock_gral_serv_final')
            ->where('id', $folio)
            ->get();

        $its_ok = true;
        foreach ($data as $data) {
            if ($data->reg_mex == 1) {
                if ($data->reg_mex_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_cam == 1) {
                if ($data->reg_cam_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_and == 1) {
                if ($data->reg_and_po == 0) {
                    $its_ok = false;
                }
            }

            if ($data->reg_car == 1) {
                if ($data->reg_car_po == 0) {
                    $its_ok = false;
                }
            }
        }

        if ($its_ok) {
            DB::table('stock_gral_serv_final')
                ->where('id', $folio)
                ->update(['ok'        => 1]);
        }
    }

    public static function insert_load_stocks_final($data, $username, $date)
    {

        $id_region_one = 0;
        $id_region_two = 0;
        $id_region_three = 0;
        $id_region_four = 0;


        if ($data[19] == 1) {
            // mex1
            $id_region_one = 1;
        }
        if ($data[22] == 1) {
            // guat2
            $id_region_two = 1;
        }
        if ($data[25] == 1) {
            // hond3
            $id_region_two = 1;
        }
        if ($data[28] == 1) {
            // repd4
            $id_region_four = 1;
        }
        if ($data[31] == 1) {
            // hait5
            $id_region_four = 1;
        }
        if ($data[34] == 1) {
            // arub6
            $id_region_four = 1;
        }
        if ($data[37] == 1) {
            // salv7
            $id_region_two = 1;
        }
        if ($data[40] == 1) {
            // nica8
            $id_region_two = 1;
        }
        if ($data[43] == 1) {
            // cr9
            $id_region_two = 1;
        }
        if ($data[46] == 1) {
            // pana10
            $id_region_two = 1;
        }
        if ($data[49] == 1) {
            // angu11
            $id_region_four = 1;
        }
        if ($data[52] == 1) {
            // baha12
            $id_region_four = 1;
        }
        if ($data[55] == 1) {
            // beli13
            $id_region_two = 1;
        }
        if ($data[58] == 1) {
            // berm14
            $id_region_four = 1;
        }
        if ($data[61] == 1) {
            // caym15
            $id_region_four = 1;
        }
        if ($data[64] == 1) {
            // guya16
            $id_region_four = 1;
        }
        if ($data[67] == 1) {
            // suri17
            $id_region_four = 1;
        }
        if ($data[70] == 1) {
            // turk18
            $id_region_four = 1;
        }
        if ($data[73] == 1) {
            // brit19
            $id_region_four = 1;
        }
        if ($data[76] == 1) {
            // maar20
            $id_region_four = 1;
        }
        if ($data[79] == 1) {
            // saba21
            $id_region_four = 1;
        }
        if ($data[82] == 1) {
            // anti22
            $id_region_four = 1;
        }
        if ($data[85] == 1) {
            // mons23
            $id_region_four = 1;
        }
        if ($data[88] == 1) {
            // kitt24
            $id_region_four = 1;
        }
        if ($data[91] == 1) {
            // bart25
            $id_region_four = 1;
        }
        if ($data[94] == 1) {
            // marti26
            $id_region_four = 1;
        }
        if ($data[97] == 1) {
            // trin27
            $id_region_four = 1;
        }
        if ($data[100] == 1) {
            // jama28
            $id_region_four = 1;
        }
        if ($data[103] == 1) {
            // barb29
            $id_region_four = 1;
        }
        if ($data[106] == 1) {
            // bona30
            $id_region_four = 1;
        }
        if ($data[109] == 1) {
            // cura31
            $id_region_four = 1;
        }
        if ($data[112] == 1) {
            // col32
            $id_region_three = 1;
        }
        if ($data[115] == 1) {
            // ven33
            $id_region_three = 1;
        }
        if ($data[118] == 1) {
            // ecu34
            $id_region_three = 1;
        }
        if ($data[121] == 1) {
            // ptor35
            $id_region_four = 1;
        }
        if ($data[124] == 1) {
            // croi36
            $id_region_four = 1;
        }
        if ($data[127] == 1) {
            // thom37
            $id_region_four = 1;
        }
        if ($data[130] == 1) {
            // jhon38
            $id_region_four = 1;
        }
        if ($data[133] == 1) {
            // virg39
            $id_region_four = 1;
        }
        if ($data[136] == 1) {
            // domi40
            $id_region_four = 1;
        }
        if ($data[139] == 1) {
            // gren41
            $id_region_four = 1;
        }
        if ($data[142] == 1) {
            // luci42
            $id_region_four = 1;
        }
        if ($data[145] == 1) {
            // vinc43
            $id_region_four = 1;
        }
        if ($data[148] == 1) {
            // fren44
            $id_region_four = 1;
        }
        if ($data[151] == 1) {
            // mart45
            $id_region_four = 1;
        }
        if ($data[154] == 1) {
            // guad46
            $id_region_four = 1;
        }
        if ($data[157] == 1) {
            // reun47
            $id_region_four = 1;
        }
        if ($data[160] == 1) {
            // newc48
            $id_region_four = 1;
        }
        if ($data[163] == 1) {
            // peru49
            $id_region_three = 1;
        }

        DB::table('stock_gral_serv_final')->insert(
            [
                'material' => $data[0],
                'descripcion' => $data[1],
                'tipo_status' => $data[2],
                'precio_usd' => $data[3],
                'sir' => $data[4],
                'fcr' => $data[5],
                'proyecto' => $data[6],
                'proveedor' => $data[7],
                'ots' => (empty($data[8]) ? NULL : $data[8]),
                'obs' => (empty($data[9]) ? NULL : $data[9]),
                'modelo' => (empty($data[10]) ? NULL : $data[10]),
                'cant_pza_sku' => (empty($data[11]) ? NULL : $data[11]),
                'garantia_years' => (empty($data[12]) ? NULL : $data[12]),
                'tipo_uso' => (empty($data[13]) ? NULL : $data[13]),
                'tipo_mat' => (empty($data[14]) ? NULL : $data[14]),
                'cat' => (empty($data[15]) ? NULL : $data[15]),
                'fam' => (empty($data[16]) ? NULL : $data[16]),
                'marca' => (empty($data[17]) ? NULL : $data[17]),
                'commodity' => (empty($data[18]) ? NULL : $data[18]),
                'mex1' => (empty($data[19]) ? NULL : $data[19]),
                'mex_fecha_embarque' => (empty($data[20]) ? NULL : $data[20]),
                'mex_vva' => (empty($data[21]) ? NULL : $data[21]),
                'guat2' => (empty($data[22]) ? NULL : $data[22]),
                'guat_fecha_embarque' => (empty($data[23]) ? NULL : $data[23]),
                'guat_vva' => (empty($data[24]) ? NULL : $data[24]),
                'hond3' => (empty($data[25]) ? NULL : $data[25]),
                'hond_fecha_embarque' => (empty($data[26]) ? NULL : $data[26]),
                'hond_vva' => (empty($data[27]) ? NULL : $data[27]),
                'repd4' => (empty($data[28]) ? NULL : $data[28]),
                'repd_fecha_embarque' => (empty($data[29]) ? NULL : $data[29]),
                'repd_vva' => (empty($data[30]) ? NULL : $data[30]),
                'hait5' => (empty($data[31]) ? NULL : $data[31]),
                'hait_fecha_embarque' => (empty($data[32]) ? NULL : $data[32]),
                'hait_vva' => (empty($data[33]) ? NULL : $data[33]),
                'arub6' => (empty($data[34]) ? NULL : $data[34]),
                'arub_fecha_embarque' => (empty($data[35]) ? NULL : $data[35]),
                'arub_vva' => (empty($data[36]) ? NULL : $data[36]),
                'salv7' => (empty($data[37]) ? NULL : $data[37]),
                'salv_fecha_embarque' => (empty($data[38]) ? NULL : $data[38]),
                'salv_vva' => (empty($data[39]) ? NULL : $data[39]),
                'nica8' => (empty($data[40]) ? NULL : $data[40]),
                'nica_fecha_embarque' => (empty($data[41]) ? NULL : $data[41]),
                'nica_vva' => (empty($data[42]) ? NULL : $data[42]),
                'cr9' => (empty($data[43]) ? NULL : $data[43]),
                'cr_fecha_embarque' => (empty($data[44]) ? NULL : $data[44]),
                'cr_vva' => (empty($data[45]) ? NULL : $data[45]),
                'pana10' => (empty($data[46]) ? NULL : $data[46]),
                'pana_fecha_embarque' => (empty($data[47]) ? NULL : $data[47]),
                'pana' => (empty($data[48]) ? NULL : $data[48]),
                'angu11' => (empty($data[49]) ? NULL : $data[49]),
                'angu_fecha_embarque' => (empty($data[50]) ? NULL : $data[50]),
                'angu_vva' => (empty($data[51]) ? NULL : $data[51]),
                'baha12' => (empty($data[52]) ? NULL : $data[52]),
                'baha_fecha_embarque' => (empty($data[53]) ? NULL : $data[53]),
                'baha_vva' => (empty($data[54]) ? NULL : $data[54]),
                'beli13' => (empty($data[55]) ? NULL : $data[55]),
                'beli_fecha_embarque' => (empty($data[56]) ? NULL : $data[56]),
                'beli_vva' => (empty($data[57]) ? NULL : $data[57]),
                'berm14' => (empty($data[58]) ? NULL : $data[58]),
                'berm_fecha_embarque' => (empty($data[59]) ? NULL : $data[59]),
                'berm_vva' => (empty($data[60]) ? NULL : $data[60]),
                'caym15' => (empty($data[61]) ? NULL : $data[61]),
                'caym_fecha_embarque' => (empty($data[62]) ? NULL : $data[62]),
                'caym_vva' => (empty($data[63]) ? NULL : $data[63]),
                'guya16' => (empty($data[64]) ? NULL : $data[64]),
                'guya_fecha_embarque' => (empty($data[65]) ? NULL : $data[65]),
                'guya_vva' => (empty($data[66]) ? NULL : $data[66]),
                'suri17' => (empty($data[67]) ? NULL : $data[67]),
                'suri_fecha_embarque' => (empty($data[68]) ? NULL : $data[68]),
                'suri_vva' => (empty($data[69]) ? NULL : $data[69]),
                'turk18' => (empty($data[70]) ? NULL : $data[70]),
                'turk_fecha_embarque' => (empty($data[71]) ? NULL : $data[71]),
                'turk_vva' => (empty($data[72]) ? NULL : $data[72]),
                'brit19' => (empty($data[73]) ? NULL : $data[73]),
                'brit_fecha_embarque' => (empty($data[74]) ? NULL : $data[74]),
                'brit_vva' => (empty($data[75]) ? NULL : $data[75]),
                'maar20' => (empty($data[76]) ? NULL : $data[76]),
                'maar_fecha_embarque' => (empty($data[77]) ? NULL : $data[77]),
                'maar_vva' => (empty($data[78]) ? NULL : $data[78]),
                'saba21' => (empty($data[79]) ? NULL : $data[79]),
                'saba_fecha_embarque' => (empty($data[80]) ? NULL : $data[80]),
                'saba_vva' => (empty($data[81]) ? NULL : $data[81]),
                'anti22' => (empty($data[82]) ? NULL : $data[82]),
                'anti_fecha_embarque' => (empty($data[83]) ? NULL : $data[83]),
                'anti_vva' => (empty($data[84]) ? NULL : $data[84]),
                'mons23' => (empty($data[85]) ? NULL : $data[85]),
                'mons_fecha_embarque' => (empty($data[86]) ? NULL : $data[86]),
                'mons_vva' => (empty($data[87]) ? NULL : $data[87]),
                'kitt24' => (empty($data[88]) ? NULL : $data[88]),
                'kitt_fecha_embarque' => (empty($data[89]) ? NULL : $data[89]),
                'kitt_vva' => (empty($data[90]) ? NULL : $data[90]),
                'bart25' => (empty($data[91]) ? NULL : $data[91]),
                'bart_fecha_embarque' => (empty($data[92]) ? NULL : $data[92]),
                'bart_vva' => (empty($data[93]) ? NULL : $data[93]),
                'marti26' => (empty($data[94]) ? NULL : $data[94]),
                'marti_fecha_embarque' => (empty($data[95]) ? NULL : $data[95]),
                'marti_vva' => (empty($data[96]) ? NULL : $data[96]),
                'trin27' => (empty($data[97]) ? NULL : $data[97]),
                'trin_fecha_embarque' => (empty($data[98]) ? NULL : $data[98]),
                'trin_vva' => (empty($data[99]) ? NULL : $data[99]),
                'jama28' => (empty($data[100]) ? NULL : $data[100]),
                'jama_fecha_embarque' => (empty($data[101]) ? NULL : $data[101]),
                'jama_vva' => (empty($data[102]) ? NULL : $data[102]),
                'barb29' => (empty($data[103]) ? NULL : $data[103]),
                'barb_fecha_embarque' => (empty($data[104]) ? NULL : $data[104]),
                'barb_vva' => (empty($data[105]) ? NULL : $data[105]),
                'bona30' => (empty($data[106]) ? NULL : $data[106]),
                'bona_fecha_embarque' => (empty($data[107]) ? NULL : $data[107]),
                'bona_vva' => (empty($data[108]) ? NULL : $data[108]),
                'cura31' => (empty($data[109]) ? NULL : $data[109]),
                'cura_fecha_embarque' => (empty($data[110]) ? NULL : $data[110]),
                'cura_vva' => (empty($data[111]) ? NULL : $data[111]),
                'col32' => (empty($data[112]) ? NULL : $data[112]),
                'col_fecha_embarque' => (empty($data[113]) ? NULL : $data[113]),
                'col_vva' => (empty($data[114]) ? NULL : $data[114]),
                'ven33' => (empty($data[115]) ? NULL : $data[115]),
                'ven_fecha_embarque' => (empty($data[116]) ? NULL : $data[116]),
                'ven_vva' => (empty($data[117]) ? NULL : $data[117]),
                'ecu34' => (empty($data[118]) ? NULL : $data[118]),
                'ecu_fecha_embarque' => (empty($data[119]) ? NULL : $data[119]),
                'ecu_vva' => (empty($data[120]) ? NULL : $data[120]),
                'ptor35' => (empty($data[121]) ? NULL : $data[121]),
                'ptor_fecha_embarque' => (empty($data[122]) ? NULL : $data[122]),
                'ptor_vva' => (empty($data[123]) ? NULL : $data[123]),
                'croi36' => (empty($data[124]) ? NULL : $data[124]),
                'croi_fecha_embarque' => (empty($data[125]) ? NULL : $data[125]),
                'croi_vva' => (empty($data[126]) ? NULL : $data[126]),
                'thom37' => (empty($data[127]) ? NULL : $data[127]),
                'thom_fecha_embarque' => (empty($data[128]) ? NULL : $data[128]),
                'thom_vva' => (empty($data[129]) ? NULL : $data[129]),
                'jhon38' => (empty($data[130]) ? NULL : $data[130]),
                'jhon_fecha_embarque' => (empty($data[131]) ? NULL : $data[131]),
                'jhon_vva' => (empty($data[132]) ? NULL : $data[132]),
                'virg39' => (empty($data[133]) ? NULL : $data[133]),
                'virg_fecha_embarque' => (empty($data[134]) ? NULL : $data[134]),
                'virg_vva' => (empty($data[135]) ? NULL : $data[135]),
                'domi40' => (empty($data[136]) ? NULL : $data[136]),
                'domi_fecha_embarque' => (empty($data[137]) ? NULL : $data[137]),
                'domi_vva' => (empty($data[138]) ? NULL : $data[138]),
                'gren41' => (empty($data[139]) ? NULL : $data[139]),
                'gren_fecha_embarque' => (empty($data[140]) ? NULL : $data[140]),
                'gren_vva' => (empty($data[141]) ? NULL : $data[141]),
                'luci42' => (empty($data[142]) ? NULL : $data[142]),
                'luci_fecha_embarque' => (empty($data[143]) ? NULL : $data[143]),
                'luci_vva' => (empty($data[144]) ? NULL : $data[144]),
                'vinc43' => (empty($data[145]) ? NULL : $data[145]),
                'vinc_fecha_embarque' => (empty($data[146]) ? NULL : $data[146]),
                'vinc_vva' => (empty($data[147]) ? NULL : $data[147]),
                'fren44' => (empty($data[148]) ? NULL : $data[148]),
                'fren_fecha_embarque' => (empty($data[149]) ? NULL : $data[149]),
                'fren_vva' => (empty($data[150]) ? NULL : $data[150]),
                'mart45' => (empty($data[151]) ? NULL : $data[151]),
                'mart_fecha_embarque' => (empty($data[152]) ? NULL : $data[152]),
                'mart_vva' => (empty($data[153]) ? NULL : $data[153]),
                'guad46' => (empty($data[154]) ? NULL : $data[154]),
                'guad_fecha_embarque' => (empty($data[155]) ? NULL : $data[155]),
                'guad_vva' => (empty($data[156]) ? NULL : $data[156]),
                'reun47' => (empty($data[157]) ? NULL : $data[157]),
                'reun_fecha_embarque' => (empty($data[158]) ? NULL : $data[158]),
                'reun_vva' => (empty($data[159]) ? NULL : $data[159]),
                'newc48' => (empty($data[160]) ? NULL : $data[160]),
                'newc_fecha_embarque' => (empty($data[161]) ? NULL : $data[161]),
                'new_vva' => (empty($data[162]) ? NULL : $data[162]),
                'peru49' => (empty($data[163]) ? NULL : $data[163]),
                'peru_fecha_embarque' => (empty($data[164]) ? NULL : $data[164]),
                'peru_vva' => (empty($data[165]) ? NULL : $data[165]),
                'comentarios_ing' => (empty($data[166]) ? NULL : $data[166]),
                'user_carga' => $username,
                'created_at' => $date,
                'reg_mex' => $id_region_one,
                'reg_cam' => $id_region_two,
                'reg_and' => $id_region_three,
                'reg_car' => $id_region_four
            ]
        );


        // if(empty($data[5]) || $data[5] == ''){
        //     $data[5] = Null;
        // }else{
        //     //echo date('Ymd',$data[8]);
        //     $data[5] = trim($data[5]);
        //     $ddate = explode('/',$data[5]);

        //     $data[5] = $ddate[2].'-'.$ddate[0].'-'.$ddate[1];
        // }       

        // DB::table('stock_gral_serv_final')->insert(
        //     [
        //         'material' => $data[0],
        //         'descripcion' => $data[1],
        //         'tipo_status' => $data[2],                                
        //         'cat' => $data[3],
        //         'proveedor' => $data[4],
        //         'ots' => (empty($data[5]) ? NULL : $data[5]),                
        //         'modelo' => (empty($data[6]) ? NULL : $data[6]),
        //         'garantia_years' => (empty($data[7]) ? NULL : $data[7]),
        //         'tipo_uso' => (empty($data[8]) ? NULL : $data[8]),
        //         'sir' => $data[9],
        //         'user_carga' => $username,
        //         'created_at' => $date,
        //         'reg_mex' => 1
        //     ]);



        // Damos de alta la refacción en alta de partes.
        DB::table('alcopar_partes')->insert(
            [
                'fecha'            => $date,
                'parte'             => $data[0],
                'descripcion'       => $data[1],
                'modelo'            => $data[6],
                'username'          => $username,
                'depto'             => 'INGENIERIA',
                'motivo'            => 'CARGA AUT. STOCK FINAL',
                'status'            => 'STOCK FINAL',
                'ing'               => $username,
                'fechareving'       => $date,
                'reving'            => 0,
                'comentario_reving' => 'STOCK FINAL',
                'costo'             => 1
            ]
        );
    }
}
