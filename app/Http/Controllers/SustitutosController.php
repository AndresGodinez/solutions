<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargaMasivaFechaCreacionPiezas;
use App\Http\Requests\CargaMasivaInventariosRequest;
use App\Http\Requests\CargaMasivaMM60;
use App\Http\Requests\CargaMasivaSustitutosRequest;
use App\Jobs\CargaMasivaSustitutos;
use App\Jobs\SqlJob;
use App\Utils\MyUtils;
use Illuminate\Support\Facades\DB;
use function date;
use function redirect;

class SustitutosController extends Controller
{
    public function cargaMM60(CargaMasivaMM60 $request)
    {
        $table = "mm60";

        DB::table($table)->truncate();

        $file = $request->file('carga-mm60');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY '\t'
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@ignore, @material, @descripcion, @cum, @price, @abc)
							SET
							material 	= TRIM(@material),
							descripcion = TRIM(@descripcion),
							cum 		= TRIM(@cum),
							price 		= TRIM(@price),
							abc 		= TRIM(@abc)";

        $this->dispatch(
            new CargaMasivaSustitutos($query)
        );

        $update_date = date("Y-m-d H:i:s");
        $queryUpdate = "UPDATE ".$table." SET update_date = '{$update_date}'";

        $this->dispatch(
            new SqlJob($queryUpdate)
        );

        return redirect()->back()->with(['message' => 'El arvhivo esta siendo procesado']);
    }

    public function cargaFechaCreacionPiezas(CargaMasivaFechaCreacionPiezas $request)
    {
        $table = "materiales_fecha_creacion";

        DB::table($table)->truncate();

        $file = $request->file('file_c_date_pzas');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY '\t'
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@ignore, @material, @fecha_creacion)
							SET
							material 		= TRIM(@material),
							fecha_creacion 	= STR_TO_DATE(@fecha_creacion, '%m/%d/%Y')";

        $this->dispatch(
            new CargaMasivaSustitutos($query)
        );


        $update_date = date("Y-m-d H:i:s");
        $queryUpdate = "UPDATE ".$table." SET update_date = '{$update_date}'";

        $this->dispatch(
            new SqlJob($queryUpdate)
        );

        return redirect()->back()->with(['message' => 'El arvhivo esta siendo procesado']);
    }

    public function cargaMasivaSustitutos(CargaMasivaSustitutosRequest $request)
    {
        $file = $request->file('carga_masiva');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $table = "tmp_sustitutos";

        DB::table($table)->truncate();

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY ','
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@material, @sustituto, @tipo)
							SET
							material 	= TRIM(@material),
							sustituto 	= TRIM(@sustituto),
							tipo 		= TRIM(@tipo)";

        $this->dispatch(
            new CargaMasivaSustitutos($query)
        );

        return redirect()->back()->with(['message' => 'El arvhivo esta siendo procesado']);

    }

    public function cargaInventarios(CargaMasivaInventariosRequest $request)
    {
        $table = "materiales_plantas";

        DB::table($table)->truncate();

        $file = $request->file('file_plantas');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY '\t'
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@material, @planta, @cantidad)
							SET
							material 	= TRIM(@material),
							planta 		= TRIM(@planta),
							cantidad 	= TRIM(@cantidad)";

        $this->dispatch(
            new CargaMasivaSustitutos($query)
        );

        $update_date = date("Y-m-d H:i:s");
        $queryUpdate = "UPDATE ".$table." SET update_date = '{$update_date}'";

        $this->dispatch(
            new SqlJob($queryUpdate)
        );

    }


}