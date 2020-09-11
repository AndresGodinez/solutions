@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">


               

            

    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Carga Archivo General de Stocks</h4>
                    <a href="{{url('stock-basico-tecnico/descarga')}}" style="position:absolute; top 5px; right:25px;" class="btn btn-success">Descargar Reporte General</a>
                </div>
                
                    <div class="card-body">
                        <form action="{{route('uploadStock.process')}}" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="form-group">
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Stock Básico de Técnicos</h4>
                    </div>
                    
                        <div class="card-body">
                            <table id="ListaStockBasicoTecnico"
                                    class="table table-striped table-bordered complex-headers dataTable">
                                <thead>
                                <tr>
                                    <th class="text-center" >BIN</th>
                                    <th class="text-center" >SLOC</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
            integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#ListaStockBasicoTecnico').DataTable({
                "language": {
                    "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
                } ,
                'serverSide': true,
                'processing': true,
                'reponsive':true,
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
                        className: 'text-center',
                        data: 'sloc',
                    },
                ],

            });
        });
    </script>

    <script type="text/javascript">
        function buttonEdit(e) {
            return `<button id="manageBtn" type="button" onclick="edit('${e.bin}','${e.sloc}')"
                    class="btn btn-success" style="width:100%;" >  ${e.bin} </button>`;
        }

        function edit(bin,sloc) {
            location.href = "{{url('stock-basico-tecnico-bin')}}?bin="+bin+"&sloc="+sloc ;
        }


    </script>

@endsection
