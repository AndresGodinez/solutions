<?php


Route::middleware('auth')->group(function () {
    //stocks
    Route::group(['prefix' => 'stocks'], function () {
        Route::get('/',                             'StocksController@index');
        Route::get('/pendientes',                     'StocksController@indexPendingList');
        Route::get('/detalle/{id}',                 'StocksController@detail');
        Route::get('/cargas',                         'StocksController@uploads');
        Route::post('/process/stock-inicial/',         'StocksController@upload_stock_inicial');
        Route::post('/process/stock-inicial-isc/',    'StocksController@upload_stock_inicial_isc');

        Route::get('/final',                         'StocksController@index_stocks_final');
        Route::get('/final/pendientes',             'StocksController@indexPendingList_stocks_final');
        Route::get('/final/detalle/{id}',             'StocksController@detail_stocks_final');
        Route::get('/cargas',                         'StocksController@uploads');
        Route::post('/process/stock-final/',         'StocksController@upload_stock_final');
        Route::post('/process/stock-final-isc/',    'StocksController@upload_stock_final_isc');

        Route::get('/descarga/{id}',                 'StocksController@descarga');
    });
});
