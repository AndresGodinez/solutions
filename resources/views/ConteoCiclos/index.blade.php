@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header h5 text-white bg-info">
                Carga Materiales para Hojas de Conteo
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('process-hojas-conteo-ciclos') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="hoja_conteo_ciclos_file"> Hojas de Conteo</label>
                        <p class="alert alert-warning">
                            <strong> **NOTA El archivo TIENE QUE SER en formato .CSV </strong>
                        </p>
                        <input type="file"
                               name="hoja_conteo_ciclos_file"
                               class="form-control-file"
                               accept=".txt"
                               required
                        >
                        <div>
                            <input type="submit" class="btn btn-info mt-2" value="Subir archivo">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
