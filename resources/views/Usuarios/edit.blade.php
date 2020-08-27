@extends('layouts.app')
@include('Partials.errors')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header h5">
                {{ 'Editar Usuario' }}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('usuario.update') }}" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"
                               id="nombre"
                               name="nombre"
                               class="form-control"
                               value="{{ $usuario->nombre }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control"
                               value="{{ $usuario->mail }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control"
                               value="{{ $usuario->username }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="depto">Departamento</label>
                        <input type="text"
                               id="depto"
                               name="depto"
                               class="form-control"
                               value="{{ $usuario->depto }}">
                    </div>
                </div>

                <div class="form-row">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
@endsection
