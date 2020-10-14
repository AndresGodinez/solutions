<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SurtimientoConcentrado extends Model
{
    protected $connection = 'logistica';

    protected $table = 'surtimiento_concentrado';

    public static function eliminacionPorPlanta(string $planta)
    {
        $query = "DELETE FROM reforig_logistica.surtimiento_concentrado
            WHERE
                surtimiento_concentrado.planta='$planta'";
        DB::statement($query);
    }

    public static function insercionConcentrado(string $planta)
    {

        $query = "INSERT INTO reforig_logistica.surtimiento_concentrado
                SELECT
                    surtimiento.planta AS planta,
                    surtimiento.material AS material,
                    UPPER(inventario_lx02.descripcion) AS descripcion,
                    inventario_lx02.sloc AS sloc,
                    inventario_lx02.nivel AS nivel,
                    inventario_lx02.bin AS bin,
                    inventario_lx02.stock AS stock,
                    Sum(surtimiento.surtir) AS surtir,
                    0 AS surtir2,
                    inventario_lx02.orden AS orden
                FROM
                    reforig_logistica.inventario_lx02
                INNER JOIN reforig_logistica.surtimiento ON surtimiento.material = inventario_lx02.material
                AND surtimiento.planta = inventario_lx02.planta
                WHERE
                    surtimiento.surtir > 0
                AND inventario_lx02.orden > 0
                AND inventario_lx02.planta = ' $planta '
                GROUP BY
                    surtimiento.planta,
                    surtimiento.material,
                    inventario_lx02.nivel,
                    inventario_lx02.bin,
                    inventario_lx02.sloc,
                    inventario_lx02.stock
                HAVING
                    Sum(surtimiento.surtir) > 0
                ORDER BY
                    surtimiento.material,
                    inventario_lx02.orden,
                    inventario_lx02.bin";

        DB::statement($query);
    }

    public static function binesParaPicking(string $planta)
    {
        // UPDATE A LOS BINES PARA PICKING
        $data = DB::connection('logistica')
            ->table('surtimiento_concentrado')
            ->where('planta', $planta)
            ->select(
                'planta',
                'material',
                'descripcion',
                'sloc',
                'nivel',
                'surtir',
                'surtir2',
                'orden'
            )
            ->orderBy('material')
            ->orderBy('orden')
            ->orderBy('bin')
            ->get();

        $material='';

        foreach ($data as $datum) {
            if($datum->material != $material){
                $surtir2 = $datum->surtir;
            }
            if ($surtir2 > 0){
                if ($datum->stock > $surtir2){
                    $material = $datum->material;
                    $bin = $datum->bin;
                    $sloc = $datum->sloc;
                    $query = " UPDATE reforig_logistica.surtimiento_concentrado
                        SET surtimiento_concentrado.surtir2 = $surtir2
                        WHERE surtimiento_concentrado.material = '$material'
                            AND
                              surtimiento_concentrado.bin = '$bin'
                            AND
                              surtimiento_concentrado.planta='$planta'
                          AND
                              surtimiento_concentrado.sloc='$sloc'";
                    DB::statement($query);
                    $surtir2 = 0;
                }
                else{
                    $material = $datum->material;
                    $bin = $datum->bin;
                    $sloc = $datum->sloc;
                    $stock = $datum->toc;

                    $query2 = "UPDATE reforig_logistica.surtimiento_concentrado
                    SET surtimiento_concentrado.surtir2=$stock
                    WHERE surtimiento_concentrado.material = '$material'
                      AND surtimiento_concentrado.bin = '$bin'
                      AND surtimiento_concentrado.planta='$planta'
                      AND surtimiento_concentrado.sloc='$sloc'";

                    DB::statement($query2);

                    $surtir2 = $surtir2 - $stock;

                }
            }
            else {
                $material = $datum->material;
                $bin = $datum->bin;
                $sloc = $datum->sloc;
                $query3 = " UPDATE reforig_logistica.surtimiento_concentrado
                    SET surtimiento_concentrado.surtir2=0
                    WHERE surtimiento_concentrado.material = '$material'
                      AND surtimiento_concentrado.bin = '$bin'
                      AND surtimiento_concentrado.planta='$planta'
                      AND surtimiento_concentrado.sloc='$sloc'";

                DB::statement($query3);

            }
        }

    // BORRA LAS LINEAS INNECESARIAS DE SURTIMIENTO
        SurtimientoConcentrado::where('surtir2', '=', 0)
            ->where('planta', $planta)->delete();
    }

}
