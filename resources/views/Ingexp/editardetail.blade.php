@extends("layouts.app")
@section("content")

<?php 
$data = $get_records[0];
$data2 = $get_records_dt;
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
		<form  action="{{ url('/ingexp/cargarpostedit/')}}" method="post" enctype="multipart/form-data" name="forma" id="formID">
			@csrf
			<div class="row">
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Titulo:</label>
						<input name="titulo" class="form-control " required="true" type="text" id="titulo" value="<?=$data['titulo']?>" style="height: 60px; font-size:30px;">
						<input name="id" value="<?=$id?>" hidden>
					</fieldset>
				</div>
				<div class="col-md-12 col-12">
					<?php 
						if($data['archivo_carga'] == '' || $data['archivo_carga'] == Null){ ?>
									<div class="alert alert-warning alert-dismissible mb-2" role="alert">										
										<div class="d-flex align-items-center">
											<i class="bx bx-error-circle"></i>
											<span>
												Atención! Archivo no presente en la base de datos.
											</span>
										</div>
									</div>
					<?php }else{ ?>
						<a target="_blank" href="{{ url('/ingexp/visor/') }}/<?=$id?>">
									<div class="alert alert-info alert-dismissible mb-2" role="alert">										
										<div class="d-flex align-items-center">
											<i class="bx bx-import"></i>
											<span>
												Ver archivo.
											</span>
										</div>
									</div>
						</a>
					<?php } ?>
				</div>				
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">ARCHIVO DE CARGA:</label>						
						<input name="uploadedfile" class="form-control" id="uploadedfile" type="file" >
						
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">LINEA DE PRODUCTO:</label>
						<select class="form-control" name="linea" id="linea" required="true">
							<option value="">Seleccionar Linea</option>
							<?php 
								foreach($data2['linea'] as $v){
							?>
							<option <?php if($data['linea'] == $v['idlinea']){ echo 'selected=""'; } ?>  value="<?=$v['idlinea']?>"><?=$v['linea']?></option>							
							<?php
								}
							?>
						</select>
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">CATEGORIA:</label>
						<input name="categoria" class="form-control" type="text" id="categoria" value="<?=$data['categoria']?>"  required="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">PALARA CLAVE:</label>
						<input name="palabra" class="form-control" type="text" id="titulo" value="<?=$data['palabra']?>"  required="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">MODELO:</label>
						<input name="modelo" class="form-control" type="text" id="titulo" value="<?=$data['modelo']?>"  required="true">
					</fieldset>
				</div>
				<div class="col-md-6 col-5">
					<fieldset class="form-group">
						<label for="basicInput">TIPO ARCHIVO:</label>
						<select class="form-control" name="tipo" id="tipo"  required="true">
							<option value="">Seleccionar Tipo</option>
							<?php 
								foreach($data2['tipo'] as $v){
							?>
							<option <?php if($data['tipo'] == $v['idtipo']){ echo 'selected=""'; } ?>  value="<?=$v['idtipo']?>"><?=$v['tipo']?></option>							
							<?php
								}
							?>
						</select>
					</fieldset>
				</div>


				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">COMENTARIOS:</label>
						<textarea name="comentarios" class="form-control" rows="5"  required="true"><?=$data['comentarios']?></textarea>
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