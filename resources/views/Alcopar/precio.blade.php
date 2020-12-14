@extends("layouts.app")

@section("content")
    <div class="row d-flex justify-content-end my-3 ">
        <a href="{{ route('descargaPrecio') }}" class="btn btn-success">Descargar</a>
    </div>

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
						<th>Num Parte</th>
						<th>Descripción</th>
						<th>Modelo</th>
						<th>Fecha Creación</th>
						<th>Días Creación</th>
						<th>Días c/Depto.</th>
						<th>Tipo Mat.</th>
						<th>Categoría</th>
						<th>Fam</th>
						<th>Marca</th>
						<th>Cat. Extra</th>
						</tr>
					</thead>
					<tbody>
						<?php $n = 1; ?>
						@foreach($get_records as $get_records)

						<tr>
							<td>
								<a href="{{	url('alcopar/precio/edit/'.$get_records['id']) }}">
									<strong>{{ $get_records['parte'] }}</strong>
								</a>
							</td>
							<td>{{ $get_records['descripcion'] }}</td>
							<td>{{ $get_records['modelo'] }}</td>
							<td>{{ $get_records['fecha'] }}</td>
							<td>{{ $get_records['dias4'] }}</td>
							<td>{{ $get_records['diasd'] }}</td>
							<td>{{ $get_records['tipo_material'] }}</td>
							<td>{{ $get_records['categoria'] }}</td>
							<td>{{ $get_records['familia'] }}</td>
							<td>{{ $get_records['marca'] }}</td>
							<td>{{ $get_records['tipo_extra'] }}</td>

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
