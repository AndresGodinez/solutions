<?php
Route::middleware('auth')->group(function () {
    //Materiales Susitutos
    Route::get('/materiales', 'MaterialesController@search')
        ->name('materiales.search')
        ->middleware('permission:busqueda materiales');

    Route::get('/materiales-consulta', 'MaterialesController@consulta')
        ->name('materiales.consulta')
        ->middleware('permission:busqueda materiales');

    Route::get('/materiales-download', 'MaterialesController@download')
        ->name('materiales.download')
        ->middleware('permission:descarga de materiales');

    Route::get('/carga-sustituto', 'MaterialesController@cargaSustitutos')
        ->name('materiales-sustitutos.cargaSustitutos')
        ->middleware('permission:carga sustituto');
});
