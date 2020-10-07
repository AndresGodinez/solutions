<?php

namespace App\Http\Controllers;

use App\CiclosTemp;
use App\Http\Requests\ProcessInventarioLX02Request;
use App\InventarioLX02;
use App\Jobs\ExecuteByConnection;
use App\Surtimiento;
use App\SurtimientoReserva;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use function view;

class Lx02Controller extends Controller
{
    public function index()
    {
        return view('Lx02.index');
    }

    public function processInventarioLx02(ProcessInventarioLX02Request $request)
    {
        dd($request->all());

        $user = $request->user();

        $planta = $user->planta;

        $file = $request->file('inventario_lx02');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $connection = 'logistica';

        $query = 'LOAD DATA LOCAL INFILE "'.$nameFile.'"
                  INTO TABLE reforig_logistica.inventario_lx02
                  FIELDS TERMINATED BY ","
                  LINES TERMINATED BY "\r\n"
                  IGNORE 7 LINES
                  (@ignora1,
                  @material,
                  @descripcion,
                  @planta,
                  @sloc,
                  @nivel,
                  @bin,
                  @stock,
                  @fecha
                    )

                    SET
                    material=TRIM(@material),
                    descripcion=UPPER(replace(TRIM(@descripcion),"\"","")),
                    planta=TRIM(@planta),
                    sloc=TRIM(@sloc),
                    nivel=TRIM(@nivel),
                    bin=TRIM(@bin),
                    stock=replace(@stock,",",""),
                    fecha=STR_TO_DATE(@fecha, "%m/%d/%Y")
                ';

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        InventarioLX02::updateDescription($planta);

        Surtimiento::deletePlanta($planta);

        SurtimientoReserva::deletePlanta($planta);

        SurtimientoReserva::updatePlanta($planta);

        SurtimientoReserva::markAsBorrar($planta);

        SurtimientoReserva::markAsBorrarReserva($planta);

        SurtimientoReserva::consolidarReserva($planta);

        Surtimiento::insertConsolidado($planta);



    }
}
