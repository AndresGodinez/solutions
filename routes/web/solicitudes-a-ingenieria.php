<?php
Route::middleware('auth')->group(function () {
    Route::group( ['prefix' => 'solicitudes-a-ingenieria'], function()
    {
    	// Solicitudes
        Route::resource('/', 'SolicitudController',[
		    'names' => [
		        'index' => 'crear-solicitudes-ing'		        
		    ]])        	
        	->middleware('permission:crear solicitudes ing');

		Route::post('/solicitud/questions', 'SolicitudController@questions');
		Route::post('/solicitud/create', 'SolicitudController@create');
		Route::post('/solicitud/search', 'SolicitudController@search');
	    Route::post('/solicitud/info-help-documents', 'SolicitudController@infoHelpDocuments');
	    Route::post('/solicitud/info-solved-cases', 'SolicitudController@infoSolvedCases');
		Route::get('/solicitud/show/{id}', 'SolicitudController@show');
		Route::post('/solicitud/saved', 'SolicitudController@saved');
	    Route::post('/solicitud/subir', 'DocumentoController@subir');
	    Route::get('/solicitud/descargar/{id}', 'SolicitudController@descargar');

	    // Modo de falla.
	    Route::get('/modo-falla/', 'ModoFallasController@index');
		Route::get('/modo-falla/form', 'ModoFallasController@showForm')
			->name('modo-de-falla-ing')
        	->middleware('permission:modo de falla ing');

		Route::get('/modo-falla/get_content_by_id', 'ModoFallasController@fillSelect');
		Route::post('/modo-falla/create', 'ModoFallasController@create');
		Route::post('/modo-falla/questions', 'ModoFallasController@questionsExists');
		Route::post('/modo-falla/create-new-mode', 'ModoFallasController@newMode');
		Route::post('/modo-falla/search-one', 'ModoFallasController@searchOneQuestion');
		Route::post('/modo-falla/update', 'ModoFallasController@UpdateQuestions');

		// Documento.
		Route::get('/documento/descargar/{id}/{question}', 'DocumentoController@descargar');

		// Detalle solicitud.
		Route::get('/detalle/', 'DetalleController@index');
		Route::get('/detalle/cerradas-rechazadas', 'DetalleController@cerradas_rechazadas')
			->name('solicitudes-ing-canceladas-y-rechazadas')
        	->middleware('permission:solicitudes ing canceladas y rechazadas');

		Route::get('/detalle/abiertas-en-revision', 'DetalleController@abiertas_en_revision')
			->name('solicitudes-ing-abiertas-y-revision')
        	->middleware('permission:solicitudes ing abiertas y revisión');

		Route::get('/detalle/show/{id}', 'DetalleController@detail');
		Route::post('/detalle/create', 'DetalleController@create');
		Route::post('/detalle/taller', 'DetalleController@taller');
		Route::post('/detalle/subtypeChange', 'DetalleController@subtypeChange');
	    Route::post('/detalle/filters', 'DetalleController@filters');
	    Route::post('/detalle/rechazar', 'DetalleController@rechazar');
	    Route::post('/detalle/quests-ing', 'DetalleController@quests_ing');
	    Route::get('/detalle/descargar/{id}', 'DetalleController@descargar');

	    //Reporte.
	    Route::get('/reporte/', 'ReporteController@index')
	    	->name('reporte-solicitudes-ing')
        	->middleware('permission:reporte solicitudes ing');

		Route::post('/reporte/generate', 'ReporteController@report');

		// Mail Sender.
		Route::get('/mail/', 'MailController@index');
		Route::get('/mail/send/{id}', 'MailController@send');
    });
});
