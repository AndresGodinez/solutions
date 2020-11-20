<?php


// Route::middleware('auth')->group(function () {
    //stocks
    Route::group(['prefix' => 'ingexp'], function () {
        
        Route::get('/cargar',                                       'IngexpController@cargar');

        Route::post('/cargarpost',                                       'IngexpController@cargarpost');
        Route::post('/cargarpostedit',                                       'IngexpController@cargarpostedit');
        
        Route::get('/editar',                                       'IngexpController@editar');        
        Route::get('/editar/{id}',                             'IngexpController@editardetail');

        Route::get('/buscar',                                       'IngexpController@buscar');
        Route::get('/visor/{id}',                             'IngexpController@visor');





        Route::get('/solicitaracceso/login',                                       'IngexpController@solicitaracceso_login');
        Route::get('/solicitaracceso',                                       'IngexpController@solicitaracceso');
        Route::post('/solicitaracceso_procesar',                                       'IngexpController@solicitaracceso_procesar');
        

        Route::get('/comprobarpago',                                       'IngexpController@comprobarpago');
        Route::post('/comprobarpago_procesar',                                       'IngexpController@comprobarpago_procesar');

        Route::get('/login',                                       'IngexpController@login');
        Route::post('/login_procesar',                                       'IngexpController@login_procesar');

        Route::get('/liberaracceso',                                       'IngexpController@liberaracceso');

        Route::get('/liberaracceso_detaill',                                       'IngexpController@liberaracceso_detaill');
        Route::post('/liberaracceso_procesar',                                       'IngexpController@liberaracceso_procesar');

        Route::get('/cargardetallessolicitud/{id}',                                       'IngexpController@cargardetallessolicitud');
        Route::post('/changeestatussolicitud',                                       'IngexpController@changeestatussolicitud');
        
        Route::get('/acceso',                                       'IngexpController@acceso');

        Route::get('/listadeacceso',                                       'IngexpController@listadeacceso');
        
        
        
    });
// });
