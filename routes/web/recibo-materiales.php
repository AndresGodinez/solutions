<?php

Route::middleware('auth')->group(function () {
    //Recibo Materiales
    Route::group(['prefix' => 'recibo-materiales'], function () {

        Route::post('/pre-print/{reciboFolio}', 'ReciboMaterialesController@prePrint')
            ->name('recibo-materiales.pre-print');

        Route::post('/decision-print', 'ReciboMaterialesController@decision')
            ->name('recibo-materiales.decision-print');

        Route::post('/print2', 'ReciboMaterialesController@print2')
            ->name('recibo-materiales.print2');

        Route::post('/print/{reciboFolio}', 'ReciboMaterialesController@print')
            ->name('recibo-materiales.print');

        Route::get('/', 'ReciboMaterialesController@index')
            ->name('recibo-materiales.index');

        Route::get('/create', 'ReciboMaterialesController@create')
            ->name('recibo-materiales.create');

        Route::post('/store', 'ReciboMaterialesController@store')
            ->name('recibo-materiales.store');

        Route::post('/{reciboFolio}', 'ReciboMaterialesController@description')
            ->name('recibo-materiales.description');

        Route::get('/{reciboFolio}/show', 'ReciboMaterialesController@show')
            ->name('recibo-materiales.show');





    });
});
