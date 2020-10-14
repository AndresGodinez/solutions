<?php
Route::middleware('auth')->group(function () {

//Roles

    Route::get('/role-create', 'RolesController@create')
        ->name('role.create')
        ->middleware('permission:crear roles');

    Route::post('/role-store', 'RolesController@store')
        ->name('roles.store')
        ->middleware('permission:crear roles');

    Route::get('/roles', 'RolesController@index')
        ->name('roles.index')
        ->middleware('permission:ver roles');

    Route::get('/role-edit/{role}', 'RolesController@edit')
        ->name('role.edit')
        ->middleware('permission:editar roles');

    Route::post('/role-update/{role}', 'RolesController@update')
        ->name('role.update')
        ->middleware('permission:editar roles');

    Route::post('/role-destroy/{role}', 'RolesController@destroy')
        ->name('role.destroy')
        ->middleware('permission:eliminar roles');

});
