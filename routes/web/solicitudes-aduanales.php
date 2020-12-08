<?php
Route::middleware('auth')->group(function () {
    Route::group(['prefix' => 'solicitudes-aduanales'], function(){
        Route::get('/',                                         'SolicitudesAduanales@index');
        //->middleware('permission:solicitudes-aduanales');
        Route::get('/solicitudes/',                             'SolicitudesAduanales@solicitudes');
        Route::get('/solicitudes/detalle/{id}',                 'SolicitudesAduanales@solicitudes_cerrar');
        Route::post('/detalle/info-request/',                   'SolicitudesAduanales@detail_process');
        Route::get('/detalle/{string}/',                        'SolicitudesAduanales@detail');
        Route::get('/solicitar',                                'SolicitudesAduanales@solicitar');
        Route::post('/process/solicitar',                       'SolicitudesAduanales@solicitar_create');
        Route::post('/process/solicittudes/contestar',          'SolicitudesAduanales@solicitudes_contestar');
        Route::post('/process/solicittudes/contestar/file',     'SolicitudesAduanales@solicitudes_contestar_file');
	});
});
