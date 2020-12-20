@extends('layouts.app')

@section('content')
<div class="text-left">
	<div class="card-body">
		<h4 class="card-title">Revisión de Solicitud </h4>
		<h6 class="card-subtitle mb-2 text-muted">Busqueda por dispatch</h6>
		<br>
		<input type="hidden" name="type_slct" id="type_slct" value="{{ $type_slct }}" />
		<div class="row form-group justify-content-center">
        @if ($depto != 'TALLER')
			<div class="form-group col-md-4  justify-content-center" style="width: 20rem;">
				<label for="region">Region:&nbsp;</label>
				<select name="region" id="region" class="form-control" onchange="send()">
					<option value="">Todas</option>
					@foreach ($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                    @endforeach
				</select>
			</div>
            @endif
			<div class="form-group col-md-4  justify-content-center" style="width: 20rem;">
				<label for="information">Tipo de Informacion:&nbsp;</label>
				<select name="information" id="information" class="form-control" onchange="send()">
					<option value=""> Seleccione </option>
					@foreach ($information as $information)
						<option value="{{ $information->id }}">{{ $information->informacion }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group col-md-4  justify-content-center" style="width: 20rem;">
				<label for="line">Linea:&nbsp;</label>
				<select name="line" id="line" class="form-control" onchange="send()">
					<option value=""> Seleccione </option>
					@foreach ($line as $line)
						<option value="{{ $line->id }}">{{ $line->linea }}</option>
					@endforeach
				</select>
			</div>

		@if ($depto != 'TALLER')
		<div class="form-group col-md-4  justify-content-center">
				<label for="user">Generados por:&nbsp;</label>
				<select name="user" id="user" class="form-control" onchange="send()">
					<option selected value="">Todos</option>
					<option value="{{$username}}">Generadas por mi</option>
				</select>
		</div>
		@endif
        </div>
		<div id="body_tbl"class="form-group">
			<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>SOLICITUD</th>
						<th>DISPATCH</th>
						<th>MODELO</th>
						<th>SERIE</th>
						<th>DESCRIPCION DEL PROBLEMA</th>
						<th>LINEA DE PRODUCTO</th>
						<th>FECHA CREACION</th>
						<th>ANTIGUEDAD</th>
						<th>ESTATUS</th>
						<th>USUARIO</th>
						<th>INGENIERO</th>
						<th>TIPO INF</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($details as $detail)
					<tr>
						<td>{{$detail->id_sol}}</td>
						<td><a href="{{ url('solicitudes-a-ingenieria/'.$detail->ruta.'/show') }}/{{$detail->id_sol}}">{{$detail->dispatch}}</a></td>
						<td>{{$detail->modelo}}</td>
						<td>{{$detail->serie}}</td>
						<td>{{$detail->descripcion_problema}}</td>
						<td>{{$detail->linea}}</td>
						<td>{{$detail->fecha_envio}}</td>
						<td>
							<?php 
							if(isset($detail->dia))
							{
								echo $detail->dia;
							}
							else
							{
								$today = date("Y-m-d H:i:s");
			                    $fecha_envio = $detail->fecha_envio;

			                    $date_one = new DateTime($fecha_envio);
			                    $date_two = new DateTime($today);
			                    $diff = $date_one->diff($date_two);
								echo $diff->days;
							}
							?>
						</td>
						<td>{{$detail->status}}</td>
						<td>{{$detail->usuario}}</td>
						<td>{{$detail->nombre}}</td>
						<td>
							<?php 
								if($detail->informacion == 1)
								{
									echo "SOLICITUD DE INFORMACION TECNICA";
								}
								elseif($detail->informacion == 2)
								{
									echo "EVIDENCIA DE ACP";
								}
								elseif($detail->informacion == 3)
								{
									echo "EXPLOSIONADOS/PARTES";
								}
								elseif($detail->informacion == 4)
								{
									echo "FLAMAZO";
								}
								elseif($detail->informacion == 5)
								{
									echo "CONTACT CENTER";
								}
								elseif($detail->informacion == 6)
								{
									echo "VENTAS / DISTRIBUIDORES";
								}
							?> 
						</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<th>SOLICITUD</th>
						<th>DISPATCH</th>
						<th>MODELO</th>
						<th>SERIE</th>
						<th>DESCRIPCION DEL PROBLEMA</th>
						<th>LINEA DE PRODUCTO</th>
						<th>FECHA CREACION</th>
						<th>ANTIGUEDAD</th>
						<th>ESTATUS</th>
						<th>USUARIO</th>
						<th>INGENIERO</th>
						<th>TIPO INF</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
/*	$(document).ready(function () {
		$('#dtBasicExample').DataTable();
		$('.dataTables_length').addClass('bs-select');
	});*/

window.onload = function(){
//	send();
}
function send ()
{
	var data =
	{
		region:	$("#region").val(),
		information:	$("#information").val(),
		line:	$("#line").val(),
		user:	$("#user").val(),
		type_slct: $("#type_slct").val(),
	}
	$.ajax({
		url: "{{ url('solicitudes-a-ingenieria/detalle/filters') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		type: 'POST',
		data: data,
		success: function( data )
		{
			if( data.ok != false)
			{
				$('#body_tbl' ).html( data.html );
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
</script>
@endsection
@endsection
