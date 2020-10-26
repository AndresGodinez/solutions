@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Impresión de Etiquetas
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h5>Datos del material</h5>
                        <form action="{{ route('impresion.etiquetas.consulta') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="material">Número de parte</label>
                                    <input type="text"
                                           id="material"
                                           name="material"
                                           class="form-control"
                                           required
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info" value="Imprimir">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
