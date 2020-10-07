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


        mysql_query("
INSERT INTO reforig_logistica.surtimiento
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
surtimiento_reserva.planta='$planta'
") or die(mysql_error());

    }
}
