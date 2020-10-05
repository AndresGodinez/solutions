@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

    <div class="container">

        <div class="row d-flex justify-content-between my-3 ">
            @can('crear usuarios')
            <a href="{{ route('usuario.create') }}" class="btn btn-primary">Nuevo Usuario</a>
            @endcan
            @can('exportar usuarios')
            <a href="{{ route('usuarios.export') }}" class="btn btn-success">Descargar Usuarios</a>
            @endcan
        </div>

        <section id="basic-datatable">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Usuarios</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <table id="example" class="table table-striped table-bordered table-responsive complex-headers dataTable" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">Usuario</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Correo</th>
                                <th class="text-center">Editar</th>
                                <th class="text-center">Eliminar</th>
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
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            },
            "ajax": "{{ url('usuario/datoinicial')}}",
            "order": [
                [1, "desc"]
            ],
            "columns": [
                {
                    data: 'username'
                },
                {
                    data: 'nombre'
                },{data:'role'},
                {
                    data: 'mail'
                }, {
                    "render" : buttonEdit,
                    "data" : null
                }, {
                    "render" : buttonDelete,
                    "data" : null
                },
            ],

        });
    });
</script>

<script type="text/javascript">
    function buttonEdit(e) {

        return '@can("editar usuarios")<button id="manageBtn" type="button" onclick="myFunc('+e.id+')" class="btn btn-success btn-xs">Editar</button>@endcan';
    }
    function myFunc(id) {
        location.href = "{{url('usuario')}}/" + id + "/edit";
    }
    function buttonDelete(e) {

        return '@can("eliminar usuarios")<button id="manageBtn" type="button" onclick="del('+e.id+')" class="btn btn-danger btn-xs">Eliminar</button>@endcan';
    }
    async function del(e) {
        let value = await Swal.fire({
            title: 'Cuidado',
            text: 'Desea eliminar el usuario',
            icon: 'warning',
            confirmButtonText: 'ok'
        });
        if (value.isConfirmed){
            let responseDelete = await axios.post('/delete-usuario',{user_id: e});

            if (responseDelete){
                location.href = "{{url('usuarios')}}";
            }
        }
    }
</script>

@endsection
