@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between ">
            <a href="{{ route('usuario.create') }}" class="btn btn-primary">Nuevo Usuario</a>
            <a href="{{ route('usuarios.export') }}" class="btn btn-success">Descargar Usuarios</a>
        </div>
        <div class="row pt-3">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th colspan="3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->mail }}</td>
                        <td>
                            <a href="{{ route('usuario.show', ['usuario' => $usuario->id] ) }}"
                               class="btn btn-info text-white"
                            >
                                Detalles
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('usuario.edit', ['usuario' => $usuario->id]) }}"
                               class="btn btn-secondary"
                            >
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row pt-3">
            {{ $usuarios->appends(request()->all())->links() }}
        </div>
    </div>
@endsection
