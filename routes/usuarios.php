<?php
Route::middleware('auth')->group(function () {

//Usuarios
    Route::get('/usuarios-export', 'UsuariosController@download')
        ->name('usuarios.export');

    Route::delete('/delete-usuario', 'UsuariosController@destroy')
        ->name('usuario.delete');

    Route::get('usuario-edit-password', 'UsuariosController@editPassword')
        ->name('usuario.editPassword');

    Route::post('usuario-update-password', 'UsuariosController@updatePassword')
        ->name('usuario.updatePassword');

    Route::get('/usuarios', 'UsuariosController@index')
        ->name('usuarios.index');

    Route::get('/usuario/datoinicial', 'UsuariosController@datoinicial')
        ->name('usuario.datoinicial');

    Route::get('/usuario/{usuario}', 'UsuariosController@show')
        ->name('usuario.show');

    Route::get('/usuario/{usuario}/edit', 'UsuariosController@edit')
        ->name('usuario.edit');

    Route::post('/usuario/{usuario}', 'UsuariosController@update')
        ->name('usuario.update');

    Route::post('/usuario', 'UsuariosController@store')
        ->name('usuario.store');

    Route::get('/usuario-create', 'UsuariosController@create')
        ->name('usuario.create');
});

Route::get('usuarios-cambiar-old-password', 'UsuariosController@changeOldPassword')
    ->name('change.oldpassword');

Route::post('usuario-update-old-password', 'UsuariosController@updateOldPassword')
    ->name('usuario.updateOldPassword');
