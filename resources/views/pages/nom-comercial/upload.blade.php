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
            <h5>Carga de datos</h5>
        </div>  
    </div>
</div>
<hr>
<div class="container">
	<div class="row">
   		<div class="col-sm-6">
           <form method="POST" enctype="multipart/form-data" action="{{ url('nom-comerciales/carga/process/') }}">
           		{{ csrf_field() }}
           		<h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para la <strong><mark>Base de datos</mark></strong> de los números de parte para NOM Comerciales.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong> 
                </div>
                <input type="file" id="file" name="file" class="form-control form-control-input-file"/>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Subir archivo</button>
            </form>
    	</div>
   	</div>
</div>
<hr>
<hr>
<div style="height: 60px;"></div>
@endsection


