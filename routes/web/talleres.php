<?php
Route::middleware('auth')->group(function () {

//Talleres

    Route::get('/taller-create', 'TalleresController@create')
        ->name('taller.create')
        ->middleware('permission:crear talleres');

    Route::post('/taller-store', 'TalleresController@store')
        ->name('taller.store')
        ->middleware('permission:crear talleres');

    Route::get('/talleres', 'TalleresController@index')
        ->name('talleres.index')
        ->middleware('permission:administrar talleres');

    Route::get('/talleres-consulta', 'TalleresController@consulta')
        ->name('talleres.consulta')
        ->middleware('permission:consulta talleres');

    Route::get('/talleres-json-consulta', 'TalleresController@index_json')
        ->name('talleres.index_json_consulta')
        ->middleware('permission:consulta talleres');

    Route::get('/talleres-json-administrar', 'TalleresController@index_json')
        ->name('talleres.index_json_administrar')
        ->middleware('permission:administrar talleres');

    Route::get('/taller-edit/{taller}', 'TalleresController@edit')
        ->name('taller.edit')
        ->middleware('permission:editar talleres');

    Route::put('/taller-update', 'TalleresController@update')
        ->name('taller.update')
        ->middleware('permission:editar talleres');

    Route::post('/taller-destroy/{taller}', 'TalleresController@destroy')
        ->name('taller.destroy')
        ->middleware('permission:eliminar talleres');

});
