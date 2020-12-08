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
		<div class="col-sm-4">
			<h2>
			  <strong>Reporte TS C4/CRM</strong>
			</h2>
			<div class="pagotaller">
				<form class="generic_form" action="{{ url('pago-a-talleres/reporte-ts-crm/process/') }}" method="POST" style="border: 1px solid #CCCCCC; margin-bottom: 60px; padding: 15px;">
				  	@csrf
				  	<div class="form-group">
				  		<label for="from"><strong>Del:</strong></label>
				    	<input class="form-control" type="date" id="from" name="from" value="" />	
				  	</div>
				    <div class="form-group">
				    	<label for="to"><strong>Al:</strong></label>
				    	<input class="form-control" type="date" id="to" name="to" value="" />	
				    </div>
				    <button class="btn btn-primary">
				    	Generar Reporte
				    </button>
				</form>
			</div>
		</div>
		<div class="col-sm-8 text-right">
			@if(isset($log[0]->completed) && $log[0]->completed == 1)
			<?php 
			$old_date = date($log[0]->end_process);
			$new_date = date('Y-m-d', strtotime($old_date));
			?>
			<a href="{{ url('pago-a-talleres/reporte-ts-crm/download/reporte-ts-'.$new_date.'.csv') }}" class="btn btn-primary" target="_blank">
				Descargar Archivo {{ $log[0]->end_process }}
			</a>
			@endif
		</div>
	</div>
</div>
@endsection
