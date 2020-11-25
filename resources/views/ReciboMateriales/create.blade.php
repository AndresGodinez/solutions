@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header bg-info text-white">
            <div class="card-title">
                Recibo de materiales
            </div>
            <div class="card-title">
                Datos de la llegada
            </div>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('recibo-materiales.store') }}" method="post">
                    @csrf
                    <table class="table">
                        <tr>
                            <td>Fecha</td>
                            <td>{{ $date }}</td>
                        </tr>
                        <tr>
                            <td>Folio Caseta</td>
                            <td>
                                <label>
                                    <input name="caseta" id="caseta" type="text" class="form-control">
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td>Proveedor</td>
                            <td>
                                <label>
                                    <select name="proveedor" id="proveedor" class="form-control">
                                        <option value="">Seleccione</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->vendor }}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-info" value="Continuar">
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        </div>
    </div>
@endsection
