@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <style type="text/css">
        td.details-control {
            background: url('{{ asset('images') }}/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.details td.details-control {
            background: url('{{ asset('images') }}/details_close.png') no-repeat center center;
        }

        table.table-detail{
            border: 0;
        }
        table.table-detail td, table.table-detail th{
            border: 0;
            background-color: white!important;
        }
        table.table-detail td.detail-field{
            text-align: right;
            font-weight: bold;
        }

    </style>
    <div class="container">

        <div class="row d-flex justify-content-between my-3 ">
            @can('crear talleres')
            <a href="{{ route('taller.create') }}" class="btn btn-primary">Nuevo Taller</a>
            @endcan
            
        </div>

        <section id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Administrar Talleres</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="data_talleres" class="table table-striped table-bordered table-responsive-lg complex-headers dataTable" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">NÚMERO - NOMBRE CS </th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">MUNICIPIO</th>
                                <th class="text-center">SUPERVISOR</th>
                                <th class="text-center">REGIÓN</th>
                                <th class="text-center">TIPO CS</th>
                                @can('editar talleres')
                                <th class="text-center">Editar</th>
                                @endcan
                                @can('eliminar talleres')
                                <th class="text-center">Eliminar</th>
                                @endcan
                               
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

    function format ( d ) {
        return '<table class="table-detail">'+
                    '<tr>'+
                    '<td class="detail-field" rowspan="5">NUMERO CS:</td><td rowspan="5">'+d.taller+'</td>'+
                    '<td class="detail-field">NOMBRE CS:</td><td>'+d.nombre+'</td>'+
                    '<td class="detail-field">ESTATUS TALLER:</td><td>'+d.status+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    ''+
                    '<td class="detail-field">TIPO CS:</td><td>'+d.subtipo+'</td>'+
                    '<td class="detail-field">DIRECCION: </td><td>'+d.direccion+', '+d.colonia+'</td>'+
                    '<td class="detail-field">TELEFONO: </td><td>'+d.telefono+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    ''+
                    ''+
                    '</tr>'+
                    '<tr>'+
                    '<td class="detail-field">ESTADO: </td><td>'+d.estado+'</td>'+
                    '<td class="detail-field">CABECERA: </td><td>'+d.cabecera+'</td>'+
                    '<td class="detail-field">CP: </td><td>'+d.cp+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    ''+
                    '<td class="detail-field">SUPERVISOR: </td><td>'+d.supervisor+'</td>'+
                    '<td class="detail-field">CONTACTO: </td><td>'+d.contacto+'</td>'+
                    '<td class="detail-field">CORREO: </td><td>'+d.correo+'</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td class="detail-field">VENDOR: </td><td>'+d.vendor+'</td>'+
                    '<td class="detail-field">RESPONSBALE: </td><td>'+d.responsable+'</td>'+
                    '<td class="detail-field">FECHA CENTRALIZADO: </td><td>'+d.fecha_centralizado+'</td>'+
                    '</tr>'+
                '</table>'
            ;
    }

    $(document).ready(function() {
        dt = $('#data_talleres').DataTable({
            "serverSide": true,
            "processing": true,
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            },
            "ajax": "{{ url('talleres-json-administrar')}}",
            "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            buttons: [
            {
                extend: 'excel',
                text: '<span class="fa fa-file-excel-o"></span> Excel Export',
                exportOptions: {
                    modifier: {
                        search: 'applied',
                        order: 'applied'
                    }
                }
            }
        ],
            "order": [
                [1, "desc"]
            ],
            "columns": [
                {
                    "class":          "details-control",
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": ""
                },
                {
                    data: 'numero_nombre_taller'
                },
                {
                    data: 'estado'
                },
                {
                    data: 'ciudad'
                },
                {
                    data: 'supervisor'
                },
                {
                    data: 'subzona'
                }, 
                {
                    data: 'subtipo'
                }
                @can('editar talleres')
                ,{
                    "render" : buttonEdit,
                    "data" : null
                } 
                @endcan

                @can('eliminar talleres')
                ,{
                    "render" : buttonDelete,
                    "data" : null
                }
                @endcan
            ],

        });

        // Array to track the ids of the details displayed rows
        var detailRows = [];
     
        $('#data_talleres tbody').on( 'click', 'tr td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = dt.row( tr );
            var idx = $.inArray( tr.attr('id'), detailRows );
     
            if ( row.child.isShown() ) {
                tr.removeClass( 'details' );
                row.child.hide();
     
                // Remove from the 'open' array
                detailRows.splice( idx, 1 );
            }
            else {
                tr.addClass( 'details' );
                row.child( format( row.data() ) ).show();
     
                // Add to the 'open' array
                if ( idx === -1 ) {
                    detailRows.push( tr.attr('id') );
                }
            }
        } );
     
        // On each draw, loop over the `detailRows` array and show any child rows
        dt.on( 'draw', function () {
            $.each( detailRows, function ( i, id ) {
                $('#'+id+' td.details-control').trigger( 'click' );
            } );
        } );
    });
</script>

<script type="text/javascript">
    function buttonEdit(e) {

        return '@can("editar talleres")<button id="manageBtn" type="button" onclick="edit('+e.id+')" class="btn btn-success btn-xs">Editar</button>@endcan';
    }
    function edit(id) {
        location.href = "{{url('taller-edit')}}/" + id;
    }
    function buttonDelete(e) {

        return '@can("eliminar talleres")<button id="manageBtn" type="button" onclick="del('+e.id+')" class="btn btn-danger btn-xs">Eliminar</button>@endcan';
    }
   
    async function del(id) {
        let value = await Swal.fire({
            title: 'Cuidado',
            text: '¿Desea eliminar el Taller?',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
        if (value.isConfirmed){
            let responseDelete = await axios.post('/taller-destroy/'+id);

            if (responseDelete){
                location.href = "{{url('talleres')}}";
            }
        }
    }

   
</script>

@endsection
