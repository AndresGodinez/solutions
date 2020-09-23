<?php


Route::middleware('auth')->group(function () {
    //Fechas Promesa
    Route::group(['prefix' => 'fecha-promesa'], function () {

        Route::get('/', 'FechaPromesaController@search')
            ->name('fechas-promesa.search');

        Route::get('/download-report-fecha-promesa-general', 'FechaPromesaController@downloadFechaPromesaGeneral')
            ->name('download.report.fecha.promesa.general');

        Route::get('/download-report-fecha-promesa-detalle', 'FechaPromesaController@downloadFechaPromesaDetalle')
            ->name('download.report.fecha.promesa.detalle');

        Route::post('consulta', 'FechaPromesaController@consulta')
            ->name('fechas-promesa.consulta');

        Route::post('update-fechas-promesas', 'FechaPromesaController@actualizarFechasPromesas')
            ->name('actualizarFechasPromesas');


//        CARGAS DE ARCHIVOS

        Route::post('upload-promesa-tracker-process', 'FechaPromesaController@uploadTrackerProcess')
            ->name('upload-promesa-tracker-process');

        Route::post('upload-lead-time', 'FechaPromesaController@uploadLeadTime')
            ->name('upload-lead-time-process');

        Route::post('upload-backorder', 'FechaPromesaController@uploadBackorder')
            ->name('upload-uploadBackorder');

//        Templates

        Route::get('/download-template-fechas-promesas-tracker', 'FechaPromesaController@downloadTemplatePromesasTracker')
            ->name('download-template-fechas-promesas-tracker');

        Route::get('/download-template-fechas-promesas-lead-time', 'FechaPromesaController@downloadTemplateLeadTime')
            ->name('download-template-fechas-promesas-lead-time');

        Route::get('/download-template-fechas-promesas-backorder', 'FechaPromesaController@downloadTemplateBackorder')
            ->name('download-template-fechas-promesas-backorder');

    });
});
