<?php


Route::middleware('auth')->group(function () {
    //Fechas Promesa
    Route::group(['prefix' => 'fecha-promesa'], function () {

        Route::get('/', 'FechaPromesaController@search')
            ->name('fechas-promesa.search')
            ->middleware('permission:consultar fechas promesas');

        Route::post('consulta', 'FechaPromesaController@consulta')
            ->name('fechas-promesa.consulta')
            ->middleware('permission:consultar fechas promesas');

        Route::post('update-fechas-promesas', 'FechaPromesaController@actualizarFechasPromesas')
            ->name('actualizarFechasPromesas')
            ->middleware('permission:actualizar fechas promesa');

//        Reports

        Route::get('/download-report-fecha-promesa-general', 'FechaPromesaController@downloadFechaPromesaGeneral')
            ->name('download.report.fecha.promesa.general')
            ->middleware('permission:descarga reporte fecha promesa general');

        Route::get('/download-report-fecha-promesa-detalle', 'FechaPromesaController@downloadFechaPromesaDetalle')
            ->name('download.report.fecha.promesa.detalle')
            ->middleware('permission:descarga reporte fecha promesa detallado');

//        CARGAS DE ARCHIVOS

        Route::post('upload-promesa-tracker-process', 'FechaPromesaController@uploadTrackerProcess')
            ->name('upload-promesa-tracker-process')
            ->middleware('permission:carga archivo fechas promesas tracker');

        Route::post('upload-lead-time', 'FechaPromesaController@uploadLeadTime')
            ->name('upload-lead-time-process')
            ->middleware('permission:carga archivo fechas promesas lead time');

        Route::post('upload-backorder', 'FechaPromesaController@uploadBackorder')
            ->name('upload-uploadBackorder')
            ->middleware('permission:carga archivo fechas promesas backorder');

//        Templates

        Route::get('/download-template-fechas-promesas-tracker', 'FechaPromesaController@downloadTemplatePromesasTracker')
            ->name('download-template-fechas-promesas-tracker')
            ->middleware('permission:carga archivo fechas promesas tracker');

        Route::get('/download-template-fechas-promesas-lead-time', 'FechaPromesaController@downloadTemplateLeadTime')
            ->name('download-template-fechas-promesas-lead-time')
            ->middleware('permission:carga archivo fechas promesas lead time');

        Route::get('/download-template-fechas-promesas-backorder', 'FechaPromesaController@downloadTemplateBackorder')
            ->name('download-template-fechas-promesas-backorder')
            ->middleware('permission:carga archivo fechas promesas backorder');

    });
});
