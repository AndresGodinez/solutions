@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h5>Proceso masivo de cálculo de sustitutos</h5>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <form action="{{route('sustitutos.carga-mm60')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="carga-mm60">Carga MM60</label>
                    <p>1.- Primero, debes cargar la tabla de MM60.</p>
                    <p class="alert alert-warning">
                        <strong> **NOTA El archivo TIENE QUE SER en formato .TXT </strong>
                    </p>
                    <input type="file"
                           name="carga-mm60"
                           class="form-control-file"
                           accept="text/plain"
                           required
                    >
                    <div>
                        <input type="submit" class="btn btn-info mt-2" value="Subir archivo">
                    </div>
                </form>
            </div>
            <div class="form-group col-md-6">
                <form action="{{route('sustitutos.carga-fecha-creacion-piezas')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="file_c_date_pzas">Carga Fecha creación de piezas</label>
                    <p>2.- Después, debes cargar las fechas de creación de las piezas. </p>
                    <p class="alert alert-warning">
                        <strong> **NOTA El archivo TIENE QUE SER en formato .TXT</strong>
                    </p>
                    <input type="file"
                           id="file_c_date_pzas"
                           name="file_c_date_pzas"
                           class="form-control-file"
                           accept="text/plain"
                           required
                    >
                    <div>
                        <input type="submit" class="btn btn-info mt-2" value="Subir archivo">
                    </div>
                </form>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <form action="{{ route('sustitutos.carga-inventarios') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="file_plantas">Carga de Inventarios</label>
                    <p>3.- Después, debes cargar los inventarios restantes de las piezas. </p>
                    <p class="alert alert-warning">
                        <strong> **NOTA El archivo TIENE QUE SER en formato .TXT</strong>
                    </p>
                    <input type="file"
                           id="file_plantas"
                           name="file_plantas"
                           class="form-control-file"
                    >
                    <div>
                        <input type="submit" class="btn btn-info mt-2" value="Subir archivo">
                    </div>
                </form>
            </div>
            <div class="form-group col-md-6">
                <form action="{{ route('sustitutos.carga-masiva-sustitutos') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="carga_masiva">Carga Masiva Sustitutos</label>
                    <p class="alert alert-warning">
                        <strong> **AQUÍ puedes cargar tu archivo generado de SAP para actualizar los sustitutos en
                            el sistema, recuerda que el archivo TIENE QUE SER en formato .CSV</strong>
                    </p>
                    <input type="file"
                           id="carga_masiva"
                           name="carga_masiva"
                           class="form-control-file"
                           required
                           accept="text/csv"
                    >
                    <div>
                        <input type="submit" class="btn btn-info mt-2" value="Subir archivo">
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
