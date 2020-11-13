@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container d-flex justify-content-end mb-3">
            <a href="{{ route('recibo-materiales.create') }}" class="btn btn-info">
                Nuevo Folio
            </a>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Folios de Recibo de Materiales Abiertos
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg">
                            <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Folio Caseta</th>
                                <th>Proveedor</th>
                                <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reciboFolios as $folio)
                                <tr>
                                    <td>
                                        <a href="{{ route('recibo-materiales.show', ['reciboFolio'=> $folio->id]) }}">
                                            {{ $folio->id }}
                                        </a>
                                    </td>
                                    <td>{{ $folio->fecha }}</td>
                                    <td>{{ $folio->folio_caseta }}</td>
                                    <td>{{ $folio->vendor }}</td>
                                    <td>{{ $folio->materilaesVendorLedTime->nombre ?? 'Sin nombre'}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
