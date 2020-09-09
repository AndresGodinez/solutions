<?php

            use App\Stock;

            $orders = Stock::query()
            ->selectRaw('stock_inicial.id,
            stock_inicial.no_parte,
            stock_inicial.descripcion,
            stock_inicial.tipo_material,
            stock_inicial.precio_usd,
            stock_inicial.sir_anual,
            stock_inicial.proyecto,
            stock_inicial.categoria,
            stock_inicial.proveedor,
            stock_inicial.ots,
            stock_inicial.modelo,
            stock_inicial.produccion_inicial,
            stock_inicial.fecha_carga,
            datediff(curdate(),fecha_carga) as fecha_usuario,
            usuarios.nombre')
            ->from('stock_inicial')
            ->leftJoin('usuarios', 'stock_inicial.usuario', '=', 'usuarios.username')
            ->whereRaw('stock_inicial.activo=1')
            ->get();
?>
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
        <table rder="1" cellpadding="2" cellspacing="0" width="100%">
            <div class="col-6">
                <fieldset class="form-group">
                    <th>NUM PARTE</th>
                    <th class="text-center">DESCRIPCION</th>
                    <th class="text-center">MODELO</th>
                    <th class="text-center">TIPO MATERIAL</th>
                    <th class="text-center">CATEGORIA</th>
                    <th class="text-center">USUARIO</th>
                    <th class="text-center">FECHA CARGA</th>
                    <th class="text-center">DIAS PENDIENTE</th>
                </fieldset>
            </div>
            <?php
            foreach ($orders as $k => $v) {
            ?>
                <div class="col-6">
                    <fieldset class="form-group">
                        <?= $v->no_parte ?>
                        <?= $v->descripcion ?>
                        <?= $v->modelo ?>
                        <?= $v->tipo_material ?>
                        <?= $v->categoria ?>
                        <?= $v->nombre ?>
                        <?= $v->fecha_carga ?>
                        <?= $v->fecha_usuario ?>
                    </fieldset>
                </div>
            <?php
            } ?>

        </table>