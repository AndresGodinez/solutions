<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Menu;
use App\Models\TicketsAbiertosModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;
use Illuminate\Support\Str;
use App\Exports\SimpleExport;
use App\Utils\MyUtils;
use Maatwebsite\Excel\Facades\Excel;

date_default_timezone_set("America/Mexico_City");

class TicketsAbiertosController extends Controller
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

        return view("pages.tickets-abiertos.index", ['items' => $items]);
    }

    public function uploads()
    {
        $user       = Session::get('username');
        $items      = Menu::getMenu2($user);

        return view("pages.tickets-abiertos.uploads", ['items' => $items]);
    }

    // Carga para guias
    public function upload_tickets_abiertos_guias(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/cargas");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/guias/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\guias\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            TicketsAbiertosModel::truncate_table("tickets_abiertos_guias");

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 1) 
                {   
                    // most be insert
                    if(!empty($data[0]))
                    {
                        TicketsAbiertosModel::insert_load_data_guias($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    // Carga para pedidos
    public function upload_tickets_abiertos_pedidos(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/cargas");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/pedidos/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\pedidos\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            TicketsAbiertosModel::truncate_table("tickets_abiertos_pedidos");

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[0]))
                    {
                        TicketsAbiertosModel::insert_load_data_pedidos($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    // Carga para reservas
    public function upload_tickets_abiertos_reservas(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/cargas");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/reservas/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\reservas\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            TicketsAbiertosModel::truncate_table("tickets_abiertos_reservas");

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[0]))
                    {
                        TicketsAbiertosModel::insert_load_data_reservas($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    // Carga para pex
    public function upload_tickets_abiertos_pex(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/cargas");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/pex/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\pex\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            TicketsAbiertosModel::truncate_table("tickets_abiertos_pex");

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[22]))
                    {
                        TicketsAbiertosModel::insert_load_data_pex($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }
                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    // Carga para tickets
    public function upload_tickets_abiertos(Request $request)
    {
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/cargas");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/tickets-abiertos/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\tickets-abiertos\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            TicketsAbiertosModel::truncate_table("tickets_abiertos");

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[1]))
                    {
                        TicketsAbiertosModel::insert_load_data_tickets($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }

    // Carga para tickets servicios abiertos
    public function upload_tickets_servicios_abiertos(Request $request)
    {
        session_start();
        $user   = Session::get('username');
        $items  = Menu::getMenu2($user);
        $date   = date("Y-m-d");
        $file   = $request->file('file');    
        $valid = true;
        $redirect = url("tickets-abiertos/");

        if (!empty($file)) 
        {
            $final_file = Str::uuid().'.' . $file->getClientOriginalExtension();
            $file->storeAS('tickets-abiertos/tickets-servicios-abiertos/' . $date . '/', $final_file);
        } 
        else
        { 
            $valid = false;
            $redirect = url("tickets-abiertos/cargas");
        }

        if($valid)
        {
            $handle = fopen("D:inetpub\\wwwroot\\Soluciones2\\storage\\app\\tickets-abiertos\\tickets-servicios-abiertos\\".$date."\\".$final_file, "r+");
            $start = 0;
            
            $date_today = date("Y-m-d");

            if(!TicketsAbiertosModel::select_log($date_today))
            {
                TicketsAbiertosModel::insert_log($date_today, Session::get('username'));
                TicketsAbiertosModel::truncate_table("tickets_servicios_abiertos");
            }  

            while (($data = fgetcsv($handle)) !== FALSE) 
            {
                if($start > 0) 
                {   
                    // most be insert
                    if(!empty($data[1]))
                    {
                        TicketsAbiertosModel::insert_load_data_tickets_sa($data, Session::get('username'), date("Y-m-d H:i:s"));
                    }
                }

                $start++;
            };
        }

        echo '<script>window.location.href = "'.$redirect.'";</script>';
    }


    // Descarga de reportes.
    // Reporte de todos los regs.
    public function download_report_all()
    {
        $data = TicketsAbiertosModel::download_report_all_db();

        $head[] = array('Ticket', 
                            'Tipo de pago', 
                            'Estados CRM', 
                            'Subestado CRM', 
                            'Fecha de Creación del Ticket',
                            'Días abierto',
                            'Rango de días',
                            'Taller',
                            'Zona',
                            'Supervisor',
                            'Fecha de programación',
                            'Status (Centro de Soluciones)',
                            'ACP',
                            'Folio de Ingenieria',
                            'Pedido/Reserva',
                            'Fecha Pedido/Reserva',
                            'Tiempo Pedido/Reserva',
                            'Technician Id',
                            'Muebleria',
                            '#Numero de Guia',
                            '#Pedidos Abiertos');

        foreach ($data as $data) 
        {
           $results[] = array('Ticket' => $data['ticket_id'], 
                            'Tipo de pago' => $data['tipo_pago'], 
                            'Estados CRM' => $data['estado'], 
                            'Subestado CRM' => $data['sub_estado'], 
                            'Fecha de Creación del Ticket' => $data['fecha'],
                            'Días abierto' => $data['dias_abierto'],
                            'Rango de días' => $data['rango_dias'],
                            'Taller' => $data['taller'],
                            'Zona' => $data['zona'],
                            'Supervisor' => $data['supervisor'],
                            'Fecha de programación' => $data['fecha_programacion'],
                            'Status (Centro de Soluciones)' => $data['status_cs'],
                            'ACP' => $data['acp'],
                            'Folio de Ingenieria' => $data['ing'],
                            'Pedido/Reserva' => $data['ped_resrv'],
                            'Fecha Pedido/Reserva' => $data['ped_resrv_fecha'],
                            'Tiempo Pedido/Reserva' => $data['ped_resrv_dias'],
                            'Technician Id' => $data['technician_id'],
                            'Muebleria' => $data['muebleria'],
                            '#Numero de Guia' => $data['guia'],
                            '#Pedidos Abiertos' => $data['n_pedidos_abiertos']); 
        }

        $name = 'Servicios Abiertos';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        return Excel::download(new SimpleExport($head, $results), $fileName);
    }

    // Descarga de reportes por taller.
    public function download_report_taller(Request $request)
    {
        $data = TicketsAbiertosModel::download_report_taller_db($request->taller);

        $head[] = array('Ticket', 
                            'Tipo de pago', 
                            'Estados CRM', 
                            'Subestado CRM', 
                            'Fecha de Creación del Ticket',
                            'Días abierto',
                            'Rango de días',
                            'Taller',
                            'Zona',
                            'Supervisor',
                            'Fecha de programación',
                            'Status (Centro de Soluciones)',
                            'ACP',
                            'Folio de Ingenieria',
                            'Pedido/Reserva',
                            'Fecha Pedido/Reserva',
                            'Tiempo Pedido/Reserva',
                            'Technician Id',
                            'Muebleria',
                            '#Numero de Guia',
                            '#Pedidos Abiertos');

        foreach ($data as $data) 
        {
           $results[] = array('Ticket' => $data['ticket_id'], 
                            'Tipo de pago' => $data['tipo_pago'], 
                            'Estados CRM' => $data['estado'], 
                            'Subestado CRM' => $data['sub_estado'], 
                            'Fecha de Creación del Ticket' => $data['fecha'],
                            'Días abierto' => $data['dias_abierto'],
                            'Rango de días' => $data['rango_dias'],
                            'Taller' => $data['taller'],
                            'Zona' => $data['zona'],
                            'Supervisor' => $data['supervisor'],
                            'Fecha de programación' => $data['fecha_programacion'],
                            'Status (Centro de Soluciones)' => $data['status_cs'],
                            'ACP' => $data['acp'],
                            'Folio de Ingenieria' => $data['ing'],
                            'Pedido/Reserva' => $data['ped_resrv'],
                            'Fecha Pedido/Reserva' => $data['ped_resrv_fecha'],
                            'Tiempo Pedido/Reserva' => $data['ped_resrv_dias'],
                            'Technician Id' => $data['technician_id'],
                            'Muebleria' => $data['muebleria'],
                            '#Numero de Guia' => $data['guia'],
                            '#Pedidos Abiertos' => $data['n_pedidos_abiertos']); 
        }

        $name = 'Servicios Abiertos';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        return Excel::download(new SimpleExport($head, $results), $fileName);
    }

    // Descarga de reportes por antiguedad.
    public function download_report_antiguedad(Request $request)
    {
        $data = TicketsAbiertosModel::download_report_antiguedad_db($request->antiguedad);

        $head[] = array('Ticket', 
                            'Tipo de pago', 
                            'Estados CRM', 
                            'Subestado CRM', 
                            'Fecha de Creación del Ticket',
                            'Días abierto',
                            'Rango de días',
                            'Taller',
                            'Zona',
                            'Supervisor',
                            'Fecha de programación',
                            'Status (Centro de Soluciones)',
                            'ACP',
                            'Folio de Ingenieria',
                            'Pedido/Reserva',
                            'Fecha Pedido/Reserva',
                            'Tiempo Pedido/Reserva',
                            'Technician Id',
                            'Muebleria',
                            '#Numero de Guia',
                            '#Pedidos Abiertos');

        foreach ($data as $data) 
        {
           $results[] = array('Ticket' => $data['ticket_id'], 
                            'Tipo de pago' => $data['tipo_pago'], 
                            'Estados CRM' => $data['estado'], 
                            'Subestado CRM' => $data['sub_estado'], 
                            'Fecha de Creación del Ticket' => $data['fecha'],
                            'Días abierto' => $data['dias_abierto'],
                            'Rango de días' => $data['rango_dias'],
                            'Taller' => $data['taller'],
                            'Zona' => $data['zona'],
                            'Supervisor' => $data['supervisor'],
                            'Fecha de programación' => $data['fecha_programacion'],
                            'Status (Centro de Soluciones)' => $data['status_cs'],
                            'ACP' => $data['acp'],
                            'Folio de Ingenieria' => $data['ing'],
                            'Pedido/Reserva' => $data['ped_resrv'],
                            'Fecha Pedido/Reserva' => $data['ped_resrv_fecha'],
                            'Tiempo Pedido/Reserva' => $data['ped_resrv_dias'],
                            'Technician Id' => $data['technician_id'],
                            'Muebleria' => $data['muebleria'],
                            '#Numero de Guia' => $data['guia'],
                            '#Pedidos Abiertos' => $data['n_pedidos_abiertos']); 
        }

        $name = 'Servicios Abiertos';
        $extension = '.xlsx';

        $fileName = MyUtils::getName($name, $extension);

        return Excel::download(new SimpleExport($head, $results), $fileName);
    }
}
