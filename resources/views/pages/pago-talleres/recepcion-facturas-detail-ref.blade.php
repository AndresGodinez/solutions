@extends("layouts.app")

@section("content")
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
<div style="height: 30px;"></div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>
			  <strong>Facturas Recibidas</strong>  <small>(<strong>Detalle</strong>)</small>
			</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<thead>
				    <tr>
				      <th scope="col">Proveedor</th>
				      <th scope="col">Taller</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Fecha Recepción Fact</th>
				      <th scope="col">Factura</th>
				      <th scope="col">Referencia</th>
				      <th scope="col">Importe</th>
				      <th scope="col">Imprimir PDF</th>
				      <th scope="col">Imprimir XML</th>
				      <th scope="col">Aceptar</th>
				      <th scope="col">Rechazar</th>
				    </tr>
				</thead>
				<tbody>
					@foreach($data as $data)
					<tr>
						<td>{{ $data->vendor }}</td>
						<td>{{ $data->taller }}</td>
						<td>{{ $data->nombre }}</td>
						<td>{{ date('d-m-Y',strtotime($data->fecharecepcion)) }}</td>
						<td>{{ $data->numfact }}</td>
						<td>
							<a href="#">
								{{ $data->referencia }}
							</a>
						</td>
						<td>{{ $data->importe }}</td>
						<td>{{ $data->pdf }}</td>
						<td>{{ $data->xml }}</td>
						<td>
							<form action="" method="POST">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-primary">
							    	Aceptar
							    </button>
							</form>
						</td>
						<td>
							<form action="" method="POST">
								{{ csrf_field() }}
								<button type="submit" class="btn btn-danger">
							    	Rechazar
							    </button>
							</form>
						</td>
					</tr>	
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
