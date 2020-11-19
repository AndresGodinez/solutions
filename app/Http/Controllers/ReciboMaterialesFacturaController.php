<?php

namespace App\Http\Controllers;

use App\ReciboFolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function compact;
use function view;

class ReciboMaterialesFacturaController extends Controller
{

    public function cargaFactura()
    {
        $reciboFolios = ReciboFolio::orderBy('id')
            ->where('status', 'Abierto')
            ->where('fecha', '>=', '2017-01-01')
            ->paginate();

        return view('ReciboMateriales/carga-factura', compact('reciboFolios'));
    }

    public function cargaFacturaPorFolio(ReciboFolio $reciboFolio )
    {
        return view('ReciboMateriales/factura/form', compact('reciboFolio'));
    }

    public function processFactura(ReciboFolio $reciboFolio, Request $request)
    {
        dd($request->all());
        $user = $request->user();
        $planta = $user->planta;

        $queryDel = "DELETE FROM reforig_logistica.recibo_captura
                    WHERE
                    recibo_captura.planta='$planta'
                    AND recibo_captura.id='$reciboFolio->id'";

        DB::delete($queryDel);

//        Subir archivo al server

        $query = 'LOAD DATA LOCAL INFILE "'.$file.'"
                  INTO TABLE reforig_logistica.recibo_captura
                  FIELDS TERMINATED BY ","
                  LINES TERMINATED BY "\r\n"
                  IGNORE 1 LINES
                    (
                    @planta,
                    @material,
                    @cantidad,
                    @bin,
                    )
                    SET
                    material = UPPER(TRIM(@material)),
                    planta = "'.$planta.'",
                    cantidad = @cantidad,
                    bin=UPPER(TRIM(@binfinal))
                  ';

            $query = "UPDATE reforig_logistica.recibo_facturas
            LEFT JOIN reforig_logistica.recibo_captura ON recibo_captura.material = recibo_facturas.material
            SET
            recibo_facturas.bin=recibo_captura.bin
            WHERE
            recibo_facturas.id='$reciboFolio->id'
            AND recibo_captura.id='$reciboFolio->id'
            ";

        DB::statement($query);

        $query2 = "UPDATE reforig_logistica.recibo_facturas
                    SET
                    recibo_facturas.var = 0
                    WHERE
                    recibo_facturas.status = 'LIBERAR'
                    AND recibo_facturas.id='$reciboFolio->id'";

        DB::statement($query2);

        $query3 = "UPDATE reforig_logistica.recibo_facturas
                    SET
                    recibo_facturas.var = recibo_facturas.cantidad
                    WHERE
                    recibo_facturas.status = 'NO EN RECIBO'
                    AND recibo_facturas.id='$reciboFolio->id'
                    ";

        DB::statement($query3);


        // RUTINA ACTUALIZA 103 EN FUNCION A LA CAPTURA


        $query4 = "
            SELECT
            recibo_facturas.factura,
            recibo_facturas.material,
            recibo_facturas.cantidad,
            recibo_facturas.status
            FROM
            reforig_logistica.recibo_facturas
            WHERE
            recibo_facturas.id='$reciboFolio->id'
            ORDER BY
            recibo_facturas.material,
            recibo_facturas.cantidad
            ";

        DB::statement($query4);

    }

}
