@extends("layouts.app")

@section("content")
<?php

$row = $get_records['partes'];
$row1 = $get_records['row1'];
$row2 = $get_records['row2'];

?>


<h3>Ya hay una solicitud con ese n&uacute;mero de parte</h3>


<?php



$id_alcopar = session('id');
$fecha = $row['fecha'];
$parte = $row['parte'];
$descripcion = $row['descripcion'];
$motivo = $row['motivo'];
$username_alcopar = $row['username'];
$status = $row['status'];
$sust = $row['sust'];
$tipo = $row['tipo'];
$comentario = $row['comentario'];



?>

<div class="card">
	<div class="card-body">	
	<form name='forma' action='/alcopar/alta_material_existente2.php' id='formID' method='post'>
<div class="row">
		<div class="col-md-4 col-12">
			<fieldset class="form-group">
				<label for="basicInput">Fecha Creaci&oacute;n:</label>
				<input name="fecha" type="text" readonly id="fecha" size="40" class="form-control" value="<?php echo ($row['fecha']); ?>">
			</fieldset>
		</div>

		<div class="col-md-4 col-12">
			<fieldset class="form-group">
				<label for="basicInput">No Parte :</label>
				<input name="parte" type="text" readonly id="parte" size="40" class="form-control" value="<?php echo ($row['parte']); ?>">
			</fieldset>
		</div>

		<div class="col-md-4 col-12">
			<fieldset class="form-group">
				<label for="basicInput">Descripción :
				</label>
				<input name="descripcion" type="text" readonly id="descripcion" class="form-control" size="40" value="<?php echo ($row['descripcion']); ?>">
			</fieldset>
		</div>

		<div class="col-md-4 col-12">
			<fieldset class="form-group">
				<label for="basicInput">Status :</label>
				<input name='status' type='text' readonly id='status' class="form-control" size="55" value='<?php echo $status; ?>'>
			</fieldset>
		</div>
		<?php if ($comentario <> '') { ?>
			<div class="col-md-4 col-12">
				<fieldset class="form-group">
					<label for="basicInput">Comentario :
					</label>
					<input name='comentario' type='text' readonly id='motivo' class="form-control" size='40' value='<?php echo $comentario; ?>'>
				</fieldset>
			</div>
		<?php } ?>
		<?php if ($sust <> '') { ?>
			<div class="col-md-4 col-12">
				<fieldset class="form-group">
					<label for="basicInput">Sustituto :
					</label>
					<input name='sustituto' type='text' readonly id='sustituto' class="form-control" size='40' value='<?php echo $sust; ?>'>
				</fieldset>
			</div>
			<<div class="col-md-4 col-12">
				<fieldset class="form-group">
					<label for="basicInput">TIPO :
					</label>
					<input name='sustituto' type='text' readonly id='sustituto' class="form-control" size='40' value='<?php echo $tipo; ?>'>
				</fieldset>
				</div>
				<?php if ($row1 >= 1) { ?>
					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">Descripción Sustituto:
							</label>
							<input name="descripcion" type="text" readonly class="form-control" id="descripcion" size="40" value="<?php echo ($row2['descripcion']); ?>">
						</fieldset>
					</div>

					<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput">Status de Sustituto :
							</label>
							<input name='status' type='text' readonly id='status' class="form-control" size="55" value='<?php echo $row2['status']; ?>'>
						</fieldset>
					</div>
							
							<?php if ($row2['comentario'] <> '') { ?>
								<div class="col-md-4 col-12">
									<fieldset class="form-group">
										<label for="basicInput">Comentario de Sustituto :
										</label>
										<input name='comentario' class="form-control" type='text' readonly id='motivo' size='40' value='<?php echo $row2['comentario']; ?>'>
									</fieldset>
								</div>
					<?php }
						}
					} ?>


					<div class="col-md-12 col-12">
						<fieldset class="form-group">
							

								<?php
								$fechasolicitud = $fecha;
								$fecha2 = strtotime('+1 month', strtotime($fechasolicitud));
								$fecha3 = date('Y-m-j', $fecha2);
								$hoy = date('Y-m-d');


								if ($fecha3 < $hoy) {

									if ($comentario == "NO HAY PROVEEDOR DISPONIBLE" or $comentario == "NO TIENE COSTO EN LA PLANTA") {
										echo "<input type='submit' id='grabar'  name='grabar' value='Reenviar Solicitud'> ";
									}
								}
								if ($status == 'COSTO ESTANDAR POR ASIGNAR') {
									echo "<input type='submit' id='agrega' class='btn btn-primary'  name='agrega' value='Agregar correo'> ";
								} elseif ($status == 'EN REVISION DE FACTIBILIDAD DE SURTIMIENTO') {
									echo "<input type='submit' id='agrega' class='btn btn-primary'   name='agrega' value='Agregar correo'> ";
								} elseif ($status == 'EN REVISION DE LA INFORMACION DEL NUM DE PARTE') {
									echo "<input type='submit' id='agrega'  class='btn btn-primary'  name='agrega' value='Agregar correo'> ";
								} elseif ($status == 'PARTE AUTORIZADA POR DARSE DE ALTA EN SAP') {
									echo "<input type='submit' id='agrega'  class='btn btn-primary'  name='agrega' value='Agregar correo'> ";
								}





								?>

						</fieldset>
					</div>

					<div class="col-md-12 col-12">
						<fieldset class="form-group">							
							<a class="btn btn-primary"  value="" href="{{ url('/alcopar/altamaterial')}}">Regresar</a>				
						</fieldset>
					</div>
							</div>
	
				</form>
							</div>
</div>						
	@endsection