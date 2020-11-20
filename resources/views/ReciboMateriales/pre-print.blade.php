@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="card-title">
                Imprimir Etiquetas
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('recibo-materiales.print', ['reciboFolio' => ]) }}"></form>
                    <a href="#" class="btn btn-info">Si</a>
                    <a href="#" class="btn btn-primary">No</a>
                </div>
            </div>
        </div>
    </div>
@endsection
