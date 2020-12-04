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


}
