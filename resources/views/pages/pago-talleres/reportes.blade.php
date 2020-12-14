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
			<div class="alert alert-warning" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">×</span> 
	            </button>
	            <strong>¿Deseas descargar el reporte de Volumen TS?</strong> Da click en el botón de abajo... 
          	</div>
          	<div style="height: 15px;"></div>
          	<a class="btn btn-primary" href="{{ url('pago-a-talleres/reporte-ts-crm/descargar/reporte/') }}" target="_blank">
              	Descargar reporte
          	</a>      
		</div>
		<div class="col-sm-4">
			<div class="alert alert-warning" role="alert">
	            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                <span aria-hidden="true">×</span> 
	            </button>
	            <strong>¿Deseas descargar el reporte de Facturas Recibidas?</strong> Da click en el botón de abajo... 
          	</div>
			<div style="height: 15px;"></div>
          	<a class="btn btn-primary" href="{{ url('pago-a-talleres/facturas-recibidas/x-tallr/descargar/') }}" target="_blank">
              	Descargar reporte
          	</a>      
		</div>
	</div>
</div>
@endsection