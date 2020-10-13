<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StockBasicoTecnico extends Model
{
    public $timestamps = false;
    protected $table = 'stockbasico_tecnico';

    protected $connection = 'logistica';

    public static function actualizarStock(string $planta)
    {
        // RESET A LA EXISTENCIA DEL STOCK DEL TECNICO
        DB::connection('logistica')
            ->table('stockbasico_tecnico')
            ->where('planta', $planta)
            ->update(['stock' => null]);
    }

    public static function updateStockTecnico(string $planta)
    {
        // UPDATE DEL STOCK DEL TECNICO EN LA BASE DE DATOS DE SB
        $query = " UPDATE reforig_logistica.stockbasico_tecnico
            LEFT JOIN reforig_logistica.inventario_lx02 ON stockbasico_tecnico.material = inventario_lx02.material
            AND stockbasico_tecnico.bin = inventario_lx02.bin
            AND inventario_lx02.planta='$planta'
            SET
                stockbasico_tecnico.stock=inventario_lx02.stock";
        DB::statement($query);

        // ACTUALIZA A 0 EL STOCK QUE NO HAY
        $query2 = "UPDATE reforig_logistica.stockbasico_tecnico
            SET
                stockbasico_tecnico.stock=0
            WHERE
                stockbasico_tecnico.stock IS NULL
            AND stockbasico_tecnico.planta='$planta'";

        DB::statement($query2);

        // DETERMINA SI HAY QUE SURTIR
        $query3 = "UPDATE reforig_logistica.stockbasico_tecnico
            SET
                stockbasico_tecnico.surtir = stockbasico_tecnico.max - stockbasico_tecnico.stock
            WHERE
                stockbasico_tecnico.planta = '$planta'";

        DB::statement($query3);

        // PONE 0 EN SURTIR SI EL TECNICO TIENE EXCESO DE INV

        $query4 = "UPDATE reforig_logistica.stockbasico_tecnico
            SET
                stockbasico_tecnico.surtir = 0
            WHERE
                stockbasico_tecnico.surtir < 0
            AND stockbasico_tecnico.planta='$planta'";

        DB::statement($query4);

    }
}
