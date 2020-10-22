<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaMaterialesRequest;
use App\Material;
use App\Stock;
use App\Sustituto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function compact;
use function datatables;
use function redirect;
use function response;
use function url;
use function view;

class MaterialesController extends Controller
{

    public function index(Request $request)
    {
        $get_records = Sustituto::get_all_sol_records(1);

        return view("Sustitutos.index", compact('get_records'));
    }

    public function detail(Request $request, int $id)
    {
        $user = Auth::user()->username;

        $data       = Sustituto::get_sol_by_id($id);
        $data_log   = Sustituto::get_log_sol_by_id($id);

        $access     = Sustituto::get_access(Auth::user()->username, Auth::user()->depto);

        return view("Sustitutos.detail", compact('data', 'data_log', 'access', 'user'));
    }

    public function search()
    {
        return view('Materiales/search');
    }

    public function consulta(ConsultaMaterialesRequest $request)
    {
        $material = Material::where('part_number', $request->get('ipt_material'))->first();

        $sustitutos = DB::table('materiales_sustitutos')
            ->select(
                'mm.part_number as x',
                'm.create_date as fechaLiga',
                'materiales_sustitutos.rel',
                'mmm.part_number as y',
                'mmm.part_description',
                'mmm.rs01',
                'mmm.rs02',
                'mmm.rs03',
                'mmm.rs05',
                'mmm.rs06',
                'wpx_sustitutos.sustituto_sug'
            )
            ->join('materiales as m', 'm.id', '=', 'materiales_sustitutos.id_material')
            ->join('materiales as mm', 'mm.id', '=', 'materiales_sustitutos.id_material_logico')
            ->join('materiales as mmm', 'mmm.id', '=', 'materiales_sustitutos.id_material_sustituto')
            ->join('wpx_sustitutos', 'wpx_sustitutos.id', '=', 'materiales_sustitutos.id_material_sustituto')
            ->where('m.part_number', '=', 'WP326020544')
            ->get();
        return view('Materiales/show', compact('material', 'sustitutos'));
    }

    public function download(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
        header('Content-Disposition: attachment; filename=Reporte de usuario.xls');

        $sustitutos = Sustituto::query()
            ->selectRaw('
            material,
            sustituto,
            rel
            ')
            ->from('wpx_sustitutos')
            ->get();

        return view('Materiales.export', compact('sustitutos'));
    }

    public function cargaSustitutos()
    {
        return view('Materiales.carga-sustitutos');
    }

    public function solicitud()
    {
        return view('Materiales.solicitud');
    }

    public function datoinicial()
    {

        dd([
            'de' => datatables()->of(Stock::query()->selectRaw('
        wpx_ligas_sustitutos.*',
                'wpx_ligas_sustitutos_status.status as status')
                ->from('wpx_ligas_sustitutos')
                ->whereRaw('wpx_ligas_sustitutos.id_status in (1,3)')
                ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=',
                    'wpx_ligas_sustitutos.id_status')
                ->get())->toJson()
        ]);
        return datatables()->of(Stock::query()->selectRaw('
        wpx_ligas_sustitutos.*',
            'wpx_ligas_sustitutos_status.status as status')
            ->from('wpx_ligas_sustitutos')
            ->whereRaw('wpx_ligas_sustitutos.id_status in (1,3)')
            ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=',
                'wpx_ligas_sustitutos.id_status')
            ->get())->toJson();
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }

    public function process(Request $request)
    {
        // Obtenemos el usuario de la sesion para validar el acceso al sistema.
        $user = Auth::user();

        $valid = true;
        $target = "";
        $message = "¡Los cambios se guardaron exitosamente!";
        $redirect = "";

        $request->ipt_componente = $this->clean_string(isset($request->ipt_componente) ? $request->ipt_componente : "");
        $request->ipt_componente_sust = $this->clean_string(isset($request->ipt_componente_sust) ? $request->get('ipt_componente_sust') : "");
        $request->ipt_componente_sust_descr = $this->clean_string(isset($request->ipt_componente_sust_descr) ? $request->ipt_componente_sust_descr : "");

        if (empty($request->ipt_componente)) {
            $message = "Por favor ingrese un Componente que requiere sustituto.";
            $valid = false;
            $target = "#ipt_componente";
        } elseif (empty($request->ipt_componente)) {
            $message = "Por favor ingrese un Componente sustituto.";
            $valid = false;
            $target = "#ipt_componente";
        } elseif (empty($request->ipt_componente_sust_descr)) {
            $message = "Por favor ingrese una Descripción del sustituto.";
            $valid = false;
            $target = "#ipt_componente_sust_descr";
        }

        if ($valid) {
            // Primero debemos de validar que la refacción que requiere un sustituto este dada de alta en CS. (master data).
            $data_master_data = Sustituto::validate_master_data($request->get('ipt_componente'));

            if ($data_master_data['valid']) {
                if (Sustituto::validate_if_exist_liga($request->ipt_componente, $request->ipt_componente_sust)) {
                    // Si si existe, insertamos el regristro ya como una solicitud formal.
                    $depto = $user->depto;
                    $userName = $user->username;

                    $data_create_sol = Sustituto::create_solicitud($request->get('ipt_componente'),
                        $request->get('ipt_componente_sust'), $request->get('ipt_componente_sust_descr'), $userName, $depto);

                    if ($data_create_sol['valid']) {
                        $data_insert_log = Sustituto::insert_log($data_create_sol['id'], 1, $userName, $depto,
                            "Se crea la solicitud");

                        if (!$data_insert_log['valid']) {
                            $message = $data_insert_log['message'];
                            $valid = $data_insert_log['valid'];
                        } else {
                            $redirect = "detalle/".$data_create_sol['id'];
                        }
                    } else {
                        $message = $data_create_sol['message'];
                        $valid = $data_create_sol['valid'];
                    }
                } else {
                    $message = "No se puede generar una solicitud ya que existe una solicitud entre estos dos materiales previamente.";
                    $valid = false;
                    $target = "#ipt_componente";
                }
            } else {
                $message = "No se puede generar una solicitud ya que el Componente que requiere sustituto no existe o no esta dado de alta en SAP.";
                $valid = false;
                $target = "#ipt_componente";
            }
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        return redirect(url('sustitutos'))->with(['message' => $message]);
    }

    public function get_description_by_np(Request $request)
    {
        $valid = true;
        $target = "";
        $message = "¡Los cambios se guardaron exitosamente!";

        $iptComponent = $request->get('ipt_componente');

        $request->ipt_componente = $this->clean_string(isset($iptComponent) ? $iptComponent : "");

        if(!empty($request->ipt_componente))
        {
            $data_master_data = Sustituto::validate_master_data($request->get('ipt_componente'));

            if($data_master_data['valid'])
            {
                $response['np_description'] = $data_master_data['np_description'];
                $response['valid'] = $valid;
            }
            else
            {
                $message = "No se puede generar una solicitud ya que el Componente que requiere sustituto no existe o no esta dado de alta en SAP.";
                $valid = false;
                $target = "#ipt_componente";

                $response['message'] = $message;
                $response['valid'] = $valid;
                $response['target'] = $target;
            }

            return response()->json($response);
        }
        return response()->json(['message' => 'error obteniendo datos']);

    }

    public function set_track(Request $request)
    {
        $gbl_user = Auth::user()->username;
        $gbl_name = Auth::user()->nombre;
        $gbl_depto = Auth::user()->depto;

        $valid = true;
        $target = "";
        $message = "¡Los cambios se guardaron exitosamente!";
        $redirect = "";

        $request->ipt_id        = $this->clean_string(isset($request->ipt_id) ? $request->ipt_id : "");
        $request->ipt_comments  = $this->clean_string(isset($request->ipt_comments) ? $request->ipt_comments : "");
        $request->ipt_rel       = $this->clean_string(isset($request->ipt_rel) ? $request->ipt_rel : "");
        $request->ipt_action    = $this->clean_string(isset($request->ipt_action) ? $request->ipt_action : "");

        if(isset($gbl_user) && !empty($gbl_user))
        {
            if(empty($request->ipt_comments))
            {
                $message = "Por favor ingresa tus comentarios del porque autorizas o rechazas esta solicitud.";
                $valid = false;
                $target = "#ipt_comments";
            }
            elseif(empty($request->ipt_rel))
            {
                $message = "Por favor ingresa un tipo de relación entre los materiales.";
                $valid = false;
                $target = "#ipt_rel";
            }
            elseif(empty($request->ipt_action))
            {
                $message = "Por favor ingrese una acción valida.";
                $valid = false;
                $target = "#ipt_action";
            }
            elseif(empty($request->ipt_id))
            {
                $message = "Por favor NO modifique la id de la solicitud de liga.";
                $valid = false;
                $target = "#ipt_id";
            }
        }

        if($valid)
        {
            $depto_ing = "";
            $depto_mat = "";
            $depto_ven = "";

            if($gbl_depto == "INGENIERIA")
            {
                $id_status = 3;
                $depto_ing = 1;
            }
            elseif($gbl_depto == "MATERIALES")
            {
                $id_status = 3;
                $depto_mat = 1;
            }
            elseif($gbl_depto == "VENTAS")
            {
                $id_status = 3;
                $depto_ven = 1;
            }

            $insert_contribute  = Sustituto::insert_contribute($request->ipt_id, $request->ipt_comments, $request->ipt_rel, $request->ipt_action, $gbl_user, $gbl_depto, $id_status);

            if($insert_contribute['valid'])
            {
                $update_sol_gen = Sustituto::update_sol_gen($depto_ing, $depto_mat, $depto_ven, $request->ipt_id, $request->ipt_action);

                if($update_sol_gen['valid'])
                {
                    $redirect = $request->ipt_id;
                }
                else
                {
                    $message = "No se puede contribuir a la solicitud :: update_sol_gen, por favor contacte al departemento de sistemas. => ".$update_sol_gen['message'];
                    $valid = false;
                    $target = "#ipt_id";
                }
            }
            else
            {
                $message = "No se puede contribuir a la solicitud :: insert_contribute, por favor contacte al departemento de sistemas.";
                $valid = false;
                $target = "#ipt_id";
            }

        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        return redirect(url('/solicitudes-sustituto'));
    }

    public function cancel_sol(Request $request)
    {
        $user = Auth::user()->username;
        $depto = Auth::user()->depto;
        $valid = true;
        $target = "";
        $message = "¡Los cambios se guardaron exitosamente!";
        $redirect = "";

        $request->ipt_id        = $this->clean_string(isset($request->ipt_id) ? $request->ipt_id : "");
        $request->ipt_comments  = $this->clean_string(isset($request->ipt_comments) ? $request->ipt_comments : "");

        if(empty($request->ipt_id))
        {
            $message = "Por favor no modifiques la id de la solicitud.";
            $valid = false;
            $target = "#ipt_id";
        }
        elseif(empty($request->ipt_comments))
        {
            $message = "Por favor ingresea el porque estas cancelando la solicitud.";
            $valid = false;
            $target = "#ipt_comments";
        }

        if($valid)
        {
            Sustituto::cancel_sol($request->ipt_id, $user, $depto, $request->ipt_comments);
            $redirect = $request->ipt_id;
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        return redirect(url('/solicitudes-sustituto'));
    }
}
