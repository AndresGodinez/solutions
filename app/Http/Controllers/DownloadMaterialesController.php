<?php

namespace App\Http\Controllers;

use App\Exports\SimpleExport;
use App\Sustituto;
use App\Utils\MyUtils;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadMaterialesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return BinaryFileResponse
     */
    public function __invoke(Request $request)
    {
        $name = 'Sustitutos';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        $head = [
            'Material',
            'Sustituto',
            'Relacion'
        ];

        $sustitutos = Sustituto::all()->take(10);

        $data = $this->getDataSustitutos($sustitutos);

        return Excel::download(new SimpleExport($head, $data), $fileName);
    }

    private function getDataSustitutos(Collection $sustitutos)
    {
        $data = [];

        foreach ($sustitutos as $sustituto) {
            $data[] = $this->getSingleSustituto($sustituto);
        }
        return $data;
    }

    private function getSingleSustituto(Sustituto $sustituto)
    {
        return [
            $sustituto->material,
            $sustituto->sustituto,
            $sustituto->rel,
        ];
    }
}
