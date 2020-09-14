<?php
Route::middleware('auth')->group(function () {

    //Stock tecnico

    Route::get('stock-basico-tecnico', 'StockBasicoTecnicoController@index')
        ->name('stock-basico-tecnico.index');

    Route::get('stock-basico-tecnico-bin', 'StockBasicoTecnicoController@indexBin')
        ->name('stock-basico-tecnico.indexBin');

    Route::get('stock-basico-tecnico/datoinicial', 'StockBasicoTecnicoController@datoInicial')
        ->name('stock-basico-tecnico.datoInicial');

    Route::get('stock-basico-tecnico/descarga', 'StockBasicoTecnicoController@descarga')
        ->name('stock-basico-tecnico.descarga');

    Route::get('stock-basico-tecnico/descargabin/{id}', 'StockBasicoTecnicoController@descargabin')
        ->name('stock-basico-tecnico.descargabin');

    Route::get('stock-basico-tecnico/datoinicial-bin', 'StockBasicoTecnicoController@datoInicialBin')
        ->name('stock-basico-tecnico-bin.datoInicialBin');

    Route::post('upload-stock-tecnico', 'StockBasicoTecnicoController@uploadStockTecnico')
        ->name('upload-stock-tecnico.process');

    Route::post('uploadStock', 'StockBasicoTecnicoController@uploadStock')
        ->name('uploadStock.process');

    Route::post('stock-basico-tecnico/editarBin', 'StockBasicoTecnicoController@editarBin');

    Route::post('stock-basico-tecnico/saveedit', 'StockBasicoTecnicoController@saveedit');

    Route::post('stock-basico-tecnico/saveadd', 'StockBasicoTecnicoController@saveadd');
    Route::post('stock-basico-tecnico/deleteBin', 'StockBasicoTecnicoController@deleteBin');
});
