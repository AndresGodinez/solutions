@extends('layouts.app')
@section('content')
    <div class="container">
        @include('Partials.errors')
        <div class="row">
            <h5>Consulta de Fechas Promesa</h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('fechas-promesa.consulta') }}">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="no_pedido">No. de pedido</label>
                            <input type="text"
                                   id="no_pedido"
                                   name="no_pedido"
                                   class="form-control"
                                   required
                            >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Consultar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
