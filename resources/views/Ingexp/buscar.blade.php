@extends("layouts.app")

@section("content")

    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <section id="basic-datatable">
        <div class="row">
            <div class="col-sm-12">
                <h2><strong>Buscar Existente</strong></h2>
            </div>
        </div>
    </section>
    <div style="height: 30px;"></div>
    <section id="basic-datatable">

        <div class="row">
            <div class="col-sm-12">
                <div class="card p-1">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="#">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="model">Modelo</label>
                                        <input type="text" id="model" name="model" class="form-control"
                                               placeholder="Modelo">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="linea">LINEA DE PRODUCTO:</label>
                                        <select class="form-control filtro" name="linea" id="linea" require="true">
                                            <option value="0">Seleccionar Linea</option>
                                            @foreach($lineas as $linea)
                                                <option value="{{ $linea->idlinea }}"> {{ $linea->linea }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tipo">TIPO ARCHIVO:</label>
                                        <select class="form-control filtro" name="tipo" id="tipo">
                                            <option value="0">Seleccionar Tipo</option>
                                            @foreach($tipos as $tipo)
                                                <option value="{{ $tipo->idtipo }}">{{ $tipo->tipo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-info" value="Buscar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card p-1">
                    <table class="table table-striped table-bordered complex-headers table-responsive">
                        <thead>
                        <tr>
                            <th>TITULO</th>
                            <th>CATEGORIA</th>
                            <th>MODELO</th>
                            <th>LINEA</th>
                            <th>TIPO</th>
                            <th>COMENTARIOS</th>
                            <th>FECHA ACTUALIZACION</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($get_records as $record)
                            <tr>
                                <td><a target="_blank"
                                       href="{{	url('ingexp/visor/'.$get_records['idregistro']) }}"><?=substr($record->titulo,
                                            0, 40)?></a></td>
                                <td>{{ $record->categoria }}</td>
                                <td><?=substr($record->modelo, 0, 40)?></td>
                                <td>{{ $record->lineaRel->linea ?? ''}}</td>
                                <td>{{ $record->tipoRel->tipo ?? ''}}</td>
                                <td>{{ $record->comentarios }}</td>
                                <td>{{ $record->fecha }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 p-1">
                {!! $get_records->appends(request()->all())->links() !!}
            </div>
        </div>
    </section>
@endsection
