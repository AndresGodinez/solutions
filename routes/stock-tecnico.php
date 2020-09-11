<?php
Route::middleware('auth')->group(function () {

//Stock tecnico

    Route::get('stock-basico-tecnico', 'StockBasicoTecnicoController@index')
        ->name('stock-basico-tecnico.index');

    Route::get('stock-basico-tecnico-bin', 'StockBasicoTecnicoController@indexBin')
        ->name('stock-basico-tecnico.indexBin');

    Route::get('stock-basico-tecnico/datoinicial', 'StockBasicoTecnicoController@datoInicial')
        ->name('stock-basico-tecnico.datoInicial');

    Route::get('stock-basico-tecnico/datoinicial-bin', 'StockBasicoTecnicoController@datoInicialBin')
        ->name('stock-basico-tecnico-bin.datoInicialBin');

    Route::post('upload-stock-tecnico', 'StockBasicoTecnicoController@uploadStockTecnico')
        ->name('upload-stock-tecnico.process');
});
