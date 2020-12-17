@extends('layouts.app')
@section('content')
    <div class="modal" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert" id="div_mensaje"></div>
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
                    <form action="{{ route('solicitud-sustituto.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="ipt_componente">Componente que requiere sustituto</label>
                                <input type="text"
                                       id="ipt_componente"
                                       name="ipt_componente"
                                       class="form-control"
                                       value="{{old('ipt_componente')}}"
                                       required
                                >
                            </div>
                            <div class="form-group col-md-3 toEvaluate" >
                                <p><strong>Descripción:</strong> </br> <span id="informacion_componente"></span> </p>
                            </div>
                            <div class="form-group toEvaluate col-md-3">
                                <label for="ipt_componente_sust">Razón de sustituto:</label>
                                <input type="text"
                                       id="ipt_componente_sust"
                                       name="ipt_componente_sust"
                                       class="form-control"
                                       value="{{ old('ipt_componente_sust') }}"
                                >
                            </div>
                            <div class="form-group toEvaluate col-md-3">
                                <label for="ipt_componente_sust_descr">Descripción del sustituto:</label>
                                <input type="text"
                                       id="ipt_componente_sust_descr"
                                       name="ipt_componente_sust_descr"
                                       class="form-control"
                                       value="{{old('ipt_componente_sust_descr')}}"
                                >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group toEvaluate col-md-3">
                                <label for="modelo">Modelo</label>
                                <input type="text"
                                       id="modelo"
                                       name="modelo"
                                       class="form-control"
                                       value="{{old('modelo')}}"
                                >
                            </div>
                            <div class="form-group toEvaluate col-md-3">
                                <label for="taller">Taller </label>
                                <input type="text"
                                       id="taller"
                                       name="taller"
                                       class="form-control"
                                       value="{{old('taller')}}"
                                >
                            </div>
                            <div class="form-group toEvaluate col-md-3">
                                <label for="no_dispatch">No. Dispatch</label>
                                <input type="text"
                                       id="no_dispatch"
                                       name="no_dispatch"
                                       class="form-control"
                                       value="{{old('no_dispatch')}}"
                                >
                            </div>
                            <div class="form-group toEvaluate col-md-3">
                                <label for="proveedor">Proveedor</label>
                                <input type="text"
                                       id="proveedor"
                                       name="proveedor"
                                       class="form-control"
                                       value="{{old('proveedor')}}"
                                >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group toEvaluate">
                                <button type="submit" class="btn btn-success">
                                    Crear solicitud
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
        <div id="description_by_np" style="display: none">

        </div>
    </div>

    <script>

        $(document).ready(function(){
            $(".toEvaluate").hide();
        });

        $('#ipt_componente').focus(function(){
            $(".toEvaluate").hide();
        });

        $('#ipt_componente').blur(function(){



            let np = $(this).val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            });

            $("#description_by_np").load( "{{ url('/get_description_by_np')}}",  { ipt_componente: np }, function() {
                let valid = $('#valid').val();
                if (valid){
                    $('.toEvaluate').show();
                    $('#informacion_componente').text($('#np_description').val());
                }
                else{
                    $('#div_mensaje').text($('#message').val());
                    $('#myModal').modal('show');
                    $(".toEvaluate").hide();
                    $(response.target).focus();
                    $(".toEvaluate").hide();
                }
            });


        });
    </script>

@endsection
