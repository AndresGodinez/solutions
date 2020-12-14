<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'pago-a-talleres'], function()
    {
        Route::get('/', 												'PagoTalleresController@recepcion_facturas');
		Route::get('/reporte-ts-crm/cargas/', 							'PagoTalleresController@uploads');
		Route::post('/reporte-ts-crm/cargas/process/claims/', 			'PagoTalleresController@uploads_claims');
		Route::post('/reporte-ts-crm/cargas/process/prorrateo/', 		'PagoTalleresController@uploads_prorrateo');
		Route::post('/reporte-ts-crm/cargas/process/pago-a-talleres/', 	'PagoTalleresController@uploads_pago_a_talleres');
		Route::get('/reporte-ts-crm/descargar/reporte/', 				'PagoTalleresController@download_report');
		Route::get('/reporte-ts-crm/download/{date}', 					'PagoTalleresController@download_file');

		// Recepción de facturas
		Route::get('/recepcion-de-facturas/', 							'PagoTalleresController@recepcion_facturas');
		Route::post('/process/recepcion-facturas/', 					'PagoTalleresController@recepcion_facturas_detail');
		Route::get('/recepcion-de-facturas/detalle/{flag}/{taller}', 	'PagoTalleresController@recepcion_facturas_detail_taller');
		Route::get('/recepcion-de-facturas/referencia/{referencia}', 	'PagoTalleresController@recepcion_facturas_detail_referencia');
		Route::post('/process/recepcion-facturas/admin/', 				'PagoTalleresController@recepcion_facturas_process_admin');
		Route::post('/process/recepcion-facturas/taller/', 				'PagoTalleresController@recepcion_facturas_process_taller');

		// Reportes.
		Route::get('/reportes/', 										'PagoTalleresController@recepcion_facturas_reports');
		Route::get('/facturas-recibidas/x-tallr/descargar/', 			'PagoTalleresController@recepcion_facturas_descargar_taller');
		Route::post('/facturas-recibidas/x-tallr/descargar/process', 	'PagoTalleresController@recepcion_facturas_descargar_taller_process');

    });
});
