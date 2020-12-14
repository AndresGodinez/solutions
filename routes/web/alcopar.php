<?php


Route::middleware('auth')->group(function () {
    //stocks
    Route::group(['prefix' => 'alcopar'], function () {
        Route::get('/reving',                                       'AlcoparController@reving')
        ->middleware('permission:rev ingenieria/alta sap');



        Route::get('/reving/edit/{id}',                             'AlcoparController@revingedit')
        ->middleware('permission:rev ingenieria/alta sap');


        Route::get('/reving/procesarechazar',                       'AlcoparController@procesarechazar');
        Route::get('/reving/procesarechazar3',                      'AlcoparController@procesarechazar3');

        Route::post('/reving/procesarechazar1',                     'AlcoparController@procesarechazar1');
        Route::post('/reving/procesarechazar4',                     'AlcoparController@procesarechazar4');
        Route::post('/reving/procesa',                              'AlcoparController@procesa');

        Route::get('/reving/jquery/getCategoriaJquery/{id}',        'AlcoparController@getCategoriaJquery');
        Route::get('/reving/jquery/getFamiliaJquery/{id}',          'AlcoparController@getFamiliaJquery');
        Route::get('/reving/jquery/getCategoriaExtraJquery/{id}',   'AlcoparController@getCategoriaExtraJquery');

        Route::get('/factible',                                      'AlcoparController@factible')
        ->middleware('permission:rev materiales/alta costo');

        Route::get('/factible/edit/{id}',                            'AlcoparController@factibledit')
        ->middleware('permission:rev materiales/alta costo');

        Route::post('/factible/procesafactible',                     'AlcoparController@procesafactible');
        Route::get('/factible/procesarechazar',                      'AlcoparController@procesarechazarfac');
        Route::get('/factible/procesarechazar3',                     'AlcoparController@procesarechazarfac3');
        Route::post('/factible/procesarechazarfac1',                 'AlcoparController@procesarechazarfac1');

        Route::get('/altamaterial',                                   'AlcoparController@altamaterial')
        ->middleware('permission:solicitud de alta');

        Route::post('/factible/altamaterialupdate',                   'AlcoparController@altamaterialupdate');
        Route::post('/factible/altamaterialupdate_addcorreo',                   'AlcoparController@altamaterialupdate_addcorreo');
        Route::get('/altamaterial/existente',                         'AlcoparController@altamaterialexistente');

        Route::post('/altamaterial/save',                              'AlcoparController@altamaterialexistentesave');
        Route::post('/altamaterial/guardar',                           'AlcoparController@altamaterialexistenteguardar');

        Route::get('/classat',                                       'AlcoparController@classat')
        ->middleware('permission:clasioficacion sat');


        Route::get('/classat/edit/{id}',                             'AlcoparController@classatedit')
        ->middleware('permission:clasioficacion sat');

        Route::post('/classat/guardar',                               'AlcoparController@classatguardar');

        Route::get('/classat/clasificacionconsulta',                  'AlcoparController@clasificacionconsulta');

        Route::get('/precio',                                      'AlcoparController@precio')
        ->middleware('permission:alta precio');

        Route::get('/descarga-precio',                                      'AlcoparController@descargaPrecio')
            ->name('descargaPrecio')
            ->middleware('permission:alta precio');

        Route::get('/precio/edit/{id}',                             'AlcoparController@precioedit')
        ->middleware('permission:alta precio');

        Route::post('/precio/precioprocess',                                      'AlcoparController@precioprocess');

        Route::get('/oow',                                      'AlcoparController@oow')
        ->middleware('permission:alta oow');

        Route::get('/oow/edit/{id}',                             'AlcoparController@oowedit')
        ->middleware('permission:alta oow');

        Route::post('/oow/oowprocess',                                      'AlcoparController@oowprocess');

        Route::get('/reportalcopar',                                      'AlcoparController@reportalcopar');

        Route::get('/reportalcopardescarga',                                      'AlcoparController@reportalcopardescarga');

        Route::get('/historial/{id}',                             'AlcoparController@historial');

        Route::get('/testmail/{mail}',                             'AlcoparController@testmail');

    });
});
