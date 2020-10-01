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
		<form name='forma' action="{{ url('/alcopar/classat/guardar/')}}" id='formID' method='POST'>
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
						
					
					
					
					
						<select name='tipo_material' disabled id='tipo_material' onChange='return validateR(this.value);' class='validate[required] code_generator form-control'>
							
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
						
					
						<select name='categoria' disabled id='categoria'  class='validate[required] code_generator form-control'>
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
					
					
						<select name="familia" disabled id="familia" class='validate[required] code_generator form-control'>
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
				<div class="col-md-6 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Marca:</label>       
						
					
						<select name='marca1' id='marca1' disabled  class='validate[required] code_generator form-control'>
						
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
				<div class="col-md-6 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Tipo Categor&iacute;a Extra:</label>    
						
						
					
						<select name="categoria_extra" disabled id="categoria_extra" class='validate[required] code_generator form-control'>
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
				<div class="col-md-12 col-12">
					<fieldset class="form-group">	
					<label for="basicInput">Comentario Rev Ingenieria:</label>    			
						<textarea rows="4" cols="35" class="form-control" readonly ><?php echo $row['comentario_reving'];?></textarea>
					</fieldset>
				</div>
						
				<div class="col-md-12 col-12">					
					<fieldset class="form-group">
						<label for="basicInput">Clasificación del SAT:</label> 																
						<input name="clasif" type="text" id="clasif" size="40" onchange = 'revisa()' required="" data-validation-required-message="This First Name field is required" class="form-control">
					</fieldset>
				</div>
					
		
				
				<div class="col-md-12 col-12">
					<fieldset class="form-group">
						<label for="basicInput">Comentarios:</label>        			
						<textarea name="comentario" class="form-control" id="comentario" rows="5" style="text-transform:uppercase"></textarea>  
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
							<a class="btn btn-primary"  value="" href="{{ url('/alcopar/classat')}}">Regresar al Listado</a>
							</center>
						</fieldset>
				</div>		
			</div>			
		</form>
	</div>
</div>


<script src="{{ asset('assets') }}/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
<script src="{{ asset('assets') }}/app-assets/js/scripts/forms/validation/form-validation.js"></script>
<script>
    function revisa(texto) {
        clasif = document.getElementById('clasif').value;
        window.open("{{ url('/alcopar/classat/clasificacionconsulta/')}}?clasif=" + clasif);
        
    }                
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
