<?php


// Route::middleware('auth')->group(function () {
//stocks
Route::group(['prefix' => 'ingexp'], function () {

    Route::get('/cargar', 'IngexpController@cargar')->middleware('permission:cargar al catálogo');

    Route::post('/cargarpost', 'IngexpController@cargarpost');
    Route::post('/cargarpostedit', 'IngexpController@cargarpostedit');

    Route::get('/editar', 'IngexpController@editar')->middleware('permission:Editar existente');;
    Route::get('/editar/{id}', 'IngexpController@editardetail')->middleware('permission:Editar existente');;

    Route::get('/visor/{id}', 'IngexpController@visor')->middleware('permission:buscar');
    Route::get('/buscar', 'IngexpController@buscar')->middleware('permission:buscar');

    Route::post('/get-data-table', 'IngexpController@getDataTable');
    Route::post('/get-data-table-pagination', 'IngexpController@getDataTablePagination');


    Route::get('/confirmarpago/{id}/{token}', 'IngexpController@confirmarpago');

    Route::get('/solicitaracceso/login', 'IngexpController@solicitaracceso_login');
    Route::get('/solicitaracceso', 'IngexpController@solicitaracceso');
    Route::post('/solicitaracceso_procesar', 'IngexpController@solicitaracceso_procesar');

    Route::post('/confirmarpagopost', 'IngexpController@confirmarpagopost');

    Route::post('/solicitaraccesologin', 'IngexpController@solicitaraccesologin');


    Route::get('/comprobarpago', 'IngexpController@comprobarpago');
    Route::post('/comprobarpago_procesar', 'IngexpController@comprobarpago_procesar');

    Route::get('/login', 'IngexpController@login');
    Route::post('/login_procesar', 'IngexpController@login_procesar');

    Route::get('/liberaracceso', 'IngexpController@liberaracceso');

    Route::get('/liberaracceso_detaill', 'IngexpController@liberaracceso_detaill');
    Route::post('/liberaracceso_procesar', 'IngexpController@liberaracceso_procesar');

    Route::get('/cargardetallessolicitud/{id}', 'IngexpController@cargardetallessolicitud');
    Route::post('/changeestatussolicitud', 'IngexpController@changeestatussolicitud');

    Route::get('/acceso', 'IngexpController@acceso');

    Route::get('/listadeacceso', 'IngexpController@listadeacceso')->middleware('permission:solicitudes de acceso');


});
// });
