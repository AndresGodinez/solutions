@extends('layouts.app')

@section('content')
<input name="bin" hidden class="binvalue" value="<?=$_GET['bin']?>" />
<input name="sloc" hidden class="slocvalue" value="<?=$_GET['sloc']?>" />
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
          <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/extensions/sweetalert2.min.css">
          <meta name="csrf-token" content="{{ csrf_token() }}" />
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <section id="basic-datatable">
            <div class="row">
                <div class=" col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Subir Archivo Stock Básico de Técnicos <small>[Cargar Archivo Bin]</small></h4>
                            <a href="{{url('stock-basico-tecnico/descargabin')}}/<?=$_GET['bin']?>"
                               style="position:absolute; top: 5px; right:25px;"
                               class="btn btn-success">Descargar Reporte</a>
                        </div>
                        <div class="card-body">
                            <form action="{{route('upload-stock-tecnico.process')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="file" id="file_bin" name="file_bin" class="form-control-file" required>
                                    <input name="bin" hidden class="bin" value="<?=$_GET['bin']?>" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Enviar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Stock Básico de Técnicos</h4>
                    <button class="btn btn-success"
                            data-toggle="modal"
                            data-target="#add"
                            style="position: absolute; right:25px; top:15px;">
                        <i class="bx bx-plus"></i> Agregar
                    </button>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="ListaStockBasicoTecnico" class="table table-striped table-bordered complex-headers dataTable">
                            <thead>
                            <tr>
                                <th class="text-center">BIN</th>
                                <th class="text-center">SLOC</th>
                                <th class="text-center">MATERIAL</th>
                                <th class="text-center">MAX</th>
                                <th class="text-center">STOCK</th>
                                <th class="text-center">SURTIR</th>
                                <th style="width: 2%;" class="text-center">EDITAR</th>
                                <th style="width: 2%;" class="text-center">ELIMINAR</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </section>


        <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel1">Editar</h3>
                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
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
                    <div class="modal-body contenido-modal" style="display:none;">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cerrar</span>
                        </button>
                        <button type="button" class="btn btn-success ml-1 saveedit">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Guardar Cambios</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade text-left" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel1">Agregar nuevo</h3>
                        <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </button>
                    </div>
                    <div class="modal-body contenido-modal">
                        <form class="formadd">
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="sizing-addon1">Material</span>
                                </div>
                                <input name="material"
                                       type="text"
                                       class="form-control add_form_material"
                                       value=""
                                       placeholder="Material"
                                       aria-describedby="sizing-addon1">
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="sizing-addon1">MAX</span>
                                </div>
                                <input
                                    name="max"
                                    type="text"
                                    class="form-control add_form_max"
                                    value=""
                                    placeholder="MAX"
                                    aria-describedby="sizing-addon1">
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="sizing-addon1">Stock</span>
                                </div>
                                <input
                                    name="stock"
                                    type="text"
                                    class="form-control add_form_stock"
                                    value=""
                                    placeholder="Stock"
                                    aria-describedby="sizing-addon1">
                            </div>
                            <br>
                            <div class="input-group input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="sizing-addon1">Surtir</span>
                                </div>
                                <input name="surtir" type="text" class="form-control add_form_surtir" value="" placeholder="Surtir" aria-describedby="sizing-addon1">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Cerrar</span>
                        </button>
                        <button type="button" class="btn btn-success ml-1 saveadd">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Agregar</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>



    <script>

            dtb = $('#ListaStockBasicoTecnico').DataTable({
                'serverSide': true,
                'processing': true,
                "language": {
                    "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
                } ,
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


        function buttonEdit(e) {
            return `<button id="manageBtn" type="button" onclick="edit('${e.id}')"
                    class="btn btn-success btn-xs">  Editar </button>`;
        }
        function edit(id) {

            $('.contenido-modal').html('');
            $('.contenido-modal').hide();
            $('.loader-modal').show();
            $('#default').modal();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            $.ajax({
                url: "{{ url('stock-basico-tecnico/editarBin')}}",
                type: 'POST',
                data: {
                    'id': id
                },
                success: function(data) {


                    $('.loader-modal').hide();
                $('.contenido-modal').html(data);
                $('.contenido-modal').show();

                }
            });
        }

        function buttonDelete(e) {
            return `<button id="manageBtn" type="button" onclick="deleteItem('${e.id}')"
                    class="btn btn-danger btn-xs">  Eliminar </button>`;
        }
        function deleteItem(id) {

            Swal.fire({
                title: '¡Atención!',
                text: "¿Deseas seguir con esta acción?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                buttonsStyling: false,
                }).then(function (result) {
                if (result.value) {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



                    $.ajax({
                        url: "{{ url('stock-basico-tecnico/deleteBin')}}",
                        type: 'POST',
                        data: {
                            'id': id
                        },
                        success: function(data) {

                            dtb.ajax.reload();
                                Swal.fire({
                                    type: "success",
                                    title: '¡Hecho!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-success',
                                });

                        }
                    });


                }
            });
        }


        $('.saveedit').click(function(){
            var id = $('.edita_form_id').val();
            var material = $('.edita_form_material').val();
            var max = $('.edita_form_max').val();
            var stock = $('.edita_form_stock').val();
            var surtir = $('.edita_form_surtir').val();

            $.ajax({
                url: "{{ url('stock-basico-tecnico/saveedit')}}",
                type: 'POST',
                data: {
                    'id':id,
                    'max':max,
                    'surtir':surtir,
                    'material':material,
                    'stock':stock
                },
                success: function(data) {
                    dtb.ajax.reload();
                    Swal.fire({
                                    type: "success",
                                    title: '¡Hecho!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-success',
                                });
                                $('#default').modal('hidden');



                }
            });

        });


        $('.saveadd').click(function(){


            var material = $('.add_form_material').val();
            var max = $('.add_form_max').val();
            var stock = $('.add_form_stock').val();
            var surtir = $('.add_form_surtir').val();
            var bin = $('.binvalue').val();
            var sloc = $('.slocvalue').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ url('stock-basico-tecnico/saveadd')}}",
                type: 'POST',
                data: {
                    'max':max,
                    'surtir':surtir,
                    'material':material,
                    'stock':stock,
                    'bin':bin,
                    'sloc':sloc
                },
                success: function(data) {
                    console.log(data);
                    dtb.ajax.reload();
                    Swal.fire({
                                    type: "success",
                                    title: '¡Hecho!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-success',
                                });
                    $('.formadd').reset();
                    $('#add').modal('hidden');

                }
            });

        });
    </script>

@endsection
