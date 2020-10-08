@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @can('carga inventario a nivel bin')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Carga Inventario a nivel de BIN</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="#" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="inventario_lx02">Formato TXT | Inventario LX02</label>
                                        <input
                                            type="file"
                                            name="inventario_lx02"
                                            class="form-control-file"
                                            accept="text/csv"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('carga inventario recibo bins')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Carga Inventario Recibo bins</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('process-recibo-bins') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="recibo_bins">Formato CSV | Recibo bins</label>
                                        <input
                                            type="file"
                                            name="recibo_bins"
                                            class="form-control-file"
                                            accept="text/csv"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
@endsection
