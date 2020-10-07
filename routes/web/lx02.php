<?php


Route::middleware('auth')->group(function () {
    //Fechas Promesa
    Route::group(['prefix' => 'lx02'], function () {

        Route::get('/', 'Lx02Controller@index')
            ->name('lx02.index');

        Route::post('/process-inventario-lx02', 'Lx02Controller@processInventarioLx02')
            ->name('process-inventario-lx02');

    });
});
