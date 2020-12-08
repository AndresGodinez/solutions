<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SemaforoModel;
use Config;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

ini_set('memory_limit','2048M');

class Semaforo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Pedidos";
        $subtitle = "Servicios Abiertos";
        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        $data = array();

        $data = SemaforoModel::get_pedidos_os_abiertos();

        return view("pages.semaforo.index", ['items' => $items, 'data' => $data, 'title' => $title, 'subtitle' => $subtitle]);
    }

    public function pedidos_os_cerrados()
    {
        $title = "Pedidos";
        $subtitle = "Servicios Cerrados o No aplicables";

        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        $data = array();

        $data = SemaforoModel::get_pedidos_os_cerrados();

        return view("pages.semaforo.oscerrados", ['items' => $items, 'data' => $data, 'title' => $title, 'subtitle' => $subtitle]);
    }

    public function reservas_os_abiertos()
    {
        $title = "Reservas";
        $subtitle = "Servicios Abiertos";

        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        $data = array();

        $data = SemaforoModel::get_reservas_os_abiertos();

        return view("pages.semaforo.reservasosabiertos", ['items' => $items, 'data' => $data, 'title' => $title, 'subtitle' => $subtitle]);
    }

    public function reservas_os_cerrados()
    {
        $title = "Reservas";
        $subtitle = "Servicios Cerrados o No aplicables";

        $user = Session::get('username');
        $items = Menu::getMenu2($user);
        $data = array();

        $data = SemaforoModel::get_reservas_os_cerrados();

        return view("pages.semaforo.reservasoscerrados", ['items' => $items, 'data' => $data, 'title' => $title, 'subtitle' => $subtitle]);
    }
}
