@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>NOM Comerciales</strong></h2>
			<h5>Impresión de etiquetas de Números de parte con normativas comerciales (detalle)</h5>
		</div>	
	</div>
</div>
<hr>
<div class="container">
	<form class="" action="https://soluciones.refaccionoriginal.com/labels/etiqueta-laravel.php" method="POST">
		
		<div class="row">	
			<div class="col-sm-3">	
				<div class="form-group">
				    <input type="hidden" class="form-control" id="np" name="np" value="{{ $get_records[0]->np }}" />
				</div>
			</div>
		</div>
		<div class="row" style="background: white; border: 2px solid #000000; border-radius: 4px; padding: 15px;">
			<div class="col-sm-4">
				<strong>Número de parte:</strong>
				<strong style="font-size: 18px; color: red;">{{ $get_records[0]->np }}</strong>
				<br />
				<strong>Refacción:</strong>
				{{ $get_records[0]->refaccion }}
				<br />
				<strong>Producto:</strong>
				{{ $get_records[0]->producto }}
				<input type="hidden" class="form-control" id="producto" name="producto" value="{{ $get_records[0]->producto }}" />
				<br />
				<strong>Marca:</strong>
				{{ $get_records[0]->marca }}
				<input type="hidden" class="form-control" id="marca" name="marca" value="{{ $get_records[0]->marca }}" />
			</div>
			<div class="col-sm-4">
				<strong>Importador:</strong>
				{{ $get_records[0]->importador }}
				<input type="hidden" class="form-control" id="importador" name="importador" value="{{ $get_records[0]->importador }}" />
				<br />
				<strong>Hecho en:</strong>
				{{ $get_records[0]->hecho_en }}
				<input type="hidden" class="form-control" id="hecho_en" name="hecho_en" value="{{ $get_records[0]->hecho_en }}" />
				<br />
				<strong>Supplier:</strong>
				{{ $get_records[0]->supplier }}
				<br />
				<strong>Substitute:</strong>
				{{ $get_records[0]->substitute }}
			</div>
			<div class="col-sm-4">
				<strong>Class:</strong>
				{{ $get_records[0]->class }}
				<br />
				<strong>ABC final:</strong>
				{{ $get_records[0]->abc }}
				<br />
				<strong>Fracción Arancelaria:</strong>
				{{ $get_records[0]->fracc_arancelaria }}
				<br />
				<strong>NOMs aplicables :</strong>
				{{ $get_records[0]->nom_aplicable }}
			</div>
		</div>
		<div class="row" style="margin-top: 15px;">
			<div class="col-sm-3">
				<label><strong>Cantidad de pzas:</strong></label>
				<input type="text" name="piezas" id="piezas" value="1" class="form-control" />
				<label><strong>Cantidad de etiquetas:</strong></label>
				<input type="text" name="cantidad" id="cantidad" value="1" class="form-control" />
			</div>
		</div>
		<div class="row" style="margin-top: 30px;">
			<div class="col-sm-12">
				<button type="submit" class="btn btn-success">
					Imprimir etiqueta
				</button>
			</div>
		</div>
	</form>
</div>
<div style="height: 60px;"></div>
@endsection


