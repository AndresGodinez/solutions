<?php
// sustitutos
Route::middleware('auth')->group(function () {
    Route::get('/solicitudes-sustituto', 'MaterialesController@index')
        ->name('materiales-sustitutos.index')
        ->middleware('permission:ver sustitutos');

    Route::get('/solicitud-sustituto', 'MaterialesController@solicitud')
        ->name('materiales-sustitutos.solicitud')
        ->middleware('permission:solicitud de sustitutos');

    Route::get('solicitudes/datoinicial', 'MaterialesController@datoinicial')
        ->name('solicitudes.datoinicial');

    Route::get('sustitutos', 'MaterialesController@index')
        ->middleware('permission:ver sustitutos');

    Route::get('sustitutos/detalle/{id}', 'MaterialesController@detail')
        ->middleware('permission:ver sustitutos');

    Route::post('sustitutos/process/set-track/contribute', 'MaterialesController@set_track');

    Route::post('/sustitutos/store', 'MaterialesController@store')
        ->name('solicitud-sustituto.store');

    Route::post('/get_description_by_np', 'MaterialesController@get_description_by_np');
});
