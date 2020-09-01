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
            @csrf
            <countries-lists></countries-lists>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="username">Nombre del usuario</label>
                    <input type="text"
                           id="username"
                           name="username"
                           class="form-control"
                    >
                </div>

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
                    <label for="mail">Correo Eléctronico</label>
                    <input type="email"
                           id="mail"
                           name="mail"
                           class="form-control"
                    >
                </div>

                <div class="form-group col-md-4">
                    <label for="depto">Departamento</label>
                    <select name="depto" id="depto" class="form-control">
                        <option value="">Seleccione un departamento</option>
                        @foreach($departamentos as $depto)
                            <option value="{{ $depto->id }}">{{ $depto->departamento }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cliente">Cliente</label>
                    <input type="text"
                           id="cliente"
                           name="cliente"
                           class="form-control"
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="planta">Planta</label>
                    <select name="planta" id="planta" class="form-control">
                        <option value="">Seleccione una planta</option>
                        <option value="RS01">RS01</option>
                        <option value="RS02">RS02</option>
                        <option value="RS03">RS03</option>
                        <option value="RS04">RS04</option>
                        <option value="RS05">RS05</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <input type="submit" class="btn btn-primary" value="Crear">
            </div>
        </form>

    </div>
@endsection
