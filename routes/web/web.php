<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\Surtimiento;
use App\SurtimientoConcentrado;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    SurtimientoConcentrado::binesParaPicking('RS01');
});




// sustitutos
Route::middleware('auth')->group(function () {

    //Solicitudes ingenieria
    Route::get('/solicitud-ingenieria-create', 'SolicitudesIngenieriaController@create')
        ->name('solicitud-ingenieria.create');

    //Stocks

    Route::get('/stock', 'StockController@index')
        ->name('stock.index');

    Route::get('/stock/inicial', 'StockController@inicial')
        ->name('stock.inicial');

    Route::get('/stock/descagainicial', 'StockController@descagainicial')
        ->name('stock.descagainicial');

    Route::get('/stock/datoinicial', 'StockController@datoinicial')
        ->name('stock.datoinicial');


});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/get-countries', 'CountriesController@list')
    ->name('getCountries');

Route::get('/get-regiones', 'CountriesController@regiones')
    ->name('getRegiones');
