<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Surtimiento extends Model
{
    protected $connection = 'logistica';
    protected $table = 'surtimiento';

    public static function deletePlanta(string $planta)
    {
        DB::connection('logistica')
            ->table('surtimiento')
            ->where('planta', '=', $planta)
            ->delete();
    }

    public static function insertConsolidado(string $planta)
    {
        // AGREGA LA INFORMACION DE RESERVAS AL ARCHIVO DE SURTIMIENTO PARA CONSOLIDARLO
        $query = " INSERT INTO reforig_logistica.surtimiento
            (planta,material,surtir,reserva,dispatch,sloc,bin)
            SELECT
                surtimiento_reserva.planta,
                surtimiento_reserva.material,
                surtimiento_reserva.surtir,
                surtimiento_reserva.reserva,
                surtimiento_reserva.dispatch,
                surtimiento_reserva.sloc,
                surtimiento_reserva.bin
            FROM
                reforig_logistica.surtimiento_reserva
            WHERE
                surtimiento_reserva.planta='$planta'";

        DB::statement($query);
    }

    public static function insertSBSurtimiento(string $planta)
    {
        // INSERTA LOS REGISTROS DEL SB A TABLA DE SURTIMIENTO

        $query = " INSERT INTO
            reforig_logistica.surtimiento
            SELECT
                stockbasico_tecnico.planta AS planta,
                stockbasico_tecnico.material AS material,
                stockbasico_tecnico.surtir AS surtir,
                '' AS reserva,
                'BASICO' AS dispatch,
                stockbasico_tecnico.sloc AS sloc,
                stockbasico_tecnico.bin
            FROM
                reforig_logistica.stockbasico_tecnico
            WHERE
                stockbasico_tecnico.surtir>0
            AND stockbasico_tecnico.planta='$planta'";

        DB::statement($query);

        // UPDATE A LOS BINES EN BLANCO

        $query2 = " UPDATE reforig_logistica.surtimiento
        LEFT JOIN reforig_logistica.stockbasico_tecnico ON surtimiento.sloc=stockbasico_tecnico.sloc
        AND surtimiento.planta=stockbasico_tecnico.planta
        SET
            surtimiento.bin=stockbasico_tecnico.bin
        WHERE
            surtimiento.sloc=stockbasico_tecnico.sloc
            AND surtimiento.bin IS NULL
            AND surtimiento.planta='$planta'";

        DB::statement($query2);


    }

}
