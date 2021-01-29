<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'tickets-abiertos'], function()
	{
		Route::get('/', 												'TicketsAbiertosController@index')
		->name('reporte-kpi.descargar')
		->middleware('permission:descargar');
		;
		Route::get('/cargas', 											'TicketsAbiertosController@uploads')
		->name('reporte-kpi.carga-de-informacion')
		->middleware('permission:carga de informacion');
		
		Route::post('/process/tickets-abiertos/guias', 					'TicketsAbiertosController@upload_tickets_abiertos_guias')
		->middleware('permission:carga de informacion');

		Route::post('/process/tickets-abiertos/pedidos', 				'TicketsAbiertosController@upload_tickets_abiertos_pedidos')
		->middleware('permission:carga de informacion');

		Route::post('/process/tickets-abiertos/reservas', 				'TicketsAbiertosController@upload_tickets_abiertos_reservas')
		->middleware('permission:carga de informacion');

		Route::post('/process/tickets-abiertos/pex', 					'TicketsAbiertosController@upload_tickets_abiertos_pex')
		->middleware('permission:carga de informacion');

		Route::post('/process/tickets-abiertos/tickets', 				'TicketsAbiertosController@upload_tickets_abiertos')
		->middleware('permission:carga de informacion');
		Route::post('/process/tickets-abiertos/servicios-abiertos/', 	'TicketsAbiertosController@upload_tickets_servicios_abiertos')
		->middleware('permission:carga de informacion');

		Route::post('/download/report/all/',							'TicketsAbiertosController@download_report_all')
		->middleware('permission:descargar');

		Route::post('/download/report/taller/',							'TicketsAbiertosController@download_report_taller')
		->middleware('permission:descargar');

		Route::post('/download/report/tipo/',							'TicketsAbiertosController@download_report_tipo')
		->middleware('permission:descargar');

		Route::post('/download/report/supervisor/',						'TicketsAbiertosController@download_report_supervisor')
		->middleware('permission:descargar');

		Route::post('/download/report/antiguedad/',						'TicketsAbiertosController@download_report_antiguedad')
		->middleware('permission:descargar');

	});
});
