<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\StocksModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


date_default_timezone_set("America/Mexico_City");

class StocksController extends Controller
{
    public $dirupload =  "\\storage\\app\\";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Stocks inicial
    public function index()
    {

        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $get_records = StocksModel::get_all_records($user, $id_region);
        return view("Stocks.index", ['get_records' => $get_records]);
    }


    public function descarga(Request $request)
    {

        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;

        set_time_limit(0);
        ini_set('memory_limit', '1000M');
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');


        if ($request->id == "1") {
            header('Content-Disposition: attachment; filename=REPORTE STOCK INICIAL.xls');
            $get_records = StocksModel::get_all_records($user, $id_region);
            return view("Stocks.descargageneral_inicial", ['get_records' => $get_records]);
        }
        if ($request->id == "2") {
            header('Content-Disposition: attachment; filename=REPORTE STOCK INICIAL PENDIENTE.xls');
            $get_records = StocksModel::get_all_records_pending_list($id_region);
            return view("Stocks.descargageneral_inicial", ['get_records' => $get_records]);
        }
        if ($request->id == "3") {
            header('Content-Disposition: attachment; filename=REPORTE STOCK FINAL.xls');
            $get_records = StocksModel::get_all_records_stocks_final($user, $id_region);
            return view("Stocks.descargageneral_final", ['get_records' => $get_records]);
        }
        if ($request->id == "4") {
            header('Content-Disposition: attachment; filename=REPORTE STOCK FINAL PENDIENTE.xls');
            $get_records = StocksModel::get_all_records_pending_list_stocks_final($id_region);
            return view("Stocks.descargageneral_final", ['get_records' => $get_records]);
        }
    }

    public function indexPendingList()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;


        $get_records = StocksModel::get_all_records_pending_list($id_region);

        return view("stocks.indexPendingList", ['get_records' => $get_records]);
    }

    public function detail(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;

        $data       = StocksModel::get_records_by_id($request->id);
        $data_isc   = StocksModel::get_records_by_id_isc($request->id);

        return view("Stocks.detail", ['data' => $data, 'data_isc' => $data_isc]);
    }

    public function uploads()
    {
        $user       = Auth::user()->username;
        $items      = Menu::getMenu2($user);

        return view("stocks.uploads");
    }

    // Carga para stocks iniciales
    public function upload_stock_inicial(Request $request)
    {
        $user       = Auth::user()->username;

        $date   = date("Y-m-d");
        $file   = $request->file('file');
        $valid = true;
        $redirect = url("stocks/");

        if (!empty($file)) {
            $final_file = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAS('stock-inicial/c/' . $date . '/', $final_file);
        } else {
            $valid = false;
            $redirect = url("stocks/cargas/");
        }

        if ($valid) {
            $handle = fopen(base_path() . $this->dirupload . "stock-inicial\\c\\" . $date . "\\" . $final_file, "r+");
            $start = 0;

            while (($data = fgetcsv($handle)) !== FALSE) {
                if ($start > 1) {
                    // most be insert
                    StocksModel::insert_load($data, Auth::user()->username, date("Y-m-d H:i:s"));
                }

                $start++;
            };

            // Envio de correo alerta por id_region gente ISC.
        }

        echo '<script>window.location.href = "' . $redirect . '";</script>';
    }

    // Carga para stocks iniciales (conclusion ISC)
    public function upload_stock_inicial_isc(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;
        $redirect = url("stocks/");
        $date = date("Y-m-d");
        $file = $request->file('file');

        if (!empty($file)) {
            $final_file = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAS('stock-inicial/c/' . $date . '/', $final_file);
        } else {
            $final_file = '';
        }

        $handle = fopen(base_path() . $this->dirupload . "stock-inicial\\c\\" . $date . "\\" . $final_file, "r+");
        $start = 0;
        while (($data = fgetcsv($handle)) !== FALSE) {
            if ($start != 0) {
                // folio,  material, modelo,   po,      comentarios,    user,               fecha,          region
                StocksModel::update_stocks_iniciales_isc($data[0], $data[1], $data[2], $data[3], $data[4], $user, date("Y-m-d"), $id_region);
            }

            $start++;
        };

        echo '<script>window.location.href = "' . $redirect . '";</script>';
    }

    // Stocks inicial
    public function index_stocks_final()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;


        $get_records = StocksModel::get_all_records_stocks_final($user, $id_region);

        return view("Stocks.indexStocksFinal", ['get_records' => $get_records]);
    }

    public function indexPendingList_stocks_final()
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;


        $get_records = StocksModel::get_all_records_pending_list_stocks_final($id_region);

        return view("Stocks.indexPendingListStocksFinal", ['get_records' => $get_records]);
    }

    public function detail_stocks_final(Request $request)
    {
        $user       = Auth::user()->username;
        $id_region  = Auth::user()->id_region;

        $data       = StocksModel::get_records_by_id_stocks_final($request->id);
        $data_isc   = StocksModel::get_records_by_id_isc_stocks_final($request->id);

        return view("Stocks.detailStocksFinal", ['data' => $data, 'data_isc' => $data_isc]);
    }

    public function uploads_stocks_final()
    {
        $user       = Auth::user()->username;



        return view("Stocks.uploads");
    }

    // Carga para stocks iniciales
    public function upload_stock_final(Request $request)
    {
        $user       = Auth::user()->username;


        $date   = date("Y-m-d");
        $file   = $request->file('file');
        $valid = true;
        $redirect = url("stocks/final/");

        if (!empty($file)) {
            $final_file = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAS('stock-final/c/' . $date . '/', $final_file);
        } else {
            $valid = false;
            $redirect = url("stocks/cargas/");
        }

        if ($valid) {
            $handle = fopen(base_path() . $this->dirupload . "stock-final\\c\\" . $date . "\\" . $final_file, "r+");
            $start = 0;

            while (($data = fgetcsv($handle)) !== FALSE) {
                if ($start > 1) {
                    // most be insert
                    StocksModel::insert_load_stocks_final($data, $user, date("Y-m-d H:i:s"));
                }

                $start++;
            };

            // Envio de correo alerta por id_region gente ISC.
        }

        echo '<script>window.location.href = "' . $redirect . '";</script>';
    }

    // Carga para stocks iniciales (conclusion ISC)
    public function upload_stock_final_isc(Request $request)
    {
        $redirect = url("stocks/final/");
        $date = date("Y-m-d");
        $file = $request->file('file');

        if (!empty($file)) {
            $final_file = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAS('stock-final/c/' . $date . '/', $final_file);
        } else {
            $final_file = '';
        }

        $handle = fopen(base_path() . $this->dirupload . "stock-final\\c\\" . $date . "\\" . $final_file, "r+");
        $start = 0;
        while (($data = fgetcsv($handle)) !== FALSE) {
            if ($start != 0) {
                // folio,  material, modelo,   po,      comentarios,    user,               fecha,          region
                StocksModel::update_stocks_final_isc($data[0], $data[1], $data[2], $data[3], $data[4], Auth::user()->username, date("Y-m-d"), Auth::user()->id_region);
            }

            $start++;
        };

        echo '<script>window.location.href = "' . $redirect . '";</script>';
    }
}
