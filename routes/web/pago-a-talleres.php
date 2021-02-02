<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'pago-a-talleres'], function()
    {
         Route::get('/', 'PagoTalleresController@recepcion_facturas')
        	->name('facturas-recibidas-de-pago-a-talleres')
        	->middleware('permission:facturas recibidas de pago a talleres');

		Route::get('/reporte-ts-crm/cargas/', 'PagoTalleresController@uploads')
			->name('carga-de-datos-talleres')
        	->middleware('permission:carga de datos talleres');

		Route::post('/reporte-ts-crm/cargas/process/claims/', 'PagoTalleresController@uploads_claims');
		Route::post('/reporte-ts-crm/cargas/process/prorrateo/', 'PagoTalleresController@uploads_prorrateo');
		Route::post('/reporte-ts-crm/cargas/process/pago-a-talleres/', 'PagoTalleresController@uploads_pago_a_talleres');
		Route::get('/reporte-ts-crm/descargar/reporte/', 'PagoTalleresController@download_report')
			->name('reporte-ts')
        	->middleware('permission:reporte ts');

		Route::get('/show-file/{taller}/{referencia}/{archivo}/{extension}', 'PagoTalleresController@download_file')
			->middleware('permission:reporte ts');
		
		Route::get('/show-calendar/', 'PagoTalleresController@show_calendar_file');
		Route::get('/facts-pendientes/reporte/descargar/{taller}/{referencia}', 'PagoTalleresController@download_excel');
		Route::get('/reporte-ts-crm/download/ts/{file_name}', 'PagoTalleresController@download_file_reporte_ts');


		// Recepción de facturas
		Route::get('/recepcion-de-facturas/', 'PagoTalleresController@recepcion_facturas');
		Route::post('/process/recepcion-facturas/', 'PagoTalleresController@recepcion_facturas_detail');
		Route::get('/recepcion-de-facturas/detalle/{flag}/{taller}', 'PagoTalleresController@recepcion_facturas_detail_taller');
		Route::post('/process/recepcion-facturas/admin/', 'PagoTalleresController@recepcion_facturas_process_admin');
		Route::post('/process/recepcion-facturas/taller/', 'PagoTalleresController@recepcion_facturas_process_taller');

		// Reportes.
		Route::get('/reportes/', 'PagoTalleresController@recepcion_facturas_reports');
		Route::get('/facturas-recibidas/x-tallr/descargar/', 'PagoTalleresController@recepcion_facturas_descargar_taller')
			->name('facturas-aceptadas-admin-de-pago-a-talleres')
        	->middleware('permission:facturas aceptadas admin de pago a talleres');
		Route::post('/facturas-recibidas/x-tallr/descargar/process', 'PagoTalleresController@recepcion_facturas_descargar_taller_process');
		Route::get('/facturas-recibidas-aceptadas/x-tallr/descargar/', 'PagoTalleresController@recepcion_facturas_descargar_taller_aceptadas');

		Route::post('/facturas-recibidas-aceptadas/x-tallr/descargar/process', 'PagoTalleresController@recepcion_facturas_descargar_taller_process_aceptadas');
		Route::get('/facturas/x-tallr/descargar/', 'PagoTalleresController@recepcion_facturas_taller')
			->name('facturas-taller')
        	->middleware('permission:facturas taller');

		Route::post('/recepcion-fact/process/aut/', 'PagoTalleresController@recepcion_facturas_aut');
		Route::post('/recepcion-fact/process/rech/', 'PagoTalleresController@recepcion_facturas_rech');

    });
});
