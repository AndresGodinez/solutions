@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

    <div class="container">
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header">
                    <h4 class="card-title">Subir Archivo Stock Básico de Técnicos</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <form action="{{route('upload-stock-tecnico.process')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="file_bin">Cargar Archivo Bin</label>
                                <input type="file" id="file_bin" name="file_bin" class="form-control-file" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Enviar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

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
                                <th class="text-center">MATERIAL</th>
                                <th class="text-center">MAX</th>
                                <th class="text-center">STOCK</th>
                                <th class="text-center">SURTIR</th>
                                <th class="text-center">EDITAR</th>
                                <th class="text-center">ELIMINAR</th>
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
                'ajax': "{{ url('stock-basico-tecnico/datoinicial-bin')}}?bin={{$bin}}",
                'order': [
                    [1, 'desc'],
                ],
                'columns': [
                    {
                        data: 'bin',
                    },
                    {
                        data: 'sloc',
                    }, {
                        data: 'material',
                    }, {
                        data: 'max',
                    }, {
                        data: 'stock',
                    }, {
                        data: 'surtir',
                    },{
                        render:buttonEdit,
                        data: null,
                    },{
                        render: buttonDelete,
                        data:null,
                    },
                ],

            });
        });
    </script>

    <script type="text/javascript">
        function buttonEdit(e) {
            return `<button id="manageBtn" type="button" onclick="edit('${e.id}')"
                    class="btn btn-success btn-xs">  Editar </button>`;
        }
        function edit(id) {
            console.log('editar');
            console.log(id);
        }

        function buttonDelete(e) {
            return `<button id="manageBtn" type="button" onclick="deleteItem('${e.id}')"
                    class="btn btn-danger btn-xs">  Eliminar </button>`;
        }
        function deleteItem(id) {
            console.log('delete');
            console.log(id);
        }


    </script>

@endsection
