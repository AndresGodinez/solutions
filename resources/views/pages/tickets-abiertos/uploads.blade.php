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
			<h2>Carga de datos</h2>
		</div>	
	</div>
</div>
<div class="container">
	  <div class="row">
   		<div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/guias') }}">
           		{{ csrf_field() }}
           		<h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Guias</mark></strong> (SAP)</h4>
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
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/pedidos') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Pedidos</mark></strong> (SAP)</h4>
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
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/reservas') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Reservas</mark></strong> (SAP)</h4>
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
    <hr>
    <div class="row">
      <div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/pex') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>PEX</mark></strong> (CRM)</h4>
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
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/tickets') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Tickets</mark></strong> (CRM)</h4>
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
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/process/tickets-abiertos/servicios-abiertos') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Servicios Abiertos</mark></strong> (CRM)</h4>
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
<div style="height: 60px;"></div>
@endsection


