@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        imprimir etiquetas
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('recibo-materiales.print2') }}" method="post">
                            @csrf
                            <input type="hidden" name="cantidad" value="{{ $cantidad }}">
                            <input type="hidden" name="material" value="{{ $material }}">
                            <input type="hidden" name="descripcion" value="{{ $descripcion }}">
                            <input type="hidden" name="fecha" value="{{ $fecha }}">
                            <input type="hidden" name="etiqueta" value="{{ $etiqueta }}">
                            <input type="hidden" name="recibo_folio_id" value="{{ $reciboFolio->id }}">
                            <div class="form-group mt-4">
                                <div class="d-flex justify-content-between">
                                    <input type="submit" value="si" class="btn btn-info">
                                    <a href="{{ route('recibo-materiales.show', ['reciboFolio' => $reciboFolio->id]) }}" class="btn btn-info">No</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
