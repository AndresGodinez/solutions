<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use DateTime;

date_default_timezone_set("America/Mexico_City");

class SemaforoModel extends ModelBase
{
    public static function get_all_records($exception_tp)
    {
        $final_data = array();

        if(empty($exception_tp))
        {
            $data = SemaforoModel::select('semaforo_tickets.*')
                        ->from('semaforo_tickets') 
                        ->get();
            
            $final_data['count'] = count($data);
            $final_data['count_kmodel'] = 0;
            $final_data['count_25days'] = 0;
            $final_data['count_25_15days'] = 0;
            $final_data['count_15days'] = 0;
            
            foreach ($data as $key) 
            {
                $date_one = new DateTime($key['pedido_reserva_date']);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                
                if(substr($key->model, 0, 1) == "K")
                {
                    $final_data['count_kmodel']++;
                }
                elseif($diff->days > 25)
                {
                    $final_data['count_25days']++;
                }
                elseif($diff->days <= 25 && $diff->days > 15)
                {
                    $final_data['count_25_15days']++;
                }
                elseif($diff->days <= 15)
                {
                    $final_data['count_15days']++;
                }
            }
        }
        else
        {
            $data = SemaforoModel::select('semaforo_tickets.*')
                        ->from('semaforo_tickets')
                        ->where('tp', $exception_tp)
                        ->get();

            $final_data['count'] = count($data);
            $final_data['count_kmodel'] = 0;
            $final_data['count_25days'] = 0;
            $final_data['count_25_15days'] = 0;
            $final_data['count_15days'] = 0;
            
            foreach ($data as $key) 
            {
                $date_one = new DateTime($key['pedido_reserva_date']);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                
                if(substr($key->model, 0, 1) == "K")
                {
                    $final_data['count_kmodel']++;
                }
                elseif($diff->days > 25)
                {
                    $final_data['count_25days']++;
                }
                elseif($diff->days <= 25 && $diff->days > 15)
                {
                    $final_data['count_25_15days']++;
                }
                elseif($diff->days <= 15)
                {
                    $final_data['count_15days']++;
                }
            }
        }
        
        return $final_data;
    }

    public static function get_all_records_list($exception_tp)
    {
        if(empty($exception_tp))
        {
            $data = SemaforoModel::select('semaforo_tickets.*')
                        ->from('semaforo_tickets') 
                        ->get();

            $data_filtered = array();
            $pos_k = 0;
            $pos_25 = 0;
            $pos_25_15 = 0;
            $pos_15 = 0;

            foreach ($data as $key) 
            {
                $date_one = new DateTime($key['pedido_reserva_date']);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                
                if(substr($key->model, 0, 1) == "K")
                {
                    $data_filtered[0][$pos_k]['ticket'] = $key->ticket;
                    $data_filtered[0][$pos_k]['sub_status'] = $key->sub_status;
                    $data_filtered[0][$pos_k]['payment_type'] = $key->payment_type;
                    $data_filtered[0][$pos_k]['tp'] = $key->tp;
                    $data_filtered[0][$pos_k]['model'] = $key->model;
                    $data_filtered[0][$pos_k]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[0][$pos_k]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[0][$pos_k]['diff_days'] = $diff->days;
                    $data_filtered[0][$pos_k]['style'] = "background: red;";
                    $pos_k++;
                }
                elseif($diff->days > 25)
                {
                    $data_filtered[1][$pos_25]['ticket'] = $key->ticket;
                    $data_filtered[1][$pos_25]['sub_status'] = $key->sub_status;
                    $data_filtered[1][$pos_25]['payment_type'] = $key->payment_type;
                    $data_filtered[1][$pos_25]['tp'] = $key->tp;
                    $data_filtered[1][$pos_25]['model'] = $key->model;
                    $data_filtered[1][$pos_25]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[1][$pos_25]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[1][$pos_25]['diff_days'] = $diff->days;
                    $data_filtered[1][$pos_25]['style'] = "background: red;";
                    $pos_25++; 
                }
                elseif($diff->days <= 25 && $diff->days > 15)
                {
                    $data_filtered[2][$pos_25_15]['ticket'] = $key->ticket;
                    $data_filtered[2][$pos_25_15]['sub_status'] = $key->sub_status;
                    $data_filtered[2][$pos_25_15]['payment_type'] = $key->payment_type;
                    $data_filtered[2][$pos_25_15]['tp'] = $key->tp;
                    $data_filtered[2][$pos_25_15]['model'] = $key->model;
                    $data_filtered[2][$pos_25_15]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[2][$pos_25_15]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[2][$pos_25_15]['diff_days'] = $diff->days;
                    $data_filtered[2][$pos_25_15]['style'] = "background: yellow;";
                    $pos_25_15++;
                }
                elseif($diff->days <= 15)
                {
                    $data_filtered[3][$pos_15]['ticket'] = $key->ticket;
                    $data_filtered[3][$pos_15]['sub_status'] = $key->sub_status;
                    $data_filtered[3][$pos_15]['payment_type'] = $key->payment_type;
                    $data_filtered[3][$pos_15]['tp'] = $key->tp;
                    $data_filtered[3][$pos_15]['model'] = $key->model;
                    $data_filtered[3][$pos_15]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[3][$pos_15]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[3][$pos_15]['diff_days'] = $diff->days;
                    $data_filtered[3][$pos_15]['style'] = "background: green;";
                    $pos_15++;
                }
            }

            $data_filtered[4][0]['pos_k'] = $pos_k - 1;
            $data_filtered[4][0]['pos_25'] = $pos_25 - 1;
            $data_filtered[4][0]['pos_25_15'] = $pos_25_15 - 1;
            $data_filtered[4][0]['pos_15'] = $pos_15 - 1;
        }
        else
        {
            $data = SemaforoModel::select('semaforo_tickets.*')
                        ->from('semaforo_tickets')
                        ->where('tp', $exception_tp)
                        ->get();

            $data_filtered = array();
            $pos_k = 0;
            $pos_25 = 0;
            $pos_25_15 = 0;
            $pos_15 = 0;

            foreach ($data as $key) 
            {
                $date_one = new DateTime($key['pedido_reserva_date']);
                $date_two = new DateTime(date("Y-m-d"));
                $diff = $date_one->diff($date_two);
                
                if(substr($key->model, 0, 1) == "K")
                {
                    $data_filtered[0][$pos_k]['ticket'] = $key->ticket;
                    $data_filtered[0][$pos_k]['sub_status'] = $key->sub_status;
                    $data_filtered[0][$pos_k]['payment_type'] = $key->payment_type;
                    $data_filtered[0][$pos_k]['tp'] = $key->tp;
                    $data_filtered[0][$pos_k]['model'] = $key->model;
                    $data_filtered[0][$pos_k]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[0][$pos_k]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[0][$pos_k]['diff_days'] = $diff->days;
                    $data_filtered[0][$pos_k]['style'] = "background: red;";
                    $pos_k++;
                }
                elseif($diff->days > 25)
                {
                    $data_filtered[1][$pos_25]['ticket'] = $key->ticket;
                    $data_filtered[1][$pos_25]['sub_status'] = $key->sub_status;
                    $data_filtered[1][$pos_25]['payment_type'] = $key->payment_type;
                    $data_filtered[1][$pos_25]['tp'] = $key->tp;
                    $data_filtered[1][$pos_25]['model'] = $key->model;
                    $data_filtered[1][$pos_25]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[1][$pos_25]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[1][$pos_25]['diff_days'] = $diff->days;
                    $data_filtered[1][$pos_25]['style'] = "background: red;";
                    $pos_25++; 
                }
                elseif($diff->days <= 25 && $diff->days > 15)
                {
                    $data_filtered[2][$pos_25_15]['ticket'] = $key->ticket;
                    $data_filtered[2][$pos_25_15]['sub_status'] = $key->sub_status;
                    $data_filtered[2][$pos_25_15]['payment_type'] = $key->payment_type;
                    $data_filtered[2][$pos_25_15]['tp'] = $key->tp;
                    $data_filtered[2][$pos_25_15]['model'] = $key->model;
                    $data_filtered[2][$pos_25_15]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[2][$pos_25_15]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[2][$pos_25_15]['diff_days'] = $diff->days;
                    $data_filtered[2][$pos_25_15]['style'] = "background: yellow;";
                    $pos_25_15++;
                }
                elseif($diff->days <= 15)
                {
                    $data_filtered[3][$pos_15]['ticket'] = $key->ticket;
                    $data_filtered[3][$pos_15]['sub_status'] = $key->sub_status;
                    $data_filtered[3][$pos_15]['payment_type'] = $key->payment_type;
                    $data_filtered[3][$pos_15]['tp'] = $key->tp;
                    $data_filtered[3][$pos_15]['model'] = $key->model;
                    $data_filtered[3][$pos_15]['pedido_reserva'] = $key->pedido_reserva;
                    $data_filtered[3][$pos_15]['pedido_reserva_date'] = $key->pedido_reserva_date;
                    $data_filtered[3][$pos_15]['diff_days'] = $diff->days;
                    $data_filtered[3][$pos_15]['style'] = "background: green;";
                    $pos_15++;
                }
            }

            $data_filtered[4][0]['pos_k'] = $pos_k - 1;
            $data_filtered[4][0]['pos_25'] = $pos_25 - 1;
            $data_filtered[4][0]['pos_25_15'] = $pos_25_15 - 1;
            $data_filtered[4][0]['pos_15'] = $pos_15 - 1;
        }
        
        return $data_filtered;
    }

    public static function get_all_records_stocks_final($id_region)
    {
        $data = SemaforoModel::select('stock_gral_serv.*')
                        ->from('stock_gral_serv')
                        ->get();
        
        return $data;
    }

    public static function ifExistTicket($ticket)
    {
        $valid = false;
        $data = SemaforoModel::select('semaforo_tickets.*')
                        ->from('semaforo_tickets')
                        ->where('ticket', $ticket)
                        ->get();
        
        if(count($data) > 0)
        {
            $valid = true;
        }

        return $valid;
    }

    public static function ifExistDateOfPedido($pedido)
    {
        $date = NULL;
        $data = SemaforoModel::select('pedidos.pedido_date')
                        ->from('pedidos')
                        ->where('pedido', $pedido)
                        ->get();
        
        if(count($data) == 0)
        {
            $data = SemaforoModel::select('reservas.req_date')
                        ->from('reservas')
                        ->where('reservation', $pedido)
                        ->get();

            if(count($data) > 0)
            {
                $date = $data[0]->req_date;
            }
        }
        else
        {
            $date = $data[0]->pedido_date;
        }

        return $date;
    }

    public static function insert_load($ticket, $sub_status, $payment_type, $tp, $model, $pedido_reserva, $pedido_reserva_date, $username, $date)
    {
        DB::table('semaforo_tickets')->insert(
            ['ticket'               => $ticket, 
            'sub_status'            => $sub_status,
            'payment_type'          => $payment_type,
            'tp'                    => $tp,
            'model'                 => $model,
            'pedido_reserva'        => $pedido_reserva,
            'pedido_reserva_date'   => $pedido_reserva_date,
            'username'              => $username,
            'created_at'            => $date,
            'updated_at'            => $date]);
    }

    public static function update_load($ticket, $sub_status, $payment_type, $tp, $model, $pedido_reserva, $pedido_reserva_date, $username, $date)
    {
        DB::table('semaforo_tickets')
            ->where('ticket', $ticket)
            ->update(   ['sub_status'        => $sub_status,
            'payment_type'          => $payment_type,
            'tp'                    => $tp,
            'model'                 => $model,
            'pedido_reserva'        => $pedido_reserva,
            'pedido_reserva_date'   => $pedido_reserva_date,
            'username'              => $username,
            'updated_at'            => $date]);
    }
}
