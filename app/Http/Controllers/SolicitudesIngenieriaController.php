<?php

namespace App\Http\Controllers;

use App\LineaProducto;
use App\ModoFalla;
use App\TipoInformacion;
use Illuminate\Http\Request;
use function compact;
use function view;

class SolicitudesIngenieriaController extends Controller
{
    public function create()
    {
        $modosFalla = ModoFalla::get();
        $lineasProducto = LineaProducto::get();
        $tiposInformacion = TipoInformacion::get();

        return view('SolicitudesIngenieria.create',
            compact('modosFalla', 'lineasProducto', 'tiposInformacion')
        );
    }
}
