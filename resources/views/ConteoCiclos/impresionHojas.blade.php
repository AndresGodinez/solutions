@extends('layouts.app')
@section('content')
    <div class="container">
        @canany([
                'descarga de hojas conteo ciclicos pdf',
                'descarga de hojas conteo ciclicos xls'
                ])
        <div class="card">
            <div class="card-header h5 text-white bg-info">
                Impresión de Hojas Conteo Cíclico
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('obtener-hojas-conteo') }}" method="post">
                        @csrf
                        <label for="num_per"> Número de Personas</label>
                        <input type="number"
                               name="num_per"
                               id="num_per"
                               class="form-control"
                               required
                        >
                        <div>
                            @can('descarga de hojas conteo ciclicos pdf')
                            <input type="submit" id="pdf" name="pdf" class="btn btn-info mt-2" value="Imprimir Hojas Conteo">
                            @endcan
                            @can('descarga de hojas conteo ciclicos xls')
                                <input type="submit" id="xls" name="xls" class="btn btn-info mt-2" value="Descargar XLS">
                            @endcan
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @endcan
    </div>

@endsection
