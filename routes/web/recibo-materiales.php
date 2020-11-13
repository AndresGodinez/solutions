<?php

Route::middleware('auth')->group(function () {
    //Recibo Materiales
    Route::group(['prefix' => 'recibo-materiales'], function () {

        Route::get('/', 'ReciboMaterialesController@index')
            ->name('recibo-materiales.index');

        Route::get('/create', 'ReciboMaterialesController@create')
            ->name('recibo-materiales.create');

        Route::post('/', 'ReciboMaterialesController@description')
            ->name('recibo-materiales.description');

        Route::get('/{reciboFolio}/show', 'ReciboMaterialesController@show')
            ->name('recibo-materiales.show');

        Route::get('/factura', 'ReciboMaterialesController@cargaFactura')
            ->name('recibo-materiales.carga-factura');

    });
});
