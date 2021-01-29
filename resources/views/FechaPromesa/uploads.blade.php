@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <hr />
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header h5 bg-warning text-white">
                        Carga BO (main)
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        **NOTA el archivo TIENE QUE SER un formato .TXT
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('fecha-promesa/upload-backorder-main') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="backorder_file">Archivo de backorder</label>
                                <input type="file"
                                       id="backorder_file"
                                       name="backorder_file"
                                       class="form-control-file"
                                       accept="text/txt"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="cargar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header h5 bg-warning text-white">
                        Carga Dchain
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        **NOTA el archivo TIENE QUE SER un formato .CSV
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ url('fecha-promesa/upload-dchain') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="backorder_file">Archivo de dchain</label>
                                <input type="file"
                                       id="backorder_file"
                                       name="backorder_file"
                                       class="form-control-file"
                                       accept="text/csv"
                                       required
                                >
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="cargar">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

