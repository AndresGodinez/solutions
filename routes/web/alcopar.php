<?php


Route::middleware('auth')->group(function () {
    //stocks
    Route::group(['prefix' => 'alcopar'], function () {
        Route::get('/reving',                                       'AlcoparController@reving');       
        Route::get('/reving/edit/{id}',                             'AlcoparController@revingedit');       
        Route::get('/reving/procesarechazar',                       'AlcoparController@procesarechazar');       
        Route::get('/reving/procesarechazar3',                      'AlcoparController@procesarechazar3');               
        
        Route::post('/reving/procesarechazar1',                     'AlcoparController@procesarechazar1');   
        Route::post('/reving/procesarechazar4',                     'AlcoparController@procesarechazar4'); 
        Route::post('/reving/procesa',                              'AlcoparController@procesa');       
                
        Route::get('/reving/jquery/getCategoriaJquery/{id}',        'AlcoparController@getCategoriaJquery');       
        Route::get('/reving/jquery/getFamiliaJquery/{id}',          'AlcoparController@getFamiliaJquery');       
        Route::get('/reving/jquery/getCategoriaExtraJquery/{id}',   'AlcoparController@getCategoriaExtraJquery');       

        Route::get('/factible',                                      'AlcoparController@factible');       
        Route::get('/factible/edit/{id}',                            'AlcoparController@factibledit'); 
        Route::post('/factible/procesafactible',                     'AlcoparController@procesafactible');  
        
        Route::get('/factible/procesarechazar',                      'AlcoparController@procesarechazarfac');       
        Route::get('/factible/procesarechazar3',                     'AlcoparController@procesarechazarfac3');
        Route::post('/factible/procesarechazarfac1',                 'AlcoparController@procesarechazarfac1');   

        Route::get('/altamaterial',                                   'AlcoparController@altamaterial');       
        Route::post('/factible/altamaterialupdate',                   'AlcoparController@altamaterialupdate');
        Route::get('/altamaterial/existente',                         'AlcoparController@altamaterialexistente'); 

        Route::post('/altamaterial/save',                              'AlcoparController@altamaterialexistentesave'); 
        Route::post('/altamaterial/guardar',                           'AlcoparController@altamaterialexistenteguardar'); 

        Route::get('/classat',                                       'AlcoparController@classat');       
        Route::get('/classat/edit/{id}',                             'AlcoparController@classatedit');  
        Route::post('/classat/guardar',                               'AlcoparController@classatguardar'); 
        Route::get('/classat/clasificacionconsulta',                  'AlcoparController@clasificacionconsulta');       

        Route::get('/precio',                                      'AlcoparController@precio');       
        Route::get('/precio/edit/{id}',                             'AlcoparController@precioedit');  
        Route::post('/precio/precioprocess',                                      'AlcoparController@precioprocess'); 

        Route::get('/oow',                                      'AlcoparController@oow');       
        Route::get('/oow/edit/{id}',                             'AlcoparController@oowedit');  
        Route::post('/oow/oowprocess',                                      'AlcoparController@oowprocess'); 
        
    });
});
