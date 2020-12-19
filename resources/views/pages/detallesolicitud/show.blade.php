@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="card-title">Detalle de Solicitud<font color="gray" size="4"> ({{$detail->dispatch}})</font></h4>
			<h5 class="card-subtitle mb-2 text-muted">Informacion del General</h5>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="col-sm-12 text-left">
				<h5><strong>¿Algún problema con con el Tipo de información?</strong></h5>
				<h5>Puedes cambiarla en las opciónes de la parte de abajo</h5>
			</div>
			<div class="col-sm-6">
				<form class="generic_form" action="{{ url('solicitud-a-ingenieria/detalle/process/change-type') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" id="ipt_id" name="ipt_id" value="{{ $detail->id_sol }}" />
					<div class="form-group">
						<select name="ipt_information" id="ipt_information" class="form-control" onchange="subtypeChange()">
							<option value=""> Seleccione </option>
							@foreach ($information as $information_two)
								@if ($detail->informacion == $information_two->id)
									<option selected value="{{ $information_two->id }}">{{ $information_two->informacion }}</option>
								@else
								<option value="{{ $information_two->id }}">{{ $information_two->informacion }}</option>
								@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success">Cambiar tipo de Información</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-sm-4">
			<!-- Modal to see all records about serial no. -->
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
			  	Solicitudes relacionadas
			</button>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div style="border: 1px solid #CCCCCC; margin-top: 15px; margin-bottom: 15px;"></div>
		</div>
	</div>
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
			        		@if($closed_cases->id_sol == $detail->id_sol)
			        		<tr class="alert alert-warning">
			        		@else
			        		<tr>
			        		@endif
		      					<td>
		      						<a href="{{ (($closed_cases->status == 'CERRADA' || $closed_cases->status == 'RECHAZADA') ? url('solicitud-a-ingenieria/solicitud/show').'/'.$closed_cases->id_sol : url('solicitud-a-ingenieria/detalle/show').'/'.$closed_cases->id_sol) }}" target="_blank">
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
<div class="text-center">
	<div class="card-body">
		<table id="table" class="text-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Dispatch</th>
					@if($detail->os_cca != NULL)
					<th>Numero de Servicio</th>
					@endif
					<th>Modelo</th>
					<th>Serie</th>
					<th>Decripcion del Problema</th>
					<th>Documentos Adjuntos</th>
				</tr>
			</thead>
			<tfoot>
			</tfoot>
			<tbody>
				<tr>
					<td>{{$detail->dispatch}}</td>
					@if($detail->os_cca != NULL)
					<td>{{$detail->os_cca}}</td>
					@endif
					<td>{{$detail->modelo}}</td>
					<td>{{$detail->serie}}</td>
					<td>{{$detail->descripcion_problema}}</td>
					<td>
                    @if(substr($detail->ruta,0,10) != 'documentos')
                        <a href="{{url('solicitud-a-ingenieria/solicitud/descargar').'/'.$detail->id_sol}}" target="_blank"> Documentos</a>
                    @else
                        <a href="{{config('Pages.globals.url').'solicitudes_ingenieria/'.$detail->ruta}}" target="_blank"> {{$detail->ruta}}</a>
                    @endif

                    </td>
				</tr>
			</tbody>
		</table>
		<div class="row"></div>
		<form method="post" id="form-sol" enctype="multipart/form-data">
		@csrf
			<input id="id_request" name="id_request" type="hidden" value="{{$detail->id_sol}}">
			<input id="dispatch" name="dispatch" type="hidden" value="{{$detail->dispatch}}">

			<table id="table" class="text-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Linea de Producto</th>
						<th>Tipo de Informacion</th>
						<th>Nombre Tecnico</th>
						<th>Telefono Tecnico</th>
					</tr>
				</thead>
				<tfoot>
				</tfoot>
				<tbody>
					<tr>
						<td>
							<select name="line" id="line" class="form-control">
								<option value=""> Seleccione </option>
								@foreach ($line as $line)
									@if ($detail->linea_producto == $line->id)
										<option selected value="{{ $line->id }}">{{ $line->linea }}</option>
									@else
										<option value="{{ $line->id }}">{{ $line->linea }}</option>
									@endif
								@endforeach
							</select>
						</td>
						<td>
							<select name="information" id="information" class="form-control" onchange="subtypeChange()">
								<option value=""> Seleccione </option>
								@foreach ($information as $information_one)
									@if ($detail->informacion == $information_one->id)
										<option selected value="{{ $information_one->id }}">{{ $information_one->informacion }}</option>
									@else
									<option value="{{ $information_one->id }}">{{ $information_one->informacion }}</option>
									@endif
								@endforeach
							</select>
						</td>
						<td>{{$detail->nombre_tecnico}}</td>
						<td>{{$detail->telefono}}</td>
					</tr>
				</tbody>
			</table>
			<div class="row">
				<div class="col-sm-12">
					<div class="form-group">
						<label>Comentarios:</label>
						<textarea id="description" name="description"class="form-control" rows="4" readonly style="resize:none;">{{$detail->comentario}}</textarea>
					</div>
				</div>
			</div>
			
			<br>
			<h5 class="card-subtitle mb-2 text-muted">Comentarios Ingeniero</h5>
			<br>
			<h6 class="card-title"><strong>**Nota:</strong> Documentos adjuntos deben tener una nomenclatura sin espacios</h6>
			<table id="table" class="text-center display nowrap table table-hover table-striped table-bordered" cellspacing="0">
				<thead>
					<tr style="width: 100%;">
						<th style="width: 50%;">Comentarios Ingeniero</th>
						<th>Documentos Adjuntos</th>
						<th>Historial de Solicitudes</th>
						<th>Subtipo de Informacion</th>
					</tr>
				</thead>
				<tfoot>
				</tfoot>
				<tbody>
					<tr>
						<td>
							<textarea id="comments" name="comments"class="form-control" style="height: 140px;"></textarea>
						</td>
						<td>
							<input type="file" name="file" id="file" data-toggle="tooltip" data-placement="bottom" title="Documentos adjuntos deben tener una nomenclatura sin espacios">
						</td>
						<td></td>
						<td>
							<select name="subtype" id="subtype" class="form-control">
								<option value = ''> Seleccione </option>
								@foreach ($subtype as $subtype)
									<option value="{{$subtype->id}}">{{$subtype->sub_tipo}}</option>
								@endforeach
							</select>
						</td>
					</tr>
				</tbody>
			</table>
            <hr>
            <div class="row">
                <h4 class="card-title">{{ config('Pages.solicitud.table.info') }}</h4>
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
                                    <a href="{{ url('solicitud-a-ingenieria/documento/descargar/'.$questions->path) }}" target="_blank">
                                    @if($questions->tipo ==  "image")
                                    <img style=" max-height:100px;" src="{{ url('solicitud-a-ingenieria/documento/descargar/'.$questions->path) }}" >
                                    @endif
                                    @if($questions->tipo ==  "video")
                                        <video width="320" height="240" controls>
                                        <source src="{{ url('solicitud-a-ingenieria/documento/descargar/'.$questions->path) }}" type="{{$questions->mimeType}}">
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
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="alert alert-info">
							<strong>**¡ESPERA!</strong> Antes de mandar la información, recuerda que puedes evaluar la calidad de información que recibes por parte de los solicitantes. Por favor elije una de las siguientes opciones.
						</div>
					</div>
					<div class="col-sm-6">
						<span id="span-ipt-q1" class="hidden">Seleccione una opcion</span>
						<h4 class="card-title"> Evalua la información del Solicitante. </h4>
						<ul>
							<table>
								<tr><td><input type="radio" id="ipt_q1_1" name="ipt_q1" value="{{config('Pages.poll.scores.1')}}" checked /></td><td><label for="ipt_q1_1">a) {{config('Pages.poll.scores.1')}}</label></td></tr>
								<tr><td><input type="radio" id="ipt_q1_2" name="ipt_q1" value="{{config('Pages.poll.scores.2')}}" /></td><td><label for="ipt_q1_2">b) {{config('Pages.poll.scores.2')}}</label></td></tr>
								<tr><td><input type="radio" id="ipt_q1_3" name="ipt_q1" value="{{config('Pages.poll.scores.3')}}" /></td><td><label for="ipt_q1_3">c) {{config('Pages.poll.scores.3')}}</label></td></tr>
								<tr><td><input type="radio" id="ipt_q1_4" name="ipt_q1" value="{{config('Pages.poll.scores.4')}}" /></td><td><label for="ipt_q1_4">d) {{config('Pages.poll.scores.4')}}</label></td></tr>
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
			</div>
			<div class="card-footer bg-transparent">
				<div class="form-group text-center">
					<div class="col-lg-2 col-md-4 float-right">
						<button type="submit" class="btn btn-success from_send" id="save">Responder Solicitud</button>
					</div>
                    <div class="col-lg-2 col-md-4 float-right">
						<button type="button" class="btn btn-danger" id="rechazar">Rechazar</button>
					</div>
					<div class="col-lg-2 col-md-4 float-right">
						<a href="{{ url('solicitud-a-ingenieria/detalle') }}" class="btn btn-primary from_send"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Regresar</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

@section('scripts')
<script type="text/javascript">
function subtypeChange ()
{
	var data =
	{
		information:	$("#information").val(),
	}
	$.ajax({
		url: "{{ url('solicitud-a-ingenieria/detalle/subtypeChange') }}",
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
	var inputs = [ 'subtype', 'comments', 'id_request', 'line', 'information', 'subtype' ];

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
		var ok = validateForm();
		if( ok )
		{
			$.ajax({
				url: "{{ url('solicitud-a-ingenieria/detalle/create') }}",
				method:"POST",
				data:new FormData(this),
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data)
				{
					var message = ( !data.message ) ? 'Detalle creado correctamente' : data.message;
					var ok 		= ( !data.ok ) ? 'success' : data.ok;
					showNotification('Solicitud', message, ok);
                    $('#form-sol').trigger("reset");
                    window.location.href = "{{ url('solicitud-a-ingenieria/detalle') }}";
				},
				error: function(jq,status,message){ showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.form.error') }}', 'error'); }
			})
		}
		else
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.form.invalid') }}', 'error');
		}
    });

    $( "#rechazar" ).on( "click", function() {
        var info =
	{
		id_request:	$("#id_request").val(),
    };

    $.ajax({
        url: "{{ url('solicitud-a-ingenieria/detalle/rechazar') }}",
        method:"POST",
        data:info,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success:function(data)
        {
            var message = ( !data.message ) ? 'Detalle creado correctamente' : data.message;
            var ok 		= ( !data.ok ) ? 'success' : data.ok;
            showNotification('Solicitud', message, ok);
            $('#form-sol').trigger("reset");
            window.location.href = '{{ url('solicitud-a-ingenieria/detalle') }}';
        },
        error: function(jq,status,message){ showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.form.error') }}', 'error'); }
    });

    });
});

</script>
@endsection

@endsection
