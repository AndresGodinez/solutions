@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Datos del material
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <th>Número de parte</th>
                        <th>Descripción</th>
                        <th>Dchain</th>
                        <th>Demanda</th>
                        <th>Fecha Creación</th>
                        <th>Fecha Actualización</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $material->part_number }}</td>
                            <td>{{ $material->part_description }}</td>
                            <td>{{ $material->part_dchain }}</td>
                            <td></td>
                            <td>{{ $material->create_date }}</td>
                            <td>{{ $material->update_date }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Disponibilidad del material
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <th>RS01</th>
                        <th>RS02</th>
                        <th>RS03</th>
                        <th>RS05</th>
                        <th>RS06</th>
                        <th>Supsa</th>
                        <th>Ramos</th>
                        <th>Celaya</th>
                        <th>Plainfield</th>
                        <th>Horizon</th>
                        </thead>
                        <tbody>
                        <td>{{ $material->rs01 }}</td>
                        <td>{{ $material->rs02 }}</td>
                        <td>{{ $material->rs03 }}</td>
                        <td>{{ $material->rs05 }}</td>
                        <td>{{ $material->rs06 }}</td>
                        <td>{{ $material->vnr_sups }}</td>
                        <td>{{ $material->vnr_rams }}</td>
                        <td>{{ $material->vnr_cela }}</td>
                        <td>{{ $material->vnr_plai }}</td>
                        <td>{{ $material->vnr_hora }}</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    Datos del material y sustituto
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-responsive">
                        <thead>
                        <th>Número de parte</th>
                        <th>Descripción</th>
                        <th>Dchain</th>
                        <th>Rel</th>
                        <th>Fecha Liga</th>
                        <th>RS01</th>
                        <th>RS02</th>
                        <th>RS03</th>
                        <th>RS05</th>
                        <th>RS06</th>
                        </thead>
                        <tbody>
                        @foreach($sustitutos as $sustituto)
                            <tr class="{{ $sustituto->sustituto_sug == 1 ? 'alert alert-danger' : '' }}" >
                                <td>{{ $sustituto->sustituto }}</td>
                                <td>{{ $sustituto->material2->part_description ?? 'no tiene descripción' }}</td>
                                <td>{{ $material->part_dchain }}</td>
                                <td>{{ $sustituto->rel }}</td>
                                <td>{{ $sustituto->fecha_liga }}</td>
                                <td>{{ $material->rs01 }}</td>
                                <td>{{ $material->rs02 }}</td>
                                <td>{{ $material->rs03 }}</td>
                                <td>{{ $material->rs05 }}</td>
                                <td>{{ $material->rs06 }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{{ url('/materiales') }}" class="btn btn-primary"> regresar</a>
        </div>
    </div>

@endsection
