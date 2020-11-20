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

//        DELETE FROM reforig_logistica.recibo_facturas
//		WHERE
//		recibo_facturas.planta='$planta'
//        AND recibo_facturas.id='$reciboFolio->id
        $query = 'LOAD DATA LOCAL INFILE "'.$file.'"
                 INTO TABLE reforig_logistica.recibo_facturas
                 FIELDS TERMINATED BY ","
                 LINES TERMINATED BY "\r\n"
                 IGNORE 1 LINES
                (@factura,
                @po,
                @material,
                @cantidad
                )

                SET
                factura=TRIM(@factura),
                po=TRIM(@po),
                material=TRIM(@material),
                cantidad=replace(@cantidad,",","")
                ';

        $sql = "UPDATE reforig_logistica.recibo_facturas
SET
planta='$planta',
id='$id'
WHERE
planta IS NULL";

        $sql2 = "DELETE
FROM
reforig_logistica.recibo_folios_detalle
WHERE
recibo_folios_detalle.status='NO EN RECIBO'
AND recibo_folios_detalle.id='$id'";

        $sql3 = "
DELETE
FROM
reforig_logistica.recibo_facturas
WHERE
recibo_facturas.status='NO EN FACTURA'
AND recibo_facturas.id='$id'
";

        $sql4 = "
UPDATE
reforig_logistica.recibo_folios_detalle
SET
recibo_folios_detalle.status='HOLD'
WHERE
id='$id'
";

        $sql5 = "
DROP TABLE IF EXISTS
xrecibo
";

        $sql6 = "
CREATE TEMPORARY TABLE
xrecibo
SELECT
recibo_folios_detalle.planta,
recibo_folios_detalle.id,
recibo_folios_detalle.material,
Sum(recibo_folios_detalle.cantidad) AS cantidad
FROM
reforig_logistica.recibo_folios_detalle
WHERE
id='$id'
GROUP BY
recibo_folios_detalle.id,
recibo_folios_detalle.planta,
recibo_folios_detalle.material
";

        $sql7 = "
ALTER TABLE xrecibo
ADD INDEX
planta_id_material(planta,id,material)
";
        $sql8 = "
ALTER TABLE xrecibo
ADD INDEX
material(material)
";
        $sql9 = "
DROP TABLE IF EXISTS
xfact
";

        $sql10 = "
CREATE TEMPORARY TABLE
xfact
SELECT
recibo_facturas.planta,
recibo_facturas.id,
recibo_facturas.material,
SUM(recibo_facturas.cantidad) AS fact,
IFNULL(xrecibo.cantidad,0) AS cantidad,
IF(xrecibo.cantidad=SUM(recibo_facturas.cantidad),'LIBERAR',
IF(xrecibo.cantidad>SUM(recibo_facturas.cantidad),'SOBRANTE','FALTANTE')) AS status
FROM
reforig_logistica.recibo_facturas
LEFT JOIN xrecibo ON xrecibo.material = recibo_facturas.material
WHERE
recibo_facturas.id='$id'
GROUP BY
recibo_facturas.id,
recibo_facturas.planta,
recibo_facturas.material
";
        $sql11 = "
UPDATE
reforig_logistica.recibo_folios_detalle
LEFT JOIN xfact ON xfact.material = recibo_folios_detalle.material
AND recibo_folios_detalle.id='$id'
AND xfact.id='$id'
SET
recibo_folios_detalle.status=IFNULL(xfact.status,'FALTANTE')
WHERE
recibo_folios_detalle.id='$id'
";

        $sql12 = "
UPDATE
reforig_logistica.recibo_facturas
LEFT JOIN xfact ON xfact.material = recibo_facturas.material
AND recibo_facturas.id='$id'
AND xfact.id='$id'
SET
recibo_facturas.status=IFNULL(xfact.status,'FALTANTE')
";

        $sql13 = "
UPDATE
reforig_logistica.recibo_facturas
LEFT JOIN reforig_logistica.recibo_folios_detalle ON recibo_folios_detalle.material = recibo_facturas.material
AND recibo_folios_detalle.id='$id'
AND recibo_facturas.id='$id'
SET
recibo_facturas.bin=recibo_folios_detalle.bin
WHERE
recibo_facturas.id='$id'
";

        // si fact o si recibido y viceversa
$sql14 = "
UPDATE
reforig_logistica.recibo_facturas
LEFT JOIN
xrecibo ON recibo_facturas.material=xrecibo.material
SET
recibo_facturas.status='NO EN RECIBO'
WHERE
xrecibo.material IS NULL
AND recibo_facturas.id='$id'
";

$sql15 = "
INSERT INTO
reforig_logistica.recibo_folios_detalle
(id,planta,material,cantidad,bin,caja,hora,label,status)

SELECT
'$id' AS id,
'$planta' AS planta,
xfact.material,
xfact.fact,
'' AS bin,
'99' AS caja,
NOW() AS hora,
'NO' AS label,
'NO EN RECIBO' AS status
FROM
xfact
LEFT JOIN
xrecibo ON xfact.material=xrecibo.material
WHERE
xrecibo.material IS NULL
";

//SI RECIBIDO NO FACTURADO
$sql16 = "
UPDATE
reforig_logistica.recibo_folios_detalle
LEFT JOIN
xfact ON recibo_folios_detalle.material=xfact.material
SET
recibo_folios_detalle.status='NO EN FACTURA'
WHERE
xfact.material IS NULL
AND recibo_folios_detalle.id='$id'
";

$sql17 = "
INSERT INTO
reforig_logistica.recibo_facturas
(planta,id,factura,material,cantidad,status)

SELECT
'$planta' AS planta,
'$id' AS id,
'NO EN FACTURA' AS factura,
xrecibo.material,
xrecibo.cantidad,
'NO EN FACTURA' AS status
FROM
xrecibo
LEFT JOIN
xfact ON xrecibo.material=xfact.material
WHERE
xfact.material IS NULL
";

$sql18 = "
UPDATE
reforig_logistica.recibo_facturas
SET
recibo_facturas.103=recibo_facturas.cantidad
WHERE
recibo_facturas.status='LIBERAR'
";
$sql19= "
UPDATE
reforig_logistica.recibo_facturas
SET
recibo_facturas.103=0
WHERE
recibo_facturas.status IN ('NO EN RECIBO','NO EN FACTURA')
";

    }

    public function processCaptura(ReciboFolio $reciboFolio, Request $request)
    {
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

//TODO refactor query
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

//        TODO by each data
        $update1 = "UPDATE reforig_logistica.recibo_facturas
            SET
            recibo_facturas.var = $conteo
            WHERE
            recibo_facturas.material = '$material'
            AND recibo_facturas.factura = '$factura'
            AND recibo_facturas.id= '$id'";
    }

}
