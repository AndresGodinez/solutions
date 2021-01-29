<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\NomModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Str;

class NomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Session::get('username');
        $items = Menu::getMenu2($user);

        return view("pages.nom-comercial.index", ['items' => $items]);
    }

    public function get_np_info(Request $request)
    {
        $valid = true;
        $target = "";
        $message = "¡Número de parte validado exitosamente!";
        $redirect = "";

        $request->ipt_np            = $this->clean_string(isset($request->ipt_np) ? $request->ipt_np : "");

        if(empty($request->ipt_np))
        {
            $message = "Por favor ingrese un número de parte valido.";
            $valid = false;
            $target = "#ipt_np";
        }
        elseif(!NomModel::get_np_info_by_id($request->ipt_np))
        {
            $message = "Este número de parte no existe en la Base de datos, favor de contactar a ISC.";
            $valid = false;
            $target = "#ipt_np";
        }

        if($valid)
        {
            $redirect = url("nom-comerciales/np-info/detail/".$request->ipt_np);
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;
        
        echo(json_encode($response));
    }

    public function get_np_info_detail(Request $request)
    {
        if(!empty($request->np))
        {
            $get_records = NomModel::get_np_info($request->np);

            $user = Session::get('username');
            $items = Menu::getMenu2($user);

            return view("pages.nom-comercial.detail", ['items' => $items, 'get_records' => $get_records]);
        }
        else
        {
            exit("Access denied");
        }
    }

    public function upload()
    {
        $user = Session::get('username');
        $items = Menu::getMenu2($user);

        return view("pages.nom-comercial.upload", ['items' => $items]);
    }

    public function upload_file(Request $request)
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        $date   = date("Y-m-d--His");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("nom-comerciales/");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('nom-comerciales/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("nom-comerciales/carga/");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\nom-comerciales\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    NomModel::insert_load_nps($data, date("Y-m-d H:i:s"), $user);
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    public function print(Request $request)
    {
        $redirect = "https://soluciones.refaccionoriginal.com/labels/etiqueta-laravel.php?cantidad=1&piezas=1&descripcion=demodescripcion";
        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }
}
