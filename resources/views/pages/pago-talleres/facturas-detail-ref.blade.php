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
			  <strong>Facturas Recibidas Aceptadas</strong>  <small>(<strong>Detalle</strong>)</small>
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
				      <th scope="col">Status</th>
				      <th scope="col">Comentarios</th>
				    </tr>
				</thead>
				<tbody>
					<?php 
					$total = 0;
					?>
					@foreach($data as $data)
					<tr>
						<td>{{ $data->vendor }}</td>
						<td>{{ $data->taller }}</td>
						<td>{{ $data->nombre }}</td>
						<td>{{ $data->fecharecepcion }}</td>
						<td>{{ $data->numfact }}</td>
						<td>{{ $data->referencia }}</td>
						<td>{{ $data->importe }}</td>
						<td>{{ $data->status_fact }}</td>
						<td>{{ $data->comentarios }}</td>
					</tr>
					<?php 
					$total = $total + $data->importe;
					?>	
					@endforeach
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><strong>Total: </strong></td>
						<td>$ {{ $total }}</td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
