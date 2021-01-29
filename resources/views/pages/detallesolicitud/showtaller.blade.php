@extends('layouts.app')

@section('content')
<?php 
$sol_ing = true;
?>
<div class="text-center">
	<div class="card-body">
		
		<h4 class="card-title">Detalle de Solicitud Taller<font color="gray" size="4"> ({{$detail->dispatch}})</font></h4>
		<h5 class="card-subtitle mb-2 text-muted">Informacion del General</h5>
		<br>
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
                        <a href="{{url('solicitudes-a-ingenieria/solicitud/descargar').'/'.$detail->id_sol}}" target="_blank">
                        	<img src="{{url('solicitudes-a-ingenieria/solicitud/descargar').'/'.$detail->id_sol}}" alt="Sin documentos adjuntos" style="width: 450px;" />
                        </a>
                    @else
                        <a href="{{'solicitudes-a-ingenieria/'.$detail->ruta}}" target="_blank"> 
                        	<img src="{{'solicitudes-a-ingenieria/'.$detail->ruta}}" alt="Sin documentos adjuntos" style="width: 450px;" />
                        </a>
                    @endif
                    </td>
				</tr>
			</tbody>
		</table>
		<form  id="form-sol" enctype="multipart/form-data" method="post" action="{{ url('solicitudes-a-ingenieria/detalle/taller') }}" onsubmit="event.preventDefault(); send();">
		<!--<form method="post" id="form-sol" enctype="multipart/form-data">-->
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
							<select name="line" id="line" class="form-control" readonly>
								@foreach ($line as $line)
									@if ($detail->linea_producto == $line->id)
										<option selected value="{{ $line->id }}">{{ $line->linea }}</option>
									@endif
								@endforeach
							</select>
						</td>
						<td>
							<select name="information" id="information" class="form-control" readonly>
								@foreach ($information as $information)
									@if ($detail->informacion == $information->id)
										<option selected value="{{ $information->id }}">{{ $information->informacion }}</option>
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

						@foreach ($revision as $revision)
                    <tr>
						<td>
							<textarea id="comments" name="comments"class="form-control" rows="4" style="resize:none;" readonly>{{$revision->comentarios}}</textarea>
						</td>
						<td>
							<a href="{{ url('solicitudes-a-ingenieria/detalle/descargar/'.$detail->id_sol) }}" target="_blank" rel="noopener noreferrer">Documentos</a>
						</td>
						<td></td>
						<td>
							<select name="subtype" id="subtype" class="form-control" readonly>
								@foreach ($subtype as $subtp)revision
									@if( $subtp->id == $detail->id_sub_tipo)
										<option selected value="{{$subtp->id}}">{{$subtp->sub_tipo}}</option>
									@endif
								@endforeach
							</select>
						</td>
                        </tr>
						@endforeach

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
                                    <a href="{{ url('solicitudes-a-ingenieria/documento/descargar/'.$questions->path) }}" target="_blank">
                                    @if($questions->tipo ==  "image")
                                    <img style=" max-height:100px;" src="{{ url('solicitudes-a-ingenieria/documento/descargar/'.$questions->path) }}" >
                                    @endif
                                    @if($questions->tipo ==  "video")
                                        <video width="320" height="240" controls>
                                        <source src="{{ url('solicitudes-a-ingenieria/documento/descargar/'.$questions->path) }}" type="{{$questions->mimeType}}">
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
							<strong>**¡ESPERA!</strong> Antes de salir de esta sección, recuerda que puedes evaluar la calidad de información que recibes de Ingeniería. Por favor elije una de las siguientes opciones.
						</div>
					</div>
					<div class="col-sm-6">
						<span id="span-ipt-q1" class="hidden">Seleccione una opcion</span>
						<h4 class="card-title"> Evalua la respuesta de Ingeniería. </h4>
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
						<h4 class="card-title"> ¿En que puede mejorar Ingeniería? </h4>
						<p class="card-subtitle mb-2 text-muted"><strong>NOTA*</strong> Esta sección es para mejorar la Respuesta de Ingeniería y se revisarán los comentarios al final del mes. Si tienes comentarios sobre el modo de falla de este Reporte, será necesario que envíes otra solicitud para que te respondan a la brevedad.</p>
						<ul>
							<textarea id="ipt_q2" name="ipt_q2"class="form-control" rows="4" style="resize:none;"></textarea>
						</ul>
					</div>
				</div>
			</div>
			<div class="card-footer bg-transparent">
				<div class="form-group text-center">
					<div class="col-lg-2 col-md-4 float-right">
						<button type="submit" class="btn btn-success from_send" id="save">Responder Solicitud</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
function send()
{
    console.log("send");
    $('[name=ipt_q1]').removeClass('is-invalid');
    $('[name=ipt_q2]').removeClass('is-invalid');

	if( $("#subtype").val() != '' && $("#comments").val() != '' )
	{
		var data =
		{
			id_request:		$("#id_request").val(),
			dispatch:		$("#dispatch").val(),
			ipt_q1:			$("#ipt_q1").val(),
			ipt_q2:			$("#ipt_q2").val(),
		}
		console.log(data);
		$.ajax({
			url: "{{ url('solicitudes-a-ingenieria/detalle/taller') }}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			data: data,
			success: function( data )
			{
				if( data.ok != false && data.ok != 'error')
				{
                    showNotification('Success',data.message, 'success');
                    window.location.href = "{{ url('solicitudes-a-ingenieria/detalle/abiertas-en-revision') }}";
				}
				else
				{
					showNotification('Error',data.message, 'warning');
				}
			},
			error: function(jq,status,message)
			{
				showNotification('Error',"Error al cargar datos...", 'error');
			}
		});
	}
	else
	{
		showNotification('Error',"Indique subtipo de informacion y/o comentario.", 'error');
		if( $("#ipt_q1").val() == '') removeOrAddStyleClass(element='ipt_q1',style='is-invalid', action='add');
		if( $("#ipt_q2").val() == '' ) removeOrAddStyleClass(element='ipt_q2',style='is-invalid', action='add');
	}

}
</script>
@endsection
@endsection
