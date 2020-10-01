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
    <form name='forma' action="{{ url('/alcopar/reving/procesarechazar4/')}}" id='formID' method='post'>
    @csrf
        <table >
            <tr>
                <td >No Parte:</td>
                <td><input name="parte" type="text" size="40" class="form-control" disabled id="parte"  value="<?php echo($row['parte']);?>"></td>
            </tr>

            <tr> 
                <td width="150">Descripción:</td> 
                <td><input name="descripcion" type="text" class="form-control"  disabled id="descripcion" size="40" value="<?php echo($row['descripcion']);?>"></td>
            </tr>

          
            
            <tr>
                <td>Usuario:</td> 
                <td><input name='username' type='text' class="form-control"  disabled id='username' size="40" value='<?php echo $nombre_usuario;?>'></td>
            </tr>
            
            <tr>
                <td>Motivo:</td> 
                <td><input name='motivo' type='text' class="form-control"  disabled id='motivo' size='40' value='<?php echo $motivo;?>'></td>
            </tr>
           
            
            <tr>
                    <td>Causa del Rechazo</td>            
                <td><input name='rechazo' type='text' class="form-control"  disabled id='rechazo' size='40' value='EL NUM DE PARTE CUENTA CON SUSTITUTO'></td>            
                </tr>
                
                <tr>
                    <td>N&uacute;mero Sustituto</td>            
                <td><input name='sustituto' type='text' id='sustituto' size='40' class="validate[required,minSize[5]] text-input form-control" style="text-transform:uppercase"></td>            
                </tr>
                <tr>            
                    <td>&iquest;Qu&eacute; tipo de sustituto es?</td>
                    <td>
                        <select   class="form-control" name="tipo">
                            <option size='40' value="">SELECCIONA</option>
                            <option size='40' value="ALTERNO">ALTERNO</option>
                            <option size='40' value="DIRECTO">DIRECTO</option>
                        </select>
                    </td>
                </tr>

                <tr>            
                    <td>¿Pieza sustituta se encuentra extendida en los almacenes en SAP?</td>
                    <td>
                        <select class="form-control"  name="existe">
                            <option  size='40' value="">SELECCIONA</option>
                            <option  size='40' value="SI">SI, YA SE ENCUENTRA EXTENDIDO EN LOS ALMACENES</option>
                            <option size='40' value="NO">NO, SE CREARÁ UNA SOLICITUD DE ALTA DE PARTE</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
            
            <tr>
                <td></td>
                <td height='150'> 
                    <input type="submit" id="rechazar" class="btn btn-danger"  name="rechazar" value="Rechazar" onclick="return confirm('Estas seguro de que deseas rechazar la solicitud?')">
                    <input type="submit" id="regresar"  class="btn btn-primary" name="regresar" value="Regresar al Listado">
                </td>
            </tr>

        </table>
        
    </form>
	</div>
</div>

@endsection
