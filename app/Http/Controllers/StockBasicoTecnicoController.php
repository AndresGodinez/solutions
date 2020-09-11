<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadStockTecnicoRequest;
use App\Jobs\CargaMasivaSustitutos;
use App\StockBasicoTecnico;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SqlJob;
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

    public function descarga()
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=REPORTE STOCK GENERAL.xls');
        $user = Auth::user();
        $rows = StockBasicoTecnico::query()->selectRaw('*')->where('planta', $user->planta)
            ->orderByRaw('material')
            ->get();
        return view("StockBasicoTecnico.descarga", ['get_records' => $rows]);
    }
    public function descargabin(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=REPORTE STOCK BIN ' . $request->id . '.xls');
        $user = Auth::user();
        $rows = StockBasicoTecnico::query()->selectRaw('*')->where('planta', $user->planta)->where('bin', $request->id)
            ->orderByRaw('material')
            ->get();
        return view("StockBasicoTecnico.descarga", ['get_records' => $rows]);
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
            ->get())->toJson();
    }

    public function datoInicialBin(Request $request)
    {
        $user = Auth::user();
        $bin = $request->get('bin');

        return datatables()->of(StockBasicoTecnico::query()->selectRaw('
            *
        ')->where('planta', $user->planta)->where('bin', $bin)
            ->orderByRaw('material')
            ->get())->toJson();
    }

    public function uploadStock(UploadStockTecnicoRequest $request)
    {
        $connection = 'logistica';

        $file = $request->file('file_bin');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->where('planta', Auth::user()->planta)
            ->delete();
        $query = 'LOAD DATA LOCAL INFILE "' . $nameFile . '"
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

        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->where('planta', '')
            ->orWhere('planta', null)
            ->delete();
        return redirect(url('stock-basico-tecnico'))
            ->with(['message' => 'El arvhivo esta siendo procesado']);
    }

    public function uploadStockTecnico(UploadStockTecnicoRequest $request)
    {
        $table = "stockbasico_tecnico";

        $connection = 'logistica';

        $file = $request->file('file_bin');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $planta = Auth::user()->planta;
        $bin = $request->get('bin');

        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->whereRaw('planta=\'' . $planta . '\' and bin=\'' . $bin . '\'')
            // ->where('planta', Auth::user()->planta)
            // ->where('bin', $_SESSION['bin'])
            ->delete();

        $query = 'LOAD DATA LOCAL INFILE "' . $nameFile . '"
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

        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->where('planta', '')
            ->orWhere('planta', null)
            ->delete();
        return redirect(url('stock-basico-tecnico'))
            ->with(['message' => 'El arvhivo esta siendo procesado']);
        return redirect(url('stock-basico-tecnico'))
            ->with(['message' => 'El arvhivo esta siendo procesado']);
    }
    public function deleteBin(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        $connection = 'logistica';
        DB::connection($connection)
            ->table('stockbasico_tecnico')
            ->where('id', $_POST['id'])
            ->delete();
    }
    public function editarBin(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        $row = StockBasicoTecnico::query()
            ->selectRaw('*')
            ->from('stockbasico_tecnico')
            ->whereRaw('id=' . $_POST['id'])
            ->get();
        $row = $row[0];
?>
        <h4 class="card-title">Actualizar Material - <?= $row['material'] ?></h4>
        <form class="formedit">
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="sizing-addon1">Material</span>
                </div>
                <input name="material" type="text" class="form-control edita_form_material" value="<?= $row['material'] ?>">
                <input name="id" hidden class="edita_form_id" value="<?= $row['id'] ?>">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="sizing-addon1">MAX</span>
                </div>
                <input name="max1" type="text" class="form-control edita_form_max" value="<?= $row['max'] ?>" placeholder="MAX" aria-describedby="sizing-addon1">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="sizing-addon1">Stock</span>
                </div>
                <input name="stock" type="text" class="form-control edita_form_stock" value="<?= $row['stock'] ?>" placeholder="Stock" aria-describedby="sizing-addon1">
            </div>
            <br>
            <div class="input-group input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="sizing-addon1">Surtir</span>
                </div>
                <input name="surtir" type="text" class="form-control edita_form_surtir" value="<?= $row['surtir'] ?>" placeholder="Surtir" aria-describedby="sizing-addon1">
            </div>
        </form>
<?php
    }

    public function saveadd(Request $request)
    {
        $token = $request->ajax() ? $request->header('X-CSRF-Token') : $request->input('_token');
        $planta = Auth::user()->planta;
        // $sloc = Auth::user()->sloc;
        $bin = $_POST['bin'];
        $queryUpdate = "INSERT INTO reforig_logistica.stockbasico_tecnico (material,max,stock,surtir,planta,bin,sloc) VALUES ('" . $_POST['material'] . "', '" . $_POST['max'] . "', '" . $_POST['stock'] . "', '" . $_POST['surtir'] . "', '" . $planta . "', '" . $bin . "', '" . $_POST['sloc'] . "')";
        $this->dispatch(
            new SqlJob($queryUpdate)
        );
    }
    public function saveedit(Request $request)
    {
        $queryUpdate = "UPDATE reforig_logistica.stockbasico_tecnico SET material = '" . $_POST['material'] . "', max = '" . $_POST['max'] . "',stock = '" . $_POST['stock'] . "', surtir = '" . $_POST['surtir'] . "' where id =" . $_POST["id"];
        $this->dispatch(
            new SqlJob($queryUpdate)
        );
    }
}
