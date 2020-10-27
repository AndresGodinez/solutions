@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Impresión de Etiquetas 2
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h5>Datos del material</h5>
                        <form action="{{ route('impresion.etiquetas.print') }}" method="post">
                            @csrf
                            <input type="hidden" name="material-to-print" value="{{ $material->material }}">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="material">Número de parte</label>
                                    <input type="text"
                                           id="material"
                                           name="material"
                                           class="form-control"
                                           required
                                           disabled
                                           value="{{ $material->material }}"
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="mat_descript">Descripción</label>
                                    <input type="text"
                                           id="mat_descript"
                                           name="mat_descript"
                                           class="form-control"
                                           required
                                           disabled
                                           value="{{ $material->descripcion }}"
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="pieces">Piezas</label>
                                    <input type="number"
                                           id="pieces"
                                           name="pieces"
                                           class="form-control"
                                           value="{{ 1 }}"
                                           required
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="quantity">Cantidad de etiquetas</label>
                                    <input type="number"
                                           id="quantity"
                                           name="quantity"
                                           class="form-control"
                                           required
                                           value={{ 1 }}
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
