@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-striped table-responsive-lg">

                            <tbody>
                            <tr>
                                <td>MATERIAL</td>
                                <td>{{$materialAbc->material}}</td>
                            </tr>
                            <tr>
                                <td>DESCRIPCION</td>
                                <td>{{$materialAbc->descripcion}}</td>
                            </tr>
                            <tr>
                                <td>TIPO - {{ $materialAbc->abc }}</td>
{{--                                TODO--}}
                                <td>
                                    @if(!$materialAbc->lx02->bin)
                                        {{ 'BIN '. $materialAbc->lx02->bin}}
                                    @else
                                        {{ 'BIN '. $materialAbc->lx02->bin .'SIN INV'}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>CAJA</td>
                                <td>{{ $materialBin->caja ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>CANTIDAD</td>
                                <td class="form-row">
                                    <div class="form-group">
                                        <input type="number" class="form-control" >
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="d-flex justify-content-between">
                                    <a href="#" class="btn btn-primary">Continuar</a>
                                    <a href="#" class="btn btn-primary">Regresar</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
