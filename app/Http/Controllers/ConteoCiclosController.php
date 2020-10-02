<?php

namespace App\Http\Controllers;

use App\CiclosTemp;
use App\Exports\HojasConteoExport;
use App\Http\Requests\UploadHojasConteoRequest;
use App\Jobs\ExecuteByConnection;
use App\Jobs\UpdateCiclicosJob;
use App\Utils\MyUtils;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use function ceil;
use function compact;
use function view;

class ConteoCiclosController extends Controller
{
    public function index(Request $request)
    {
        return view('ConteoCiclos.index');
    }

    public function processHojasConteoCiclos(UploadHojasConteoRequest $request)
    {
        $user = $request->user();

        $planta = $user->planta;

        CiclosTemp::deletePlanta($user->planta);

        $file = $request->file('hoja_conteo_ciclos_file');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $connection = 'logistica';

        $query = 'LOAD DATA LOCAL INFILE "'.$nameFile.'"
            INTO TABLE ciclicos_temp
            FIELDS TERMINATED BY ","
            LINES TERMINATED BY "\r\n"
            IGNORE 7 LINES
            (@ignora1,
            @material,
            @descripcion,
            @type,
            @bin,
            @stock,
            @ia,
            @invrec
            )
            SET
                material=TRIM(@material),
                descripcion=UPPER(replace(@descripcion,",","")),
                type=TRIM(@type),
                bin=TRIM(@bin),
                planta="'.$planta.'",
                stock=replace(@stock,",",""),
                ia=@ia,
                invrec=TRIM(@invrec)
            ';

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        $this->dispatch(
            new UpdateCiclicosJob($planta)
        );

        return Redirect::route('conteo-ciclos.index')->with('message', 'El archivo está siendo procesado');

    }

    public function hojasConteoCiclos()
    {
        return view('ConteoCiclos.impresionHojas');
    }

    public function obtenerHojas(Request $request)
    {
        if($request->get('xls')){
            return Excel::download(new HojasConteoExport($request->user()->planta), 'conteo.xlsx');
        }
        else{
            $numPer = $request->get('num_per');

            $data = DB::connection('logistica')->table('ciclicos')->select(
                'material',
                'descripcion',
                'bin',
                'stock',
                'type',
                'invrec',
                'costo'
            )
                ->where('planta', $request->user()->planta)
                ->orderBy('type', 'asc')
                ->orderBy('bin', 'asc')
                ->orderBy('material', 'asc')
                ->get();

            $totalRecords = $data->count();

            $prom = ceil($totalRecords / $numPer);


//            $pdf = app('dompdf.wrapper');
            $pdf = PDF::loadView('ConteoCiclos.pdf', compact('data', 'prom', 'numPer', 'totalRecords'))->setPaper('a4', 'landscape');

            return $pdf->download('conteo.pdf');
        }

    }


}
