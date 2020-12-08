<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class SolicitudesAduanalesModel extends ModelBase
{ 
    public static function get_all_records()
    {
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales_solicitudes.*')
                        ->from('wpx_db_aduanales_solicitudes')
                        ->orderby('status')
                        ->get();

        return $data;
    }

    public static function get_all_records_by_id($id)
    {
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales_solicitudes.*')
                        ->from('wpx_db_aduanales_solicitudes')
                        ->where('id', $id)
                        ->get();

        return $data;
    }

    public static function get_all_marcas()
    {
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales_solicitudes_cat_marcas.*')
                        ->from('wpx_db_aduanales_solicitudes_cat_marcas')
                        ->get();

        return $data;
    }

    public static function get_detail_np($div_nps)
    {
        
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales.*')
                        ->from('wpx_db_aduanales')
                        ->whereIn('np', $div_nps)
                        ->get();

        return $data;
    }

    public static function create_sol($np, $description, $comments, $user, $depto)
    {                        
        $modify_date = date("Y-m-d H:i:s");
        
        DB::table('wpx_db_aduanales_solicitudes')->insert(
            ['np'           => $np, 
            'description'   => $description,
            'comments'      => $comments,
            'user'          => $user,
            'depto'         => $depto,          
            'created_at'    => $modify_date]
        );
    }

    public static function if_exist_sol($np)
    {
        $valid = false;
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales_solicitudes.*')
                        ->from('wpx_db_aduanales_solicitudes')
                        ->where('np', $np)
                        ->get();

        if(count($data) >= 1)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function contestar_sol($request, $username)
    {
        $modify_date = date("Y-m-d H:i:s");
        
        DB::table('wpx_db_aduanales')->insert(
            ['np' => $request->np,
            'sap_description' => $request->sap_description,
            'category' => $request->category,
            'product_name' => $request->product_name,
            'type_component' => $request->type_component,
            'type_functional' => $request->type_functional,
            'type_use' => $request->type_use,
            'type_np' => $request->type_np,
            'textil' => $request->textil,
            'size' => $request->size,
            'motor' => $request->motor,
            'electric' => $request->electric,
            'barras_code' => $request->barras_code,
            'sat_code' => $request->sat_code,
            'repuesto' => $request->repuesto,
            'brand' => $request->brand,
            'n_pzas' => $request->n_pzas,
            'battery' => $request->battery,
            'battery_include' => $request->battery_include,
            'battery_type' => $request->battery_type,
            'battery_n' => $request->battery_n,
            'watt_x_h' => $request->watt_x_h,
            'danger_product' => $request->danger_product,
            'url_fds' => $request->url_fds,
            'created_at' => $modify_date,
            'user' => $username]
        );

        DB::table('wpx_db_aduanales_solicitudes')
            ->where('np', $request->np)
            ->update(   [   'user_ing'          => $username,
                            'comments_ing'      => 'CIERRE SOL ADUANALES',
                            'closed_at'         => $modify_date,
                            'status'            => 0]);
    }

    public static function valid_exist_reg($np)
    {
        $valid = false;
        $data = SolicitudesAduanalesModel::select('wpx_db_aduanales.*')
                        ->from('wpx_db_aduanales')
                        ->where('np', $np)
                        ->get();

        if(count($data) >= 1)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function save_dir_file($dir, $np)
    {
        DB::table('wpx_db_aduanales')
            ->where('np', $np)
            ->update(['picture'          => $dir]);
    }
}
