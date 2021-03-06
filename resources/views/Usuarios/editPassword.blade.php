@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <h5>
                Cambio de contraseña
            </h5>
        </div>
    </div>
    <div class="container">
        <form action="{{ route('usuario.updatePassword') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ $usuario->id }}">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="username">Login</label>
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control"
                           value="{{ $usuario->username }}"
                           disabled
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre del usuario</label>
                    <input type="text"
                           id="nombre"
                           name="nombre"
                           class="form-control"
                           value="{{ $usuario->nombre }}"
                           disabled
                    >
                </div>
            </div>
            @if($request_old_password)
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="old_password">Contraseña anterior</label>
                    <input type="password"
                           id="old_password"
                           name="old_password"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            @endif
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="new_password">Nueva Contraseña</label>
                    <input type="password"
                           id="new_password"
                           name="new_password"
                           class="form-control"
                           required
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="new_password_confirm">Confirmar Nueva Contraseña</label>
                    <input type="password"
                           id="new_password_confirm"
                           name="new_password_confirm"
                           class="form-control"
                           required
                    >
                </div>
            </div>


            <div class="form-row">
                <input type="submit" class="btn btn-primary" value="Actualizar">
            </div>
        </form>

    </div>
@endsection
