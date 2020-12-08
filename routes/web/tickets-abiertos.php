<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'tickets-abiertos'], function()
	{
		Route::get('/', 												'TicketsAbiertosController@index');
		Route::get('/cargas', 											'TicketsAbiertosController@uploads');
		Route::post('/process/tickets-abiertos/guias', 					'TicketsAbiertosController@upload_tickets_abiertos_guias');
		Route::post('/process/tickets-abiertos/pedidos', 				'TicketsAbiertosController@upload_tickets_abiertos_pedidos');
		Route::post('/process/tickets-abiertos/reservas', 				'TicketsAbiertosController@upload_tickets_abiertos_reservas');
		Route::post('/process/tickets-abiertos/pex', 					'TicketsAbiertosController@upload_tickets_abiertos_pex');
		Route::post('/process/tickets-abiertos/tickets', 				'TicketsAbiertosController@upload_tickets_abiertos');
		Route::post('/process/tickets-abiertos/servicios-abiertos/', 	'TicketsAbiertosController@upload_tickets_servicios_abiertos');

		Route::post('/download/report/all/',							'TicketsAbiertosController@download_report_all');
		Route::post('/download/report/taller/',							'TicketsAbiertosController@download_report_taller');
		Route::post('/download/report/tipo/',							'TicketsAbiertosController@download_report_tipo');
		Route::post('/download/report/supervisor/',						'TicketsAbiertosController@download_report_supervisor');
		Route::post('/download/report/antiguedad/',						'TicketsAbiertosController@download_report_antiguedad');
	});
});
