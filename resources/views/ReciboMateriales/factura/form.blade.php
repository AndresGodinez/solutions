@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="card-title">
                Carga Facturas Recibo
            </div>
            <div class="card-title">
                Folio # {{ $reciboFolio->id }}
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="factura_file"></label>
                            <input type="file" id="factura_file" name="factura_file" class="form-control-file">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="submit" value="Enviar" class="btn btn-info">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
