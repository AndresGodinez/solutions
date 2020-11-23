<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReciboMaterialesDescriptionRequest;
use App\Material;
use App\MaterialABC;
use App\MaterialBin;
use App\ReciboFolio;
use App\ReciboFolioDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function compact;
use function is_null;
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

    public function description(ReciboMaterialesDescriptionRequest $request, ReciboFolio $reciboFolio)
    {
        $materialAbc = MaterialABC::where('material', $request->get('material'))->first();
        if (!is_null($materialAbc)) {
            $bin = $materialAbc->lx02->bin ?? $materialAbc->reciboBin->bin;
            $materialBin = MaterialBin::where('bin', $bin)
                ->where('planta', $request->user()->planta)
                ->first();
        } else {
            $bin = '';
            $materialBin = MaterialBin::make([
                'planta' => $request->user()->planta,
                'bin' => '',
                'caja' => 1
            ]);
        }

        return view('ReciboMateriales.revision-conteo', compact(
            'materialAbc',
            'materialBin',
            'reciboFolio'
        ));
    }

    public function show(ReciboFolio $reciboFolio)
    {
        return view('ReciboMateriales/show', compact('reciboFolio'));
    }

    public function prePrint(Request $request, ReciboFolio $reciboFolio)
    {
        $quantity = $request->get('quantity_to_print');
        $materialBD = Material::where('part_number', $request->get('material'))->first();

        ReciboFolioDetalle::create([
            'id' => $reciboFolio->id,
            'planta' => $request->user()->planta,
            'material' => $request->get('material'),
            'bin' => $request->get('bin'),
            'caja' => $request->get('caja'),
            'cantidad' => $quantity,
            'label' => $request->get('label'),
            'hora' => Carbon::now()
        ]);

        $cantidad = $quantity;
        $material = $materialBD->part_number;
        $descripcion = $materialBD->part_description;
        $fecha = Carbon::now()->format('d-m-Y');
        $etiqueta = '';

        return view('ReciboMateriales.decision', compact(
            'cantidad',
            'material',
            'descripcion',
            'fecha',
            'etiqueta',
            'reciboFolio'
        ));


    }

    public function print2(Request $request)
    {
        $cantidad = $request->get('cantidad');
        $material = $request->get('material');
        $descripcion = $request->get('descripcion');
        $fecha = $request->get('fecha');
        $etiqueta = '';
        $id = $request->get('recibo_folio_id');

        return view('print3', compact(
            'cantidad',
            'material',
            'descripcion',
            'fecha',
            'etiqueta',
            'id'
        ));
    }

    public function print(ReciboFolio $reciboFolio)
    {
        $material = $reciboFolio->material;
        $cantidad = 3;
        $id = $reciboFolio->id;
        $materialBD = Material::where('part_number', $material)->first();

        $descripcion = substr(strtoupper($materialBD->part_description), 0, 20);
        $etiqueta = '';

        $fecha = Carbon::now()->format('d-m-y');

    }

    public function decision(Request $request)
    {
        dd($request->all());
        $folio = $request->get('recibo_folio_id');
        $reciboFolio = ReciboFolio::find($folio);
        $cantidad = $request->get('cantidad');
        $material = $request->get('material');
        $descripcion = $request->get('descripcion');
        $fecha = $request->get('fecha');
        $etiqueta = $request->get('etiqueta');

        return view('ReciboMateriales.desicion', compact(''));

    }

}
