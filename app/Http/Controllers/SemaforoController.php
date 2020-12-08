<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Menu;
use App\Models\SemaforoModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Str;

error_reporting(E_ALL);
date_default_timezone_set("America/Mexico_City");

class SemaforoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        $get_all_records    = SemaforoModel::get_all_records("");
        $get_all_records_tp = SemaforoModel::get_all_records("LIVERPOOL");

        return view("pages.semaforo.index", ['items' => $items, 'get_all_records' => $get_all_records, 'get_all_records_tp' => $get_all_records_tp]);
    }

    public function list(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        if($request->type == "all-records")
        {
            $conditional = "";
        }
        elseif($request->type == "liverpool")
        {
            $conditional = "LIVERPOOL";
        }

        $get_all_records        = SemaforoModel::get_all_records($conditional);
        $get_all_records_list   = SemaforoModel::get_all_records_list($conditional);

        return view("pages.semaforo.listTicket", ['items' => $items, 'get_all_records' => $get_all_records, 'get_all_records_list' => $get_all_records_list, 'type' => $request->type]);
    }

    public function upload()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        return view("pages.semaforo.upload", ['items' => $items]);
    }

    // Carga para stocks iniciales (conclusion ISC)
    public function upload_file(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("semaforo/");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('semaforo/c/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("semaforo/carga/");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub/wwwroot/Soluciones2/storage/app/semaforo/c/".$date."/".$final_file, "r");
            $start = 0;
            
            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start != 0) 
                {   
                    /*
                    $data[0] = ticket
                    $data[1] = sub estado
                    $data[2] = tipo pago
                    $data[3] = muebleria
                    $data[4] = modelo
                    $data[5] = pedido reserva
                    */

                    if(!empty($data[5]))
                    {
                        if(SemaforoModel::ifExistTicket($data[0]))
                        {
                            $pedido_reserva_date = SemaforoModel::ifExistDateOfPedido($data[5]);
                            // most be update
                            SemaforoModel::update_load($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $pedido_reserva_date, Session::get('username'), date("Y-m-d H:i:s"));
                        }
                        else
                        {
                            $pedido_reserva_date = SemaforoModel::ifExistDateOfPedido($data[5]);
                            // most be insert
                            SemaforoModel::insert_load($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $pedido_reserva_date, Session::get('username'), date("Y-m-d H:i:s"));
                        }
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }
}
