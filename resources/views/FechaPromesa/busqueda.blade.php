@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h5>Consulta de Fechas Promesa</h5>
        </div>
{{--        @if(Auth::user()->hasPerm('fpromesa.dreport'))--}}
        <div class="row d-flex justify-content-between my-3">
            @can('desgargar fecha promesa general')
            <a href="{{ route('download.report.fecha.promesa.general') }}"
               class="btn btn-info">
                Reporte Fechas promesa General
            </a>
            @endcan
            @can('descargar fecha promesa detalles')
            <a href="{{ route('download.report.fecha.promesa.detalle') }}" class="btn btn-info">
                Reporte Fechas promesa Detalle
            </a>
            @endcan
        </div>
{{--        @endif--}}
        <div class="row mt-2">
            <div class="col-md-6">
                <form action="{{ route('fechas-promesa.consulta') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="no_pedido">No. de pedido</label>
                            <input type="text"
                                   id="no_pedido"
                                   name="no_pedido"
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
{{--            @if(Auth::user()->hasPerm('fpromesa.actFechas'))--}}
            @can('actualizar fechas promesas')
                @if( CheckLogs::check('wpx_log_bigprocess', 'fechas promesas'))
                    @if(!Session::has('message'))
                        <div class="col-md-4 d-flex">
                            <form action="{{ route('actualizarFechasPromesas') }}" method="post">
                                @csrf
                                <div class="form-group my-auto">
                                    <input type="submit" class="btn btn-success" value="Actualizar Fechas Promesa">
                                </div>
                            </form>
                        </div>
                    @endif
                @endif
            @endcan
{{--            @endif--}}
        </div>

        <div class="row mt-3">
{{--            @if(Auth::user()->hasPerm('fpromesa.promesastracker'))--}}
            @can('carga archivo fechas promesas tracker')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header h5 bg-warning text-white">
                        Fechas promesas Tracker
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert ">
                        <a href="{{route('download-template-fechas-promesas-tracker')}}" class="btn btn-primary btn-block">Descargar template</a>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        **NOTA el archivo TIENE QUE SER un formato .CSV
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('upload-promesa-tracker-process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="promesa_tracker_file">Archivo de promesa tracker</label>
                                <input type="file"
                                       id="promesa_tracker_file"
                                       name="promesa_tracker_file"
                                       class="form-control-file"
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
            @endcan
{{--            @endif--}}
{{--            @if(Auth::user()->hasPerm('fpromesa.leadtime'))--}}
            @can('carga archivo fechas promesas lead time')

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header h5 bg-warning text-white">
                        Carga Lead time
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert ">
                        <a href="{{route('download-template-fechas-promesas-lead-time')}}" class="btn btn-primary btn-block">Descargar template</a>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        **NOTA el archivo TIENE QUE SER un formato .CSV
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('upload-lead-time-process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="lead_time">Archivo de promesa lead time</label>
                                <input type="file"
                                       id="lead_time"
                                       name="lead_time"
                                       class="form-control-file"
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
            @endcan
{{--            @endif--}}

{{--            @if(Auth::user()->hasPerm('fpromesa.backorder'))--}}
            @can('carga archivo fechas promesas backorder')

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header h5 bg-warning text-white">
                        Carga Backorder
                    </div>
                </div>
                <div class="card-content">
                    <div class="alert ">
                        <a href="{{route('download-template-fechas-promesas-backorder')}}" class="btn btn-primary btn-block">Descargar template</a>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        **NOTA el archivo TIENE QUE SER un formato .CSV
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('upload-uploadBackorder') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="backorder_file">Archivo de backorder</label>
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
            @endcan
{{--            @endif--}}
        </div>

    </div>

@endsection
