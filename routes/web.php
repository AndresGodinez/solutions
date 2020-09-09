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
Route::get('/t', function () {
    return sha1('123456789');
});

//Materiales Susitutos
Route::get('/materiales', 'MaterialesController@search')
    ->name('materiales.search');

Route::get('/materiales-consulta', 'MaterialesController@consulta')
    ->name('materiales.consulta');

Route::get('/materiales-download', 'MaterialesController@download')
    ->name('materiales.download');

Route::get('/carga-sustituto', 'MaterialesController@cargaSustitutos')
    ->name('materiales-sustitutos.cargaSustitutos');

// sustitutos

Route::get('/solicitud-sustituto', 'MaterialesController@solicitud')
    ->name('materiales-sustitutos.solicitud');

//Solicitudes
Route::get('/solicitud-ingenieria-create', 'SolicitudesIngenieriaController@create')
    ->name('solicitud-ingenieria.create');

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/get-countries', 'CountriesController@list')
    ->name('getCountries');

Route::get('/get-regiones', 'CountriesController@regiones')
    ->name('getRegiones');


/////////////////////// [[ Stocks START ]] /////////////////////

Route::get('/stock', 'StockController@index')
    ->name('stock.index');

// Stock Inicial
Route::get('/stock/inicial', 'StockController@inicial')
    ->name('stock.inicial');

// api json Dato Inicial [[Data Table JSON]]
Route::get('/stock/datoinicial', 'StockController@datoinicial')
    ->name('stock.datoinicial');

Route::get('/stock/datoinicial', 'StockController@datoinicial')
    ->name('stock.datoinicial');

//api DOM [[Detallamiento]]
Route::post('/stock/detalleinicial', 'StockController@detalleinicial')
    ->name('stock.detalleinicial');

// Stock Final
Route::get('/stock/final', 'StockController@final')
    ->name('stock.final');

//view
Route::get('/stock/cargainicial', 'StockController@cargainicial')
    ->name('stock.cargainicial');

//VIEW API MULTPART
Route::post('/stock/cargainicialapi', 'StockController@cargainicialapi')->name('stock.cargainicialapi');

// Consusion Inicial -> view
Route::get('/stock/conclusioninicial', 'StockController@conclusioninicial')
    ->name('stock.conclusioninicial');
// api json Dato Inicial [[Data Table JSON]]
Route::get('/stock/conclusioninicial_dt', 'StockController@conclusioninicial_dt')
    ->name('stock.conclusioninicial_dt');
//api DOM [[Detallamiento]]
Route::post('/stock/conclusioninicial_detalle', 'StockController@conclusioninicial_detalle')
    ->name('stock.conclusioninicial_detalle');
//api UPDATE
Route::post('/stock/conclusioninicial_update', 'StockController@conclusioninicial_update
')
    ->name('stock.conclusioninicial_update');

// Stock Final
Route::get('/stock/final', 'StockController@final')
    ->name('stock.final');
// api/multpart descar de XLS de Consulta Inicial
Route::get('/stock/descagafinal', 'StockController@descagafinal')
    ->name('stock.descagafinal');
// api json Dato Inicial [[Data Table JSON]]
Route::get('/stock/datofinal', 'StockController@datofinal')
    ->name('stock.datofinal');
//api DOM [[Detallamiento]]
Route::post('/stock/detallefinal', 'StockController@detallefinal')
    ->name('stock.detallefinal');
//view
Route::get('/stock/cargafinal', 'StockController@cargafinal')
    ->name('stock.cargafinal');


/////////////////////// [[ Stocks END ]] /////////////////////
