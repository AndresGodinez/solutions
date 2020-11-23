<?php

namespace App\Http\Controllers;

use App\FechaPromesa;
use App\FechaPromesaDetalle;
use App\Http\Requests\ConsultaFechaPromesaRequest;
use App\Http\Requests\UploadBackorderRequest;
use App\Http\Requests\UploadLeadTimeRequest;
use App\Http\Requests\UploadTrackerProcessRequest;
use App\Jobs\ExecuteByConnection;
use App\Utils\MyUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use League\Csv\Writer;
use function compact;
use function exec;
use function header;
use function ini_set;
use function pclose;
use function php_uname;
use function popen;
use function response;
use function set_time_limit;
use function substr;
use function view;

class FechaPromesaController extends Controller
{
    public function search()
    {
        return view('FechaPromesa.busqueda');
    }

    public function downloadFechaPromesaGeneral(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=Reporte fecha promesa general.xls');

        $fechasPromesas = FechaPromesa::query()
            ->selectRaw('
            pedido,
            fecha_pedido,
            status_pedido,
            fecha_promesa,
            created_at,
            updated_at
            ')->from('fecha_promesa')
            ->orderBy('pedido', 'asc')
            ->get();

        return view('FechaPromesa.export-reporte-general', compact('fechasPromesas'));
    }

    public function downloadFechaPromesaDetalle(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=Reporte fecha promesa detalles.xls');

        $fechasPromesasDetalle = FechaPromesaDetalle::query()
            ->selectRaw('
            pedido,
            material,
            fecha_pedido,
            status_material,
            fecha_promesa,
            created_at,
            warning,
            updated_at
            ')->from('fecha_promesa_detalle')
            ->orderBy('pedido', 'ASC')
            ->get();

        return view('FechaPromesa.export-reporte-detalles', compact('fechasPromesasDetalle'));
    }

    public function consulta(ConsultaFechaPromesaRequest $request)
    {
        $fechaPromesa = FechaPromesa::where('pedido', $request->get('no_pedido'))->first();

        return view('FechaPromesa/detalle', compact('fechaPromesa'));
    }

    public function downloadTemplatePromesasTracker()
    {
        $record = ['pedido', 'fecha_promesa'];
        $writer = Writer::createFromString();
        $writer->insertOne($record);

        return response((string) $writer, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="template-fecha-promesa-tracker.csv"',
        ]);
    }

    public function downloadTemplateLeadTime()
    {
        $record = ['vendedor', 'nombre', 'lt'];
        $writer = Writer::createFromString();
        $writer->insertOne($record);

        return response((string) $writer, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="template-lead-time.csv"',
        ]);
    }

    public function downloadTemplateBackorder()
    {
        $record = [
            'almacen',
            'parte',
            'pedido',
            'cantidad',
            'fecha_pedido',
            'fecha_programada',
            'tipo',
            'proveedor',
            'invrs01',
            'invrs02',
            'invrs03',
            'invrs04',
            'invrs05',
            'invrs06',
            'invrs10',
            'invtotal',
            'invsaldo',
            'estado',
            'status_almacen',
        ];
        $example1 = [
            'RS03',
            '8009',
            '1472348467',
            1,
            '2019-02-12',
            '2019-02-12',
            'TEC',
            'P002',
            '53',
            0,
            17,
            0,
            0,
            0,
            0,
            70,
            69,
            'S-Ship',
            'Disponible'

            ];
        $example2 = [
            'RS02',
            '23599',
            '1457855260',
            1,
            '2019-02-12',
            '2019-02-12',
            'TEC',
            '',
            0,
            1,
            0,
            0,
            0,
            0,
            0,
            70,
            0,
            'S-Ship',
            'Disponible'
            ];
        $example3 = [
            'RS02',
            '23599',
            '1473165576',
            1,
            '2019-02-13',
            '2019-02-13',
            'TEC',
            '',
            0,
            1,
            0,
            0,
            0,
            0,
            0,
            1,
            -1,
            'N-Ship',
            'No Disponible'
        ];

        $writer = Writer::createFromString();
        $writer->setEscape('');
        $writer->insertOne($record);
        $writer->insertOne($example1);
        $writer->insertOne($example2);
        $writer->insertOne($example3);

        return response((string) $writer, 200, [
            'Content-Type' => 'text/csv',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Disposition' => 'attachment; filename="template-backorder.csv"',
        ]);

    }

    public function uploadTrackerProcess(UploadTrackerProcessRequest $request)
    {
        $file = $request->file('promesa_tracker_file');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

//        TODO REMOVE COMMENT
//        DB::connection('logistica')->table('fpromesa_tracker')->truncate();

        $table = "fpromesa_tracker";

        $connection = 'logistica';

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY ','
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@pedido, @fecha_promesa)
							SET
							pedido			= TRIM(@pedido),
							fecha_promesa 	= STR_TO_DATE(@fecha_promesa, '%Y-%m-%d')";

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        return Redirect::route('fechas-promesa.search')->with('message', 'El archivo está siendo procesado');

    }

    public function uploadLeadTime(UploadLeadTimeRequest $request)
    {
        $file = $request->file('lead_time');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

//        TODO REMOVE COMMENT
//        DB::connection('logistica')->table('fpromesa_tracker')->truncate();

        $table = "fecha_promesa_vendor";

        $connection = 'logistica';

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY ','
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@vendor, @nombre, @lt)
							SET
							vendor 	= TRIM(@vendor),
							nombre	= TRIM(@nombre),
							lt 		= TRIM(@lt)";
        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        return Redirect::route('fechas-promesa.search')->with('message', 'El archivo está siendo procesado');

    }

    public function uploadBackorder(UploadBackorderRequest $request)
    {
        $file = $request->file('backorder_file');

        $nameFile = MyUtils::saveAndReturnCompleteNameFile($file);

        $table = "fprom_bo";

//        TODO REMOVE COMMENT
//        DB::connection('logistica')->table($table)->truncate();


        $connection = 'logistica';

        $query = "LOAD DATA LOCAL INFILE '".$nameFile."'
						    INTO TABLE ".$table."
						    FIELDS TERMINATED BY ','
						    LINES TERMINATED BY '\r\n'
						    IGNORE 1 LINES
							(@almacen, @parte, @pedido, @cantidad, @fecha_pedido, @fecha_programada, @tipo, @proveedor, @invrs01, @invrs02, @invrs03, @invrs04, @invrs05, @invrs06, @invrs10, @invtotal, @invsaldo, @estado, @status_almacen)
							SET
							almacen 			= TRIM(@almacen),
							parte				= TRIM(@parte),
							pedido 				= TRIM(@pedido),
							cantidad 			= TRIM(@cantidad),
							fecha_pedido 		= STR_TO_DATE(@fecha_pedido, '%m/%d/%Y'),
							fecha_programada 	= STR_TO_DATE(@fecha_programada, '%m/%d/%Y'),
							tipo 				= TRIM(@tipo),
							proveedor 			= TRIM(@proveedor),
							invrs01 			= TRIM(@invrs01),
							invrs02 			= TRIM(@invrs02),
							invrs03 			= TRIM(@invrs03),
							invrs04 			= TRIM(@invrs04),
							invrs05 			= TRIM(@invrs05),
							invrs06 			= TRIM(@invrs06),
							invrs10 			= TRIM(@invrs10),
							invtotal 			= TRIM(@invtotal),
							invsaldo 			= TRIM(@invsaldo),
							estado 				= TRIM(@estado),
							status_almacen 		= TRIM(@status_almacen)";

        $this->dispatch(
            new ExecuteByConnection($query, $connection)
        );

        return Redirect::route('fechas-promesa.search')->with('message', 'El archivo está siendo procesado');

    }

    public function actualizarFechasPromesas()
    {
        $cmd = "php D:/inetpub/wwwroot/soluciones/wpx_includes/controllers/backend/fecha_promesa/exec.php";
        try {
            if (substr(php_uname(), 0, 7) == "Windows")
            {
                pclose(popen("start /B ".$cmd, "r"));
            }
            else
            {
                exec($cmd . " > /dev/null &");
            }
        }catch (\Exception $e){
            dd([
                'w' => $e
            ]);
        }



        $message = 'La carga se esta realizando, recarga la página las veces que sea necesario. Si no ves el botón para actualizar las fechas promesas significa que aún NO HA TERMINADO el proceso, de lo contrario YA TERMINO el proceso.';


        return Redirect::back()->with('message', $message);
    }

}
