@extends("layouts.app")

@section("content")
<?php
// dd($get_records);
?>
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/pickers/daterange/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<section id="basic-datatable">
    <div class="row">
        <div class="col-sm-12">
            <h2><strong>Lista de Solicitudes</strong></h2>
        </div>
    </div>
</section>
<div style="height: 30px;"></div>
<section id="basic-datatable">

    <div class="row">
        <div class="col-sm-12">
            <div class="card p-1">
                <table class="table table-striped table-bordered complex-headers ">
                    <thead>
                        <tr>
                            <th>NOMBRE COMERCIAL</th>
                            <th>DUEÑO</th>
                            <th>EMAIL</th>
                            <th>TELEFONO</th>
                            <th>STATUS</th>
                            <th style="width: 1%;">
                                <CENTER>#</CENTER>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($get_records as $get_records)
                        <tr>
                            <td>{{ $get_records['nombre_comercial'] }}</td>
                            <td>{{ $get_records['nombre_del_dueno'] }}</td>
                            <td>{{ $get_records['email'] }}</td>
                            <td>{{ $get_records['telefono_dueno'] }}</td>
                            <td>
                                <?php
                                if ($get_records['status'] == 0) {
                                ?>
                                    <span class="badge badge-light-info">Solicitado</span>
                                <?php
                                } else if ($get_records['status'] == 1) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                } else if ($get_records['status'] == 2) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                } else if ($get_records['status'] == 3) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                } else if ($get_records['status'] == 4) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                } else if ($get_records['status'] == 5) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                } else if ($get_records['status'] == 6) {
                                ?>
                                    <span class="badge badge-light-success">Solicitud</span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <center>
                                    <button class="btn btn-info checkvalue" rel="<?= $get_records['id'] ?>"><i class="bx bx-show-alt"></i></button>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>



    <div class="modal fade text-left w-100" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Detalles </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="detallescliente">
                        
                    </div>
                    
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cerrar</span>
                        </button>
                    </div>
            </div>
        </div>



        <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
        <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

        <script src="{{ asset('assets') }}/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
        <script src="{{ asset('assets') }}/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
        <script src="{{ asset('assets') }}/app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
        <script src="{{ asset('assets') }}/app-assets/vendors/js/pickers/pickadate/legacy.js"></script>

        <script>
          

            $('.filtro').on('change', function() {
                var tipo = $('#tipo').val();
                var linea = $('#linea').val();
                window.location = '<?php echo url('/ingexp/buscar/'); ?>?tipo=' + tipo + '&linea=' + linea
            });

            $('.table').DataTable({
                "responsive": true,
                "language": {
                    "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
                }
            });

            <?php
            if (@$_GET['success'] == 1) {
            ?>
                Swal.fire({
                    type: "success",
                    title: '¡Ejecutado con éxito!',
                    text: '',
                    confirmButtonClass: 'btn btn-success',
                });
            <?php
            } ?>

            $('.checkvalue').click(function() {
                var id = $(this).attr('rel');
                $('.detallescliente').html('<center style="margin-bottom:20px; margin-top:20px;"><div class="spinner-border text-warning" role="status"><span class="sr-only">Loading...</span></div></center>');
                $('#xlarge').modal('show');
                $.get("{{ url('ingexp/cargardetallessolicitud')}}/"+id, function(data) {
                    $('.detallescliente').html(data);
                });


            });
        </script>
        @endsection