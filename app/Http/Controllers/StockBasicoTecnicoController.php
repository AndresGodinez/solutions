<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadStockTecnicoRequest;
use App\Jobs\CargaMasivaSustitutos;
use App\StockBasicoTecnico;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function compact;
use function datatables;
use function redirect;
use function url;
use function view;

class StockBasicoTecnicoController extends Controller
{
    public function index(Request $request)
    {
        return view('StockBasicoTecnico.index');
    }

    public function indexBin(Request $request)
    {
        $bin = $request->get('bin');

        return view('StockBasicoTecnico.indexBin', compact('bin'));
    }

    public function datoInicial(Request $request)
    {
        $user = Auth::user();

        return datatables()->of(StockBasicoTecnico::query()->selectRaw('
            bin,
            sloc
        ')->groupBy(['bin', 'sloc'])
            ->where('planta', $user->planta)
            ->orderByRaw('sloc')
            ->get()
        )->toJson();
    }

    public function datoInicialBin(Request $request)
    {
        $user = Auth::user();
        $bin = $request->get('bin');

        return datatables()->of(StockBasicoTecnico::query()->selectRaw('
            *
        ')->where('planta', $user->planta)->where('bin', $bin)
            ->orderByRaw('material')
            ->get()
        )->toJson();
    }

    public function uploadStockTecnico(UploadStockTecnicoRequest $request)
    {
        $table = "stockbasico_tecnico";

        $connection = 'logistica';

        $file = $request->file('file_bin');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->where('planta', Auth::user()->planta)
            ->delete();

        $query = 'LOAD DATA LOCAL INFILE "'.$nameFile.'"
                    INTO TABLE reforig_logistica.stockbasico_tecnico
                    FIELDS TERMINATED BY ","
                    OPTIONALLY ENCLOSED BY """"
                    LINES TERMINATED BY "\r\n"
                    IGNORE 1 LINES
                    (@planta,
                    @bin,
                    @sloc,
                    @material,
                    @max,
                    @stock,
                    @surtir)

                    SET
                    planta = TRIM(UPPER(@planta)),
                    bin= TRIM(UPPER(@bin)),
                    sloc = TRIM(@sloc),
                    material= TRIM(UPPER(@material)),
                    max= TRIM(UPPER(@max)),
                    stock= TRIM(UPPER(@stock)),
                    surtir= TRIM(UPPER(@surtir))';

        $this->dispatch(
            new CargaMasivaSustitutos($query)
        );


        return redirect(url('stock-basico-tecnico'))
            ->with(['message' => 'El arvhivo esta siendo procesado']);

    }


}
