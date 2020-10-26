<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImpreseionEtiquetasConsultaRequest;
use App\MaterialABC;
use Illuminate\Http\Request;

class ImpresionEtiquetasController extends Controller
{
    public function index()
    {
        return view('ImpresionEtiquetas/index');
    }

    public function consulta(ImpreseionEtiquetasConsultaRequest $request)
    {
        $material = MaterialABC::where('material', $request->get('material'))->first();

        dd([
            'mate' => $material
        ]);
    }
}
