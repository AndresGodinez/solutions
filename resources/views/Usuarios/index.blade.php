@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <a href="{{ route('usuario.create') }}" class="btn btn-primary">Crear</a>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Pais</th>
                    <th>Region</th>
                    <th>Admin</th>
                    <th>Username</th>
                    <th>Ultacceso</th>
                    <th>Activo</th>
                    <th>Cliente</th>
                    <th>Nombre</th>
                    <th>Mail</th>
                    <th>Jefe</th>
                    <th>Depto</th>
                    <th>Cambiar</th>
                    <th>Planta</th>
                    <th colspan="3">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->id_country }}</td>
                        <td>{{ $usuario->id_region }}</td>
                        <td>{{ $usuario->admin }}</td>
                        <td>{{ $usuario->username }}</td>
                        <td>{{ $usuario->ultacceso }}</td>
                        <td>{{ $usuario->activo }}</td>
                        <td>{{ $usuario->cliente }}</td>
                        <td>{{ $usuario->nombre }}</td>
                        <td>{{ $usuario->mail }}</td>
                        <td>{{ $usuario->jefe }}</td>
                        <td>{{ $usuario->depto }}</td>
                        <td>{{ $usuario->cambiar }}</td>
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
                        <td>
                            Eliminar
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
