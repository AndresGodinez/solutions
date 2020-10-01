<?php
Route::middleware('auth')->prefix('conteo-ciclos')->group(function () {

//Conteo Ciclicos
    Route::get('/', 'ConteoCiclosController@index')
        ->name('conteo-ciclos.index');

    Route::post('/process-hojas-conteo-ciclos', 'ConteoCiclosController@processHojasConteoCiclos')
        ->name('process-hojas-conteo-ciclos');

    Route::get('/hojas-conteo-cicliclos', 'ConteoCiclosController@hojasConteoCiclos')
        ->name('hojas-conteo-ciclicos');

    Route::post('/obtener-hojas-conteo-cicliclos', 'ConteoCiclosController@obtenerHojas')
        ->name('obtener-hojas-conteo');

});
