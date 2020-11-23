@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Folios de Recibo de Materiales
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg">
                            <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Folio Caseta</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{ $reciboFolio->id }}
                                </td>
                                <td>{{ $reciboFolio->folio_caseta }}</td>
                                <td>{{ $reciboFolio->materilaesVendorLedTime->nombre ?? 'Sin nombre'}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Datos de llegada
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('recibo-materiales.description', ['reciboFolio' => $reciboFolio->id]) }}"
                              method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="material">Material</label>
                                    <input type="text"
                                           id="material"
                                           name="material"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="submit" value="continuar" class="btn btn-info">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('recibo-materiales.index') }}" class="btn btn-info">Folios Abiertos </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
