@extends("layouts.app")

@section("content")
<?php 
$bootbox = true;
?>
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
							<form action="{{ url('pago-a-talleres/recepcion-fact/process/aut/') }}" method="POST" class="generic_form">
								{{ csrf_field() }}
								<input type="hidden" name="ipt_taller" value="{{ $data->taller }}" />
								<input type="hidden" name="ipt_ref" value="{{ $data->referencia }}" />
								<input type="hidden" name="ipt_fact" value="{{ $data->numfact }}" />
								<button type="submit" class="btn btn-primary">
							    	Aceptar
							    </button>
							</form>
						</td>
						<td>
							<div class="modal fade" id="exampleModal{{ $data->referencia }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
								    <div class="modal-content">
								      	<form action="{{ url('pago-a-talleres/recepcion-fact/process/rech/') }}" method="POST" class="generic_form">
									    	<div class="modal-body" style="padding: 10px;">
												{{ csrf_field() }}
												<input type="hidden" name="ipt_taller" value="{{ $data->taller }}" />
												<input type="hidden" name="ipt_ref" value="{{ $data->referencia }}" />
												<div class="modal-header">
										        	<h5 class="modal-title" id="exampleModalLabel">Rechazar [ {{ $data->referencia }} ]</h5>
										        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          		<span aria-hidden="true">&times;</span>
										        	</button>
										      	</div>
												<div class="form-group">
										  			<label for="ipt_comentarios"><strong>Comentarios:</strong></label>
											    	<input class="form-control" type="text" id="ipt_comentarios" name="ipt_comentarios" value="" required="required" />	
											  	</div>	
									    	</div>
										    <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										        <button type="submit" class="btn btn-primary">Aceptar</button>
									      	</div>
								      	</form>	
									</div>
								</div>
							</div>
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $data->referencia }}">
							  	Rechazar
							</button>
						</td>
					</tr>	
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
