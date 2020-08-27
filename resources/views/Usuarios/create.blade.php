@extends('layouts.app')
@section('content')
    @include('Partials.errors')
    <div class="container">
        <div class="card">
            <div class="card-header h5">
                {{ 'Crear Usuario' }}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('usuario.store') }}" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"
                               id="nombre"
                               name="nombre"
                               class="form-control"
                               >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control"
                               >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="depto">Departamento</label>
                        <input type="text"
                               id="depto"
                               name="depto"
                               class="form-control"
                               >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
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
    </div>
@endsection
