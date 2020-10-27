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
         
        
    });
// });
