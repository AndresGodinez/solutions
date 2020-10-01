@extends("layouts.app")

@section("content")
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Revisión de Números de Parte</strong></h2>			
		</div>
	</div>
</section>
<div style="height: 30px;"></div>
<section id="basic-datatable">

	<div class="row">
		<div class="col-sm-12">
			<div class="card p-1">
				<table class="table table-striped table-bordered complex-headers table-responsive">
					<thead>
						<tr>
						<th>NUM PARTE</th>
						<th>DESCRIPCION</th>
						<th>MODELO</th>
						<th>FECHA CREACION</th>
						<th>DIAS CREACION</th>
						<th>DIAS CON DEPARTAMENTO</th>
						<th>TALLER</th>
						<th>DISPATCH</th>
						<th>SOLICITANTE</th>
						<th>STATUS</th>
						<th>MOTIVO</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1; ?>
						@foreach($get_records as $get_records)
						
						<tr>
							<td>
								<a href="{{	url('alcopar/reving/edit/'.$get_records['id']) }}">
									<strong>{{ $get_records['parte'] }}</strong>
								</a>
							</td>
							<td>{{ $get_records['descripcion'] }}</td>
							<td>{{ $get_records['modelo'] }}</td>
							<td>{{ $get_records['fecha'] }}</td>
							<td>{{ $get_records['dias2'] }}</td>
							<td>{{ $get_records['diasd'] }}</td>
							<td>{{ $get_records['taller'] }}</td>
							<td>{{ $get_records['dispatch'] }}</td>
							<td>{{ $get_records['nombre_usuario'] }}</td>							
							<td>{{ $get_records['status'] }}</td>
							<td>{{ $get_records['motivo'] }}</td>
							
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
<script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script>

        $('.table').DataTable({
			"responsive":true,
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            }
		});

		<?php 
		if(@$_GET['success'] == 1){
			?>
			Swal.fire({
                                    type: "success",
                                    title: '¡Ejecutado con éxito!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-success',
                                });
			<?php
		}
		?>
		
</script>
@endsection
