<?php


Route::middleware('auth')->group(function () {
    //LX02
    Route::group(['prefix' => 'lx02'], function () {

        Route::get('/', 'Lx02Controller@index')
            ->name('lx02.index')
            ->middleware('permission:subir archivo LX02');

        Route::post('/process-inventario-lx02', 'Lx02Controller@processInventarioLx02')
            ->name('process-inventario-lx02')
            ->middleware('carga inventario a nivel bin');

        Route::post('/process-recibo-bins', 'Lx02Controller@processReciboBins')
            ->name('process-recibo-bins')
            ->middleware('carga inventario recibo bins');

    });
});
