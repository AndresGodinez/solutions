<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialesController extends Controller
{
    public function search()
    {
        return view('Materiales/search');
    }

    public function consulta(Request $request)
    {
        $material = Material::where('part_number', $request->get('ipt_material'))->first();

            dd([
                'mate' => $material
            ]);

    }
}
