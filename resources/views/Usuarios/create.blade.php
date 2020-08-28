@extends('layouts.app')
@section('content')
    @include('Partials.errors')
    <div class="row">
        <div class="container">
            <h5>
                Crear Usuario
            </h5>
        </div>
    </div>
    <div class="container">

        <form action="{{ route('usuario.store') }}" method="post">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre</label>
                    <input type="text"
                           id="nombre"
                           name="nombre"
                           class="form-control"
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="username">Username</label>
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control"
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="depto">Departamento</label>
                    <input type="text"
                           id="depto"
                           name="depto"
                           class="form-control"
                    >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="jefe">Jefe</label>
                    <input type="text"
                           id="jefe"
                           name="jefe"
                           class="form-control"
                    >
                </div>
            </div>

            <div class="form-row">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </form>

    </div>
@endsection
