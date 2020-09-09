<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Supoort\Facades\Validator;

class StockController extends Controller
{
    public function index(Request $request)
    {
        return view('Stock.index', compact(null));
    }

    public function inicial(Request $request)
    {
        return view('Stock.inicial', compact(null));
    }

    public function final(Request $request)
    {
        return view('Stock.final', compact(null));
    }

    public function descagainicial(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=REPORTE STOCK INICIAL.xls');
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
        <table border="1" cellpadding="2" cellspacing="0" width="100%">
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
    <?php
    }


    public function datoinicial(Request $request)
    {

        return datatables()->of(Stock::query()->selectRaw('
        stock_inicial.id,
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
            // ->limit(2)
            ->get())->toJson();
    }

    public function detalleinicial(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
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
    }
}
