<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
date_default_timezone_set("America/Mexico_City");

class NomModel extends ModelBase
{ 
    public static function insert_load_nps($data, $date, $user)
    {
        $table = "nom_comercial";

        // precondiciones 
        if(!empty($data[0]))
        {
            $if_exist_np = DB::table($table)
                        ->where('np', $data[0])
                        ->get();    

            if(count($if_exist_np) == 0)
            {
                // Insertamos en la tabla ligera
                DB::table($table)->insert(
                    ['np' => (empty($data[0]) ? "" : trim($data[0])),
                    'refaccion' => (empty($data[1]) ? "" : trim($data[1])),
                    'producto' => (empty($data[2]) ? "" : trim($data[2])),
                    'marca' => (empty($data[3]) ? "" : trim($data[3])),
                    'importador' => (empty($data[4]) ? "" : trim($data[4])),
                    'hecho_en' => (empty($data[5]) ? "" : trim($data[5])),
                    'supplier' => (empty($data[6]) ? "" : trim($data[6])),
                    'substitute' => (empty($data[7]) ? "" : trim($data[7])),
                    'class' => (empty($data[8]) ? "" : trim($data[8])),
                    'abc' => (empty($data[9]) ? "" : trim($data[9])),
                    'fracc_arancelaria' => (empty($data[10]) ? "" : trim($data[10])),
                    'nom_aplicable' => (empty($data[11]) ? "" : trim($data[11])),
                    'user' => $user,
                    'created_at' => $date,
                    'updated_at' => $date]);
            }
            else
            {
                // Si ya existe el registro solo lo actualizamos en la tabla ligera.
                DB::table($table)
                    ->where('np', $data[0])
                    ->update(['refaccion' => (empty($data[1]) ? "" : trim($data[1])),
                            'producto' => (empty($data[2]) ? "" : trim($data[2])),
                            'marca' => (empty($data[3]) ? "" : trim($data[3])),
                            'importador' => (empty($data[4]) ? "" : trim($data[4])),
                            'hecho_en' => (empty($data[5]) ? "" : trim($data[5])),
                            'supplier' => (empty($data[6]) ? "" : trim($data[6])),
                            'substitute' => (empty($data[7]) ? "" : trim($data[7])),
                            'class' => (empty($data[8]) ? "" : trim($data[8])),
                            'abc' => (empty($data[9]) ? "" : trim($data[9])),
                            'fracc_arancelaria' => (empty($data[10]) ? "" : trim($data[10])),
                            'nom_aplicable' => (empty($data[11]) ? "" : trim($data[11])),
                            'user' => $user,
                            'updated_at' => $date]);
            }
        }
    }   

    public static function get_np_info($np)
    {
        $data = NomModel::select('nom_comercial.*')
                        ->from('nom_comercial')
                        ->where('np', $np)
                        ->get();

        return $data;
    }

    public static function get_np_info_by_id($np)
    {
        $valid = false;
        $data = NomModel::select('nom_comercial.*')
                        ->from('nom_comercial')
                        ->where('np', $np)
                        ->get();

        if(count($data) > 0)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function clean_string($string)
    {
        return trim(strip_tags($string));
    }
}
