<?php


Route::middleware('auth')->group(function () {
    //stocks
    Route::group(['prefix' => 'stocks'], function () {
        Route::get('/',                             'StocksController@index')
        ->middleware('permission:stock inicial');

        Route::get('/pendientes',                     'StocksController@indexPendingList')
        ->middleware('permission:stock inicial');

        Route::get('/detalle/{id}',                 'StocksController@detail')
        ->middleware('permission:stock inicial');

        Route::get('/cargas',                         'StocksController@uploads')
        ->middleware('permission:carga');

        Route::post('/process/stock-inicial/',         'StocksController@upload_stock_inicial');
        Route::post('/process/stock-inicial-isc/',    'StocksController@upload_stock_inicial_isc');

        Route::get('/final',                         'StocksController@index_stocks_final')
        ->middleware('permission:stock final');

        Route::get('/final/pendientes',             'StocksController@indexPendingList_stocks_final')
        ->middleware('permission:stock final');

        Route::get('/final/detalle/{id}',             'StocksController@detail_stocks_final')
        ->middleware('permission:stock final');
        
        Route::post('/process/stock-final/',         'StocksController@upload_stock_final');
        Route::post('/process/stock-final-isc/',    'StocksController@upload_stock_final_isc');

        Route::get('/descarga/{id}',                 'StocksController@descarga');
    });
});
