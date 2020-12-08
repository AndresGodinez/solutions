@extends("layouts.app") @section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <!-- Modal to see all records about serial no. -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Solicitudes relacionadas
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solicitudes relacionadas por serie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id Sol.</th>
                                    <th>Dispatch</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($closed_cases as $closed_cases)
                                    @if($closed_cases->id_sol == $solicitud[0]->id_sol)
                                    <tr class="alert alert-warning">
                                    @else
                                    <tr>
                                    @endif
                                        <td>
                                            <a href="{{ (($closed_cases->status == 'CERRADA' || $closed_cases->status == 'RECHAZADA') ? url('solicitud/show').'/'.$closed_cases->id_sol : url('detalle/show').'/'.$closed_cases->id_sol) }}" target="_blank">
                                                {{ $closed_cases->id_sol }}
                                            </a>    
                                        </td>
                                        <td>
                                            {{ $closed_cases->dispatch }}
                                        </td>
                                        <td>
                                            {{ $closed_cases->status }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <div class="card-body">
        <h4 class="card-title">{{ config('pages.solicitud.title') }}</h4>
        <h6 class="card-subtitle mb-2 text-muted">{{ config('pages.solicitud.subtitle') }}</h6> @foreach($solicitud as $solicitud)
            @csrf
            <table id="table" class=" justify-content-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{ config('pages.solicitud.table.dispatch') }}</th>
                        <th>{{ config('pages.solicitud.table.model') }}</th>
                        <th>{{ config('pages.solicitud.table.serie') }}</th>
                        <th>{{ config('pages.solicitud.table.brand') }}</th>
                        <th>{{ config('pages.solicitud.table.problem') }}</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <tr>
                        <td>
                            <input autofocus type="text" name="dispatch" id="dispatch" class="form-control" value="{{$solicitud->dispatch}}" disabled  readonly>
                        </td>
                        <td>
                            <input type="text" name="model" id="model" class="form-control" value="{{$solicitud->modelo}}" disabled readonly>
                        </td>
                        <td>
                            <input type="text" name="serie" id="serie" class="form-control" value="{{$solicitud->serie}}" disabled readonly>
                        </td>
                        <td>
                            <input type="text" name="brand" id="brand" class="form-control" value="{{$solicitud->brand}}" disabled readonly>
                        </td>
                        <td>
                            <input type="text" name="problem" id="problem" class="form-control" value="{{$solicitud->dispatch}}" disabled readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>{{ config('pages.solicitud.table.fail') }}</th>
                        <th>{{ config('pages.solicitud.table.line') }}</th>
                        <th>{{ config('pages.solicitud.table.type') }}</th>
                        <th>{{ config('pages.solicitud.table.name') }}</th>
                        <th>{{ config('pages.solicitud.table.phone') }}</th>
                    </tr>
                </thead>
                <tfoot>
                </tfoot>
                <tbody>
                    <tr>
                        <td>
                            <select name="fail" id="fail" class="form-control" readonly disabled >
                                <option value=""> Seleccione </option>
                                @foreach ($mode_fail as $mode_fail) @if ( $mode_fail->id_modofalla == $solicitud->id_falla)
                                <option selected value="{{ $mode_fail->id_modofalla }}">{{ $mode_fail->modo_falla }}</option>
                                @endif @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="line" id="line" class="form-control" disabled readonly>
                                <option value=""> Seleccione </option>
                                @foreach ($line as $line) @if ( $line->id == $solicitud->linea_producto)
                                <option selected value="{{ $line->id }}">{{ $line->linea }}</option>
                                @endif @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="information" id="information" class="form-control" disabled readonly>
                                <option value=""> Seleccione </option>
                                @foreach ($information as $information) @if ( $information->id == $solicitud->informacion)
                                <option selected value="{{ $information->id }}">{{ $information->informacion }}</option>
                                @endif @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="name" id="name" class="form-control" value="{{$solicitud->nombre_tecnico}}" disabled readonly>
                        </td>
                        <td>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{$solicitud->telefono}}" disabled readonly>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label>{{ config('pages.solicitud.table.comment') }}</label>
                        <textarea id="comment" name="comment" class="form-control" rows="4" readonly>{{$solicitud->comentario}}</textarea>
                    </div>
                    <div class="form-group">
                        <!--
                        @if( strpos($solicitud->ruta, 'documentos/') !== false)
                            <a href="https://soluciones.refaccionoriginal.com/solicitudes_ingenieria/{{$solicitud->ruta}}" target="_blank">Documento disponible</a>
                        @else
                            <a href="{{$solicitud->ruta}}" target="_blank">Documento disponible</a>
                        @endif
                        -->
                        @if(substr($solicitud->ruta,0,10) != 'documentos')
                            <a href="{{ url('solicitud/descargar').'/'.$id }}" target="_blank"> Documentos</a>
                        @else
                            <a href="{{ config('pages.globals.url').'solicitudes_ingenieria/'.$solicitud->ruta }}" target="_blank"> {{$solicitud->ruta}}</a>
                        @endif
                    </div>
                </div>
                <div id="help" style="height:250px; overflow:auto;">
                </div>
                <div style="width:20px;"></div>
                <div style="height:250px; overflow:auto;">
                    <div id="faqs" style="height:250px; overflow:auto;"></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <h4 class="card-title">{{ config('pages.solicitud.table.info') }}</h4>
            </div>
            <input id="_questions" name="_questions" type="hidden" value="">
            <div class="row" id="info-solicitud">
                <table id="table" class=" justify-content-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                        <tr>
                            <th>Pregunta</th><th>Respuesta</th><th>Archivo</th>
                        </tr>
                </thead>
                <tbody>
                        @foreach ($questions as $questions)
                        <tr>
                            <th>{{$questions->pregunta}}</th>
                            <td>{{$questions->respuesta}}</td>
                            <td>
                                @if ($questions->ruta != '')
                                    <a href="{{ url('documento/descargar/'.$questions->path) }}" target="_blank">
                                    @if($questions->tipo ==  "image")
                                    <img style=" max-height:100px;" src="{{ url('documento/descargar/'.$questions->path) }}" >
                                    @endif
                                    @if($questions->tipo ==  "video")
                                        <video width="320" height="240" controls>
                                        <source src="{{ url('documento/descargar/'.$questions->path) }}" type="{{$questions->mimeType}}">
                                        Your browser does not support the video tag.
                                        </video>
                                    @endif
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr>
            <div class="main-quest-ing">
                @if($depto == 'TALLER' || $depto == 'IT')
            <form method="post" id="form-sol" enctype="multipart/form-data" action="{{ url('detalle/quests-ing') }}">
                @csrf   
                    <input id="id_request" name="id_request" type="hidden" value="{{$solicitud->id_sol}}">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                <strong>**¡ESPERA!</strong> Antes de mandar la información, recuerda que puedes evaluar la calidad de información que recibes de field service. Por favor elije una de las siguientes opciones.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <span id="span-ipt-q1" class="hidden">Seleccione una opcion</span>
                            <h4 class="card-title"> Evalua la información de Ingeniería. </h4>
                            <ul>
                                <table>
                                    <tr><td><input type="radio" id="ipt_q1_1" name="ipt_q1" value="{{config('pages.poll.scores.1')}}" checked /></td><td><label for="ipt_q1_1">a) {{config('pages.poll.scores.1')}}</label></td></tr>
                                    <tr><td><input type="radio" id="ipt_q1_2" name="ipt_q1" value="{{config('pages.poll.scores.2')}}" /></td><td><label for="ipt_q1_2">b) {{config('pages.poll.scores.2')}}</label></td></tr>
                                    <tr><td><input type="radio" id="ipt_q1_3" name="ipt_q1" value="{{config('pages.poll.scores.3')}}" /></td><td><label for="ipt_q1_3">c) {{config('pages.poll.scores.3')}}</label></td></tr>
                                    <tr><td><input type="radio" id="ipt_q1_4" name="ipt_q1" value="{{config('pages.poll.scores.4')}}" /></td><td><label for="ipt_q1_4">d) {{config('pages.poll.scores.4')}}</label></td></tr>
                                </table>
                            </ul>
                        </div>
                        <div class="col-sm-5">
                            <h4 class="card-title"> ¿En qué puede mejorar la documentación? </h4>
                            <p class="card-subtitle mb-2 text-muted"><strong>NOTA*</strong> Esta sección es para mejorar la Respuesta de Ingeniería y se revisarán los comentarios al final del mes. Si tienes comentarios sobre el modo de falla de este Reporte, será necesario que envíes otra solicitud para que te respondan a la brevedad.</p>
                            <ul>
                                <textarea id="ipt_q2" name="ipt_q2"class="form-control" rows="4" style="resize:none;"></textarea>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="card-title"> ¿Recomendaria este servicio? </h4>
                            <ul>
                                <table>
                                    <tr><td><input type="radio" id="ipt_q3" name="ipt_q3" value="Si" checked /></td><td><label for="ipt_q3">Si</label></td></tr>
                                    <tr><td><input type="radio" id="ipt_q3" name="ipt_q3" value="No" /></td><td><label for="ipt_q3">No</label></td></tr>
                                </table>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-success from_send" id="save">Responder Enquesta</button>
                    </div>
                </form>
                 @endif
            </div>
            <div class="row" style="height: 30px;"></div>
            <div class="row">
                <h4 class="card-title">{{ config('pages.solicitud.table.ingeniero') }}</h4>
            </div>
            <div class="row">
                <table id="table" class="text-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Comentarios Ingeniero</th>
                            <th>Documentos Adjuntos</th>
                            <th>Historial de Solicitudes</th>
                            <th>Subtipo de Informacion</th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>
                            @foreach ($revision as $revisions)
                            <tr>
                                <td>{{$revisions->comentarios}}</td>
                                <td>
                                @if(substr($revisions->ruta,0,10) != 'documentos')
                                    @if($revisions->ruta == null || empty($revisions->ruta) || $revisions->ruta == "Ningún archivo subido.")
                                        Sin Documento adjunto
                                    @else
                                    <a href="{{ url('detalle/descargar/'.$revisions->idsol) }}" target="_blank" rel="noopener noreferrer">
                                        Documentos
                                    </a>
                                    @endif    
                                @else
                                     @if($revisions->ruta == null || empty($revisions->ruta) || $revisions->ruta == "Ningún archivo subido.")
                                        Sin Documento adjunto
                                    @else
                                        <a href="{{config('pages.globals.url').'/solicitudes_ingenieria/'.$revisions->ruta}}" target="_blank">
                                            Documentos
                                        </a>
                                    @endif
                                @endif
                                </td>
                                <td></td>
                                <td>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-transparent">
                <div class="form-group text-center">
                    <div class="col-lg-2 col-md-4 float-right">
                        <a onclick="window.close()" class="btn btn-primary from_send"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Regresar</a>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
@if(isset($sol_ing_csat[0]->ing_usr_agnt) && $sol_ing_csat[0]->ing_usr_agnt != NULL)
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h4><strong>Ey, ¡Espera un momento!</strong></h4>
            <h5>¿Quieres saber como te evaluo Ingeniería? ¡Da click en el boton de abajo!</h5>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
                Ver evaluación de Ingeniería
            </button>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <hr />
        </div>
    </div>
</div>

<div style="height: 100px;"></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Ingeniería dice</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div role="alert" class="get_txt_desc alert alert-light" style="color: rgb(0, 0, 0); border: 1px solid rgb(204, 204, 204);">
                    <strong>Información del solicitante: </strong> 
                    <br/> 
                    {{ $sol_ing_csat[0]->ing_q1 }}
                    <br/>
                    <br/>
                    <strong>¿En qué puede mejorar la documentación?: </strong> 
                    <br/>
                    {{ $sol_ing_csat[0]->ing_q2 }}
                    <br/>
                    <br/>
                    <strong>¿Recomendaria este servicio?: </strong> 
                    <br/>
                    {{ $sol_ing_csat[0]->ing_q3 }}
                    <br/>
                    <br/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endif





@section('scripts') 
<script type="text/javascript">
function subtypeChange ()
{
    var data =
    {
        information:    $("#information").val(),
    }
    $.ajax({
        url: "{{ url('detalle/subtypeChange') }}",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: 'POST',
        data: data,
        success: function( data )
        {
            if( data.ok != false)
            {
                $('#subtype' ).html( data.html );
            }
            else
            {
                showNotification('Error',"Datos no encontrados.", 'warning');
            }
        },
        error: function(jq,status,message)
        {
            showNotification('Error',"Error al cargar datos...", 'error');
        }
    });
}

function validateForm()
{
    var inputs = [ 'ipt_q1', 'ipt_q3'];

    const keys = Object.keys(inputs);
    var questions_validis = 0;
    var inputs_validis    = 0;

    inputs.forEach(function(element)
    {
        var action = ( $("#"+element).val() != '' ) ? 'remove' : 'add';
        removeOrAddStyleClass(element,style='is-invalid', action);
        if( $("#"+element).val() != '' ) inputs_validis++;
    });
    return ( inputs_validis == inputs.length );
}

$(document).ready(function()
{
    $('#form-sol').on('submit', function(event)
    {
        event.preventDefault();
        //var ok = validateForm();
        
        $.ajax({
            url: "{{ url('detalle/quests-ing') }}",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {   
                showNotification('Solicitud', data.message, data.ok);
                $('#form-sol').trigger("reset");
                //window.location.href = '{{ url('detalle') }}';
            },
            error: function(jq,status,message){ showNotification('{{ config('pages.solicitud.scripts.notifications.title.error') }}', '{{ config('pages.solicitud.scripts.form.error') }}', 'error'); }
        });
    });

    $( "#rechazar" ).on( "click", function() {
        var info =
    {
        id_request: $("#id_request").val(),
    };

    $.ajax({
        url: "{{ url('detalle/rechazar') }}",
        method:"POST",
        data:info,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success:function(data)
        {
            var message = ( !data.message ) ? 'Detalle creado correctamente' : data.message;
            var ok      = ( !data.ok ) ? 'success' : data.ok;
            showNotification('Solicitud', message, ok);
            $('#form-sol').trigger("reset");
            window.location.href = '{{ url('detalle') }}';
        },
        error: function(jq,status,message){ showNotification('{{ config('pages.solicitud.scripts.notifications.title.error') }}', '{{ config('pages.solicitud.scripts.form.error') }}', 'error'); }
    });

    });
});

</script>

@endsection @endsection
