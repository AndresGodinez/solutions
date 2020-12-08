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
		<div class="col-sm-10">
			<h2>Solicitud de información <small>[Detalle]</small></h2>
			<h5>Aqui puedes solicitar para los números de parte información más detallada. Recuerda que puedes solicitar de <strong>hasta 3</strong> números de parte por acción.</h5>
		</div>	
		<div class="col-sm-2">
			<a class="btn btn-primary" href="{{ url('solicitudes-aduanales/') }}" style="margin-top: 30px;"> <- Regresar</a>
		</div>
	</div>
</div>
<hr>
<form method="POST" enctype="multipart/form-data" action="{{ url('solicitudes-aduanales/process/solicitar') }}" class="generic_form">
{{ csrf_field() }}
<div class="container">
    <div class="row">
   		<div class="table-responsive col-sm-12">
            <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                        <th>No.</th>
                        <th>Número de parte</th>
                        <th>Descripción</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			1
	            		</td>
	            		<td>
	            			<input type="text" id="np1" name="np1" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="description1" name="description1" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<textarea type="text" id="comments1" name="comments1" class="form-control" style="min-height: 90px;"></textarea>
	            		</td>
	            	</tr>
	            	<tr>
	            		<td>
	            			2
	            		</td>
	            		<td>
	            			<input type="text" id="np2" name="np2" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="description2" name="description2" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<textarea type="text" id="comments2" name="comments2" class="form-control" style="min-height: 90px;"></textarea>
	            		</td>
	            	</tr>
	            	<tr>
	            		<td>
	            			3
	            		</td>
	            		<td>
	            			<input type="text" id="np3" name="np3" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="description3" name="description3" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<textarea type="text" id="comments3" name="comments3" class="form-control" style="min-height: 90px;"></textarea>
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
   	</div>
   	<div class="row">
   		<div class="col-sm-12">
   			<button class="btn btn-primary">
	   			Solicitar
	   		</button>
   		</div>
   	</div>
</div>
</form>
<div style="height: 60px;"></div>
@endsection


