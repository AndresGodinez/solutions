@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h5>Consulta General de Materiales</h5>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('materiales.consulta') }}">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="ipt_material">No. de parte</label>
                            <input type="text"
                                   id="ipt_material"
                                   name="ipt_material"
                                   class="form-control"
                                   required
                            >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <input type="submit" class="btn btn-info" value="Consultar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <a href="{{ route('downloadMateriales') }}"
                   class="btn btn-success"
                >
                    Descargar Reporte
                </a>
            </div>
        </div>
    </div>

@endsection
