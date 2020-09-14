<?php
Route::middleware('auth')->group(function () {

//Carga masiva sustitutos

    Route::post('sustitutos-carga-mm60', 'SustitutosController@cargaMM60')
        ->name('sustitutos.carga-mm60');

    Route::post('sustitutos-carga-fecha-creacion-piezas', 'SustitutosController@cargaFechaCreacionPiezas')
        ->name('sustitutos.carga-fecha-creacion-piezas');

    Route::post('sustitutos-carga-inventarios', 'SustitutosController@cargaInventarios')
        ->name('sustitutos.carga-inventarios');

    Route::post('sustitutos-carga-masiva-sustitutos', 'SustitutosController@cargaMasivaSustitutos')
        ->name('sustitutos.carga-masiva-sustitutos');
});
