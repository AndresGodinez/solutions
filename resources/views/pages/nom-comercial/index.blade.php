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
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>NOM Comerciales</strong></h2>
			<h5>Impresión de etiquetas de Números de parte con normativas comerciales</h5>
		</div>	
	</div>
</div>
<hr>
<div class="container">
	<form class="generic_form form_ligas" action="{{ url('nom-comerciales/process/np-info/') }}" method="POST">
		{{ csrf_field() }}
		<div class="row">	
			<div class="col-sm-3">	
				<div class="form-group">
				    <label for="ipt_np">Número de parte<sup style="color: red;"><strong>*</strong></sup>:</label>
				    <input type="text" class="form-control" id="ipt_np" name="ipt_np" value="" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-success">
					Consultar NP
				</button>
			</div>
		</div>
	</form>
</div>
<div style="height: 60px;"></div>
@endsection


