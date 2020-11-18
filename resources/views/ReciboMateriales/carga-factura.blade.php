@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Folios de Recibo de Materiales por Ingresar
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
                                <th colspan="2"></th>
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
                                    <td>
                                        <a href="{{ route('recibo-materiales.carga-factura-por-folio', [ 'reciboFolio' => $folio->id ]) }}">
                                            {{ 'CARGAR FACTURAS'}}
                                        </a>
                                    </td>
                                    <td>{{ 'CARGAR CAPTURA'}}</td>
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
