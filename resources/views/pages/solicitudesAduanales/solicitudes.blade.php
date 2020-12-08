@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Solicitudes</h2>
			<h5><a href="#">Descargar reporte</a></h5>
		</div>	
	</div>
</div>
<div style="height: 30px;"></div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
					    <th>No.</th>
					    <th>No. parte</th>
					    <th>Descripción</th>
					    <th>Comentarios</th>
					    <th>Usuario</th>
					    <th>Departamento</th>
					    <th>Status</th>
					    <th>Fecha</th>
					    <th>Días</th>
					</tr>
				</thead>
				<tbody>
					<?php $n = 1; ?>
					@foreach($get_records as $get_records)
					<tr>
					    <td>{{ $n++ }}</td>
					    <td>
					    	<a href="{{	url('solicitudes-aduanales/solicitudes/detalle/'.$get_records->id) }}">
					    		<strong>{{ $get_records->np }}</strong>
					    	</a>
					    </td>
					    <td>{{ $get_records->description }}</td>
					    <td>{{ $get_records->comments }}</td>
					    <td>{{ $get_records->user }}</td>
					    <td>{{ $get_records->depto }}</td>
					    <td>{{ (($get_records->status == 1)  ? 'Abierta' : 'Cerrada') }}</td>
					    <td>{{ $get_records->created_at }}</td>
					    <td>
					    	<?php 
                            $date_one = new DateTime($get_records->created_at);
                            $date_two = new DateTime(date("Y-m-d H:i:s"));
                            $diff = $date_one->diff($date_two);
                            echo $diff->days;
                            ?>
					    </td>
					   <!--  <td>
					    	@if($get_records->ok == 0)
				    		<i class="material-icons cancel">
							cancel
							</i>
							@else
							<i class="material-icons ok">
							check_circle
							</i>
							@endif
					    </td> -->
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
