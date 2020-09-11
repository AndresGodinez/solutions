@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

    <div class="container">

        <div class="row d-flex justify-content-between my-3 ">
            <a href="#" class="btn btn-primary">Nuevo Usuario</a>
            <a href="#" class="btn btn-success">Descargar Usuarios</a>
        </div>

        <section id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stock Básico de Técnicos</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="ListaStockBasicoTecnico"
                               class="table table-striped table-bordered table-responsive complex-headers dataTable"
                        >
                            <thead>
                            <tr>
                                <th class="text-center">BIN</th>
                                <th class="text-center">SLOC</th>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
            integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#ListaStockBasicoTecnico').DataTable({
                'serverSide': true,
                'processing': true,
                'ajax': "{{ url('stock-basico-tecnico/datoinicial')}}",
                'order': [
                    [1, 'desc'],
                ],
                'columns': [
                    {
                        'render': buttonEdit,
                        'data': null,
                    },
                    {
                        data: 'sloc',
                    },
                ],

            });
        });
    </script>

    <script type="text/javascript">
        function buttonEdit(e) {
            return `<button id="manageBtn" type="button" onclick="edit('${e.bin}')"
                    class="btn btn-success btn-xs">  ${e.bin} </button>`;
        }

        function edit(bin) {
            location.href = "{{url('stock-basico-tecnico-bin')}}?bin="+bin ;
        }


    </script>

@endsection
