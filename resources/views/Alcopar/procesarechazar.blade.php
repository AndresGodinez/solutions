@extends("layouts.app")
@section("content")
<?php 

$row = $get_records['row'];

$parte=$row['parte'];
$descripcion=$row['descripcion'];
$motivo=$row['motivo'];
$username_alcopar=$row['username'];


$nombre_usuario=$get_records['nombre'];


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
    <form name='forma' action="{{ url('/alcopar/reving/procesarechazar1/')}}" id='formID' method='post'>
    @csrf
        <table width="100%">
        <tr>
            <td>No Parte:</td>
            <td><input name="parte" type="text" class="form-control" disabled id="parte" size="40" value="<?php echo($row['parte']);?>"></td>
        </tr>

            <tr> 
                <td width="90">Descripción:</td> 
            <td><input name="descripcion" type="text" class="form-control" disabled id="descripcion" size="40" value="<?php echo($row['descripcion']);?>"></td>
            </tr>

            <tr>
            <td></td>
            </tr>
        
        <tr>
            <td>Usuario:</td> 
            <td><input name='username' type='text' class="form-control" disabled id='username' size="40" value='<?php echo $nombre;?>'></td>
            </tr>
        
        <tr>
            <td>Motivo:</td> 
            <td><input name='motivo' type='text' class="form-control" disabled id='motivo' size='40' value='<?php echo $motivo;?>'></td>
        </tr>

            <tr>
            <td></td>
            </tr>
            
            <tr>
                <td>Causa del Rechazo</td>            
            <td>
            <select name="rechazo" class="form-control">
                <!-- <option value="EL NUM DE PARTE ES INCORRECTO">EL NUM DE PARTE ES INCORRECTO</option> -->
                <option value="EL NUM DE PARTE CUENTA CON SUSTITUTO">EL NUM DE PARTE CUENTA CON SUSTITUTO</option>
            <option value="EL NUM DE PARTE ESTA OBSOLETO">EL NUM DE PARTE ESTA OBSOLETO</option>
            <option value="PIEZA NO REFACCIONABLE">PIEZA NO REFACCIONABLE</option>
                </select>
            </td>
            </tr>
            
            <tr>
            <td></td>
            <td height='150'> 
                <input class="btn btn-danger"   type="submit" id="rechazar"  name="rechazar" value="Rechazar" onclick="return confirm('Estas seguro de que deseas rechazar la solicitud?')">                
                <a class="btn btn-primary"  value="" href="{{ url('/alcopar/reving')}}">Regresar al Listado</a>
            </td>
        </tr>

        </table>

        </form>
	</div>
</div>

@endsection
