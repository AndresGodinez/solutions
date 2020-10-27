<?php

Route::middleware('auth')->group(function () {
    //Impresión etiquetas
    Route::group(['prefix' => 'impresion-etiquetas'], function () {

        Route::get('/', 'ImpresionEtiquetasController@index')
            ->name('impresion.etiquetas.index');

        Route::post('/constulta', 'ImpresionEtiquetasController@consulta')
            ->name('impresion.etiquetas.consulta');

        Route::post('/print', 'ImpresionEtiquetasController@print')
            ->name('impresion.etiquetas.print');

    });
});
