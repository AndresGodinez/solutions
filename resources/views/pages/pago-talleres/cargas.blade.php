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
			<h2>Carga de datos</h2>
		</div>	
	</div>
</div>
<div class="container">
	<div class="row">
   		<div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('pago-a-talleres/reporte-ts-crm/cargas/process/claims') }}">
           		{{ csrf_field() }}
           		<h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>CLAIMS APROBADOS</mark></strong> (CRM)</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong> 
                </div>
                <input type="file" id="file" name="file" class="form-control form-control-input-file" required="required" />
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Subir archivo</button>
            </form>
    	</div>
    	<div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('pago-a-talleres/reporte-ts-crm/cargas/process/prorrateo') }}">
           		{{ csrf_field() }}
           		<h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para la Conclusión de <strong><mark>PRORRATEO</mark></strong></h4>
                <input type="hidden" name="k" value="upload_file_inicial_isc" />
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong> 
                </div>
                <input type="file" id="file" name="file" class="form-control form-control-input-file" required="required" />
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Subir archivo</button>
            </form>
    	</div>
      <div class="col-sm-4">
          <form method="POST" enctype="multipart/form-data" action="{{ url('pago-a-talleres/reporte-ts-crm/cargas/process/pago-a-talleres') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>PAGO A TALLERES</mark></strong></h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong> 
                </div>
                <input type="file" id="file" name="file" class="form-control form-control-input-file" required="required" />
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


