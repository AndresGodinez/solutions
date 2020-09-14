<?php


Route::middleware('auth')->group(function () {
    //Fechas Promesa
    Route::group(['prefix' => 'fecha-promesa'], function () {

        Route::get('/', 'FechaPromesaController@search')
            ->name('fechas-promesa.search');

        Route::post('consulta', 'FechaPromesaController@consulta')
            ->name('fechas-promesa.consulta');
    });
});
