@extends("layouts.app")
@section("content")
<section id="basic-datatable">
	
	<div class="row">
		<div class="col-sm-12">
			<h2><i>Consulta de Stock Final <small>[Detalle]</small></i></h2>
			<form style="position: absolute; top:0px; right:15px;">
				<a href="{{ url('stocks/final') }}" class="btn btn-primary">
					< Regresar
				</a>
			</form>
		</div>	
	</div>
</section>
<hr>
<section id="basic-datatable">
	<div class="card">
    <div class="row">
   		<div class="table-responsive col-sm-12">
            <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                        <th>Folio</th>
                        <th>Material</th>
                        <th>Descripción</th>
                        <th>Modelo</th>
                        <th>Status</th>
                        <th>Precio USD</th>
                        <th>SIR</th>
                        <th>FCR</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<strong>
	            				{{ $data[0]['id'] }}
	            			</strong>
	            		</td>
	            		<td>
	            			{{ $data[0]['material'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['descripcion'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['modelo'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['tipo_status'] }}
	            		</td>
	            		<td>
	            			$ {{ $data[0]['precio_usd'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['sir'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['fcr'] }}
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                    	<th>Proyecto</th>
                        <th>Proveedor</th>
                        <th>Ots</th>
                        <th>Obs</th>
                        <th>Cant. pzas por SKU</th>
                        <th>Años de Garantia</th>
                        <th>Tipo funcional</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			{{ $data[0]['proyecto'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['proveedor'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['ots'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['obs'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['cant_pza_sku'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['garantia_years'] }}
	            		</td>
	            		<td>
	            			{{ $data[0]['tipo_uso'] }}
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                    	<th>Tipo de materiales</th>
                        <th>Categoría</th>
                        <th>Familia</th>
                        <th>Marca</th>
                        <th>Commodity</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			<?php echo $data[0]['tipo_mat'];?>
	            		</td>
	            		<td>
	            			<?php echo $data[0]['cat'];?>
	            		</td>
	            		<td>
	            			<?php echo $data[0]['fam'];?>
	            		</td>
	            		<td>
	            			<?php echo $data[0]['marca'];?>
	            		</td>
	            		<td>
	            			<?php echo $data[0]['commodity'];?>
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                        <th>País</th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
		                    <?php
		                    $string = ""; 
		                    if(isset($data[0]['mex1']) && $data[0]['mex1'] > 0)
		                    {
		                    	$string .= "[<strong>México</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['mex_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['mex_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['guat2']) && $data[0]['guat2'] > 0)
		                    {
		                    	$string .= "[<strong>Guatemala</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['guat_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['guat_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['hond3']) && $data[0]['hond3'] > 0)
		                    {
		                    	$string .= "[<strong>Honduras</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['hond_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['hond_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['repd4']) && $data[0]['repd4'] > 0)
		                    {
		                    	$string .= "[<strong>Rep. Dominicana</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['repd_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['repd_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['hait5']) && $data[0]['hait5'] > 0)
		                    {
		                    	$string .= "[<strong>Haiti</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['hait_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['hait_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['arub6']) && $data[0]['arub6'] > 0)
		                    {
		                    	$string .= "[<strong>Aruba</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['arub_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['arub_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['salv7']) && $data[0]['salv7'] > 0)
		                    {
		                    	$string .= "[<strong>El Salvador</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['salv_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['salv_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['nica8']) && $data[0]['nica8'] > 0)
		                    {
		                    	$string .= "[<strong>Nicaragua</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['nica_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['nica_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['cr9']) && $data[0]['cr9'] > 0)
		                    {
		                    	$string .= "[<strong>Costa Rica</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['cr_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['cr_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['pana10']) && $data[0]['pana10'] > 0)
		                    {
		                    	$string .= "[<strong>Panama</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['pana_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['pana_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['angu11']) && $data[0]['angu11'] > 0)
		                    {
		                    	$string .= "[<strong>Anguila</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['angu_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['angu_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['baha12']) && $data[0]['baha12'] > 0)
		                    {
		                    	$string .= "[<strong>Bahamas</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['baha_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['baha_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['beli13']) && $data[0]['beli13'] > 0)
		                    {
		                    	$string .= "[<strong>Belize</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['beli_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['beli_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['berm14']) && $data[0]['berm14'] > 0)
		                    {
		                    	$string .= "[<strong>Bermuda</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['berm_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['berm_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['caym15']) && $data[0]['caym15'] > 0)
		                    {
		                    	$string .= "[<strong>Cayman</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['caym_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['caym_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['guya16']) && $data[0]['guya16'] > 0)
		                    {
		                    	$string .= "[<strong>Guayna</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['guya_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['guya_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['suri17']) && $data[0]['suri17'] > 0)
		                    {
		                    	$string .= "[<strong>Suriname</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['suri_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['suri_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['turk18']) && $data[0]['turk18'] > 0)
		                    {
		                    	$string .= "[<strong>Turks&Caicos</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['turk_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['turk_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['brit19']) && $data[0]['brit19'] > 0)
		                    {
		                    	$string .= "[<strong>British Virgin Islands</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['brit_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['brit_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['maar20']) && $data[0]['maar20'] > 0)
		                    {
		                    	$string .= "[<strong>St. Maarten</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['maar_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['maar_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['saba21']) && $data[0]['saba21'] > 0)
		                    {
		                    	$string .= "[<strong>Saba & St Eustatius</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['saba_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['saba_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['anti22']) && $data[0]['anti22'] > 0)
		                    {
		                    	$string .= "[<strong>Antigua&Barbuda</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['anti_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['anti_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['mons23']) && $data[0]['mons23'] > 0)
		                    {
		                    	$string .= "[<strong>Monserrat</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['mons_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['mons_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['kitt24']) && $data[0]['kitt24'] > 0)
		                    {
		                    	$string .= "[<strong>St Kitts & Nevis</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['kitt_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['kitt_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['bart25']) && $data[0]['bart25'] > 0)
		                    {
		                    	$string .= "[<strong>St Barthelemy</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['bart_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['bart_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['marti26']) && $data[0]['marti26'] > 0)
		                    {
		                    	$string .= "[<strong>St Martin</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['marti_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['marti_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['trin27']) && $data[0]['trin27'] > 0)
		                    {
		                    	$string .= "[<strong>Trinidad&Tobago</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['trin_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['trin_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['jama28']) && $data[0]['jama28'] > 0)
		                    {
		                    	$string .= "[<strong>Jamaica</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['jama_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['jama_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['barb29']) && $data[0]['barb29'] > 0)
		                    {
		                    	$string .= "[<strong>Barbados</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['barb_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['barb_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['bona30']) && $data[0]['bona30'] > 0)
		                    {
		                    	$string .= "[<strong>Bonaire</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['bona_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['bona_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['cura31']) && $data[0]['cura31'] > 0)
		                    {
		                    	$string .= "[<strong>Curacao</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['cura_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['cura_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['col32']) && $data[0]['col32'] > 0)
		                    {
		                    	$string .= "[<strong>Colombia</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['col_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['col_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['ven33']) && $data[0]['ven33'] > 0)
		                    {
		                    	$string .= "[<strong>Venezuela</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['ven_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['ven_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['ecu34']) && $data[0]['ecu34'] > 0)
		                    {
		                    	$string .= "[<strong>Ecuador</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['ecu_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['ecu_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['ptor35']) && $data[0]['ptor35'] > 0)
		                    {
		                    	$string .= "[<strong>Puerto Rico</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['ptor_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['ptor_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['croi36']) && $data[0]['croi36'] > 0)
		                    {
		                    	$string .= "[<strong>St. Croix</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['croi_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['croi_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['thom37']) && $data[0]['thom37'] > 0)
		                    {
		                    	$string .= "[<strong>St. Thomas</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['thom_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['thom_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['jhon38']) && $data[0]['jhon38'] > 0)
		                    {
		                    	$string .= "[<strong>ST. John</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['jhon_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['jhon_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['virg39']) && $data[0]['virg39'] > 0)
		                    {
		                    	$string .= "[<strong>US Virgin Islands</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['virg_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['virg_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['domi40']) && $data[0]['domi40'] > 0)
		                    {
		                    	$string .= "[<strong>Dominica</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['domi_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['domi_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['gren41']) && $data[0]['gren41'] > 0)
		                    {
		                    	$string .= "[<strong>Grenada</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['gren_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['gren_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['luci42']) && $data[0]['luci42'] > 0)
		                    {
		                    	$string .= "[<strong>St Lucia</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['luci_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['luci_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['vinc43']) && $data[0]['vinc43'] > 0)
		                    {
		                    	$string .= "[<strong>St Vincent & Grenadines</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['vinc_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['vinc_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['fren44']) && $data[0]['fren44'] > 0)
		                    {
		                    	$string .= "[<strong>French Guiana</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['fren_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['fren_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['mart45']) && $data[0]['mart45'] > 0)
		                    {
		                    	$string .= "[<strong>Martinique</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['mart_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['mart_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['guad46']) && $data[0]['guad46'] > 0)
		                    {
		                    	$string .= "[<strong>Guadalupe</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['guad_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['guad_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['reun47']) && $data[0]['reun47'] > 0)
		                    {
		                    	$string .= "[<strong>Reunion</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['reun_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['reun_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['newc48']) && $data[0]['newc48'] > 0)
		                    {
		                    	$string .= "[<strong>New caledonia</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['newc_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['newc_fecha_embarque']." <br />";
		                    }
		                    if(isset($data[0]['peru49']) && $data[0]['peru49'] > 0)
		                    {
		                    	$string .= "[<strong>Peru</strong>]";
		                    	$string .= " <strong>vva:</strong>".$data[0]['peru_vva'];
		                    	$string .= " <strong>fecha embarque:</strong> ".$data[0]['peru_fecha_embarque']." <br />";
		                    }

		                    echo $string;
		                    ?>
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                    	<th>Comentarios ING</th>
                        <th>Usuario ING</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
	            <tbody>
	            	<tr>
	            		<td>
	            			{{ $data[0]['comentarios_ing'] }} 
	            		</td>
	            		<td>
	            			{{ $data[0]['user_carga'] }} 
	            		</td>
	            		<td>
	            			 
	            		</td>
	            		<td>
	            			 
	            		</td>
	            	</tr>
	            </tbody>
	        </table>
	    </div>
	    <div class="table-responsive col-sm-12">
	        <table class="table table-hover"> 
                <thead>
                    <tr class="active">
                    	<th></th>
                    	<th>Comentarios ISC</th>
                        <th>Usuario ISC</th>
                        <th>PO</th>
                        <th>Fecha</th>
                        <th>Días</th>
                        <th>Región</th>
                    </tr>
                </thead>
	            <tbody>
	            	<?php 
	            	$date_uploaded = $data[0]['date_created'];
	            	
	            	if($data[0]['reg_mex'] == 1)
	            	{
		            	if($data_isc[4][0]['countRegion1'] > 0)
		            	{
		            		for ($i=0; $i < $data_isc[4][0]['countRegion1']; $i++) 
			            	{ 
			            	?>
			            	<tr>
			            		<td style="background: green;"></td>
			            		<td>
			            			{{ $data_isc[0][$i]['comentarios'] }}
			            		</td>
			            		<td>
			            			{{ $data_isc[0][$i]['user'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[0][$i]['po'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[0][$i]['created_at'] }} 
			            		</td>
			            		<td>
							    	<?php 
		                            $date_one = new DateTime($data_isc[0][$i]['created_at']);
		                            $date_two = new DateTime($date_uploaded);
		                            $diff = $date_one->diff($date_two);
		                            echo $diff->days;
		                            ?>
			            		</td>
			            		<td>
			            			MX
			            		</td>
			            	</tr>
			            	<?php
			            	}	
		            	}
		            	else
		            	{
		            	?>
		            	<tr>
	            			<td style="background: red;"></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td>MX</td>
	            		</tr>
		            	<?php	
		            	}
		            }
	            	
	            	if($data[0]['reg_cam'] == 1)
	            	{
		            	if($data_isc[4][0]['countRegion2'] > 0)
		            	{
		            		for ($i=0; $i < $data_isc[4][0]['countRegion2']; $i++) 
			            	{ 
			            	?>
			            	<tr>
			            		<td style="background: green;"></td>
			            		<td>
			            			{{ $data_isc[1][$i]['comentarios'] }}
			            		</td>
			            		<td>
			            			{{ $data_isc[1][$i]['user'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[1][$i]['po'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[1][$i]['created_at'] }} 
			            		</td>
			            		<td>
							    	<?php 
		                            $date_one = new DateTime($data_isc[1][$i]['created_at']);
		                            $date_two = new DateTime($date_uploaded);
		                            $diff = $date_one->diff($date_two);
		                            echo $diff->days;
		                            ?>
			            		</td>
			            		<td>
			            			CAM
			            		</td>
			            	</tr>
			            	<?php
			            	}	
		            	}
		            	else
		            	{
		            	?>
		            	<tr>
	            			<td style="background: red;"></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td>CAM</td>
	            		</tr>
		            	<?php	
		            	}
		            }

	            	if($data[0]['reg_and'] == 1)
	            	{
		            	if($data_isc[4][0]['countRegion3'] > 0)
		            	{
		            		for ($i=0; $i < $data_isc[4][0]['countRegion3']; $i++) 
			            	{ 
			            	?>
			            	<tr>
			            		<td style="background: green;"></td>
			            		<td>
			            			{{ $data_isc[2][$i]['comentarios'] }}
			            		</td>
			            		<td>
			            			{{ $data_isc[2][$i]['user'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[2][$i]['po'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[2][$i]['created_at'] }} 
			            		</td>
			            		<td>
							    	<?php 
		                            $date_one = new DateTime($data_isc[2][$i]['created_at']);
		                            $date_two = new DateTime($date_uploaded);
		                            $diff = $date_one->diff($date_two);
		                            echo $diff->days;
		                            ?>
			            		</td>
			            		<td>
			            			AND
			            		</td>
			            	</tr>
			            	<?php
			            	}	
		            	}
		            	else
		            	{
		            	?>
		            	<tr>
	            			<td style="background: red;"></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td>AND</td>
	            		</tr>
		            	<?php	
		            	}
		            }
	            	
	            	if($data[0]['reg_car'] == 1)
	            	{
		            	if($data_isc[4][0]['countRegion4'] > 0)
		            	{
		            		for ($i=0; $i < $data_isc[4][0]['countRegion4']; $i++) 
			            	{ 
			            	?>
			            	<tr>
			            		<td style="background: green;"></td>
			            		<td>
			            			{{ $data_isc[3][$i]['comentarios'] }}
			            		</td>
			            		<td>
			            			{{ $data_isc[3][$i]['user'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[3][$i]['po'] }} 
			            		</td>
			            		<td>
			            			{{ $data_isc[3][$i]['created_at'] }} 
			            		</td>
			            		<td>
							    	<?php 
		                            $date_one = new DateTime($data_isc[3][$i]['created_at']);
		                            $date_two = new DateTime($date_uploaded);
		                            $diff = $date_one->diff($date_two);
		                            echo $diff->days;
		                            ?>
			            		</td>
			            		<td>
			            			CAR
			            		</td>
			            	</tr>
			            	<?php
			            	}	
		            	}
		            	else
		            	{
		            	?>
		            	<tr>
	            			<td style="background: red;"></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td></td>
	            			<td>CAR</td>
	            		</tr>
		            	<?php	
		            	}
		            }
	            	?>

	            </tbody>
	        </table>
	    </div>
   	</div>
	</div>

<div style="height: 60px;"></div>
@endsection


