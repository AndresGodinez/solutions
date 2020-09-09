<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Sustituto extends Model
{
    protected $table = 'wpx_sustitutos';

    public $timestamps = false;

    // Get all records.
    public static function get_all_sol_records($type)
    {
        $data = [];

        if($type == 1)
        {
            $data = DB::table('wpx_ligas_sustitutos')->select('wpx_ligas_sustitutos.*',
                'wpx_ligas_sustitutos_status.status as status')
                ->whereRaw('wpx_ligas_sustitutos.id_status in (1,3)')
                ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=', 'wpx_ligas_sustitutos.id_status')
                ->get();
        }
        elseif($type == 2)
        {
            $data = DB::table('wpx_ligas_sustitutos')->select('wpx_ligas_sustitutos.*',
                'wpx_ligas_sustitutos_status.status as status')
                ->whereRaw('wpx_ligas_sustitutos.id_status in (2,4,5)')
                ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=', 'wpx_ligas_sustitutos.id_status')
                ->get();
        }
        return $data;
    }

    // Consulto la validación de la refacción que requiere sustituto.
    public static function validate_master_data($np)
    {
        $valid = true;
        $np_description = "";
        $response = array();

        $data = DB::table('materiales')->select('part_description')
            ->where('part_number', '=', $np)
            ->get();

        if(!empty($data[0]->part_description))
        {
            $np_description = $data[0]->part_description;
        }
        else
        {
            $valid = false;
        }

        $response['valid'] = $valid;
        $response['np_description'] = $np_description;

        return $response;
    }

    // Validamos ya existe una liga smilar
    public static function validate_if_exist_liga($np, $np_sust)
    {
        $data = DB::table('wpx_ligas_sustitutos')
            ->select('np')
            ->whereRaw("np = '".$np."' and np_sust = '".$np_sust."'")
            ->get();

        if(!empty($data[0]->np))
        {
            $result = false;
        }
        else
        {
            $result = true;
        }

        return $result;
    }

    public static function create_solicitud($np, $np_sust, $np_sust_descr, $username, $user_depto)
    {
        $valid 		= true;
        $message 	= "";
        $id 		= "";
        $response = array();

        if(!empty($username))
        {
            $created_at = date("Y-m-d H:i:s");
            $id = DB::table('wpx_ligas_sustitutos')->insertGetId(
                ['np' 			=> $np,
                    'id_status'     => 1,
                    'np_sust' 		=> $np_sust,
                    'np_sust_descr' => $np_sust_descr,
                    'depto_ing' 	=> 0,
                    'depto_mat' 	=> 0,
                    'depto_ven' 	=> 0,
                    'usr_request' 	=> $username,
                    'usr_depto'		=> $user_depto,
                    'created_at' 	=> $created_at]
            );
        }
        else
        {
            $valid 		= false;
            $message 	= "Por favor vuelve a Iniciar Sesión ya que tu sesión ya expiro.";
            $id 		= "";
        }

        $response['valid'] = $valid;
        $response['message'] = $message;
        $response['id'] = $id;

        return $response;
    }

    public static function insert_log($id, $id_status, $modify_by, $depto, $comments)
    {
        $valid 		= true;
        $message 	= "";
        $response = array();

        if(!empty($id))
        {
            $modify_date = date("Y-m-d H:i:s");
            DB::table('wpx_ligas_sustitutos_log')->insert(
                ['id_sol' 		=> $id,
                    'modify_by' 	=> $modify_by,
                    'id_status'     => $id_status,
                    'depto'         => $depto,
                    'comments'      => $comments,
                    'modify_date' 	=> $modify_date]
            );
        }
        else
        {
            $valid 		= false;
            $message 	= "Hubo un error con la id insertada, favor de levantar de nuevo la solicitud, si se perciste este problema favor de contactar a sistemas.";
        }

        $response['valid'] = $valid;
        $response['message'] = $message;

        return $response;
    }

    // Get all records.
    public static function get_sol_by_id($id)
    {
        return DB::table('wpx_ligas_sustitutos')->select('wpx_ligas_sustitutos.*',
            'wpx_ligas_sustitutos_status.status as status',
            'usuarios.nombre as nombre',
            'usuarios.depto as depto')
            ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=', 'wpx_ligas_sustitutos.id_status')
            ->join('usuarios', 'usuarios.username', '=', 'wpx_ligas_sustitutos.usr_request')
            ->where('wpx_ligas_sustitutos.id', $id)
            ->get();
    }

    public static function get_log_sol_by_id($id)
    {
        return DB::table('wpx_ligas_sustitutos_log')->select('wpx_ligas_sustitutos_log.*',
            'wpx_ligas_sustitutos_status.status as status',
            'usuarios.nombre as nombre')
            ->join('wpx_ligas_sustitutos_status', 'wpx_ligas_sustitutos_status.id_status', '=', 'wpx_ligas_sustitutos_log.id_status')
            ->join('usuarios', 'usuarios.username', '=', 'wpx_ligas_sustitutos_log.modify_by')
            ->where('wpx_ligas_sustitutos_log.id_sol', $id)
            ->orderByRaw('modify_date DESC')
            ->get();
    }

    public static function get_access($username, $depto)
    {
        return DB::table('wpx_ligas_sustitutos_vobo')->select('wpx_ligas_sustitutos_vobo.*')
            ->whereRaw('wpx_ligas_sustitutos_vobo.username = "'.$username.'" AND depto = "'.$depto.'"')
            ->get();
    }

    public static function insert_contribute($id, $comments, $rel, $action, $modify_by, $depto, $id_status)
    {

        $valid      = true;
        $message    = "";
        $response = array();

        if(!empty($id))
        {
            $modify_date = date("Y-m-d H:i:s");
            if($rel == 3)
            {
                DB::table('wpx_ligas_sustitutos_log')->insert(
                    ['id_sol'       => $id,
                        'id_status'     => $id_status,
                        'modify_by'     => $modify_by,
                        'depto'         => $depto,
                        'comments'      => $comments,
                        'modify_date'   => $modify_date,
                        'action'        => $action]
                );
            }
            else
            {
                DB::table('wpx_ligas_sustitutos_log')->insert(
                    ['id_sol'       => $id,
                        'id_status'     => $id_status,
                        'modify_by'     => $modify_by,
                        'depto'         => $depto,
                        'comments'      => $comments,
                        'modify_date'   => $modify_date,
                        'rel'           => $rel,
                        'action'        => $action]
                );
            }
        }
        else
        {
            $valid      = false;
            $message    = "Hubo un error con la id insertada, favor de levantar de nuevo la solicitud, si se perciste este problema favor de contactar a sistemas.";
        }

        $response['valid'] = $valid;
        $response['message'] = $message;

        return $response;
    }

    public static function update_sol_gen($depto_ing, $depto_mat, $depto_ven, $id, $action)
    {
        $status_ing = "";
        $status_mat = "";
        $status_ven = "";
        $valid = true;
        $message = "";
        $response = array();

        if($action == "Rechazar")
        {
            $id_status = 5;
            if(DB::table('wpx_ligas_sustitutos')
                ->where('id', $id)
                ->update(   ['id_status'     => $id_status]))
            {
                $valid = true;
            }
            else
            {
                $valid      = false;
                $message    = "Hubo un error en actualizar el trackin depto_mat, contactar a Sistemas.";
            }

            $modify_date = date("Y-m-d H:i:s");
            $comments = "Solicitud rechazada correctamente";
            $modify_by = "System";
            $depto = $modify_by;
            DB::table('wpx_ligas_sustitutos_log')->insert(
                ['id_sol'       => $id,
                    'modify_by'     => $modify_by,
                    'id_status'     => $id_status,
                    'depto'         => $depto,
                    'comments'      => $comments,
                    'modify_date'   => $modify_date]
            );
        }
        else
        {
            $id_status = 3;

            if(!empty($depto_ing))
            {
                if(DB::table('wpx_ligas_sustitutos')
                    ->where('id', $id)
                    ->update(   ['depto_ing'    => $depto_ing,
                        'id_status'     => $id_status]))
                {
                    $valid = true;
                }
                else
                {
                    $valid      = false;
                    $message    = "Hubo un error en actualizar el trackin depto_ing, contactar a Sistemas.";
                }
            }
            elseif(!empty($depto_mat))
            {
                if(DB::table('wpx_ligas_sustitutos')
                    ->where('id', $id)
                    ->update(   ['depto_mat'    => $depto_mat,
                        'id_status'     => $id_status]))
                {
                    $valid = true;
                }
                else
                {
                    $valid      = false;
                    $message    = "Hubo un error en actualizar el trackin depto_mat, contactar a Sistemas.";
                }
            }
            elseif(!empty($depto_ven))
            {
                if(DB::table('wpx_ligas_sustitutos')
                    ->where('id', $id)
                    ->update(   ['depto_ven'    => $depto_ven,
                        'id_status'     => $id_status]))
                {
                    $valid = true;
                }
                else
                {
                    $valid      = false;
                    $message    = "Hubo un error en actualizar el trackin depto_ven, contactar a Sistemas.";
                }
            }

            $data = DB::table('wpx_ligas_sustitutos')->select('wpx_ligas_sustitutos.depto_ing',
                'wpx_ligas_sustitutos.depto_mat',
                'wpx_ligas_sustitutos.depto_ven')
                ->where('wpx_ligas_sustitutos.id', $id)
                ->get();

            $update_aproved_ing = false;
            $update_aproved_mat = false;
            $update_aproved_ven = false;

            foreach ($data as $data)
            {
                if($data->depto_ing == 1)
                {
                    $update_aproved_ing = true;
                }

                if($data->depto_mat == 1)
                {
                    $update_aproved_mat = true;
                }

                if($data->depto_ven == 1)
                {
                    $update_aproved_ven = true;
                }
            }

            if($update_aproved_ing == true && $update_aproved_mat == true && $update_aproved_ven == true)
            {
                $id_status = 4;
                if(DB::table('wpx_ligas_sustitutos')
                    ->where('id', $id)
                    ->update(   ['id_status'     => $id_status]))
                {
                    $valid = true;
                }
                else
                {
                    $valid      = false;
                    $message    = "Hubo un error en actualizar el trackin depto_mat, contactar a Sistemas.";
                }

                $modify_date = date("Y-m-d H:i:s");
                $comments = "Solicitud aprovada correctamente";
                $modify_by = "System";
                $depto = $modify_by;
                DB::table('wpx_ligas_sustitutos_log')->insert(
                    ['id_sol'       => $id,
                        'modify_by'     => $modify_by,
                        'id_status'     => $id_status,
                        'depto'         => $depto,
                        'comments'      => $comments,
                        'modify_date'   => $modify_date]
                );
            }
        }


        $response['valid'] = $valid;
        $response['message'] = $message;

        return $response;
    }

    public static function cancel_sol($id, $user, $depto, $comments)
    {
        $modify_date = date("Y-m-d H:i:s");
        $modify_by = $user;
        $id_status = 2;

        DB::table('wpx_ligas_sustitutos_log')->insert(
            ['id_sol'       => $id,
                'modify_by'     => $modify_by,
                'id_status'     => $id_status,
                'depto'         => $depto,
                'comments'      => $comments,
                'modify_date'   => $modify_date]
        );

        DB::table('wpx_ligas_sustitutos')
            ->where('id', $id)
            ->update(   ['id_status'     => $id_status]);
    }

}
