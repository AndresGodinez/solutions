@extends('layouts.app')
@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form class="generic_form form_ligas"
                  action="{{ url('sustitutos/process/set-track/contribute/cancel') }}"
                  method="POST">
                @csrf
                <input type="hidden" id="ipt_id" name="ipt_id" value="{{ $data[0]->id }}"/>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancelación de solicitud</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ipt_comments">Agrega el porque estas cancelando esta solicitud <sup
                                    style="color: red;"><strong>*</strong></sup>:</label>
                            <textarea class="form-control" id="ipt_comments" name="ipt_comments"
                                      cols="30" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
            <div class="col-sm-12">
                <h2><strong>Detalle de la Solicitud de liga</strong></h2>
                <h5>Consulta la información completa de liga en esta sección</h5>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Información del Solicitante
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ipt_user">Nombre de usuario <sup style="color: red;"><strong>*</strong></sup>:</label>
                                    <input type="text" class="form-control" id="ipt_user" name="ipt_user"
                                           value="{{ $data[0]->usr_request }}" disabled/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ipt_name">Nombre del solicitante <sup
                                            style="color: red;"><strong>*</strong></sup>:</label>
                                    <input type="text" class="form-control" id="ipt_name" name="ipt_name" value="{{ $data[0]->nombre }}"
                                           disabled/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="ipt_depto">Departamento: <sup style="color: red;"><strong>*</strong></sup>:</label>
                                    <input type="text" class="form-control" id="ipt_depto" name="ipt_depto"
                                           value="{{ $data[0]->depto }}" disabled/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="get_txt_desc alert alert-secondary" role="alert">
                                <strong>Fecha de solicitud: </strong> {{ $data[0]->created_at }}
                                <br/>
                                <strong>Status actual: </strong>
                                @if($data[0]->status == 'Sin revisión' || $data[0]->status == 'Cancelado' || $data[0]->status == 'Rechazado')
                                    <strong>
			 		<span style="color: red;">
				 		{{ $data[0]->status }}
				 	</span>
                                    </strong>
                                @elseif($data[0]->status == 'En revisión')
                                    <strong>
			 		<span class="danger">
				 		{{ $data[0]->status }}
				 	</span>
                                    </strong>
                                @elseif($data[0]->status == 'Aprobado')
                                    <strong>
			 		<span style="color: green;">
				 		{{ $data[0]->status }}
				 	</span>
                                    </strong>
                                @endif
                                <br/>
                                <strong>Componente: </strong> {{ $data[0]->np }}
                                <br/>
                                <strong>Componente Sustituto: </strong> {{ $data[0]->np_sust ?? 'No se especificó' }}
                                <br/>
                                <strong>Descripción del componente Sustituto: </strong> {{ $data[0]->np_sust_descr ?? 'No se especificó' }}
                                <br/>
                                <strong>Modelo: </strong> {{ $data[0]->modelo ?? 'No se especificó' }}
                                <br/>
                                <strong>Taller: </strong> {{ $data[0]->taller ?? 'No se especificó' }}
                                <br/>
                                <strong>No Dispatch: </strong> {{ $data[0]->no_dispatch ?? 'No se especificó' }}
                                <br/>
                                <strong>Proveedor:</strong> {{ $data[0]->proveedor ?? 'No se especificó'}}
                                <br/>
                            </div>
                        </div>
                        @if($user == $data[0]->usr_request)
                            <div class="col-sm-12">
                                <h5><strong>¿Algo está mal con tu solicitud?</strong></h5>
                                <p>Si esta solicitud contiene información equivocada que detectaste, no te preocupes, la puedes
                                    cancelar sin ningun problema antes de que las areas responsables la revisen, para cancelarla por
                                    favor da clic en el siguiente botón:</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Cancelar esta solicitud
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Historial de Seguimiento
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ url('sustitutos/process/set-track/contribute') }}"
                              method="POST"
                              class="generic_form form_ligas"
                              >
                            @csrf
                            <input type="hidden" id="ipt_id" name="ipt_id" value="{{ $data[0]->id }}"/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        >> Departamento de Ingenieria
                                        @if($data[0]->depto_ing == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    @if($data[0]->depto_ing == 0 && (isset($access[0]->depto) && $access[0]->depto == "INGENIERIA") && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                        <div class="form-group">
                                            <label for="ipt_comments">Por favor agrega tus comentarios dependiendo si autorizas
                                                o rechazas esta solicitud <sup
                                                    style="color: red;"><strong>*</strong></sup>:</label>
                                            <textarea class="form-control" id="ipt_comments" name="ipt_comments"
                                                      cols="30" rows="3" required></textarea>
                                        </div>
                                    @else
                                        @foreach($data_log as $data_log_ing)
                                            @if($data_log_ing->depto == 'INGENIERIA')
                                                <div class="get_txt_desc alert alert-secondary" role="alert"
                                                     style="color: #000000; border: 1px solid #CCCCCC;">
                                                    <strong>Fecha de seguimiento: </strong> {{ ($data_log_ing->modify_date) }}
                                                    <br/>
                                                    <strong>Días en departamento: </strong> 5
                                                    <br/>
                                                    <strong>Acción del departamento: </strong> {{ $data_log_ing->action }}
                                                    <br/>
                                                    <strong>Comentarios: </strong> {{ ucfirst(strtolower($data_log_ing->comments)) }}
                                                    <br/>
                                                    <strong>Relación: </strong>
                                                    @if($data_log_ing->rel == 1)
                                                        Directo
                                                    @elseif($data_log_ing->rel == 2)
                                                        Alterno
                                                    @else
                                                        N/A
                                                    @endif
                                                    <br/>
                                                    <strong>Seguimiento
                                                        por: </strong> {{ ucwords(strtolower($data_log_ing->nombre)) }}
                                                </div>
                                                @break
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($data[0]->depto_ing == 0)
                                        @if(isset($access[0]->depto) && $access[0]->depto == "INGENIERIA" && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                            <div class="form-group">
                                                <label for="ipt_rel">Tipo de relación entre los materiales <sup
                                                        style="color: red;"><strong>*</strong></sup>:</label>
                                                <select id="ipt_rel" name="ipt_rel" class="form-control">
                                                    <option value="">Selecciona una opción...</option>
                                                    <option value="1">Directo</option>
                                                    <option value="2">Alterno</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="ipt_action">Acción <sup style="color: red;"><strong>*</strong></sup>:</label>
                                                <select id="ipt_action" name="ipt_action" class="form-control" required>
                                                    <option value="">Selecciona una opción...</option>
                                                    <option value="Autorizar">Autorizar</option>
                                                    <option value="Rechazar">Rechazar</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                Contribuir al seguimiento
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <form class="generic_form form_ligas" action="{{ url('sustitutos/process/set-track/contribute') }}"
                              method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="ipt_id" name="ipt_id" value="{{ $data[0]->id }}"/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        >> Departamento de Materiales
                                        @if($data[0]->depto_mat == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    @if($data[0]->depto_mat == 0 && (isset($access[0]->depto) && $access[0]->depto == "MATERIALES") && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                        <div class="form-group">
                                            <label for="ipt_comments">Por favor agrega tus comentarios dependiendo si autorizas
                                                o rechazas esta solicitud <sup
                                                    style="color: red;"><strong>*</strong></sup>:</label>
                                            <textarea class="form-control" id="ipt_comments" name="ipt_comments"
                                                      cols="30" rows="3" required></textarea>
                                        </div>
                                    @else
                                        @foreach($data_log as $data_log_mat)
                                            @if($data_log_mat->depto == 'MATERIALES')
                                                <div class="get_txt_desc alert alert-secondary" role="alert"
                                                     style="color: #000000; border: 1px solid #CCCCCC;">
                                                    <strong>Fecha de seguimiento: </strong> {{ $data_log_mat->modify_date }}
                                                    <br/>
                                                    <strong>Días en departamento: </strong> 5
                                                    <br/>
                                                    <strong>Acción del departamento: </strong> {{ $data_log_mat->action }}
                                                    <br/>
                                                    <strong>Comentarios: </strong> {{ ucfirst(strtolower($data_log_mat->comments)) }}
                                                    <br/>
                                                    <strong>Relación: </strong>
                                                    @if($data_log_mat->rel == 1)
                                                        Directo
                                                    @elseif($data_log_mat->rel == 2)
                                                        Alterno
                                                    @else
                                                        N/A
                                                    @endif
                                                    <br/>
                                                    <strong>Seguimiento
                                                        por: </strong> {{ ucwords(strtolower($data_log_mat->nombre)) }}
                                                </div>
                                                @break
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($data[0]->depto_mat == 0)
                                        @if(isset($access[0]->depto) && $access[0]->depto == "MATERIALES" && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                            <div class="form-group">
                                                <input type="hidden" id="ipt_rel" name="ipt_rel" value="3"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="ipt_action">Acción <sup style="color: red;"><strong>*</strong></sup>:</label>
                                                <select id="ipt_action" name="ipt_action" class="form-control" required>
                                                    <option value="">Selecciona una opción...</option>
                                                    <option value="Autorizar">Autorizar</option>
                                                    <option value="Rechazar">Rechazar</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                Contribuir al seguimiento
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <form class="generic_form form_ligas" action="{{ url('sustitutos/process/set-track/contribute') }}"
                              method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="ipt_id" name="ipt_id" value="{{ $data[0]->id }}"/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>
                                        >> Departamento de Ventas
                                        @if($data[0]->depto_ven == 0)
                                            <box-icon name='x-circle' type='solid' color='#cb2146' ></box-icon>
                                        @else
                                            <box-icon name='check-circle' type='solid' color='#9ebf88' ></box-icon>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    @if($data[0]->depto_ven == 0 && isset($access[0]->depto) && $access[0]->depto == "VENTAS" && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                        <div class="form-group">
                                            <label for="ipt_comments">Por favor agrega tus comentarios dependiendo si autorizas
                                                o rechazas esta solicitud <sup
                                                    style="color: red;"><strong>*</strong></sup>:</label>
                                            <textarea class="form-control" id="ipt_comments" name="ipt_comments"
                                                      cols="30" rows="3" required></textarea>
                                        </div>
                                    @else
                                        @foreach($data_log as $data_log_ven)
                                            @if($data_log_ven->depto == 'VENTAS')
                                                <div class="get_txt_desc alert alert-secondary" role="alert"
                                                     style="color: #000000; border: 1px solid #CCCCCC;">
                                                    <strong>Fecha de seguimiento: </strong> {{ $data_log_ven->modify_date }}
                                                    <br/>
                                                    <strong>Días en departamento: </strong> 5
                                                    <br/>
                                                    <strong>Acción del departamento: </strong> {{ $data_log_ven->action }}
                                                    <br/>
                                                    <strong>Comentarios: </strong> {{ ucfirst(strtolower($data_log_ven->comments)) }}
                                                    <br/>
                                                    <strong>Relación: </strong>
                                                    @if($data_log_ven->rel == 1)
                                                        Directo
                                                    @elseif($data_log_ven->rel == 2)
                                                        Alterno
                                                    @else
                                                        N/A
                                                    @endif
                                                    <br/>
                                                    <strong>Seguimiento
                                                        por: </strong> {{ ucwords(strtolower($data_log_ven->nombre)) }}
                                                </div>
                                                @break
                                            @else
                                                @continue
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-sm-4">
                                    @if($data[0]->depto_ven == 0)
                                        @if(isset($access[0]->depto) && $access[0]->depto == "VENTAS" && ($data[0]->id_status != 2 && $data[0]->id_status != 5))
                                            <div class="form-group">
                                                <input type="hidden" id="ipt_rel" name="ipt_rel" value="3"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="ipt_action">Acción <sup style="color: red;"><strong>*</strong></sup>:</label>
                                                <select id="ipt_action" name="ipt_action" class="form-control" required>
                                                    <option value="">Selecciona una opción...</option>
                                                    <option value="Autorizar">Autorizar</option>
                                                    <option value="Rechazar">Rechazar</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-success">
                                                Contribuir al seguimiento
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="container">
            <a href="{{ url('/sustitutos') }}" class="btn btn-primary"> regresar</a>
        </div>
    </div>


    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>

@endsection
