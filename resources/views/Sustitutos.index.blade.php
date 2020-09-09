@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

    <div class="container">

        <div class="row d-flex justify-content-between my-3 ">
            <a href="{{ route('materiales-sustitutos.solicitud') }}" class="btn btn-primary">Nueva Solicitud</a>
        </div>

        <section id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Solicitudes</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="example" class="table table-striped table-bordered complex-headers dataTable" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">No.parte</th>
                                <th class="text-center">Descripción</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ing</th>
                                <th class="text-center">Mat</th>
                                <th class="text-center">Ven</th>
                                <th class="text-center">Días</th>
                                <th class="text-center">Solicitante</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </section>

    </div>


    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": "{{ url('solicitudes/datoinicial')}}",
                "order": [
                    [0, "desc"]
                ],
                "columns": [
                    {
                        data: 'id'
                    },
                    {
                        "render" : noParteButton,
                        "data" : null
                    },
                    {
                        data: 'descripcion'
                    }, {
                        "data" : status
                    }, {
                        "data" : ing
                    },{
                        "data" : mat
                    },{
                        "data" : ven
                    },{
                        "data" : dias
                    },{
                        "data" : solicitante
                    },
                ],

            });
        });
    </script>

    <script type="text/javascript">
        function noParteButton(e) {

            return '<button id="manageBtn" type="button" onclick="showDetail('+e.id+')" class="btn btn-success btn-xs">Mostrar Detalle</button>';
        }
        function showDetail(id) {
            location.href = "{{url('usuario')}}/" + id + "/edit";
        }
    </script>

@endsection
