<?php

namespace App\Http\Controllers;

use App\Stock;
use Illuminate\Http\Request;

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

    public function cargainicial(Request $request)
    {
        return view('Stock.cargainicial', compact(null));
    }
    public function cargainicialapi(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        return $_FILES;
    }

    public function conclusioninicial(Request $request)
    {
        return view('Stock.conclusioninicial', compact(null));
    }

    public function conclusioninicial_dt(Request $request)
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

    public function conclusioninicial_detalle(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        return view('Stock.conclusioninicial_detalle', compact(null));
    }

    public function conclusioninicial_update(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');

        return view('Stock.inicial', compact(null));
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
        <table rder="1" cellpadding="2" cellspacing="0" width="100%">
            <tr>
                <th>NUM PARTE</th>
                <th class="text-center">DESCRIPCION</th>
                <th class="text-center">MODELO</th>
                <th class="text-center">TIPO MATERIAL</th>
                <th class="text-center">CATEGORIA</th>
                <th class="text-center">USUARIO</th>
                <th class="text-center">FECHA CARGA</th>
                <th class="text-center">DIAS PENDIENTE</th>
            </tr>
            <?php
            foreach ($orders as $k => $v) {
            ?>
                <tr>
                    <td><?= $v->no_parte ?></td>
                    <td><?= $v->descripcion ?></td>
                    <td><?= $v->modelo ?></td>
                    <td><?= $v->tipo_material ?></td>
                    <td><?= $v->categoria ?></td>
                    <td><?= $v->nombre ?></td>
                    <td><?= $v->fecha_carga ?></td>
                    <td><?= $v->fecha_usuario ?></td>
                </tr>
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
            // ->limit(10)
            ->get())->toJson();
    }
}
