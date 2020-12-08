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
<div class="modal" tabindex="-1" role="dialog" id="myModalFile">
	<form method="POST" enctype="multipart/form-data" action="{{ url('solicitudes-aduanales/process/solicittudes/contestar/file/') }}">
		{{ csrf_field() }}
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-body text-center">
			        	<input type="hidden" id="np" name="np" class="form-control" value="{{ $get_records_id[0]->np }}" />
			        	<input type="hidden" id="id" name="id" class="form-control" value="{{ $get_records_id[0]->id }}" />
			        	<h4>¡Espera, Aún no termina el proceso de solicitud¡</h4>
			        	<div class="alert alert-warning" role="alert">
			        		A continuación puedes cargar el dibujo relacionado a este número de parte (<strong>{{ $get_records_id[0]->np }}</strong>). Si cuentas con el adjunta el archivo y da clic en <strong>Cargar</strong>, si no cuentas con el, puedes <strong>Cerrar</strong> este cuadro de diálogo.
			        	</div>

			        	<input type="file" id="picture" name="picture" class="form-control" value="" />
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			        <button class="btn btn-primary">Cargar</button>
			    </div>
		    </div>
		</div>
	</form>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Solicitud de información <small>[Detalle]</small></h2>
		</div>	
	</div>
</div>
<hr>
<form method="POST" enctype="multipart/form-data" action="{{ url('solicitudes-aduanales/process/solicittudes/contestar') }}" class="generic_form_files">
{{ csrf_field() }}
<div class="container" style="margin-bottom: 30px;">
	<div class="row">
		<div class="col-sm-8">
			<strong>Nombre del solicitante: </strong> {{ $get_records_id[0]->user }}
			<br />
			<strong>Descripción del solicitante: </strong> {{ $get_records_id[0]->description }}
			<br />
			<strong>Comentarios del solicitante: </strong> {{ $get_records_id[0]->comments }}
			<br />
			<strong>Fecha: </strong> {{ $get_records_id[0]->created_at }}
		</div>
		<div class="col-sm-4 text-right">
			<a class="btn btn-primary" href="{{ url('solicitudes-aduanales/solicitudes/') }}"> <- Regresar</a>
		</div>
	</div>
</div>
<div class="container">
    <div class="row">
   		<div class="table-responsive col-sm-12">
            <table class="table table-hover table-bordered"> 
                <thead>
                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF;">
                        <th style="color: #FFFFFF;">Número de parte</th>
                        <th style="color: #FFFFFF;">Descripción SAP</th>
                        <th style="color: #FFFFFF;">Categoría</th>
                        <th style="color: #FFFFFF;">Nombre del producto / Nombre Comercial</th>
                        <th style="color: #FFFFFF;">¿Es componente  y / o parte de qué máquina?</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<strong>{{ $get_records_id[0]->np }}</strong>
	            			<input type="hidden" id="np" name="np" class="form-control" value="{{ $get_records_id[0]->np }}" />
	            		</td>
	            		<td>
	            			<input type="text" id="sap_description" name="sap_description" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="category" name="category" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="product_name" name="product_name" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="type_component" name="type_component" class="form-control" value="" />
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF;">
                    	<th style="color: #FFFFFF;">¿Cómo funciona?/¿Cómo o donde se instala?</th>
                    	<th style="color: #FFFFFF;">¿Para qué se utiliza?</th>
                    	<th style="color: #FFFFFF;">Materia Constitutiva / Tipo de material</th>
                        <th style="color: #FFFFFF;">% del material constitutiva si es textil</th>
                        <th style="color: #FFFFFF;">Medidas (Largo, ancho, diámetro, etc)</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<input type="text" id="type_functional" name="type_functional" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="type_use" name="type_use" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="type_np" name="type_np" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="textil" name="textil" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="size" name="size" class="form-control" value="" />
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF;">
	    				<th style="color: #FFFFFF;">Tipo de Motor (Monofásico, bifásico, trifásico, sincrono, asincrono, C.A, C.C)</th>
                        <th style="color: #FFFFFF;">Especificaciones Eléctricas (Volt, Amp Ohms, Watts, etc)</th>
                        <th style="color: #FFFFFF;">Codigo de barras</th>
                        <th style="color: #FFFFFF;">Codigo SAT</th>
                        <th style="color: #FFFFFF;">¿Este producto es un repuesto?</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr>
	    				<td>
	            			<input type="text" id="motor" name="motor" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="electric" name="electric" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="barras_code" name="barras_code" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="sat_code" name="sat_code" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<select id="repuesto" name="repuesto" class="form-control">
	            				<option value="">Seleccióna una opción...</option>
	            				<option value="0">Si</option>
	            				<option value="1">No</option>
	            			</select>
	            		</td>
	    			</tr>
	    		</tbody>
	    	</table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF;">
                        <th style="color: #FFFFFF;">Nombre de la marca</th>
                        <th style="color: #FFFFFF;">Número de piezas contenidas en el producto</th>
                        <th style="color: #FFFFFF;">¿Son necesarias baterías para que funcione el producto o es el producto una batería?</th>
                        <th style="color: #FFFFFF;">¿Están las baterías incluidas con el producto?</th>
                        <th style="color: #FFFFFF;">Tipo de batería</th>
                        <th style="color: #FFFFFF;">Número de baterías incluidas</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<select id="brand" name="brand" class="form-control">
	            				<option value="">Seleccióna una opción...</option>
	            				@foreach($get_records_marcas as $get_records_marcas)
	            				<option value="{{ $get_records_marcas->id_marca }}">{{ $get_records_marcas->name }}</option>
	            				@endforeach
	            			</select>
	            		</td>
	            		<td>
	            			<input type="text" id="n_pzas" name="n_pzas" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<select id="battery" name="battery" class="form-control">
	            				<option value="">Seleccióna una opción...</option>
	            				<option value="0">Si</option>
	            				<option value="1">No</option>
	            				<option value="2">N/A</option>
	            			</select>
	            		</td>
	            		<td>
	            			<select id="battery_include" name="battery_include" class="form-control">
	            				<option value="">Seleccióna una opción...</option>
	            				<option value="0">Si</option>
	            				<option value="1">No</option>
	            				<option value="2">N/A</option>
	            			</select>
	            		</td>
	            		<td>
	            			<input type="text" id="battery_type" name="battery_type" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<input type="text" id="battery_n" name="battery_n" class="form-control" value="" />
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF;">
                    	<th style="color: #FFFFFF;">Watt horas por batería</th>
                        <th style="color: #FFFFFF;">¿Se considera el producto mercancía peligrosa o material peligroso cuyo transporte, almacenamiento y gestión de residuos están regulados?</th>
                        <th style="color: #FFFFFF;">URL de la ficha de datos de seguridad (FDS)</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<input type="text" id="watt_x_h" name="watt_x_h" class="form-control" value="" />
	            		</td>
	            		<td>
	            			<select id="danger_product" name="danger_product" class="form-control">
	            				<option value="">Seleccióna una opción...</option>
	            				<option value="0">Si</option>
	            				<option value="1">No</option>
	            			</select>
	            		</td>
	            		<td>
	            			<input type="text" id="url_fds" name="url_fds" class="form-control" value="" />
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
   	</div>
   	<div class="row">
   		<div class="col-sm-12">
   			<button class="btn btn-success">
	   			Contestar
	   		</button>
   		</div>
   	</div>
</div>
</form>
<div style="height: 60px;"></div>
@endsection


