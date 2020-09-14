<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class FechaPromesaController extends Controller
{
    public function search()
    {
        return view('FechaPromesa.busqueda');
    }

    public function consulta(Request $request)
    {
        dd($request->all());
    }
}
