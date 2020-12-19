<?php

namespace App\Http\Controllers;

use Mail;
use App\Models\Menu;
use App\Models\PagoTalleresModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Str;
use App\Jobs\ReporteTs;

use Maatwebsite\Excel\Facades\Excel;
use Artisan;

use App\Exports\SimpleExport;
use App\Utils\MyUtils;

error_reporting(E_ALL);
date_default_timezone_set("America/Mexico_City");

class PagoTalleresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $PDO;

    public function recepcion_facturas()
    {
        $user       = Session::get('username');

        return view("pages.pago-talleres.recepcion-facturas");
    }

    public function recepcion_facturas_reports()
    {
        $user       = Session::get('username');

        return view("pages.pago-talleres.reportes");
    }

    public function recepcion_facturas_descargar_taller()
    {
        $user       = Session::get('username');

        return view("pages.pago-talleres.reportes-recepcion-facturas-taller");
    }

    public function recepcion_facturas_descargar_taller_aceptadas()
    {
        $user       = Session::get('username');

        return view("pages.pago-talleres.reportes-recepcion-facturas-taller-aceptadas");
    }

    public function recepcion_facturas_descargar_taller_process(Request $request)
    {
        $user  = Session::get('username');
        $valid = true;
        $target = "";
        $message = "Procesando información espere un momento...";
        $redirect = url("pago-a-talleres/facturas-recibidas/x-tallr/descargar/");

        $request->taller     = $this->clean_string(isset($request->taller) ? $request->taller : "");

        if(empty($request->from))
        {
            $message = "Por favor ingrese una fecha de inicio valida.";
            $valid = false;
            $target = "#from";
        }
        elseif(empty($request->to))
        {
            $message = "Por favor ingrese una fecha fin valida.";
            $valid = false;
            $target = "#to";
        }

        if($valid)
        {
            if(empty($request->taller))
            {
                $data = PagoTalleresModel::get_data_recepcion_facturas_report($request->from, $request->to);
            }
            else
            {
                $data = PagoTalleresModel::get_data_recepcion_facturas_report_taller($request->taller, $request->from, $request->to);
            }
        }

        return view("pages.pago-talleres.recepcion-facturas-detail-ref", ['data' => $data]);

       /* $name = 'Facturas recibidas';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        $head = [
            'Material',
            'Sustituto',
            'Relacion'
        ];

        $sustitutos = Sustituto::all()->take(10);

        $data = $this->getDataSustitutos($sustitutos);
        return Excel::download(new SimpleExport($head, $data), $fileName); */

        /*$response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));*/
    }

    public function recepcion_facturas_taller()
    {
        $user  = Session::get('username');
        $data = PagoTalleresModel::get_data_facturas_report_taller($user);

        return view("pages.pago-talleres.facturas-detail-ref", ['data' => $data]);
    }

    public function recepcion_facturas_descargar_taller_process_aceptadas(Request $request)
    {
        $user  = Session::get('username');
        $valid = true;
        $target = "";
        $message = "Procesando información espere un momento...";
        $redirect = url("pago-a-talleres/facturas-recibidas-aceptadas/x-tallr/descargar/");

        $request->taller     = $this->clean_string(isset($request->taller) ? $request->taller : "");

        if(empty($request->from))
        {
            $message = "Por favor ingrese una fecha de inicio valida.";
            $valid = false;
            $target = "#from";
        }
        elseif(empty($request->to))
        {
            $message = "Por favor ingrese una fecha fin valida.";
            $valid = false;
            $target = "#to";
        }

        if($valid)
        {
            if(empty($request->taller))
            {
                $data = PagoTalleresModel::get_data_recepcion_facturas_report_aceptadas($request->from, $request->to);
            }
            else
            {
                $data = PagoTalleresModel::get_data_recepcion_facturas_report_taller_aceptadas($request->taller, $request->from, $request->to);
            }
        }

        return view("pages.pago-talleres.recepcion-facturas-detail-ref-aceptadas", ['data' => $data]);
    }

    public function recepcion_facturas_detail(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);
        $valid = true;
        $target = "";
        $message = "Procesando información espere un momento...";
        $redirect = url("pago-a-talleres/recepcion-de-facturas/");

        $request->ipt_taller     = $this->clean_string(isset($request->ipt_taller) ? $request->ipt_taller : "");

        if(empty($request->ipt_taller))
        {
            $message = "Por favor ingrese un número de taller valido.";
            $valid = false;
            $target = "#ipt_taller";
        }
        elseif(!PagoTalleresModel::taller_exist($request->ipt_taller))
        {
            $message = "Lo sentimos pero este taller no existe en la base de datos.";
            $valid = false;
            $target = "#ipt_taller";
        }

        if($valid)
        {
            if($user == $request->ipt_taller)
            {
                //Mostramos la vista para el taller interno.
                $redirect = url("pago-a-talleres/recepcion-de-facturas/detalle/1/".$request->ipt_taller);

            }
            elseif(PagoTalleresModel::is_admin($user))
            {
                //Preguntamos si el admin de talleres para mostrar la vista como admin.
                $redirect = url("pago-a-talleres/recepcion-de-facturas/detalle/2/".$request->ipt_taller);
            }
            else
            {
                $message = "Lo sentimos pero no eres administrador para ver este contenido.";
                $valid = false;
                $target = "#ipt_taller";
            }
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

    public function recepcion_facturas_detail_taller(Request $request)
    {
        $user       = Session::get('username');
        $flag       = $request->flag;
        $data_facts_pendientes_claims = array();
        //Obtenemos la info general del taller.
        $data_info_taller       = PagoTalleresModel::get_data_info_taller($request->taller);
        //Obtenemos las facturas pendientes.
        $data_facts_pendientes  = PagoTalleresModel::get_data_facts_pendientes($request->taller);

        if($flag == 1)
        {
            $data_facts_pendientes_claims = PagoTalleresModel::get_data_facts_pendientes_claims($data_facts_pendientes);
        }

        return view("pages.pago-talleres.recepcion-facturas-detail",
                    ['data_info_taller' => $data_info_taller,
                    'data_facts_pendientes' => $data_facts_pendientes,
                    'data_facts_pendientes_claims' => $data_facts_pendientes_claims,
                    'flag' => $flag]);
    }

    public function uploads()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        return view("pages.pago-talleres.cargas", ['items' => $items]);
    }

    public function uploads_claims(Request $request)
    {
        $user       = Session::get('username');
        $dir        = "D:inetpub\\wwwroot\\Soluciones3\\storage\\app\\pago-a-talleres\\pago-a-talleres\\";

        $date   = date("Y-m-d--His");
        $file   = $request->file('file');
        $valid = true;
        $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");

        if (!empty($file))
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('pago-a-talleres/claims/' . $date . '/', $final_file);
        }
        else
        {
            $valid = false;
            $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");
        }

        if($valid)
        {
            $handle = fopen($dir.$date."\\".$final_file, "r+");
            $start = 0;

            while (($data = fgetcsv($handle)) !== FALSE)
            {
                if($start > 0)
                {
                    // most be insert
                    PagoTalleresModel::create_table_if_not_exist();
                    PagoTalleresModel::insert_load_claims($data, date("Y-m-d"));
                }

                $start++;
            };
        }


        return redirect($redirect);
    }

    public function uploads_prorrateo(Request $request)
    {
        $user       = Session::get('username');
        $dir        = "D:inetpub\\wwwroot\\Soluciones3\\storage\\app\\pago-a-talleres\\pago-a-talleres\\";

        $date   = date("Y-m-d--His");
        $file   = $request->file('file');
        $valid = true;
        $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");

        if (!empty($file))
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('pago-a-talleres/claims/' . $date . '/', $final_file);
        }
        else
        {
            $valid = false;
            $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");
        }

        if($valid)
        {
            $handle = fopen($dir.$date."\\".$final_file, "r+");
            $start = 0;

            while (($data = fgetcsv($handle)) !== FALSE)
            {
                if($start > 0)
                {
                    // most be insert
                    PagoTalleresModel::insert_load_prorrateo($data, date("Y-m-d"));
                }

                $start++;
            };

            $handle_x = fopen($dir.$date."\\".$final_file, "r+");
            $start_x = 0;
            while (($data_x = fgetcsv($handle_x)) !== FALSE)
            {
                if($start_x > 0)
                {
                    // most be insert
                    PagoTalleresModel::insert_load_total_approved_parts($data_x, date("Y-m-d"));
                }

                $start_x++;
            };
        }


        return redirect($redirect);
    }

    public function uploads_pago_a_talleres(Request $request)
    {
        $user       = Session::get('username');
        $dir        = "D:inetpub\\wwwroot\\Soluciones3\\storage\\app\\pago-a-talleres\\pago-a-talleres\\";

        $date   = date("Y-m-d--His");
        $file   = $request->file('file');
        $valid = true;
        $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");

        if (!empty($file))
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('pago-a-talleres/pago-a-talleres/' . $date . '/', $final_file);
        }
        else
        {
            $valid = false;
            $redirect = url("pago-a-talleres/reporte-ts-crm/cargas/");
        }

        if($valid)
        {
            $handle = fopen($dir.$date."\\".$final_file, "r+");
            $start = 0;

            while (($data = fgetcsv($handle)) !== FALSE)
            {
                if($start > 0)
                {
                    // most be insert
                    PagoTalleresModel::insert_load_pago_a_talleres($data, date("Y-m-d"));
                }

                $start++;
            };
        }

        return redirect($redirect);

    }

    public function download_report()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        $data = PagoTalleresModel::get_all_reports();

        return view("pages.pago-talleres.download-report", ['items' => $items, 'data' => $data]);
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }

    public function download_file($date)
    {
    	return Storage::download('/pago-a-talleres/'.$date);
    }

    public function recepcion_facturas_process_admin(Request $request)
    {
        $message = "¡Información actualizada correctamente!";
        $valid =  true;
        $target = "";
        $redirect = url('pago-a-talleres/recepcion-de-facturas/detalle/2/'.$request->ipt_taller);

        if(PagoTalleresModel::update_pagoataller_admin($request))
        {
            $message = "¡Hubo un error al actualizar la información!";
            $valid =  false;
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

    public function recepcion_facturas_process_taller(Request $request)
    {
        $redirect = url('pago-a-talleres/recepcion-de-facturas/detalle/1/'.$request->ipt_taller);
        $ipt_file_xml   = $request->file('ipt_file_xml');
        $ipt_file_pdf   = $request->file('ipt_file_pdf');

        $valid = true;

        if (!empty($ipt_file_xml) && !empty($ipt_file_pdf))
        {
            $final_file_xml = Str::uuid().'.' . $ipt_file_xml->getClientOriginalExtension();
            $ipt_file_xml->storeAS('pago-a-talleres/facturas/' . $request->ipt_taller . '/' . $request->ipt_referencia . '/' , $final_file_xml);
            $final_file_pdf = Str::uuid().'.' . $ipt_file_pdf->getClientOriginalExtension();
            $ipt_file_pdf->storeAS('pago-a-talleres/facturas/' . $request->ipt_taller . '/' . $request->ipt_referencia . '/' , $final_file_pdf);
        }
        else
        {
            $valid = false;
        }

        if($valid)
        {
            PagoTalleresModel::update_pagoataller_taller($request, $final_file_xml, $final_file_pdf);
        }

        return redirect($redirect);
    }

    public function recepcion_facturas_aut(Request $request)
    {
        $message = "¡Información actualizada correctamente!";
        $valid =  true;
        $target = "";
        $redirect = "";

        if(PagoTalleresModel::update_pagoataller_aut($request))
        {
            $message = "¡Hubo un error al actualizar la información!";
            $valid =  false;
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

     public function recepcion_facturas_rech(Request $request)
    {
        $message = "¡Información actualizada correctamente!";
        $valid =  false;
        $target = "";
        $redirect = "";

        if(PagoTalleresModel::update_pagoataller_rech($request))
        {
            $message = "¡Hubo un error al actualizar la información!";
            $valid =  false;
        	
        	
        }

		Mail::send('mailing.pago-a-talleres-rechazar',
    					['referencia' => $request->ipt_ref,
						'comentarios' => $request->ipt_comentarios], 
						function ($mailing) {
		    $mailing->from("no-responder@whirlpool.com", "Cancelación de Claim");
		    $mailing->to("noe_delgado_munoz_proceti@whirlpool.com");
		});

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }
}
