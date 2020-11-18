@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
                    <form action="{{ route('recibo-materiales.pre-print') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <table class="table table-striped table-responsive-lg">
                                <tbody>
                                <tr>
                                    <td>MATERIAL</td>
                                    <td>{{$materialAbc->material ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>DESCRIPCION</td>
                                    <td>{{ substr($materialAbc->descripcion, 0, 15) ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>TIPO - {{ $materialAbc->abc ?? ''}}</td>
                                    {{--                                TODO--}}
                                    <td>
                                        @if($materialAbc->lx02->bin)
                                            {{ 'BIN - '. $materialAbc->lx02->bin }}
                                        @else
                                            {{ 'BIN - '. $materialAbc->lx02->bin .' SIN INV'}}
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
                                            <label>
                                                <input name="material"
                                                       type="hidden"
                                                       value="{{$materialAbc->material ?? ''}}">

                                                <input name="description"
                                                       type="hidden"
                                                       value="{{ substr($materialAbc->descripcion, 0, 15) ?? ''}}">
                                                <input name="quantity_to_print" type="number" class="form-control">
                                                <input name="caja" value="{{ $materialBin->caja ?? ''}}" type="hidden" >
                                                <input name="tipo" value="{{ $materialAbc->abc ?? ''}}" type="hidden" >
                                                @if($materialAbc->lx02->bin)
                                                    <input name="bin"
                                                           type="hidden"
                                                           value="{{ 'BIN - '. $materialAbc->lx02->bin }}"  >
                                                @else

                                                    <input name="bin"
                                                           type="hidden"
                                                           value="{{ 'BIN - '. $materialAbc->lx02->bin .' SIN INV'}}"  >

                                                @endif
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="d-flex justify-content-between">
                                        <input type="submit"
                                               class="btn btn-primary"
                                               value="Continuar"
                                        >

                                        <input type="button"
                                               class="btn btn-primary"
                                               value="Regresar"
                                               onclick="history.back()"
                                        />
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
