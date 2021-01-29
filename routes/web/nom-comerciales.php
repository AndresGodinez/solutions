<?php 
Route::middleware('auth')->group(function () {
	Route::group( ['prefix' => 'nom-comerciales'], function()
	{
		Route::get('/', 'NomController@index')
		->name('consulta-de-informacion-nom')
		->middleware('permission:consulta de informacion nom');

		Route::post('/process/np-info/', 'NomController@get_np_info')
		->middleware('permission:consulta de informacion nom');
		Route::get('/np-info/detail/{np}', 'NomController@get_np_info_detail')
		->middleware('permission:consulta de informacion nom');
		

		Route::get('/carga/', 'NomController@upload')
		->name('carga-de-informacion-nom')
		->middleware('permission:carga de informacion nom');

		Route::post('/carga/process/', 'NomController@upload_file')
		->middleware('permission:carga de informacion nom');
		Route::post('/process/impresion/', 'NomController@print')
		->middleware('permission:carga de informacion nom');
	});
});
