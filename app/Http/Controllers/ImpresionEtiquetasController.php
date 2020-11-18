<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImpreseionEtiquetasConsultaRequest;
use App\Http\Requests\ImpresionEtiquetasPrintRequest;
use App\MaterialABC;
use Illuminate\Support\Facades\Auth;
use function compact;
use function is_null;
use function view;

class ImpresionEtiquetasController extends Controller
{
    public function index()
    {
        return view('ImpresionEtiquetas/index');
    }

    public function consulta(ImpreseionEtiquetasConsultaRequest $request)
    {
        $material = MaterialABC::where('material', $request->get('material'))->first();

        if(is_null($material)){
            $material = MaterialABC::make([
                'material' => $request->get('material'),
                'sustituto' => '',
                'descripcion' => ''
            ]);
        }

        return view('ImpresionEtiquetas.consulta', compact('material'));
    }

    public function print(ImpresionEtiquetasPrintRequest $request)
    {
        $planta = Auth::user()->planta;
        $cantidad = $request->get('quantity');
        $materialAbc = MaterialABC::where('material', $request->get('material-to-print'))->first();
        if (is_null($materialAbc)){
            $materialAbc = MaterialABC::make([
                'material' => $request->get('material'),
                'sustituto' => '',
                'descripcion' => ''
            ]);
        }
        $material = $materialAbc->material;
        $piezas = $request->get('pieces');

        if ($materialAbc->descripcion == ''){
            $materialAbc->descripcion = 'No contiene descripcion';
        }

        $descripcion = substr(strtoupper($materialAbc->descripcion), 0, 20).' '.$piezas.'PIEZAS';

        $etiqueta = '';

        $fecha = date('d-m-Y H:i:s');

        return view('ImpresionEtiquetas.print', compact(
            'material',
            'cantidad',
            'piezas',
            'planta',
            'descripcion',
            'etiqueta',
            'fecha'
        ));
    }
}
