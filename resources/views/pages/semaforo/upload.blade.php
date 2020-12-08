@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Carga de datos</h2>
		</div>	
	</div>
</div>
<div class="container">
  	<div class="row">
     		<div class="col-sm-5">
             <form method="POST" enctype="multipart/form-data" action="{{ url('semaforo/carga/process/') }}">
             		{{ csrf_field() }}
             		<h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Tickets CRM</mark></strong></h4>
                  <div class="alert alert-warning" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span> 
                      </button>
                      <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong> 
                  </div>
                  <input type="file" id="file" name="file" class="form-control form-control-input-file" required="required"/>
                  <div style="height: 15px;"></div>
                  <button class="btn btn-primary" type="submit">Subir archivo</button>
              </form>
      	</div>
     	</div>
</div>
<hr>
<div style="height: 60px;"></div>
@endsection


