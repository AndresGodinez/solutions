@extends("layouts.app")
@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<h2>Consulta de información <small>[Detalle]</small></h2>
		</div>	
		<div class="col-sm-4 text-right">
			<a class="btn btn-primary" href="{{ url('solicitudes-aduanales/') }}"> <- Regresar</a>
		</div>
	</div>
</div>
<hr>

@if(count($data) >= 1)
	@foreach($data as $data)
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>
					<strong>NP: {{ $data->np }}</strong>
				</h2>
			</div>
		</div>
		<div class="row">
	   		<div class="table-responsive col-sm-12">
	            <table class="table table-hover table-bordered"> 
	                <thead>
	                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF !important;">
	                        <th style="color: #FFFFFF;">Descripción SAP</th>
	                        <th style="color: #FFFFFF;">Categoría</th>
	                        <th style="color: #FFFFFF;">Nombre del producto / Nombre Comercial</th>
	                        <th style="color: #FFFFFF;">¿Es componente  y / o parte de qué máquina?</th>
	                        <th style="color: #FFFFFF;">¿Cómo funciona?/¿Cómo o donde se instala?</th>
	                        <th style="color: #FFFFFF;">¿Para qué se utiliza?</th>
	                    </tr>
	                </thead>
		            <tbody>
		            	<tr>
		            		<td>
		            			{{ $data->sap_description }}
		            		</td>
		            		<td>
		            			{{ $data->category }}
		            		</td>
		            		<td>
		            			{{ $data->product_name }}
		            		</td>
		            		<td>
		            			{{ $data->type_component }}
		            		</td>
		            		<td>
		            			{{ $data->type_functional }}
		            		</td>
		            		<td>
		            			{{ $data->type_use }}
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
		    </div>
		    <div class="table-responsive col-sm-12">
		        <table class="table table-hover table-bordered"> 
	                <thead>
	                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF !important;">
	                    	<th style="color: #FFFFFF;">Materia Constitutiva / Tipo de material</th>
	                        <th style="color: #FFFFFF;">% del material constitutiva si es textil</th>
	                        <th style="color: #FFFFFF;">Medidas (Largo, ancho, diámetro, etc)</th>
	                        <th style="color: #FFFFFF;">Tipo de Motor (Monofásico, bifásico, trifásico, sincrono, asincrono, C.A, C.C)</th>
	                        <th style="color: #FFFFFF;">Especificaciones Eléctricas (Volt, Amp Ohms, Watts, etc)</th>
	                        <th style="color: #FFFFFF;">Codigo de barras</th>
	                        <th style="color: #FFFFFF;">Codigo SAT</th>
	                    </tr>
	                </thead>
		            <tbody>
		            	<tr>
		            		<td>
		            			{{ $data->type_np }}
		            		</td>
		            		<td>
		            			{{ $data->textil }}
		            		</td>
		            		<td>
		            			{{ $data->size }}
		            		</td>
		            		<td>
		            			{{ $data->motor }}
		            		</td>
		            		<td>
		            			{{ $data->electric }}
		            		</td>
		            		<td>
		            			{{ $data->barras_code }}
		            		</td>
		            		<td>
		            			{{ $data->sat_code }}
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
		    </div>
		    <div class="table-responsive col-sm-12">
		        <table class="table table-hover table-bordered"> 
	                <thead>
	                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF !important;">
	                    	<th style="color: #FFFFFF;">¿Este producto es un repuesto?</th>
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
		            			{{ $data->repuesto }}
		            		</td>
		            		<td>
		            			{{ $data->brand }}
		            		</td>
		            		<td>
		            			{{ $data->n_pzas }}
		            		</td>
		            		<td>
		            			{{ $data->battery }}
		            		</td>
		            		<td>
		            			{{ $data->Battery_include }}
		            		</td>
		            		<td>
		            			{{ $data->battery_type }}
		            		</td>
		            		<td>
		            			{{ $data->battery_n }}
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
		    </div>
		    <div class="table-responsive col-sm-12">
		        <table class="table table-hover table-bordered"> 
	                <thead>
	                    <tr class="active" style="background: #3490dc; border: 1px solid #3490dc; color: #FFFFFF !important;">
	                    	<th style="color: #FFFFFF;">Watt horas por batería</th>
	                        <th style="color: #FFFFFF;">¿Se considera el producto mercancía peligrosa o material peligroso cuyo transporte, almacenamiento y gestión de residuos están regulados?</th>
	                        <th style="color: #FFFFFF;">URL de la ficha de datos de seguridad (FDS)</th>
	                        <th style="color: #FFFFFF;">Dibujo de la pieza</th>
	                    </tr>
	                </thead>
		            <tbody>
		            	<tr>
		            		<td>
		            			{{ $data->watt_x_h }}
		            		</td>
		            		<td>
		            			{{ $data->danger_product }}
		            		</td>
		            		<td>
		            			{{ $data->url_fds }}
		            		</td>
		            		<td>
		            			<a href="{{ url('storage/'.$data->picture) }}" target="_blank">
		            				Ver imagen	
		            			</a>
		            		</td>
		            	</tr>
		            </tbody>
		        </table>
		    </div>
	   	</div>
	</div>
	<div style="height: 30px; margin-top: 40px; margin-bottom: 5px; border-color: #CCCCCC; border-bottom-style: dashed; border-bottom-width: 2px;"></div>
	<div style="height: 10px; margin-top: 5px; margin-bottom: 5px; border-color: #CCCCCC; border-bottom-style: dashed; border-bottom-width: 2px;"></div>
	<div style="height: 10px; margin-top: 5px; margin-bottom: 60px; border-color: #CCCCCC; border-bottom-style: dashed; border-bottom-width: 2px;"></div>
	@endforeach
@else
	<div class="container text-center">
		<div class="row">
			<div class="col-sm-12">
				<h2>Lo sentimos pero no se encontraron resultados en la búsqueda.</h2>
			</div>	
		</div>
	</div>
@endif
@endsection


