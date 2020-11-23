@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header">
                    Detalle de Fecha Promesa
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Fecha Pedido</th>
                            <th>Status Pedido</th>
                            <th>Fecha Promesa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $fechaPromesa->pedido }}</td>
                            <td>{{ $fechaPromesa->fecha_pedido }}</td>
                            <td>{{ $fechaPromesa->status_pedido }}</td>
                            <td>{{ $fechaPromesa->fecha_promesa }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>No. Parte</th>
                            <th>Pedido</th>
                            <th>Fecha Pedido</th>
                            <th>Status de No. parte</th>
                            <th>Fecha Promesa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fechaPromesa->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->material }}</td>
                                <td>{{ $detalle->pedido }}</td>
                                <td>{{ $detalle->fecha_pedido }}</td>
                                <td>{{ $detalle->status_material }}</td>
                                <td>{{ $detalle->fecha_promesa }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="javascript:history.back()" class="btn btn-info"> Regresar</a>
                </div>

            </div>
        </div>
    </div>

@endsection
