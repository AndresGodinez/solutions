<?php
// sustitutos
Route::middleware('auth')->group(function () {
    Route::get('/solicitudes-sustituto', 'MaterialesController@index')
        ->name('materiales-sustitutos.index');

    Route::get('/solicitud-sustituto', 'MaterialesController@solicitud')
        ->name('materiales-sustitutos.solicitud');

    Route::get('solicitudes/datoinicial', 'MaterialesController@datoinicial')
        ->name('solicitudes.datoinicial');

    Route::get('sustitutos', 'MaterialesController@index');

    Route::get('sustitutos/detalle/{id}', 'MaterialesController@detail');

    Route::post('sustitutos/process/set-track/contribute', 'MaterialesController@set_track');

    Route::post('/sustitutos/process', 'MaterialesController@process');

    Route::post('/process/{np}', 'MaterialesController@get_description_by_np');
});
