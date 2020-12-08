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
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Solicitudes Aduanales</h2>
		</div>	
	</div>
</div>
<div class="container">
	<div class="row">
   		<div class="col-sm-6">
           <form method="POST" enctype="multipart/form-data" action="{{ url('solicitudes-aduanales/detalle/info-request/') }}" class="generic_form">
           		{{ csrf_field() }}
           		<h4 style="margin-bottom: 15px;">Por favor ingresa el Número de parte que deseas consultar</h4>
           		<p>Puedes realizar la busqueda de hasta <strong>10</strong> números de parte. Recuerda que si es mas de un número de parte, cada refacción debe de ir separa da por una coma. <strong>Ej.:</strong> 0002345, 78908WD, KT8999</p>
                <input type="text" id="ipt_np" name="ipt_np" class="form-control form-control-input-file" required="required" />
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">consultar</button>
            </form>
    	</div>
    	<div class="col-sm-6">
    		<h5>¿No encontraste lo que necesitabas? Por favor da clic para solicitar información exacta al Equipo de Ingenieria.</h5>
    		<a href="{{ url('solicitudes-aduanales/solicitar') }}" class="btn btn-primary">
    			Solicitar Información
    		</a>
    	</div>
   	</div>
</div>
<hr>
<div style="height: 60px;"></div>
@endsection


