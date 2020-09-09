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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {

//Materiales Susitutos
    Route::get('/materiales', 'MaterialesController@search')
        ->name('materiales.search');

    Route::get('/materiales-consulta', 'MaterialesController@consulta')
        ->name('materiales.consulta');

    Route::get('/materiales-download', 'MaterialesController@download')
        ->name('materiales.download');

    Route::get('/carga-sustituto', 'MaterialesController@cargaSustitutos')
        ->name('materiales-sustitutos.cargaSustitutos');
});
// sustitutos
Route::middleware('auth')->group(function () {
    Route::get('/solicitudes-sustituto', 'MaterialesController@index')
        ->name('materiales-sustitutos.index');

    Route::get('/solicitud-sustituto', 'MaterialesController@solicitud')
        ->name('materiales-sustitutos.solicitud');

    Route::get('solicitudes/datoinicial', 'MaterialesController@datoinicial')
        ->name('solicitudes.datoinicial');

    Route::get('sustitutos', 'MaterialesController@index');

    Route::get('sustitutos/detalle/{id}', 'MaterialesController@detail');

    Route::post('sustitutos/process/set-track/contribute', 'MaterialesController@set_track');

    Route::post('/sustitutos/process', 'MaterialesController@process');

    Route::post('/process/{np}', 'MaterialesController@get_description_by_np');

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

//Materiales
Route::get('/t', function (){
    return sha1('123456789');
});

Route::get('/materiales', 'MaterialesController@search')
    ->name('materiales.search');

Route::get('/materiales-consulta', 'MaterialesController@consulta')
    ->name('materiales.consulta');

Route::get('/materiales-download', 'DownloadMaterialesController')
    ->name('downloadMateriales');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/get-countries', 'CountriesController@list')
    ->name('getCountries');

Route::get('/get-regiones', 'CountriesController@regiones')
    ->name('getRegiones');


