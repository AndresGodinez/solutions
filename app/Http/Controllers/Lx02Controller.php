<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessInventarioLX02Request;
use App\Http\Requests\ProcessReciboBinsRequest;
use App\Jobs\ExecuteByConnection;
use App\Jobs\UpdateLX02Job;
use App\Utils\MyUtils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use function response;
use function view;

class Lx02Controller extends Controller
{
    public function index()
    {
        if (!Auth::user()->planta) {
            return response(view('Bag.missing_planta'));
        }

        return view('Lx02.index');
    }

    public function processInventarioLx02(ProcessInventarioLX02Request $request)
    {

        $user = $request->user();

        $planta = $user->planta;

        $file = $request->file('inventario_lx02');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $connection = 'logistica';

        $query = 'LOAD DATA LOCAL INFILE "'.$nameFile.'"
                    INTO TABLE reforig_logistica.inventario_lx02
                    FIELDS TERMINATED BY "|"
                    LINES TERMINATED BY "\r\n" IGNORE 7 LINES
                    (@ignora1, @material, @descripcion, @planta, @sloc, @nivel, @bin, @stock, @fecha)
                    SET
                        material = TRIM(@material),
                        descripcion = TRIM(@descripcion),
                        planta = TRIM(@planta),
                        sloc = TRIM(@sloc),
                        nivel = TRIM(@nivel),
                        bin = TRIM(@bin),
                        stock = TRIM(@stock),
                        fecha = STR_TO_DATE(@fecha, "%m/%d/%Y")';

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        dd($query);

        dd('done');

        $this->dispatch(
            new UpdateLX02Job($planta)
        );

        return Redirect::route('lx02.index')
            ->with('message', 'El archivo de inventario LX02 está siendo procesado');

    }

    public function processReciboBins(ProcessReciboBinsRequest $request)
    {

        $file = $request->file('recibo_bins');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $connection = 'logistica';

        DB::connection($connection)->table('recibo_bins')->truncate();

        $query = 'LOAD DATA LOCAL INFILE "'.$nameFile.'"
                  INTO TABLE reforig_logistica.recibo_bins
                  FIELDS TERMINATED BY ","
                  LINES TERMINATED BY "\r\n"
                  IGNORE 1 LINES
                  (@planta, @material, @bin, @fecha)
                  SET
                    planta = TRIM(@planta),
                    material = TRIM(@material),
                    bin = TRIM(@bin),
                    fecha = STR_TO_DATE(@fecha, "%m/%d/%Y")';

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        return Redirect::route('lx02.index')
            ->with('message', 'El archivo está siendo procesado');

    }
}
