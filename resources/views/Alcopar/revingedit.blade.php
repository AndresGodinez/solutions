@extends("layouts.app")
@section("content")
<?php 

$row = $get_records['row'][0];
$row2 = $get_records['row2'];


//$row2 = 3;
#$row3 = $get_records['row2'][0];

$data = $get_records;

?>

<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/plugins/forms/validation/form-validation.css">
<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Revisión de Número de Parte</strong></h2>			
		</div>
	</div>
</section>
<div style="height: 30px;"></div>
	
<div class="card">		
	<div class="card-body">
		<form name='forma' action="{{ url('/alcopar/reving/procesa/')}}" id='formID' method='POST'>
		@csrf
			<div class="row">
				<div class="col-md-4 col-12">
						<fieldset class="form-group">
							<label for="basicInput"> No Parte:</label>
							<input name="parte" class="form-control" type="text" readonly id="parte" size="40" value="<?php echo($row['parte']);?>">
						</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput"> Modelo:</label>           
						<input name="modelo" class="form-control" type="text" readonly id="modelo" size="40" value="<?php echo($row['modelo']);?>">
					</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput"> Descripción:</label>           			
					<input name="descripcion" class="form-control" type="text"  id="descripcion" size="40" value="<?php echo($row['descripcion']);?>">
					</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput"> Taller:</label>           
					
					<input name="taller" type="text" class="form-control" readonly id="descripcion" size="40" value="<?php echo($row['taller']);?>">
					</fieldset>
				</div>

				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput"> Dispatch:</label>           
					
						<input name="Dispatch" type="text" class="form-control" readonly id="Dispatch" size="40" value="<?php echo($row['dispatch']);?>">
					</fieldset>
				</div>

				<?php 
				if($row['status']=='RECHAZADA')
				{
				?>
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput"> Motivo Rechazo Materiales:</label>           			
						<input name="motivo" type="text" readonly id="motivo" size="40" value="<?php echo($row['comentario']);?>" class="form-control">
					</fieldset>
				</div>
						
				
				<?php
				}
				?>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">&iquest;De d&oacute;nde se obtuvo el n&uacute;mero?:</label>           			
						<input name="donde" type="text" readonly id="donde" size="40" value="<?php echo($row['pregunta']);?>" class="form-control">
					</fieldset>
				</div>
				
				
				
				<?php
				if($row['pregunta']=='Otros')
				{
				?>
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<input name="otro" class="form-control" type="text" readonly id="otro" size="40" value="<?php echo($row['otros']);?>">
					</fieldset>
				</div>                
				<?php
				}
				?>
				<div class="col-md-6 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Usuario:</label>           			
						<input name='username' type='text' readonly id='username' size="40" value='<?php echo $get_records['nombre_usuario'];?>' class="form-control">
					</fieldset>
				</div>

				<div class="col-md-6 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Motivo:</label>           			
						<input name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo $row['motivo'];?>' class="form-control">
					</fieldset>
				</div>
					
				
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Tipo de Material:</label>           			
						
					
					
					
					
						<select name='tipo_material' id='tipo_material' required="" data-validation-required-message="This First Name field is required" onChange='return validateR(this.value);' class='validate[required] code_generator form-control'>
							
							<option value="">Seleccionar Tipo de Material...</option>
							<?php
							$get_tipo_material = "";
							$get_selected_tipo_material = "";
							foreach($data['tipo'] as $k => $rowp)
							{
							$selected = ($row['alcopar_tipo_material'] == $rowp['id_tipo_material'] ? 'selected' : '');
							if($get_tipo_material == "")
							{
								$get_tipo_material = ($selected == "" ? "" : $rowp['id_tipo_material']);
								$get_selected_tipo_material = $rowp['id_tipo_material'];
							}
							?>
							<option <?php echo $selected;?>  value="<?php echo $rowp['id_tipo_material'];?>">
								<?php  echo $rowp['tipo_material'];?>
							</option>
							<?php
							}
							?>
						</select>
					</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Categor&iacute;a:</label>       
						
					
						<select name='categoria' id='categoria' required="" data-validation-required-message="This First Name field is required"  class='validate[required] code_generator form-control'>
							<?php 
							
							?>
							<option value=''>Seleccionar Categoria...</option>
							<?php
							$get_categoria = "";
							$get_categoria_selected = "";
							foreach($data['categoria'] as $k => $rowp)
							{
								$selected = ($row['alcopar_categoria'] == $rowp['id_categoria'] ? 'selected' : '');
								if($get_categoria == "")
								{
									$get_categoria = ($selected == "" ? "" : $rowp['id_categoria']);
									$get_categoria_selected = $rowp['id_categoria'];
								}

								if($get_selected_tipo_material == '2')
								{   
									if($rowp['id'] >= 6)
									{
									?>
									<option <?php echo $selected;?>  value="<?php  echo $rowp['id_categoria'];?>">
										<?php  echo $rowp['categoria'];?>
									</option>
									<?php    
									}
								}
								else
								{
									if($rowp['id'] < 6)
									{
									?>
									<option <?php echo $selected;?>  value="<?php  echo $rowp['id_categoria'];?>">
										<?php  echo $rowp['categoria'];?>
									</option>
									<?php    
									}  
								} 
							}
							?>
						</select>
						</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Familia:</label>       
					
					
						<select name="familia" id="familia" required="" data-validation-required-message="This First Name field is required" class='validate[required] code_generator form-control'>
						<option value=''>
							<?php echo (!isset($row['alcopar_familia']) ? 'categoria de familia no ingresada' : 'Seleccionar Familia...');?>
						</option>
						<?php
						$get_familia = "";
						if(isset($row['alcopar_categoria']))
						{
							
							
							foreach($data['familia'] as $k => $rowp)
							{
							$selected = ($row['alcopar_familia'] == $rowp['id_familia'] ? 'selected' : '');
								if($get_familia == "")
								{
									$get_familia = ($selected == "" ? "" : $rowp['id_familia']);
								}
							?>
							<option <?php echo $selected;?>  value="<?php  echo $rowp['id_familia'];?>">
								<?php  echo $rowp['familia'];?>
							</option>
							<?php
							}
						}
						?>
						</select>
						</fieldset>
				</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Marca:</label>       
						
					
						<select name='marca1' id='marca1' required="" data-validation-required-message="This First Name field is required" class='validate[required] code_generator form-control'>
						
						<option value=''>Seleccionar Tipo de Marca...</option>
						<?php
						$get_marca = "";
						foreach($data['marca'] as $k => $rowp)
						{
						$selected = ($row['alcopar_marca'] == $rowp['id'] ? 'selected' : '');
						if($get_marca == "")
						{
							$get_marca = ($selected == "" ? "" : $rowp['id']);
						}
						?>
						<option <?php echo $selected;?>  value="<?php echo $rowp['id_marca'];?>">
							<?php echo $rowp['marca'];?>
						</option>
						<?php
						}
						?>
						</select>
						</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Tipo Categor&iacute;a Extra:</label>    
						
						
					
						<select name="categoria_extra" id="categoria_extra" required="" data-validation-required-message="This First Name field is required" class='validate[required] code_generator form-control'>
							<option value='0'>
								<?php //echo (!isset($row['id_tipo_material']) ? 'No tiene tipo de Material' : 'Seleccionar Categor&iacute;a Extra...');?>
								Selecciónar Categoría extra...
							</option>
							<?php 
							
						
							$get_tipo_cat_ext = "";
							foreach($data['extra'] as $k => $rowp)
							{
							$selected = ($row['id_tipo_material'] == $rowp['id_tipo_material'] ? 'selected' : '');
							if($get_tipo_cat_ext == "")
							{
								$get_tipo_cat_ext = ($selected == "" ? "" : $rowp['id']);
							}
							?>
							<option <?php echo $selected;?>  value="<?php echo $rowp['id'];?>">
								<?php echo $rowp['tipo_extra'];?>
							</option>
							<?php
							}
							?>
						</select>
						</div>
				<div class="col-md-4 col-12">
					<fieldset class="form-group">				
						<button type="button" class="see-btn-cde btn btn-primary" style=" width:100%; margin-top:20px;">
							Ver Código
						</button>
					</fieldset>
				</div>
						
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Módulo a Reasignar
					</label> 
					
					
						
						<select name="asigna" class="form-control">
							<option value="">Escoge un m&oacute;dulo </option>
							<option value="revmat">Rev Materiales</option>
							<option value="precio">Alta Precio</option>
							<option value="oow">Alta OOW</option>
						</select>
						</fieldset>
				</div>
					
				
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Comentarios:</label>        			
						<textarea name="comentario" class="form-control" id="comentario" rows="5"   style="text-transform:uppercase"></textarea>  
						
					</fieldset>
				</div>
					
				<?php
				if($row2 >= 1)
				{
				?>
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Historial de Asignaci&oacute;n:</label>                            
						<a href="historial.php?id=<?php echo $id;?>" rel="shadowbox;height=400;width=600">
							HISTORIAL
						</a>
					</fieldset>
				</div>
					
				<?php
				}
				?>
			
				<div class="col-md-12 col-12 mt-2">
						<fieldset class="form-group">
							<center>
							<input class="btn btn-primary" type="submit" id="grabar"  name="grabar" value="Autorizar" onclick="return confirm('Estas seguro de que deseas autorizar la solicitud?')" />
							<input class="btn btn-primary"  type="submit" id="cancelar"  name="cancelar" value="Cancelar" onclick="return confirm('Estas seguro de que deseas cancelar la solicitud?')" />
							<input class="btn btn-primary"  type="submit" id="rechazar"  name="rechazar" value="Rechazar" onclick="return confirm('Estas seguro de que deseas rechazar la solicitud?')" />
							<input class="btn btn-primary"  type="submit" id="reasignar"  name="reasignar" value="Reasignar" onclick="return confirm('Estas seguro de que deseas reasignar la solicitud?')" />
							<a class="btn btn-primary"  value="" href="{{ url('/alcopar/reving')}}">Regresar al Listado</a>
							</center>
						</fieldset>
				</div>		
			</div>			
		</form>
	</div>
</div>

<!-- <div id="myCeroModal">
    <div style="text-align: right;">
        <a href="#" class="lnk-cerrar">Cerrar x</a>
    </div>
    <h2>Código generado:</h2>
    <div id="code"></div>
</div> -->

<div class="modal fade text-left" id="myCeroModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title" id="myModalLabel1">Código generado:</h3>
				<button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
					<i class="bx bx-x"></i>
				</button>
			</div>
			<div class="modal-body" id="code">	
				<p style="font-weight: bold; font-size: 22px;">Aún falta que selecciones más opciones.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light-secondary" data-dismiss="modal">
					<i class="bx bx-x d-block d-sm-none"></i>
					<span class="d-none d-sm-block">Cerrar</span>
				</button>				
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('assets') }}/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="{{ asset('assets') }}/app-assets/js/scripts/forms/validation/form-validation.js"></script>
<script>
// jQuery(document).ready(function(){
// // binds form submission and fields to the validation engine
// jQuery("#formID").validationEngine();
// }); 
</script>
<script type="text/javascript">
    $(document).ready(function(){
		$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();

        var code = "";
        var code_material   = "<?php echo ($get_tipo_material   == '' ? '' : $get_tipo_material);?>";
        var code_categoria  = "<?php echo ($get_categoria       == '' ? '' : $get_categoria);?>";
        var code_familia    = "<?php echo ($get_familia         == '' ? '' : $get_familia);?>";
        var code_marca      = "<?php echo ($get_marca           == '' ? '' : $get_marca);?>";
            if(code_marca < 10)
            {
                code_marca = "0" + code_marca;   
            }
        var code_cat_ext    = "<?php echo ($get_tipo_cat_ext    == '' ? '' : $get_tipo_cat_ext);?>";

        function code_generator(){
				var dir = $(this).attr('id');
				
				if(dir == "tipo_material")
				{
					code_material = $(this).val();
				}
				else if(dir == "categoria")
				{
					code_categoria = $(this).val();
				}
				else if(dir == "familia")
				{
					code_familia = $(this).val();
				}
				else if(dir == "marca1")
				{
					code_marca = $(this).val();
				}
				else if(dir == "categoria_extra")
				{
					code_cat_ext = $(this).val();
				}
				
				code = code_material + code_categoria + code_familia + code_marca + code_cat_ext;
				
				if(code_material == "" || code_categoria == "" || code_familia == "" || code_marca == "" || code_cat_ext == "")
				{
					data =  '<p style="font-weight: bold; font-size: 22px;">' +
								'Aún falta que selecciones más opciones.' +
							'</p>';
				}
				else
				{
					data =  '<p style="font-weight: bold; font-size: 22px;">' +
								+ code +
							'</p>';
				}
				
				$("#code").html(data);
		}

        $("#tipo_material").change(function () {
            $("#tipo_material option:selected").each(function () {
                id_tipo_material = $(this).val();
				
                $.get("{{ url('/alcopar/reving/jquery/getCategoriaJquery/')}}/"+id_tipo_material, function(data){
                    $("#categoria").html(data);
                });            
            });
        });

        $("#categoria").change(function () {
            $("#categoria option:selected").each(function () {
                id_categoria = $(this).val();
                $.get("{{ url('/alcopar/reving/jquery/getFamiliaJquery/')}}/"+id_categoria, function(data){
                    $("#familia").html(data);
                });            
            });
        });

        $("#tipo_material").change(function () {
            $("#tipo_material option:selected").each(function () {
                id_tipo_material = $(this).val();
                $.get("{{ url('/alcopar/reving/jquery/getCategoriaExtraJquery/')}}/"+id_tipo_material, function(data){
                    $("#categoria_extra").html(data);
                });            
            });
        });


        $(".see-btn-cde").click(function(){		
			code_generator();	
            $('.mask').show();
            $('#myCeroModal').modal('show');
        });

        $(".lnk-cerrar").click(function(e){
            e.preventDefault();
            $('.mask').hide();
            $('#myCeroModal').modal('hide');
        });
    });
</script>
@endsection
