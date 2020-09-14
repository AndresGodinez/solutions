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
        $countries = Country::all()->sortBy('name');

        return response()->json($countries);
    }

    public function regiones(Request $request)
    {
        $regiones = Region::where('id_contry', $request->get('country'))
            ->orderBy('name')
            ->get();
        return response()->json($regiones);
    }
}
