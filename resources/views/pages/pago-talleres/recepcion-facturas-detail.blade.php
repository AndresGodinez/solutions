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
			  <strong>Recepción de facturas</strong>  <small>(<strong>Detalle</strong>)</small>
			</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-7">
			<table class="table">
				<caption>Facturas pendientes por recibir</caption>
				<thead>
				    <tr>
				      <th scope="col">No.</th>
				      <th scope="col">Referencia</th>
				      <th scope="col">Fecha</th>
				      <th scope="col">Importe</th>
				      @if($flag == 1)
				      <th scope="col">Detalle</th>
				      @endif
				    </tr>
				</thead>
				<tbody>
					<?php 
					$n = 1;
					$importe_final = 0;
					?>
					@foreach($data_facts_pendientes as $data_facts_pendientes)
				    <tr>
					    <th scope="row">{{ $n++ }}</th>
					    <td>
				    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $data_facts_pendientes->referencia }}">
							  	{{ $data_facts_pendientes->referencia }}
							</button>
					    </td>
					    <td>{{ $data_facts_pendientes->fecha }}</td>
					    <td>{{ $data_facts_pendientes->importe }}</td>
					    @if($flag == 1)
					    <td>
					    	<div class="modal fade bd-example-modal-lg" id="exampleModaldetail{{ $data_facts_pendientes->referencia }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
								    <div class="modal-content" style="padding: 10px;">
							      		<table class="table">
											<thead>
											    <tr>
											      <th scope="col">Dispatch</th>
											      <th scope="col">Claim</th>
											      <th scope="col">Referencia</th>
											      <th scope="col">Fecha</th>
											      <th scope="col">Cantidad</th>
											    </tr>
											</thead>
											<tbody>
												<?php
												$total = 0;
												$iva = 0;
												if(isset($data_facts_pendientes_claims[$data_facts_pendientes->referencia]) && !empty($data_facts_pendientes_claims))
												{
													$n = count($data_facts_pendientes_claims[$data_facts_pendientes->referencia]);
												?>
												@for($i=0; $i<$n; $i++)
												<tr>
													<td>
														{{ $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['dispatch'] }}
													</td>
													<td>
														{{ $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['claim'] }}
													</td>
													<td>
														{{ $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['reference'] }}
													</td>
													<td>
														{{ $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['claim_app_date'] }}
													</td>
													<td>
														{{ $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['total_approved_claim_amount'] }}
													</td>
												</tr>
												<?php 
												$total = $total + $data_facts_pendientes_claims[$data_facts_pendientes->referencia][$i]['total_approved_claim_amount'];
												?>
												@endfor
												<?php 
												}	
												?>
											</tbody>	
							      		</table>
							      		<div style="padding: 10px;">
											<?php 
											$iva = $total * .16;
											$grand_total = $iva + $total;
											?>
											<strong>Subtotal:</strong> {{ $total }}<br />
											<strong>Iva:</strong> {{ $iva }}<br />
											<strong>Total:</strong> {{ $grand_total }}<br /> 
							      		</div>
							      		<div style="padding: 10px;">
							      			<a href="#">
							      				Descargar Excel
							      			</a>
							      		</div>
								    </div>
								</div>
							</div>
					    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaldetail{{ $data_facts_pendientes->referencia }}">
							  	Detalle
							</button>
					   	</td>
					    @endif
					    <?php $importe_final = $importe_final + $data_facts_pendientes->importe; ?>
				    </tr>
				    <!-- Modal -->
					<div class="modal fade" id="exampleModal{{ $data_facts_pendientes->referencia }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						    <div class="modal-content">
						      	@if($flag == 2)
						      	<form action="{{ url('pago-a-talleres/process/recepcion-facturas/admin/') }}" method="POST" class="generic_form">
						      		{{ csrf_field() }}
						      		<input type="hidden" name="ipt_referencia" value="{{ $data_facts_pendientes->referencia }}" />
						      		<input type="hidden" name="ipt_taller" value="{{ $data_info_taller[0]->taller }}" />
						      		<div class="modal-header">
							        	<h5 class="modal-title" id="exampleModalLabel">Recepción de Factura [ {{ $data_facts_pendientes->referencia }} ]</h5>
							        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          		<span aria-hidden="true">&times;</span>
							        	</button>
							      	</div>
							      	<div class="modal-body">
							      		<div class="form-group">
									  		<label><strong>Fecha:</strong></label>
									    	{{ $data_facts_pendientes->fecha }}	
									  	</div>
									  	<div class="form-group">
									  		<label><strong>Importe:</strong></label>
									    	{{ $data_facts_pendientes->importe }}	
									  	</div>
							        	<div class="form-group">
									  		<label for="ipt_no_factura"><strong>No. de factura:</strong></label>
									    	<input class="form-control" type="text" id="ipt_no_factura" name="ipt_no_factura" value="" required="required" />	
									  	</div>
							      	</div>
							      	<div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								        <button type="submit" class="btn btn-primary">Guardar</button>
							      	</div>
						      	</form>
						      	@else
						      	<form action="{{ url('pago-a-talleres/process/recepcion-facturas/taller/') }}" method="POST" enctype="multipart/form-data">
						      		{{ csrf_field() }}
						      		<input type="hidden" name="ipt_referencia" value="{{ $data_facts_pendientes->referencia }}" />
						      		<input type="hidden" name="ipt_taller" value="{{ $data_info_taller[0]->taller }}" />
						      		<div class="modal-header">
							        	<h5 class="modal-title" id="exampleModalLabel">Recepción de Factura Talleres [ {{ $data_facts_pendientes->referencia }} ]</h5>
							        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          		<span aria-hidden="true">&times;</span>
							        	</button>
							      	</div>
							      	<div class="modal-body">
							      		<div class="form-group">
									  		<label><strong>Fecha:</strong></label>
									    	{{ $data_facts_pendientes->fecha }}	
									  	</div>
									  	<div class="form-group">
									  		<label><strong>Importe:</strong></label>
									    	{{ $data_facts_pendientes->importe }}	
									  	</div>
							        	<div class="form-group">
									  		<label for="ipt_no_factura"><strong>No. de factura o Folio consecutivo interno:</strong></label>
									    	<input class="form-control" type="text" id="ipt_no_factura" name="ipt_no_factura" value="" required="required" />	
									  	</div>
									  	<div class="form-group">
									  		<label for="ipt_file_pdf"><strong>No. de factura o Folio consecutivo interno:</strong></label>
									    	<input class="form-control" type="file" id="ipt_file_pdf" name="ipt_file_pdf" value="" required="required" />	
									  	</div>
									  	<div class="form-group">
									  		<label for="ipt_file_xml"><strong>No. de factura o Folio consecutivo interno:</strong></label>
									    	<input class="form-control" type="file" id="ipt_file_xml" name="ipt_file_xml" value="" required="required" />	
									  	</div>
							      	</div>
							      	<div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								        <button type="submit" class="btn btn-primary">Guardar</button>
							      	</div>
						      	</form>
						      	@endif
						    </div>
						</div>
					</div>
				    @endforeach
				    <tr>
				    	<th></th>
				    	<td></td>
				    	<td></td>
				    	<td><strong>{{ $importe_final }}</strong></td>
				    </tr>
				</tbody>
			</table>
		</div>
		<div class="col-sm-5">
			<div style="background: #FFFFFF; border: 2px solid #000000; border-radius: 4px; padding: 15px;">
				<strong>Taller:</strong> <span style="color: red;"><strong>{{ $data_info_taller[0]->taller }}</strong></span>
				<br />
				<strong>Nombre:</strong> {{ $data_info_taller[0]->nombre }}
				<br />
				<strong>Ciudad:</strong> {{ $data_info_taller[0]->ciudad }}
				<br />
				<strong>Estado:</strong> {{ $data_info_taller[0]->estado }}
				<br />
				<strong>E-mail:</strong> {{ $data_info_taller[0]->mail }}
			</div>
		</div>
	</div>
</div>
@endsection
