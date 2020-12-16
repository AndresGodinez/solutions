@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/extensions/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">


    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Conclusion Inicial</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">

                            <a class="btn btn-success" style="position: absolute; top:15px; right:15px;"
                               href="{{ url('stock/descagainicial')}}">
                                <i class="bx bx-excel"></i> Descargar Excel
                            </a>

                            <table id="example" class="table table-striped table-bordered complex-headers dataTable"
                                   style="width:100%" style="width:100%">
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

    <div class="modal fade text-left modal-borderless" id="detalles" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Detalle</h3>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-content">
                        <div class="card-body loader-modal">
                            <center>
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="spinner-border text-warning" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>

                                <div class="spinner-border text-dark" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </center>
                        </div>
                        <div class="card-body contenido-modal" style="display:none;">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Regresar</span>
                    </button>

                </div>
            </div>
        </div>
    </div>



    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

    <script>

        function autorizando() {
            var next = 0;
            $('.formulariovalidacion').each(function(index) {
                var v = $(this).val();
                if (v != '') {
                    $(this).removeClass('is-invalid');
                    $(this).addClass('is-valid');
                    next = 1;
                } else {
                    $(this).removeClass('is-valid');
                    $(this).addClass('is-invalid');
                }
            });

            if (next == 1) {
                Swal.fire({
                    title: '¡Atención!',
                    text: '¿Deseas seguir con esta acción?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-1',
                    buttonsStyling: false,
                }).then(function(result) {
                    if (result.value) {
                        let form = $('.formenvio').serialize();
                        $.post("{{ url('stock/conclusioninicial_update')}}", form, function(data) {
                            Swal.fire({
                                type: 'success',
                                title: '¡Hecho!',
                                text: '',
                                confirmButtonClass: 'btn btn-success',
                            });
                        });

                    }
                });

            }

        };

        $(document).ready(function() {
            $('#example').DataTable({
                'serverSide': true,
                'processing': true,
                'language': {
                    'url': "{{ asset('assets') }}/dt-lang/Spanish.json",
                },
                'ajax': "{{ url('stock/conclusioninicial_dt')}}",

                'order': [
                    [6, 'desc'],
                ],
                'columns': [
                    {
                        data: 'no_parte',
                    },
                    {
                        data: 'descripcion',
                    },
                    {
                        data: 'modelo',
                    },
                    {
                        data: 'tipo_material',
                    }, {
                        data: 'categoria',
                    }, {
                        data: 'nombre',
                    }, {
                        data: 'fecha_carga',
                    }, {
                        data: 'fecha_usuario',
                    }, {
                        'render': createManageBtn,
                        'data': null,
                    },
                ],

            });

        });

        function createManageBtn(e) {
            return '<button id="manageBtn" type="button" style="padding: 10px;" onclick="openDetalles(' + e.id +
                ')" class="btn btn-success btn-xs">' + '<i class=\'bx bx-show-alt\' style=\'font-size:25px\'></i>' +
                '</button>';
        }

        function openDetalles(id) {

            $('.contenido-modal').html('');
            $('.contenido-modal').hide();
            $('.loader-modal').show();
            $('#detalles').modal();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });

            $.ajax({
                url: "{{ url('stock/conclusioninicial_detalle')}}",
                type: 'POST',
                data: {
                    'id': id,
                },
                success: function(data) {
                    $('.loader-modal').hide();
                    $('.contenido-modal').html(data);
                    $('.contenido-modal').show();
                },
            });

        }
    </script>

@endsection
