<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InventarioLX02Dev extends Model
{
    protected $connection = 'logistica';

    protected $table = 'inventario_lx02_dev';

    public static function deletePlanta(string $planta)
    {
        DB::connection('logistica')
            ->table('inventario_lx02_dev')
            ->where('planta', $planta)
            ->delete();
    }

    public static function insertData(string $planta)
    {
        $query = "INSERT INTO reforig_logistica.inventario_lx02_dev
                    (planta,material,bin)
                    SELECT planta, material, bin
                    FROM reforig_logistica.inventario_lx02
                    WHERE inventario_lx02.sloc='0001'
                    AND inventario_lx02.planta='$planta'
                    GROUP BY inventario_lx02.material
                    ORDER BY inventario_lx02.bin";

        DB::statement($query);

        $query2 = " INSERT INTO reforig_logistica.inventario_lx02_dev
                    (planta,material,bin)
                    SELECT
                        planta, material, bin
                    FROM
                        reforig_logistica.inventario_lx02
                    WHERE
                        inventario_lx02.sloc='0099'
                    AND inventario_lx02.planta='$planta'
                    GROUP BY
                        inventario_lx02.material
                    ORDER BY
                        inventario_lx02.bin";

        DB::statement($query2);

    }

}
