<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use Illuminate\Http\Request;
use function response;

class CountriesController extends Controller
{
    public function list()
    {
        return response()->json(Country::get());
    }

    public function regiones(Request $request)
    {
        $regiones = Region::where('id_contry', $request->get('country'))
            ->get();
        return response()->json($regiones);
    }
}
