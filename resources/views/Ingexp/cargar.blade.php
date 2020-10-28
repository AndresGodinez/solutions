@extends("layouts.app")
@section("content")

<?php 
$data = $get_records;

// echo "<pre>";
// print_r($data);
?>

<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>CARGA DE INFORMACION</strong></h2>
		</div>
	</div>
</section>
<div style="height: 30px;"></div>

<div class="card">
	<div class="card-body">
		<form  action="{{ url('/ingexp/cargarpost/')}}" method="post" enctype="multipart/form-data" name="forma" id="formID">
			@csrf
			<div class="row">
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Titulo:</label>
						<input name="titulo" class="form-control " require="true" type="text" id="titulo" value="" style="height: 60px; font-size:30px;">
					</fieldset>
				</div>

				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">ARCHIVO DE CARGA:</label>
						
						<input name="uploadedfile" class="form-control" id="uploadedfile" type="file"  required="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">LINEA DE PRODUCTO:</label>
						<select class="form-control" name="linea" id="linea" require="true">
							<option value="">Seleccionar Linea</option>
							<?php 
								foreach($data['linea'] as $v){
							?>
							<option value="<?=$v['idlinea']?>"><?=$v['linea']?></option>							
							<?php
								}
							?>
						</select>
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">CATEGORIA:</label>
						<input name="categoria" class="form-control" type="text" id="categoria" value=""  require="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">PALARA CLAVE:</label>
						<input name="palabra" class="form-control" type="text" id="titulo" value=""  require="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">MODELO:</label>
						<input name="modelo" class="form-control" type="text" id="titulo" value=""  require="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">TIPO ARCHIVO:</label>
						<select class="form-control" name="tipo" id="tipo"  require="true">
							<option value="">Seleccionar Tipo</option>
							<?php 
								foreach($data['tipo'] as $v){
							?>
							<option value="<?=$v['idtipo']?>"><?=$v['tipo']?></option>							
							<?php
								}
							?>
						</select>
					</fieldset>
				</div>


				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">COMENTARIOS:</label>
						<textarea name="comentarios" class="form-control" rows="5"  require="true"></textarea>
					</fieldset>
				</div>

				<div class="col-md-4 col-4"></div>
				<div class="col-md-4 col-4">
					<button class="btn btn-success" style="width: 100%;">Enviar</button>
				</div>
				<div class="col-md-4 col-4"></div>
			</div>
		</form>
	</div>
</div>




<script>
	$(document).ready(function() {
		$('#formID').submit(function(e) {
			file = $('#uploadedfile')[0].files[0];
			ext = file.name.split('.').pop().toLowerCase();

			if ($('#tipo').val() == 1) {
				if (['mp4', 'mov', 'avi'].indexOf(ext) == -1) {
					alert('El formato de archivo de video no es compatible, favor de seleccionar un MP4, AVI o MOV');
					return false;
				} else if (['mov', 'avi'].indexOf(ext) > -1) {
					if (!confirm("El formato de archivo que selecionaste requiere un proceso de conversión que será realizado en aproximadamente 15 minutos después del envío. El tiempo para que el archivo se encuentre listo para su reproducción depende del tamaño del video. ¿Deseas continuar?")) {
						return false;
					}
				}
			} else {
				if (['mp4', 'mov', 'avi'].indexOf(ext) > -1) {
					alert('El TIPO ARCHIVO seleccionado no concuerda con el archivo que estás intentando cargar, favor de corregir');
					return false;
				}
			}

			$("#enviar").val("Enviando...").attr('disabled', 'true');

		});

	});
</script>

<script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script>
		<?php 
		if(@$_GET['success'] == 1){
			?>
			Swal.fire({
                                    type: "success",
                                    title: '¡Ejecutado con éxito!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-success',
                                });
			<?php
		}
		if(@$_GET['error'] == 1){
			?>
			Swal.fire({
                                    type: "error",
                                    title: '¡Error en la carga!',
                                    text: '',
                                    confirmButtonClass: 'btn btn-danger',
                                });
			<?php
		}
		?>
		
</script>
@endsection