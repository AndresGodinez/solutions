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

Route::get('/usuarios', 'UsuariosController@index')
    ->name('usuarios.index');

Route::get('/usuario/{usuario}', 'UsuariosController@show')
    ->name('usuario.show');

Route::get('/usuario/{usuario}/edit', 'UsuariosController@edit')
    ->name('usuario.edit');

Route::post('/usuario', 'UsuariosController@store')
    ->name('usuario.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
