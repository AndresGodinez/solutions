<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Menu;
use App\Models\SolicitudesAduanalesModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Str;

class SolicitudesAduanales extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $PDO;

    public function index()
    {
        $user       = Session::get('username');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        return view("pages.solicitudesAduanales.index", ['items' => $items]);
    }

    public function solicitudes()
    {
        $user       = Session::get('username');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        $get_records = SolicitudesAduanalesModel::get_all_records();

        return view("pages.solicitudesAduanales.solicitudes", ['items' => $items, 'get_records' => $get_records]);   
    }

    public function solicitudes_cerrar(Request $request)
    {
        $user       = Session::get('username');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        $get_records_id     = SolicitudesAduanalesModel::get_all_records_by_id($request->id);
        $get_records_marcas = SolicitudesAduanalesModel::get_all_marcas();

        return view("pages.solicitudesAduanales.crear", ['items' => $items, 'get_records_id' => $get_records_id, 'get_records_marcas' => $get_records_marcas]);   
    }

    public function detail_process(Request $request)
    {
        $valid = true;
        $target = "";
        $message = "Redireccionando página...";
        $redirect = url("solicitudes-aduanales/");

        $request->ipt_np = $this->clean_string(isset($request->ipt_np) ? $request->ipt_np : "");
        
        if(empty($request->ipt_np))
        {
            $message = "Por favor ingrese por lo menos un Número de parte valido.";
            $valid = false;
            $target = "#ipt_np";
        }
        else
        {
            $div_nps = explode(",", $request->ipt_np);
            
            if(count($div_nps) > 10)
            {
                $message = "Por favor ingrese una cantidad que no excedan los 10 Números de parte.";
                $valid = false;
                $target = "#ipt_np";
            }
        }

        if($valid)
        {
            $string = "";

            for($i=0; $i < count($div_nps); $i++)
            {
                if(!empty($div_nps[$i]))
                {
                    if($i > 0)
                    {
                        $string .= "---";
                    }

                    $string .= str_replace(" ", "", $div_nps[$i]);
                }
            }

            if(!empty($string))
            {
                $redirect = url("solicitudes-aduanales/detalle/".$string);
            }
            else
            {
                $message = "Ocurrio un problema en la asignacion de los elementos.";
                $valid = false;
                $target = "#ipt_np";
            }
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }

    public function detail($string)
    {
        $user       = Session::get('username');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        $div_nps = explode("---", $string);

        $data = SolicitudesAduanalesModel::get_detail_np($div_nps);

        return view("pages.solicitudesAduanales.detail", ['items' => $items, 'data' => $data]);
    }

    public function solicitar()
    {
        $user       = Session::get('username');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        return view("pages.solicitudesAduanales.solicitar", ['items' => $items]);
    }

    public function solicitar_create(Request $request)
    {
        $user       = Session::get('username');
        $depto      = Session::get('depto');
        $id_region  = Session::get('id_region');
        $items      = Menu::getMenu2($user);

        $valid = true;
        $target = "";
        $message = "Todo ¡OK! Redireccionando página...";
        $redirect = "";

        $request->np1           = $this->clean_string(isset($request->np1) ? $request->np1 : "");
        $request->np2           = $this->clean_string(isset($request->np2) ? $request->np2 : "");
        $request->np3           = $this->clean_string(isset($request->np3) ? $request->np3 : "");
        $request->description1  = $this->clean_string(isset($request->description1) ? $request->description1 : "");
        $request->description2  = $this->clean_string(isset($request->description2) ? $request->description2 : "");
        $request->description3  = $this->clean_string(isset($request->description3) ? $request->description3 : "");
        $request->comments1     = $this->clean_string(isset($request->comments1) ? $request->comments1 : "");
        $request->comments2     = $this->clean_string(isset($request->comments2) ? $request->comments2 : "");
        $request->comments3     = $this->clean_string(isset($request->comments3) ? $request->comments3 : "");
        $lock1 = true;
        $lock2 = true;
        $lock3 = true;

        
        if(empty($request->np1) && empty($request->np2) && empty($request->np2))
        {
            $message = "Por favor ingrese por lo menos un Números de parte valido.";
            $valid = false;
            $target = "#np1";
        }
        else
        {
            if(!empty($request->np1))
            {
                $lock1 = false;
                if(empty($request->description1))
                {
                    $message = "Por favor ingrese una descripción para el Número de parte para el No. 1.";
                    $valid = false;
                    $target = "#description1";
                    $lock1 = true;
                }
                elseif(empty($request->comments1))
                {
                    $message = "Por favor ingrese algunos comentarios para el Número de parte para el No. 1.";
                    $valid = false;
                    $target = "#comments1";
                    $lock1 = true;
                }
            }
            
            if(!empty($request->np2))
            {
                $lock2 = false;
                if(empty($request->description2))
                {
                    $message = "Por favor ingrese una descripción para el Número de parte para el No. 2.";
                    $valid = false;
                    $target = "#description2";
                    $lock2 = true;
                }
                elseif(empty($request->comments2))
                {
                    $message = "Por favor ingrese algunos comentarios para el Número de parte para el No. 2.";
                    $valid = false;
                    $target = "#comments2";
                    $lock2 = true;
                }
            }
            
            if(!empty($request->np3))
            {
                $lock3 = false;
                if(empty($request->description3))
                {
                    $message = "Por favor ingrese una descripción para el Número de parte para el No. 3.";
                    $valid = false;
                    $target = "#description3";
                    $lock3 = true;
                }
                elseif(empty($request->comments3))
                {
                    $message = "Por favor ingrese algunos comentarios para el Número de parte para el No. 3.";
                    $valid = false;
                    $target = "#comments3";
                    $lock3 = true;
                }
            }
        }

        if($valid)
        {
            if(!$lock1)
            {
                if(!SolicitudesAduanalesModel::if_exist_sol($request->np1))
                {
                    SolicitudesAduanalesModel::create_sol($request->np1, $request->description1, $request->comments1, $user, $depto);
                }
                else
                {
                    $message = "No se puede solicitar el NP (".$request->np1."), ya que fue solicitado anteriormente.";
                    $valid = false;
                    $target = "#np1";
                    $lock2 = true;
                    $lock3 = true;
                }
            }

            if(!$lock2)
            {
                if(!SolicitudesAduanalesModel::if_exist_sol($request->np2))
                {
                    SolicitudesAduanalesModel::create_sol($request->np2, $request->description2, $request->comments2, $user, $depto);
                }
                else
                {
                    $message = "No se puede solicitar el NP (".$request->np2."), ya que fue solicitado anteriormente.";
                    $valid = false;
                    $target = "#np2";
                    $lock3 = true;
                }
            }

            if(!$lock3)
            {
                if(!SolicitudesAduanalesModel::if_exist_sol($request->np3))
                {
                    SolicitudesAduanalesModel::create_sol($request->np3, $request->description3, $request->comments3, $user, $depto);
                }
                else
                {
                    $message = "No se puede solicitar el NP (".$request->np3."), ya que fue solicitado anteriormente.";
                    $valid = false;
                    $target = "#np3";
                }
            }

            $redirect = url("solicitudes-aduanales/");
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }

    public function solicitudes_contestar(Request $request)
    {
        $valid = true;
        $target = "";
        $message = "Redireccionando página...";
        $redirect = "";

        $request->np = $this->clean_string(isset($request->np) ? $request->np : "");
        $request->sap_description = $this->clean_string(isset($request->sap_description) ? $request->sap_description : "");
        $request->category = $this->clean_string(isset($request->category) ? $request->category : "");
        $request->product_name = $this->clean_string(isset($request->product_name) ? $request->product_name : "");
        $request->type_component = $this->clean_string(isset($request->type_component) ? $request->type_component : "");
        $request->type_functional = $this->clean_string(isset($request->type_functional) ? $request->type_functional : "");
        $request->type_use = $this->clean_string(isset($request->type_use) ? $request->type_use : "");
        $request->type_np = $this->clean_string(isset($request->type_np) ? $request->type_np : "");
        $request->textil = $this->clean_string(isset($request->textil) ? $request->textil : "");
        $request->size = $this->clean_string(isset($request->size) ? $request->size : "");
        $request->motor = $this->clean_string(isset($request->motor) ? $request->motor : "");
        $request->electric = $this->clean_string(isset($request->electric) ? $request->electric : "");
        $request->barras_code = $this->clean_string(isset($request->barras_code) ? $request->barras_code : "");
        $request->sat_code = $this->clean_string(isset($request->sat_code) ? $request->sat_code : "");
        $request->repuesto = $this->clean_string(isset($request->repuesto) ? $request->repuesto : "");
        $request->brand = $this->clean_string(isset($request->brand) ? $request->brand : "");
        $request->n_pzas = $this->clean_string(isset($request->n_pzas) ? $request->n_pzas : "");
        $request->battery = $this->clean_string(isset($request->battery) ? $request->battery : "");
        $request->battery_include = $this->clean_string(isset($request->battery_include) ? $request->battery_include : "");
        $request->battery_type = $this->clean_string(isset($request->battery_type) ? $request->battery_type : "");
        $request->battery_n = $this->clean_string(isset($request->battery_n) ? $request->battery_n : "");
        $request->watt_x_h = $this->clean_string(isset($request->watt_x_h) ? $request->watt_x_h : "");
        $request->danger_product = $this->clean_string(isset($request->danger_product) ? $request->danger_product : "");
        $request->url_fds = $this->clean_string(isset($request->url_fds) ? $request->url_fds : "");
        
        
        if(empty($request->np))
        {
            $message = "Por favor no modifique el Número de parte.";
            $valid = false;
            $target = "#np";
        }
        if(empty($request->sap_description))
        {
            $message = "Por favor ingrese una Descripción SAP valida.";
            $valid = false;
            $target = "#sap_description";
        }
        elseif(empty($request->category))
        {
            $message = "Por favor ingrese una Categoría valida.";
            $valid = false;
            $target = "#category";
        }

        if($valid)
        {
            if(!SolicitudesAduanalesModel::valid_exist_reg($request->np))
            {
                SolicitudesAduanalesModel::contestar_sol($request, Session::get('username'));
            }
            else
            {
                $message = "Lo sentimos, pero no se puede completar esta acción ya que, ya se contesto una solicitud con este mismo número de parte.";
                $valid = false;
                $target = "#np"; 
            }
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));     
    }

    public function solicitudes_contestar_file(Request $request)
    {
        $redirect = url("solicitudes-aduanales/solicitudes/detalle/".$request->id);

        if(!empty($request->file('picture')))
        {
            $file = $request->file('picture');
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('public/solicitudesAduanales/' . $request->np . '/', $final_file);  

            SolicitudesAduanalesModel::save_dir_file('solicitudesAduanales/'.$request->np.'/'.$final_file, $request->np);

            $redirect = url("solicitudes-aduanales/detalle/".$request->np);
        }
        
        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }
}
