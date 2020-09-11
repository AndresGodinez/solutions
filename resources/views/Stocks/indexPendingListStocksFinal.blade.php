@extends("layouts.app")

@section("content")
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Stock Final</strong> <small>(pendientes)</small></h2>
			<a href="{{ url('stocks/final/') }}" class="btn btn-primary" style=" position: absolute; right:15px; top:5px;">Ver todos los proyectos (histórico)</a>
		</div>	
	</div>
</section>
<div style="height: 30px;"></div>
<section id="basic-datatable">
	<div class="card p-1">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-striped table-bordered complex-headers">
				<thead>
					<tr>
					    <th>Folio</th>
					    <th>No. parte</th>
					    <th>Descripción</th>
					    <th>Modelo</th>
					    <th>Proyecto</th>
					    <th>Proveedor</th>
					    <th>Solicitante</th>
					    <th>Fecha</th>
						<th>Días</th>
						<th></th>
							<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($get_records as $get_records)
					<tr>
					    <td>{{ $get_records->id }}</td>
					    <td>
					    	<a href="{{	url('stocks/final/detalle/'.$get_records->id) }}">
					    		<strong>{{ $get_records->material }}</strong>
					    	</a>
					    </td>
					    <td>{{ $get_records->descripcion }}</td>
					    <td>{{ $get_records->modelo }}</td>
					    <td>{{ $get_records->proyecto }}</td>
					    <td>{{ $get_records->proveedor }}</td>
					    <td>{{ $get_records->user_carga }}</td>
					    <td>{{ $get_records->created_at }}</td>
					    <td>
					    	<?php 
                            $date_one = new DateTime($get_records->created_at);
                            $date_two = new DateTime(date("Y-m-d H:i:s"));
                            $diff = $date_one->diff($date_two);
                            echo $diff->days;
                            ?>
					    </td>
					    <td>{{ $get_records->usr_request }}</td>
					    <td>
					    	@if($get_records->ok == 0)
				    		<div class="avatar bg-rgba-danger m-0 mr-75 cancel">
								<div class="avatar-content">
									<i class="bx bx-error text-danger"></i>
								</div>
							</div>
							@else
							<div class="avatar bg-rgba-success m-0 mr-75 ok">
								<div class="avatar-content">
									<i class="bx bx-check text-success"></i>
								</div>
							</div>
							@endif
					    </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>
</div>
<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script>

        $('.table').DataTable({                        
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            }        
		});	
</script>
@endsection
