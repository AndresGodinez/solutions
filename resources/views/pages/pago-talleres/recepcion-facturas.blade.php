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
			  <strong>Recepción de facturas</strong>
			</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<form class="generic_form" action="{{ url('pago-a-talleres/process/recepcion-facturas/') }}" method="POST" style="border: 1px solid #CCCCCC; margin-bottom: 60px; padding: 15px;">
				  	@csrf
			  	<div class="form-group">
			  		<label for="ipt_taller"><strong>No. Taller:</strong></label>
			    	<input class="form-control" type="text" id="ipt_taller" name="ipt_taller" value="" required="required" />	
			  	</div>
			  	<button class="btn btn-primary">
			    	Consultar
			    </button>
			</form>
		</div>
	</div>
</div>
@endsection
