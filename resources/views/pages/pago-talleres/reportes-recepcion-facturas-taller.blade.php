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
		<div class="col-sm-4">
			<h2>
			  <strong>Reporte de Facturas Recibidas</strong>
			</h2>
			<div class="pagotaller">
				<form class="generic_form" action="{{ url('pago-a-talleres/facturas-recibidas/x-tallr/descargar/process/') }}" method="POST" style="border: 1px solid #CCCCCC; margin-bottom: 60px; padding: 15px;">
				  	@csrf
				  	<div class="form-group">
				  		<label for="from"><strong>Taller:</strong></label>
				    	<input class="form-control" type="text" id="taller" name="taller" value="" />	
				  	</div>
				  	<div class="form-group">
				  		<label for="from"><strong>Del:</strong></label>
				    	<input class="form-control" type="date" id="from" name="from" value="" required="required" />	
				  	</div>
				    <div class="form-group">
				    	<label for="to"><strong>Al:</strong></label>
				    	<input class="form-control" type="date" id="to" name="to" value="" required="required" />	
				    </div>
				    <button type="submit" class="btn btn-primary">
				    	Consultar
				    </button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

