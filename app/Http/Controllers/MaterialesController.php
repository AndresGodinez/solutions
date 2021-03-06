<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaMaterialesRequest;
use App\Http\Requests\GetDescriptionMaterialRequest;
use App\Http\Requests\SolicitudSustitutoRequest;
use App\Material;
use App\Sustituto;
use App\WpxLigasSustitutos;
use App\WpxLigasSustitutosLog;
use App\WpxSustitutos;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function compact;
use function is_null;
use function redirect;
use function route;
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

        $data = Sustituto::get_sol_by_id($id);

        $data_log = Sustituto::get_log_sol_by_id($id);

        $access = Sustituto::get_access(Auth::user()->username, Auth::user()->depto);

        return view("Sustitutos.detail", compact('data', 'data_log', 'access', 'user'));
    }

    public function search()
    {
        return view('Materiales/search');
    }

    public function cancel(Request $request)
    {
        $user = $request->user()->username;
        $depto = $request->user()->depto;
        $valid = true;
        $target = "";
        $message = "¡Los cambios se guardaron exitosamente!";
        $redirect = "";

        $request->ipt_id = $this->clean_string(isset($request->ipt_id) ? $request->ipt_id : "");
        $request->ipt_comments = $this->clean_string(isset($request->ipt_comments) ? $request->ipt_comments : "");

        if (empty($request->ipt_id)) {
            $message = "Por favor no modifiques la id de la solicitud.";
            $valid = false;
            $target = "#ipt_id";
        } elseif (empty($request->ipt_comments)) {
            $message = "Por favor ingresea el porque estas cancelando la solicitud.";
            $valid = false;
            $target = "#ipt_comments";
        }

        if ($valid) {
            Sustituto::cancel_sol($request->ipt_id, $user, $depto, $request->ipt_comments);
            $redirect = $request->ipt_id;
        }

        $response['message'] = $message;
        $response['valid'] = $valid;
        $response['target'] = $target;
        $response['redirect'] = $redirect;

        echo(json_encode($response));
    }


    public function consulta(ConsultaMaterialesRequest $request)
    {
        $material = Material::where('part_number', $request->get('ipt_material'))->first();
        $sustitutos = [];
        // Agregamos el gpo.
        $sustitutos_group_rel = DB::table('wpx_sustitutos')
            ->select('wpx_sustitutos.group_rel')
            ->where('wpx_sustitutos.material', $material->part_number)
            ->orWhere('wpx_sustitutos.sustituto', $material->part_number)
            ->get();

        if (count($sustitutos_group_rel)) {
            $sustitutos = DB::table('wpx_sustitutos')
                ->select(
                    'wpx_sustitutos.sustituto',
                    'wpx_sustitutos.sustituto_sug',
                    'wpx_sustitutos.rel',
                    'wpx_sustitutos.fecha_liga',
                    'materiales.part_description',
                    'materiales.part_dchain',
                    'materiales.rs01',
                    'materiales.rs02',
                    'materiales.rs03',
                    'materiales.rs04',
                    'materiales.rs05',
                    'materiales.rs06',
                    'materiales.rs10',
                    'materiales.vnr_sups',
                    'materiales.vnr_rams',
                    'materiales.vnr_cela',
                    'materiales.vnr_plai',
                    'materiales.vnr_hora'
                )->leftJoin('materiales', 'materiales.part_number', 'wpx_sustitutos.sustituto')->where('group_rel',
                    $sustitutos_group_rel[0]->group_rel)->get();
        }

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
        return view('Materiales/solicitud');
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }

    public function store(SolicitudSustitutoRequest $request)
    {
        $user = Auth::user();

        $material = Material::where('part_number', $request->get('ipt_componente'))->first();

        if (WpxLigasSustitutos::where('np', $material->part_number)->exists()) {
            $message = 'Ya existe una solicitud para este material '.$material->part_number;
            return redirect(route('materiales-sustitutos.index'))->with(['message' => $message]);
        }

        if (WpxSustitutos::where('material', $material->part_number)->exists()) {
            $sustituto = WpxSustitutos::where('material', $material->part_number)->latest()->first();
            $message = 'El componente ya cuenta con un sustituto es '.$sustituto->sustituto;
            return redirect(route('materiales-sustitutos.index'))->with(['message' => $message]);
        }

        $nSolicitud = WpxLigasSustitutos::create([
            'np' => $request->get('ipt_componente'),
            'id_status' => 1,
            'np_sust' => $request->get('ipt_componente_sust'),
            'np_sust_descr' => $request->get('ipt_componente_sust_descr'),
            'depto_ing' => 0,
            'depto_mat' => 0,
            'depto_ven' => 0,
            'usr_request' => $user->username,
            'usr_depto' => $user->depto,
            'modelo' => $request->get('modelo'),
            'taller' => $request->get('taller'),
            'no_dispatch' => $request->get('no_dispatch'),
            'proveedor' => $request->get('proveedor'),
            'created_at' => Carbon::now()
        ]);

        WpxLigasSustitutosLog::create([
            'id_sol' => $nSolicitud->id,
            'modify_by' => $user->username,
            'id_status' => 1,
            'depto' => $user->depto,
            'comments' => 'Se crea la solicitud',
            'modify_date' => Carbon::now()
        ]);

        $message = "¡Los cambios se guardaron exitosamente!";

        return redirect(route('materiales-sustitutos.index'))->with(['message' => $message]);

    }

    public function get_description_by_np(GetDescriptionMaterialRequest $request)
    {
        $material = Material::where('part_number', $request->get('ipt_componente'))->first();

        if (is_null($material)) {
            $message = "No se puede generar una solicitud ya que el Componente que
            requiere sustituto no existe o no esta dado de alta en SAP.";

            $response['message'] = $message;
            $response['valid'] = false;
//            $response['target'] = '#ipt_componente';

        } else {
            if (WpxSustitutos::where('material', $material->part_number)->exists()) {
                $sustituto = WpxSustitutos::where('material', $material->part_number)->latest()->first();

                $response['valid'] = false;
                $response['message'] = 'El componente ya cuenta con un sustituto es '.$sustituto->sustituto;

            } elseif (WpxLigasSustitutos::where('np', $material->part_number)->exists()) {
                $response['valid'] = false;
                $response['message'] = 'El componente ya cuenta con una solicitud';
            } else {
                $response['valid'] = true;
                $response['message'] = '';
                $response['np_description'] = !!$material->part_description
                    ? $material->part_description
                    : 'encontrado, no tiene descripción';
            }

        }


        return view('Sustitutos.Partials.get_description_by_np', compact('response'));
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

        $request->ipt_id = $this->clean_string(isset($request->ipt_id) ? $request->ipt_id : "");
        $request->ipt_comments = $this->clean_string(isset($request->ipt_comments) ? $request->ipt_comments : "");
        $request->ipt_rel = $this->clean_string(isset($request->ipt_rel) ? $request->ipt_rel : "");
        $request->ipt_action = $this->clean_string(isset($request->ipt_action) ? $request->ipt_action : "");

        if (isset($gbl_user) && !empty($gbl_user)) {
            if (empty($request->ipt_comments)) {
                $message = "Por favor ingresa tus comentarios del porque autorizas o rechazas esta solicitud.";
                $valid = false;
                $target = "#ipt_comments";
            } elseif (empty($request->ipt_rel)) {
                $message = "Por favor ingresa un tipo de relación entre los materiales.";
                $valid = false;
                $target = "#ipt_rel";
            } elseif (empty($request->ipt_action)) {
                $message = "Por favor ingrese una acción valida.";
                $valid = false;
                $target = "#ipt_action";
            } elseif (empty($request->ipt_id)) {
                $message = "Por favor NO modifique la id de la solicitud de liga.";
                $valid = false;
                $target = "#ipt_id";
            }
        }

        if ($valid) {
            $depto_ing = "";
            $depto_mat = "";
            $depto_ven = "";

            if ($gbl_depto == "INGENIERIA") {
                $id_status = 3;
                $depto_ing = 1;
            } elseif ($gbl_depto == "MATERIALES") {
                $id_status = 3;
                $depto_mat = 1;
            } elseif ($gbl_depto == "VENTAS") {
                $id_status = 3;
                $depto_ven = 1;
            }

            $insert_contribute = Sustituto::insert_contribute($request->ipt_id, $request->ipt_comments,
                $request->ipt_rel, $request->ipt_action, $gbl_user, $gbl_depto, $id_status);

            if ($insert_contribute['valid']) {
                $update_sol_gen = Sustituto::update_sol_gen($depto_ing, $depto_mat, $depto_ven, $request->ipt_id,
                    $request->ipt_action);

                if ($update_sol_gen['valid']) {
                    $redirect = $request->ipt_id;
                } else {
                    $message = "No se puede contribuir a la solicitud :: update_sol_gen, por favor contacte al departemento de sistemas. => ".$update_sol_gen['message'];
                    $valid = false;
                    $target = "#ipt_id";
                }
            } else {
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

        $request->ipt_id = $this->clean_string(isset($request->ipt_id) ? $request->ipt_id : "");
        $request->ipt_comments = $this->clean_string(isset($request->ipt_comments) ? $request->ipt_comments : "");

        if (empty($request->ipt_id)) {
            $message = "Por favor no modifiques la id de la solicitud.";
            $valid = false;
            $target = "#ipt_id";
        } elseif (empty($request->ipt_comments)) {
            $message = "Por favor ingresea el porque estas cancelando la solicitud.";
            $valid = false;
            $target = "#ipt_comments";
        }

        if ($valid) {
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
