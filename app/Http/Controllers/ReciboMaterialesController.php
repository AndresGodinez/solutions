<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReciboMaterialesDescriptionRequest;
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

    public function description(ReciboMaterialesDescriptionRequest $request)
    {
        $materialAbc = MaterialABC::where('material', $request->get('material'))->first();
        if (!is_null($materialAbc)){
            $bin = $materialAbc->lx02->bin ?? $materialAbc->reciboBin->bin;
            $materialBin = MaterialBin::where('bin',$bin)
                ->where('planta', $request->user()->planta)
                ->first();
        }
        else{
            $bin = '';
            $materialBin = MaterialBin::make([
                'planta' => $request->user()->planta,
                'bin' => '',
                'caja' => 1
            ]);
        }

        return view('ReciboMateriales.revision-conteo', compact(
            'materialAbc',
            'materialBin'
        ));
    }

    public function show(ReciboFolio $reciboFolio )
    {
        return view('ReciboMateriales/show', compact('reciboFolio'));
    }


    public function prePrint(Request $request)
    {
        dd($request->all());
//        TODO save information
        ReciboFolioDetalle::create([
            'planta' => $request->user()->planta,
            'material' => $request->get('material'),
            'bin' => $request->get('bin'),
            'caja' => $request->get('caja'),
            'cantidad' => $request->get('quantity_to_print'),
            'label' => $request->get('label'),
            'hora' => Carbon::now()
        ]);
//        INSERT INTO
//reforig_logistica.recibo_folios_detalle
//SET
//id='$id' ,
//planta='$planta' ,
//material='$material' ,
//bin='$bin' ,
//caja='$caja',
//cantidad=$cantidad ,
//label='$label',
//hora= now()
//") or die(mysql_error());

    }

}
