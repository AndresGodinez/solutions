<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InventarioLX02 extends Model
{
    protected $connection = 'logistica';
    protected $table = 'inventario_lx02';

    public static function updateDescription(string $planta)
    {
        DB::connection('logistica')
            ->update("UPDATE inventario_lx02 SET descripcion = replace(descripcion,'\"','')");

        DB::connection('logistica')
            ->update("UPDATE inventario_lx02 SET descripcion = replace(descripcion,'\;','')");

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('planta', '=', '')
            ->delete();

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('planta', '=', 'RS01')
            ->where('sloc', '=', '0085')
            ->delete();

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('material', '=', '')
            ->delete();

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->whereNull('material')
            ->delete();

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('bin', 'like', 'SBTEC%')
            ->where('planta', '=', $planta)
            ->update(['orden' => 1]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('nivel', '=', '001')
            ->where('planta', '=', $planta)
            ->update(['orden' => 2]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('nivel', '=', '002')
            ->where('planta', '=', $planta)
            ->update(['orden' => 3]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('nivel', '=', '003')
            ->where('planta', '=', $planta)
            ->update(['orden' => 4]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('nivel', '=', '006')
            ->where('planta', '=', $planta)
            ->update(['orden' => 5]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->where('nivel', '=', '007')
            ->where('bin', 'like', '%QI%')
            ->where('planta', '=', $planta)
            ->update(['orden' => 6]);

        DB::connection('logistica')
            ->table('inventario_lx02')
            ->whereNull('orden')
            ->where('planta', '=', $planta)
            ->update(['orden' => 0]);

    }
}
