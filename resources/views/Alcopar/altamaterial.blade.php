@extends("layouts.app")

@section("content")
<?php

$tipomaterial = $get_records['tipomaterial'];
$categoria  = $get_records['categoria'];
$marca1   = $get_records['marca'];

?>




	<h3>Solicitud de Alta de Partes </h3>

	<h4> Datos del Material </h4>
	<div class="card">
		<div class="card-body">
			<form id="formID" name="forma" method="post" action="{{ url('/alcopar/factible/altamaterialupdate/')}}">
			@csrf

				<div class="row">
					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								N&uacute;mero Parte:</label>

							<input type="text" maxlength="20" id="parte" name="parte" class="form-control" style="text-transform:uppercase"  pattern=".{3,}"   required title="Mínimo de 3 caracteres autorizados" />
						</fieldset>
					</div>


					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								Descripci&oacute;n:</label>
							<input type="text" id="descripcion" name="descripcion" class="form-control" style="text-transform:uppercase" pattern=".{5,}"   required title="Mínimo de 5 caracteres autorizados">
						</fieldset>
					</div>


					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								Modelo:</label>
							<input type="text" maxlength="15" id="modelo" name="modelo" style="text-transform:uppercase" class="form-control">
						</fieldset>
					</div>

					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								Taller:</label>
							<input type="text" maxlength="15" id="taller" name="taller" style="text-transform:uppercase" class="form-control">
						</fieldset>
					</div>

					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								Dispatch:</label>
							<input type="text" maxlength="13" id="dispatch" name="dispatch" style="text-transform:uppercase" class="form-control">
						</fieldset>
					</div>

					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">
								Motivo:</label>
							<input type="text" id="motivo" name="motivo" size="40" style="text-transform:uppercase" class="form-control" style="text-transform:uppercase" pattern=".{5,}" required title="mMínimo de 5 caracteres autorizados">
						</fieldset>
					</div>




					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">&iquest;De d&oacute;nde obtuviste ese n&uacute;mero?</label>
							<select name='donde' id='donde' onChange='return validateR(this.value);' class='form-control' required>
								<option value=''>Seleccionar Linea</option>
								<option value='0'>Del Explosionado</option>
								<option value='1'>Solicitud de Ingenier&iacute;a (Ing me lo di&oacute;)</option>
								<option value='2'>Sustitutos de Centro de Soluciones</option>
								<option value='3'>Zpricep / Sustituto en SAP</option>
								<option value='4'>Part Smart</option>
								<option value='5'>Otros</option>
							</select>
						</fieldset>
					</div>


					<div class="col-md-4 col-12" id="otros" style="display:none">
						<fieldset class="form-group">
							<label for="basicInput">Familia:</label>
							<textarea name="otro" id="otro" rows="5" style="text-transform:uppercase" class="form-control"></textarea>
						</fieldset>
					</div>






					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">Tipo de Material:</label>
							<select name='tipo_material' id='tipo_material' onChange='return validateR(this.value);' class='form-control' required>
								<?php
								echo "<option   value=''>Seleccionar Tipo de Material</option>";
								foreach ($tipomaterial as $rowp) {
									echo "<option   value=" . $rowp['id_tipo_material'] . ">" . $rowp['tipo_material'] . "</option>";
								} ?>
							</select>
						</fieldset>
					</div>




					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">Categor&iacute;a:</label>
							<select name='categoria' id='categoria' class='validate[required] form-control' required>
								<?php
								echo "<option   value=''>Seleccionar Categoria</option>";
								foreach ($categoria as $rowp) {
									echo "<option   value=" . $rowp['id_categoria'] . ">" . $rowp['categoria'] . "</option>";
								} ?>
							</select>
						</fieldset>
					</div>



					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">Familia:</label>
							<select name="familia" id="familia" class="form-control">
								<option value=''>Seleccionar Familia</option>
							</select>
						</fieldset>
					</div>

					<div class="col-md-4 col-12 otros1" id="" style="display:none">
						<fieldset class="form-group">
							<label for="basicInput">Marca:</label>
							<select name='marca1' id='marca1' class="form-control">
								<?php
								echo "<option   value='0'>Seleccionar Tipo de Marca</option>";
								foreach ($marca1 as $rowp) {
									echo "<option   value=" . $rowp['id'] . ">" . $rowp['marca'] . "</option>";
								} ?>
							</select>
						</fieldset>
					</div>





					<div class="col-md-4 col-12 otros1" id="" style="display:none">
						<fieldset class="form-group">
							<label for="basicInput">Tipo Categor&iacute;a Extra:</label>
							<select name="categoria_extra" id="categoria_extra" class="form-control">
								<option value='0'>Seleccionar Categor&iacute;a Extra</option>
							</select>
						</fieldset>
					</div>





					<div class="col-md-4 col-12" id="otros2" style="display:none">
						<fieldset class="form-group">
							<label for="basicInput">Marca:</label>
							<select name='marca2' id='marca2' class="form-control" onChange='return validateR(this.value);'>
								<?php
								echo "<option   value='0'>Seleccionar Tipo de Marca</option>";
								foreach ($marca1 as $rowp) {
									echo "<option   value=" . $rowp['id'] . ">" . $rowp['marca'] . "</option>";
								}
								?>
							</select>
						</fieldset>
					</div>



					<div class="col-md-12 col-12">
						<fieldset class="form-group">
							<input type="submit" id="enviar" name="enviar" value="Solicitar Alta" class="btn btn-primary" style="width: 100%;">							
						</fieldset>
					</div>
				</div>
			</form>
	
		</div>
	</div>
	<script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
	<script language="javascript">
		function validateR() {
			var donde = document.getElementById("donde").value;
			var tipo_material = document.getElementById("tipo_material").value;
			if (donde == '5') {
				document.getElementById('otros').style.display = 'block';
			} else {
				document.getElementById('otros').style.display = 'none';
			}
			if (tipo_material == '1' || tipo_material == '3') {
				$('.otros1').show();
			} else {
				$('.otros1').hide();
			}
			if (tipo_material == '4') {
				document.getElementById('otros2').style.display = 'block';
			} else {
				document.getElementById('otros2').style.display = 'none';

			}

		}
		$(document).ready(function() {
			$("#categoria").change(function() {
				$("#categoria option:selected").each(function() {
					id_categoria = $(this).val();
					$.get("{{ url('/alcopar/reving/jquery/getFamiliaJquery/')}}/" + id_categoria, function(data) {
						$("#familia").html(data);
					});
				});
			})
		});

		$(document).ready(function() {
			$("#tipo_material").change(function() {
				$("#tipo_material option:selected").each(function() {
					id_tipo_material = $(this).val();
					$.get("{{ url('/alcopar/reving/jquery/getCategoriaExtraJquery/')}}/" + id_tipo_material, function(data) {
						$("#categoria_extra").html(data);
					});
				});
			})
		});

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
		?>
	</script>
	@endsection