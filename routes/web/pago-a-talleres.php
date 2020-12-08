<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'pago-a-talleres'], function()
    {
        Route::get('/', 												'PagoTalleresController@recepcion_facturas');
		Route::get('/reporte-ts-crm/cargas/', 							'PagoTalleresController@uploads');
		Route::post('/reporte-ts-crm/cargas/process/claims/', 			'PagoTalleresController@uploads_claims');
		Route::post('/reporte-ts-crm/cargas/process/prorrateo/', 		'PagoTalleresController@uploads_prorrateo');
		Route::get('/reporte-ts-crm/descargar/reporte/', 				'PagoTalleresController@download_report');
		Route::get('/reporte-ts-crm/download/{date}', 					'PagoTalleresController@download_file');

		// Recepción de facturas
		Route::get('/recepcion-de-facturas/', 							'PagoTalleresController@recepcion_facturas');
		Route::post('/process/recepcion-facturas/', 					'PagoTalleresController@recepcion_facturas_detail');
    });
});
