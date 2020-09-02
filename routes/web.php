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

//Usuarios
Route::get('/usuarios-export', 'UsersExportController')
    ->name('usuarios.export');

Route::get('/usuarios', 'UsuariosController@index')
    ->name('usuarios.index');

Route::get('/usuario/{usuario}', 'UsuariosController@show')
    ->name('usuario.show');

Route::get('/usuario/{usuario}/edit', 'UsuariosController@edit')
    ->name('usuario.edit');

Route::post('/usuario/{usuario}', 'UsuariosController@update')
    ->name('usuario.update');

Route::post('/usuario', 'UsuariosController@store')
    ->name('usuario.store');

Route::get('/usuario-create', 'UsuariosController@create')
    ->name('usuario.create');

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


