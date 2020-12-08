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
			<h2><strong>Reporte Servicios Abiertos</strong></h2>
		</div>	
	</div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
        <h4><strong>¿Comó deseas descargar tus reportes?</strong></h4>
        <p><strong><small>** Nota</small></strong> Recuerda que todos los reportes estan relacionados a la ultima carga de datos que se realizo en el sistema.</p>
    </div>
  </div>
</div>
<hr />
<div class="container">
	  <div class="row">
     		<div class="col-sm-4">
            <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/download/report/all/') }}">
             		{{ csrf_field() }}
             		<h4 style="margin-bottom: 15px;">Aquí puedes descargar el reporte general con <strong><mark>TODOS</mark></strong> los registros alimentados.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**</i></strong> Solo da clic en el botón de abajo. 
                </div>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Descargar reporte general</button>
            </form>
      	</div>
        <div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/download/report/taller') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí puedes descargar el reporte agrupado por <strong><mark>Taller</mark></strong>.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**</i></strong> Solo ingresa el id del taller en el input de abajo y despues da clic en descargar reporte. <strong></strong> 
                </div>
                <input type="text" id="taller" name="taller" class="form-control"/>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Descargar reporte</button>
            </form>
        </div>
        <div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/download/report/tipo') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí puedes descargar el reporte por <strong><mark>Tipo de Taller</mark></strong>.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**</i></strong> Solo selecciona el tipo de taller en la parte de abajo y da clic en descargar reporte. <strong></strong> 
                </div>
                <select id="tipo_taller" name="tipo_taller" class="form-control">
                  <option value="0">Selecciona una opción...</option>
                  <option value="MODULO">MODULO</option>
                  <option value="NO APLICA">NO APLICA</option>
                  <option value="TALLER">TALLER</option>
                  <option value="PSN">PSN</option>
                  <option value="DISTRIB">DISTRIB</option>
                  <option value="LAV COMERCIAL">LAV COMERCIAL</option>
                </select>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Descargar reporte</button>
            </form>
        </div>
   	</div>
    <hr>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/download/report/supervisor') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí puedes descargar el reporte por <strong><mark>Supervisor</mark></strong>.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**</i></strong> Solo selecciona el Supervisor en la parte de abajo y da clic en descargar reporte. <strong></strong> 
                </div>
                <select id="supervisor" name="supervisor" class="form-control">
                  <option value="0">Selecciona una opción...</option>
                    <option value="ANABEL FLORES">ANABEL FLORES</option>
                    <option value="ELVIA ARACELY HERNANDEZ">ELVIA ARACELY HERNANDEZ</option>
                    <option value="BERNARDO LAZARO">BERNARDO LAZARO</option>
                    <option value="JUAN CARLOS LOPEZ">JUAN CARLOS LOPEZ</option>
                    <option value="JAVIER ALATORRE">JAVIER ALATORRE</option>
                    <option value="CLAUDIA AGUILAR">CLAUDIA AGUILAR</option>
                    <option value="CONCEPCION TORIBIO">CONCEPCION TORIBIO</option>
                    <option value="FRANCISCO D INIGUEZ">FRANCISCO D INIGUEZ</option>
                    <option value="JOSE LUIS GONZALEZ">JOSE LUIS GONZALEZ</option>
                    <option value="JUAN J CABRERA">JUAN J CABRERA</option>
                    <option value="HECTOR GALVAN">HECTOR GALVAN</option>
                    <option value="RICARDO PONCE">RICARDO PONCE</option>
                    <option value="OSCAR ABOYTES">OSCAR ABOYTES</option>
                    <option value="ALMACENES COPPEL, S.A. DE">ALMACENES COPPEL, S.A. DE</option>
                    <option value="ENRIQUE LABORDE">ENRIQUE LABORDE</option>
                    <option value="OSCAR SALAZAR">OSCAR SALAZAR</option>
                    <option value="HECTOR H CHAVEZ">HECTOR H CHAVEZ</option>
                    <option value="JAIME A VERA">JAIME A VERA</option>
                    <option value="HECTOR GALVAN DE LA TORRE">HECTOR GALVAN DE LA TORRE</option>
                    <option value="SEARS">SEARS</option>
                    <option value="ALFREDO ORENDAIN">ALFREDO ORENDAIN</option>
                    <option value="JUAN C SERNA">JUAN C SERNA</option>
                    <option value="ERVEY ABIEL MARTINEZ">ERVEY ABIEL MARTINEZ</option>
                    <option value="LUZ RAZO">LUZ RAZO</option>
                    <option value="SINTHYA GUERRERO">SINTHYA GUERRERO</option>
                    <option value="VICTOR HUGO BELTRAN">VICTOR HUGO BELTRAN</option>
                    <option value="JULIO CESAR JIMENEZ">JULIO CESAR JIMENEZ</option>
                    <option value="PABLO SALGADO">PABLO SALGADO</option>
                    <option value="YAZMIN MENDEZ">YAZMIN MENDEZ</option>
                    <option value="DANIEL ALEJANDRO TREVINO">DANIEL ALEJANDRO TREVINO</option>
                    <option value="ROXANA SERRANO">ROXANA SERRANO</option>
                    <option value="OSCAR MILLAN">OSCAR MILLAN</option>
                    <option value="ALMA DELIA MORENO">ALMA DELIA MORENO</option>
                    <option value="JUAN OSCAR ABOYTES LIVERA">JUAN OSCAR ABOYTES LIVERA</option>
                </select>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Descargar reporte</button>
            </form>
        </div>
        <div class="col-sm-4">
           <form method="POST" enctype="multipart/form-data" action="{{ url('tickets-abiertos/download/report/antiguedad') }}">
              {{ csrf_field() }}
              <h4 style="margin-bottom: 15px;">Aquí puedes descargar el reporte por <strong><mark>Antigüedad</mark></strong>.</h4>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span> 
                    </button>
                    <strong><i>**</i></strong> Solo selecciona el rango de días y da clic en descargar reporte. <strong></strong> 
                </div>
                <select id="antiguedad" name="antiguedad" class="form-control">
                  <option value="0">Selecciona una opción...</option>
                  <option value="0 a 7 días">0 a 7 días</option>
                  <option value="8 a 14 días">8 a 14 días</option>
                  <option value="15 a 21 días">15 a 21 días</option>
                  <option value="22 a 30 días">22 a 30 días</option>
                  <option value="+30 días">+30 días</option>
                </select>
                <div style="height: 15px;"></div>
                <button class="btn btn-primary" type="submit">Descargar reporte</button>
            </form>
        </div>
    </div>
    <hr>
</div>
<hr>
<div style="height: 60px;"></div>
@endsection


