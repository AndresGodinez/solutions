<?php

namespace App\Http\Controllers;

use PDO;
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
        $items      = Menu::getMenu2($user);
                
        return view("pages.pago-talleres.recepcion-facturas", ['items' => $items]);
    }

    public function recepcion_facturas_detail(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);
        $valid = true;
        $target = "";
        $message = "¡El proceso de descarga se ejecuto exitosamente!";
        $redirect = url("pago-a-talleres/recepcion-de-facturas/");

        $request->ipt_taller     = $this->clean_string(isset($request->ipt_taller) ? $request->ipt_taller : "");
        
        if(empty($request->ipt_taller))
        {
            $message = "Por favor ingrese un número de taller valido.";
            $valid = false;
            $target = "#ipt_taller";
        }

        if($valid)
        {

        }
                
        //return view("pages.pago-talleres.recepcion-facturas", ['items' => $items]);

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

    // Carga de datos.
    // Carga de datos.
    // Carga de datos.

    public function uploads()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);
                
        return view("pages.pago-talleres.cargas", ['items' => $items]);
    }

    public function uploads_claims(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

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
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\pago-a-talleres\\claims\\".$date."\\".$final_file, "r+");
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

        echo '<script>window.location.href = "'.$redirect.'";</script>';
                
        return view("pages.pago-talleres.cargas", ['items' => $items]);
    }

    public function uploads_prorrateo(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

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
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\pago-a-talleres\\claims\\".$date."\\".$final_file, "r+");
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

            $handle_x = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\pago-a-talleres\\claims\\".$date."\\".$final_file, "r+");
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

        echo '<script>window.location.href = "'.$redirect.'";</script>';
                
        return view("pages.pago-talleres.cargas", ['items' => $items]);
    }

    // Carga de datos.
    // Carga de datos.
    // Carga de datos.

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
}