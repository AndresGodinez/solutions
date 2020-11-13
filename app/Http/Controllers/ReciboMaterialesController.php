<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReciboMaterialesDescriptionRequest;
use App\MaterialABC;
use App\MaterialBin;
use App\ReciboFolio;
use Illuminate\Http\Request;
use function compact;
use function view;

class ReciboMaterialesController extends Controller
{
    public function index()
    {
        $reciboFolios = ReciboFolio::orderByDesc('id')
            ->where('status', 'ABIERTO')
            ->where('fecha', '>=', '2017-01-01')
            ->paginate();

        return view('ReciboMateriales/index', compact('reciboFolios'));
    }

    public function create()
    {
        dd('create');
    }

    public function description(ReciboMaterialesDescriptionRequest $request)
    {
        $materialAbc = MaterialABC::where('material', $request->get('material'))->first();
        $bin = $materialAbc->lx02->bin ?? $materialAbc->reciboBin->bin;
        $materialBin = MaterialBin::where('bin',$bin)
            ->where('planta', $request->user()->planta)
            ->first();

        return view('ReciboMateriales.revision-conteo', compact(
            'materialAbc',
            'materialBin'
        ));
    }

    public function show(ReciboFolio $reciboFolio )
    {
        return view('ReciboMateriales/show', compact('reciboFolio'));
    }

    public function cargaFactura()
    {
        dd('carga factura');
    }
}
