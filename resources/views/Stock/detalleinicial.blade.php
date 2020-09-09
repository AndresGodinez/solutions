<?php 
            use App\Stock;
            
            $row = Stock::query()
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
            ->whereRaw('stock_inicial.id=' . $_POST['id'])
            ->get();

        $row = $row[0];

    ?>
        <div class="row">
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">No Parte:</label>
                    <input class="form-control" name="parte" type="text" readonly id="parte" size="40" value="<?php echo ($row['no_parte']); ?>">
                </fieldset>
            </div>
            <?php if ($row['no_parte_original'] != '') { ?>
                <div class="col-6">
                    <fieldset class="form-group">
                        <label for="basicInput">No. Parte Original (Se cambio por sustituto):</label>
                        <input class="form-control" type="text" maxlength="20" size='40' id="po" readonly name="po" style="text-transform:uppercase" value='<?php echo ($row['no_parte_original']); ?>' />
                    </fieldset>
                </div>
            <?php } ?>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Descripción:</label>
                    <input class="form-control" name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo ($row['descripcion']); ?>">
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Tipo Material:</label>
                    <input class="form-control" name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo ($row['tipo_material']); ?>">
                </fieldset>
            </div>



            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Precio USD:</label>
                    <input class="form-control" name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo ($row['precio_usd']); ?>">
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">SIR Anual:</label>
                    <input class="form-control" name='username' type='text' readonly id='username' size="40" value='<?php echo ($row['sir_anual']); ?>'>
                </fieldset>
            </div>


            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Proyecto:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['proyecto']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Categor&iacute;a:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['categoria']); ?>'>
                </fieldset>

            </div>

            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Proveedor:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['proveedor']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">OTS:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['ots']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <!-- Producci&oacute;n Inicial: -->
                    <label for="basicInput">Cantidad de Piezas por SKU:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['produccion_inicial']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">A&ntilde;os de Garant&iacute;a:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['garantia']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">V&oacute;lumen de Venta Anual</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['vol_vta_anual']); ?>'>
                </fieldset>
            </div>

            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Usuario Materiales:</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['nombre']); ?>'>
                </fieldset>
            </div>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Conclusi&oacute;n</label>
                    <input class="form-control" name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo ($row['conclusion']); ?>'>
                </fieldset>
            </div>
            <?if($row['conclusion']=='PO COLOCADA'){?>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">PO:</label>
                    <input class="form-control" type="text" maxlength="20" id="po" readonly name="po" style="text-transform:uppercase" value='<?php echo ($row['po']); ?>' />

                </fieldset>
            </div>
            <?}?>
            <?if($row['conclusion']=='RECHAZADA'){?>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Tipo Conclusion:</label>
                    <input class="form-control" type="text" size='40' maxlength="0" id="po" readonly name="po" style="text-transform:uppercase" value='<?php echo ($row['tipo_conclusion']); ?>' />
                </fieldset>
            </div>
            <?}?>
            <div class="col-6">
                <fieldset class="form-group">
                    <label for="basicInput">Comentarios Ingeniero:</label>
                    <textarea class="form-control" name="comentario" readonly id="comentario" rows="4" cols="41" style="text-transform:uppercase"><?php echo ($row['comentario']); ?></textarea class="form-control" > 
                </fieldset>
            </div>
                <div class="col-6">
                <fieldset class="form-group">
                <label for="basicInput">Comentarios</label>
                    <textarea class="form-control"  name="comentario" readonly id="comentario" rows="4" cols="41" style="text-transform:uppercase"><?php echo ($row['comentarios']); ?></textarea class="form-control" > 
                </fieldset>
            </div>




    <?php