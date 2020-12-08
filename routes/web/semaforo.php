<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'semaforo'], function()
    {
        Route::get('/',                                 'SemaforoController@index');
        Route::get('/carga',                            'SemaforoController@upload');
        Route::post('/carga/process/',                  'SemaforoController@upload_file');
        Route::get('/list/{type}',                      'SemaforoController@list');
    });
});
