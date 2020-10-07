<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SurtimientoReserva extends Model
{
    protected $connection = 'logistica';

    protected $table = 'surtimiento_reserva';

    public static function deletePlanta(string $planta)
    {
        DB::connection('logistica')
            ->table('surtimiento_reserva')
            ->where('planta', '=', $planta)
            ->delete();

        DB::connection('logistica')
            ->table('surtimiento_reserva')
            ->whereNull('planta')
            ->delete();

    }

    public static function updatePlanta(string $planta)
    {
        DB::connection('logistica')->update('UPDATE surtimiento_reserva
            LEFT JOIN inventario_lx02 ON surtimiento_reserva.planta = inventario_lx02.planta AND surtimiento_reserva.material = inventario_lx02.material
            SET surtimiento_reserva.stock_planta = inventario_lx02.stock
        WHERE inventario_lx02.planta= '.$planta.'
            AND inventario_lx02.sloc = "0001"
            AND inventario_lx02.bin NOT LIKE "025%"');

    }

    public static function markAsBorrar(string $planta)
    {
        // MARCA COMO BORRAR DONDE NO HAY STOCK DE UNA LINEA
        DB::connection('logistica')->update('UPDATE surtimiento_reserva
            SET surtimiento_reserva.status = "BORRAR"
            WHERE surtimiento_reserva.stock_planta IS NULL
              AND inventario_lx02.planta= '.$planta);

    }

    public static function markAsBorrarReserva(string $planta)
    {
        // MARCA COMO BORRAR DONDE HAY MENOS STOCK QUE EL SOLICITADO EN RESERVA
        DB::connection('logistica')
            ->update('UPDATE surtimiento_reserva
            SET surtimiento_reserva.status = "BORRAR"
            WHERE surtimiento_reserva.stock_planta < surtimiento_reserva.surtir
              AND surtimiento_reserva.planta= '.$planta);
    }

    public static function consolidarReserva(string $planta)
    {
        // OBTIENE EL NUMERO DE LA RESERVA A BORRAR POR INCOMPLETA Y BORRA TODAS LAS LINEAS
        // HASTA QUE TODA LA RESERVA ESTE COMPLETA

        //        $result=mysql_query("
//SELECT
//surtimiento_reserva.reserva,
//surtimiento_reserva.status
//FROM
//reforig_logistica.surtimiento_reserva
//WHERE
//surtimiento_reserva.status = 'BORRAR'
//ORDER BY
//surtimiento_reserva.fecha ASC,
//surtimiento_reserva.reserva ASC
//") or die(mysql_error());


        $surtimientos = SurtimientoReserva::where('status', 'BORRAR')->get();

        foreach ($surtimientos as $surtimiento) {

        }




        while($row = mysql_fetch_array( $result )) {

            $reserva=$row['reserva'];
            mysql_query("
DELETE
FROM
reforig_logistica.surtimiento_reserva
WHERE
surtimiento_reserva.reserva = '$reserva'
") or die(mysql_error());

        }


    }
}
