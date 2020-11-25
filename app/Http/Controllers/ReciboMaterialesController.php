<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReciboMaterialesDescriptionRequest;
use App\Material;
use App\MaterialABC;
use App\MaterialBin;
use App\MaterialesVendorLeadTime;
use App\ReciboFolio;
use App\ReciboFolioDetalle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function compact;
use function dd;
use function is_null;
use function redirect;
use function route;
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
        $date = Carbon::now()->format('d/m/Y');
        $proveedores = MaterialesVendorLeadTime::orderBy('nombre', 'ASC')->where('activo', 'SI')->get();
        return view('ReciboMateriales.create', compact('date', 'proveedores'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $planta = $user->planta;
        $query = "SELECT IFNULL(MAX(recibo_folios.id)+1,1) AS id
                    FROM reforig_logistica.recibo_folios
                    WHERE planta='$planta'";
        $data = DB::select($query);

        $id = $data[0]->id;

        ReciboFolio::create([
            'id' => $id,
            'fecha' => Carbon::now(),
            'folio_caseta' => $request->get('caseta'),
            'vendor' => $request->get('proveedor'),
            'planta' => $planta,
            'status' => 'ABIERTO'
        ]);
        return redirect(route('recibo-materiales.index'));
    }

    public function description(ReciboMaterialesDescriptionRequest $request, ReciboFolio $reciboFolio)
    {
        $materialAbc = MaterialABC::where('material', $request->get('material'))->first();
        if (!is_null($materialAbc)) {

            if (!!$bin = $materialAbc->lx02 || $materialAbc->reciboBin) {
                $bin = $materialAbc->lx02->bin ?? $materialAbc->reciboBin->bin;
                $materialBin = MaterialBin::where('bin', $bin)
                    ->where('planta', $request->user()->planta)
                    ->first();
            }

            else {
                $bin = '';
                $materialBin = MaterialBin::make([
                    'planta' => $request->user()->planta,
                    'bin' => '',
                    'caja' => 1
                ]);
            }

        }
        else {
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
            'reciboFolio',
            'bin'
        ));
    }

    public function show(ReciboFolio $reciboFolio)
    {
        return view('ReciboMateriales/show', compact('reciboFolio'));
    }

    public function prePrint(Request $request, ReciboFolio $reciboFolio)
    {
        $quantity = $request->get('quantity_to_print');
        $materialBD = MaterialABC::where('material', $request->get('material'))->first();

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
        $material = $materialBD->material;
        $descripcion = $materialBD->descripcion;
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

        return view('ReciboMateriales.print3', compact(
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
