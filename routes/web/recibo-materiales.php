<?php

Route::middleware('auth')->group(function () {
    //Recibo Materiales
    Route::group(['prefix' => 'recibo-materiales'], function () {

        Route::get('/test', 'TestController@test');

        Route::post('/pre-print/{reciboFolio}', 'ReciboMaterialesController@prePrint')
            ->name('recibo-materiales.pre-print')
            ->middleware('permission:recepcion material');

        Route::post('/decision-print', 'ReciboMaterialesController@decision')
            ->name('recibo-materiales.decision-print')
            ->middleware('permission:recepcion material');

        Route::post('/print2', 'ReciboMaterialesController@print2')
            ->name('recibo-materiales.print2')
            ->middleware('permission:recepcion material');

        Route::post('/print/{reciboFolio}', 'ReciboMaterialesController@print')
            ->name('recibo-materiales.print')
            ->middleware('permission:recepcion material');

        Route::get('/', 'ReciboMaterialesController@index')
            ->name('recibo-materiales.index')
            ->middleware('permission:folios de recibo');

        Route::get('/create', 'ReciboMaterialesController@create')
            ->name('recibo-materiales.create')
            ->middleware('permission:recepcion material');

        Route::post('/store', 'ReciboMaterialesController@store')
            ->name('recibo-materiales.store')
            ->middleware('permission:recepcion material');

        Route::post('/{reciboFolio}', 'ReciboMaterialesController@description')
            ->name('recibo-materiales.description')
            ->middleware('permission:recepcion material');

        Route::get('/{reciboFolio}/test', 'ReciboMaterialesController@test')
            ->name('recibo-materiales.test');

        Route::get('/{reciboFolio}/show', 'ReciboMaterialesController@show')
            ->name('recibo-materiales.show')
            ->middleware('permission:recepcion material');

    });
});
