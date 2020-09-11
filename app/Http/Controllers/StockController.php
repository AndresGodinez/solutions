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


        // $stock_id = @$_POST['stock_id'];
        // $stock = @$_SESSION['stock'];
        // $username = @$_SESSION['username'];
        // $comentario = $_POST['comentario'];
        // $conclusion = $_POST['conclusion'];
        // $tipo_conclusion = $_POST['tipo_conclusion'];
        // $no_sust = $_POST['no_sust'];
        // $po = $_POST['po'];

        // $usuario = @$_SESSION['usuario'];

        // if ($tipo_conclusion == '1') {
        //     $tipo_conclusion = 'Pieza Activa Por 3 Meses';
        // } elseif ($tipo_conclusion == '2') {
        //     $tipo_conclusion = 'Sustituto Activo Disponible (Con Proveedor)';
        // } elseif ($tipo_conclusion == '3') {
        //     $tipo_conclusion = 'Stock Suficiente (Inv Disponible)';
        // } elseif ($tipo_conclusion == '4') {
        //     $tipo_conclusion = 'Pieza con SIR 0  (Sin Consumo)';
        // } elseif ($tipo_conclusion == '5') {
        //     $tipo_conclusion = 'Sin Espacio En Almacén/MOQ Grande (Compra No Rentable)';
        // } elseif ($tipo_conclusion == '6') {
        //     $tipo_conclusion = 'Error En El Número De Parte';
        // } elseif ($tipo_conclusion == '7') {
        //     $tipo_conclusion = 'Otro';
        // }

        // $row = Stock::table('stock_final')
        //     ->where('id', $stock_id)
        //     ->update(
        //         [
        //             'fecha_finalizacion' => 'CURDATE()',
        //             'activo' => 0,
        //             'conclusion' => $conclusion,
        //             'comentarios' => $comentario,
        //             'usuario_materiales' => $username,
        //             'po' => $po,
        //             'tipo_conclusion' => $tipo_conclusion,
        //             'no_sust' => $no_sust
        //         ]
        //     );
        // $row = Stock::query()
        //     ->selectRaw('usuarios.mail, stock_final.no_parte')
        //     ->from('usuarios')
        //     ->leftJoin('stock_final', 'usuarios.username', '=', 'stock_final.usuario')
        //     ->whereRaw('id=' . $stock_id)
        //     ->get();

        // $row = $row[0];
        // $correo = $row['mail'];
        // $no_parte = $row['no_parte'];


        // if ($conclusion == 'RECHAZADA') {

        //     $email_message = "
        //     <html>
        //     <head>
        //     <title>E-Mail HTML</title>
        //     </head>
        //     <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />

        //     <style>

        // body, P.msoNormal, LI.msoNormal
        // {
        // background-position: top;
        // margin-left:  1em;
        // margin-top: 1em;
        // font-family: 'Arial';
        // font-size:   9pt;
        // color:    '000000';
        // }

        // table
        // {
        // font-family: 'Arial';
        // font-size:   9pt;

        // }
        // </style>

        //     <body>
        //     <p></p>
        //     <p>Por este medio te informamos que se ha rechazado la solicitud del n&uacute;mero de parte " . $no_parte . " de stock final.<br> </p>
        //     <p></p>
        //     <p></p>

        // ";


        //     $to = $correo;
        //     $subject = 'Rechazo de Stock Final No. Parte ' . $no_parte;
        //     $type = "Content-type: text/html\r\n";
        //     $headers = "MIME-Version: 1.0 \r\n";
        //     $headers = $headers . "Content-type: text/html;charset=iso-8859-1\r\n";
        //     $headers = $headers . "From: Whirlpool Service<no-responder@whirlpool.com>\r\n";


        //     $mail_sent = @mail($to, $subject, $email_message, $headers);
        // }

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


        // SELECT
        // stock_inicial.id,
        // stock_inicial.no_parte,
        // stock_inicial.descripcion,
        // stock_inicial.tipo_material,
        // stock_inicial.precio_usd,
        // stock_inicial.sir_anual,
        // stock_inicial.proyecto,
        // stock_inicial.categoria,
        // stock_inicial.proveedor,
        // stock_inicial.ots,
        // stock_inicial.modelo,
        // stock_inicial.produccion_inicial,
        // stock_inicial.fecha_carga,
        // datediff(curdate(),fecha_carga) as fecha_usuario,
        // usuarios.nombre
        // 			FROM stock_inicial
        // 			left join usuarios ON stock_inicial.usuario = usuarios.username
        // 			WHERE stock_inicial.activo=1
    }
}
