<?php

namespace App\Http\Controllers;

use App\Departamento;
use App\Http\Requests\UsuarioStoreRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Usuario;
use Illuminate\Http\Request;
use function compact;
use function redirect;
use function route;

class UsuariosController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = Usuario::orderByDesc('id')
            ->paginate();

        return view('Usuarios.index', compact('usuarios'));
    }

    public function show(Usuario $usuario)
    {
        dd($usuario);
    }

    public function edit(Usuario $usuario)
    {
        $departamentos = Departamento::all();

        return view('Usuarios/edit',
            compact('usuario', 'departamentos'));
    }

    public function store(UsuarioStoreRequest $request)
    {
        $depto = Departamento::find($request->get('depto'));

        Usuario::create([
            'nombre' => $request->get('nombre'),
            'username' => $request->get('username'),
            'mail' => $request->get('mail'),
            'depto' => $depto->departamento ?? '',
            'planta' => $request->get('planta'),
            'id_contry' => $request->get('country'),
            'id_region' => $request->get('region'),
            'cliente' => $request->get('cliente')
        ]);

        return redirect(route('usuarios.index'));
    }

    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $depto = Departamento::find($request->get('depto'));

        $usuario->update([
            'nombre' => $request->get('nombre'),
            'username' => $request->get('username'),
            'mail' => $request->get('mail'),
            'depto' => $depto->departamento ?? '',
            'planta' => $request->get('planta'),
            'id_contry' => $request->get('country'),
            'id_region' => $request->get('region'),
            'cliente' => $request->get('cliente')
        ]);

        return redirect(route('usuarios.index'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        return view('Usuarios.create', compact('departamentos'));
    }
}
