@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stock Inicial</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">

                        <a class="btn btn-success" style="position: absolute; top:15px; right:15px;" href="{{ url('stock/descagainicial')}}">
                            <i class="bx bx-excel"></i> Descargar Excel
                        </a>

                        <table id="example" class="table table-striped table-bordered complex-headers dataTable" style="width:100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>NUM PARTE</th>
                                    <th class="text-center">DESCRIPCION</th>
                                    <th class="text-center">MODELO</th>
                                    <th class="text-center">TIPO MATERIAL</th>
                                    <th class="text-center">CATEGORIA</th>
                                    <th class="text-center">USUARIO</th>
                                    <th class="text-center">FECHA CARGA</th>
                                    <th class="text-center">DIAS PENDIENTE</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": "{{ url('stock/datoinicial')}}",

            "order": [
                [6, "desc"]
            ],
            "columns": [{
                    data: 'no_parte'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'modelo'
                },
                {
                    data: 'tipo_material'
                }, {
                    data: 'categoria'
                }, {
                    data: 'nombre'
                }, {
                    data: 'fecha_carga'
                }, {
                    data: 'fecha_usuario'
                }, {
                    "render": createManageBtn,
                    "data": null
                }
            ],

        });

    });

    function createManageBtn(e) {
        return '<button id="manageBtn" type="button" onclick="myFunc(' + e.id + ')" class="btn btn-success btn-xs">Acción</button>';
    }

    function myFunc(id) {
        location.href = "{{url('usuario')}}/" + id + "/edit";
    }
</script>

@endsection
