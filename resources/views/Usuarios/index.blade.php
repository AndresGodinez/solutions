@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('usuario.create') }}" class="btn btn-primary">Nuevo Usuario</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Ultacceso</th>
                    <th>Depto</th>
                    <th>Activo</th>
                    <th>Planta</th>
                    <th colspan="3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->mail }}</td>
                        <td>{{ $usuario->ultacceso }}</td>
                        <td>{{ $usuario->depto }}</td>
                        <td>{{ $usuario->activo }}</td>
                        <td>{{ $usuario->planta }}</td>
                        <td>
                            <a href="{{ route('usuario.show', ['usuario' => $usuario->id] ) }}">
                                Detalles
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('usuario.edit', ['usuario' => $usuario->id]) }}">
                                Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
