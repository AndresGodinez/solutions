<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ciclicos extends Model
{
    protected $table = 'ciclicos';
    protected $connection = 'logistica';

    public static function delPlanta(string $planta)
    {
        Ciclicos::where('planta', $planta)->delete();
        CiclosTemp::whereNull('material')->delete();
        CiclosTemp::whereNull('planta')->update(['planta' => $planta]);
    }

    public static function copyTempToCiclicos(string $planta)
    {
        $tempData = DB::connection('logistica')
            ->table('ciclicos_temp')
            ->select()
            ->where('planta', $planta)
            ->get()
            ->toArray();

        $result = [];

        foreach ($tempData as $temp) {
            $result[] = [
                'planta'=> $temp->planta,
                'material' => $temp->material,
                'descripcion' => $temp->descripcion,
                'type' => $temp->type,
                'bin' => $temp->bin,
                'stock' => $temp->stock,
                'ia' => $temp->ia,
                'invrec' => $temp->invrec,
                'costo' => null
            ];
        }

        foreach ($result as $item) {
            DB::connection('logistica')
                ->table('ciclicos')
                ->insert($item);
        }

    }

    public static function delNullPlanta(string $planta)
    {
        Ciclicos::where('planta', $planta)->whereNull('material')->delete();
    }

    public static function updateCiclicosInfo()
    {
        $query = "UPDATE reforig_logistica.ciclicos
            LEFT JOIN reforig_logistica.materiales_costo ON ciclicos.material = materiales_costo.material
            SET ciclicos.costo=materiales_costo.costo ";
        DB::statement($query);

//        DB::connection('logistica')->update('UPDATE ciclicos
//            LEFT JOIN materiales_costo ON ciclicos.material = materiales_costo.material
//            SET ciclicos.costo=materiales_costo.costo');
    }


    public static function updateDescription(){
        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = UPPER(TRIM(descripcion)) ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"|","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,";","") ');

        DB::connection('logistica')
            ->update("UPDATE ciclicos SET descripcion = replace(descripcion,'\"','')");

        DB::connection('logistica')
            ->update("UPDATE ciclicos SET descripcion = replace(descripcion,'\'','')");

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"&"," AND ") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"-","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Ì","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,".","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"%","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"/","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"*","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"+","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"(","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,")","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"ó","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,",","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"×","") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Á","A") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"É","E") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Í","I") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Ó","O") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Ú","U") ');

        DB::connection('logistica')
            ->update('UPDATE ciclicos SET descripcion = replace(descripcion ,"Ñ","N") ');
    }
}
