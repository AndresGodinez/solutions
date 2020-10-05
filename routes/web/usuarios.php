<?php
Route::middleware('auth')->group(function () {

//Usuarios
    Route::get('/usuarios-export', 'UsuariosController@download')
        ->name('usuarios.export')->middleware('permission:exportar usuarios');

    Route::post('/delete-usuario', 'UsuariosController@destroy')
        ->name('usuario.delete')->middleware('permission:eliminar usuarios');

    Route::get('usuario-edit-password', 'UsuariosController@editPassword')
        ->name('usuario.editPassword');

    Route::post('usuario-update-password', 'UsuariosController@updatePassword')
        ->name('usuario.updatePassword');

    Route::get('/usuarios', 'UsuariosController@index')
        ->name('usuarios.index')->middleware('permission:ver usuarios');

    Route::get('/usuario/datoinicial', 'UsuariosController@datoinicial')
        ->name('usuario.datoinicial')->middleware('permission:ver usuarios');

    Route::get('/usuario/{usuario}', 'UsuariosController@show')
        ->name('usuario.show')->middleware('permission:ver usuarios');

    Route::get('/usuario/{usuario}/edit', 'UsuariosController@edit')
        ->name('usuario.edit')->middleware('permission:editar usuarios');

    Route::post('/usuario/{usuario}', 'UsuariosController@update')
        ->name('usuario.update')->middleware('permission:editar usuarios');

    Route::post('/usuario', 'UsuariosController@store')
        ->name('usuario.store')->middleware('permission:crear usuarios');

    Route::get('/usuario-create', 'UsuariosController@create')
        ->name('usuario.create')->middleware('permission:crear usuarios');
});

Route::get('usuarios-cambiar-old-password', 'UsuariosController@changeOldPassword')
    ->name('change.oldpassword');

Route::post('usuario-update-old-password', 'UsuariosController@updateOldPassword')
    ->name('usuario.updateOldPassword');
