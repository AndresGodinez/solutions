<?php
Route::middleware('auth')->prefix('conteo-ciclos')->group(function () {

//Conteo Ciclicos
    Route::get('/', 'ConteoCiclosController@index')
        ->name('conteo-ciclos.index')
        ->middleware('permission:ver conteo ciclicos');

    Route::post('/process-hojas-conteo-ciclos', 'ConteoCiclosController@processHojasConteoCiclos')
        ->name('process-hojas-conteo-ciclos')
        ->middleware('permission:carga materiales para hojas de conteo ciclicos');

    Route::get('/hojas-conteo-cicliclos', 'ConteoCiclosController@hojasConteoCiclos')
        ->name('hojas-conteo-ciclicos')
        ->middleware('permission:descarga de hojas conteo ciclicos xls');

    Route::post('/obtener-hojas-conteo-cicliclos', 'ConteoCiclosController@obtenerHojas')
        ->name('obtener-hojas-conteo')
        ->middleware('permission:descarga de hojas conteo ciclicos pdf');

});
