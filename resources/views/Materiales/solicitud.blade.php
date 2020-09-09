@extends('layouts.app')
@section('content')
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <h5>Lista de Sustitutos</h5>
        </div>
        <div class="row">
            <p class="lead">Crear solicitud de liga a un Sustituto</p>
        </div>
        <div class="row">
            <div class="card col-md-12">
                <div class="card-header">
                    Información del Solicitante
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="numbre_usuario">Nombre de usuario</label>
                            <input type="text"
                                   id="numbre_usuario"
                                   name="numbre_usuario"
                                   class="form-control"
                                   value="{{ Auth::user()->username }}"
                                   disabled
                            >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nombre_solicitante">Nombre del solicitante</label>
                            <input type="text"
                                   id="nombre_solicitante"
                                   name="nombre_solicitante"
                                   class="form-control"
                                   value="{{ Auth::user()->nombre }}"
                                   disabled
                            >
                        </div>
                        <div class="form-group col-md-3">
                            <label for="departamento">Departamento</label>
                            <input type="text"
                                   id="departamento"
                                   name="departamento"
                                   class="form-control"
                                   value="{{ Auth::user()->depto }}"
                                   disabled
                            >
                        </div>
                        <div class="form-group col-md-3">
                            <div class="alert alert-warning">
                                Hola {{ Auth::user()->nombre }} revisa tu información y llena todos los campos que se te solicitan en
                                este formulario.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row ">
            <div class="card col-md-12">
                <div class="card-header">
                    Información del material a ligar
                </div>

                <div class="card-body">
                    <form action="{{ url('/sustitutos/process/') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="ipt_componente">Componente que requiere sustituto</label>
                                <input type="text"
                                       id="ipt_componente"
                                       name="ipt_componente"
                                       class="form-control"
                                >
                            </div>
                            <div class="form-group col-md-3" id="informacion_componente">

                            </div>
                            <div class="form-group col-md-3">
                                <label for="ipt_componente_sust">Componente sustituto:</label>
                                <input type="text"
                                       id="ipt_componente_sust"
                                       name="ipt_componente_sust"
                                       class="form-control"
                                >
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ipt_componente_sust_descr">Descripción del sustituto:</label>
                                <input type="text"
                                       id="ipt_componente_sust_descr"
                                       name="ipt_componente_sust_descr"
                                       class="form-control"
                                >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    Crear solicitud
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>



    <script>
        $('#ipt_componente').blur(function(){
            console.log('se activa');

            let np = $(this).val();

            $.ajax({
                type: 'post',
                url: '/process/' + np,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function() {
                    //$('input,textarea,select').attr('disabled','disabled');
                },
                error: function(response) {
                },
                success: function(response) {

                    if(response.valid)
                    {
                        $('#informacion_componente').html('<p><strong>Descripción:</strong> ' + response.np_description + '</p>');
                    }
                    else
                    {
                        $('#ipt_componente').val('');
                        $('#myModal .modal-body').html('<div class="alert alert-warning" role="alert">' + response.message + '</div>');
                        $('#myModal').modal('show');
                        $(response.target).focus();
                    }
                }
            });
        });
    </script>


@endsection
