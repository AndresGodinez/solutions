<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = Usuario::orderByDesc('id')
            ->where('activo', 1)
            ->paginate();

        return view('Usuarios.index', compact('usuarios'));
    }

    public function show(Usuario $usuario)
    {
        dd($usuario);
    }

    public function edit(Usuario $usuario)
    {
//        dd('edit');

        return view('Usuarios/edit', compact('usuario'));
    }

    public function store(UsuarioStoreRequest $request)
    {
        dd($request->all());

    }

    public function update(UsuarioUpdateRequest $request)
    {
        dd($request->all());
    }
}
