<?php

Route::get('/factura', 'ReciboMaterialesFacturaController@cargaFactura')
    ->name('recibo-materiales.carga-factura');

Route::get('/factura/{reciboFolio}/form', 'ReciboMaterialesFacturaController@cargaFacturaPorFolio')
    ->name('recibo-materiales.carga-factura-por-folio');

Route::post('/factura/{reciboFolio}/process-factura-por-folio', 'ReciboMaterialesFacturaController@processFactura')
    ->name('recibo-materiales.process-factura-por-folio');
