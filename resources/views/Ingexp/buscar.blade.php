@extends("layouts.app")

@section("content")
<?php 
$data = $datos;

$tipo = 0;
$linea = 0;

if(isset($_GET['tipo'])){
    $tipo = $_GET['tipo'];
}
if(isset($_GET['linea'])){
    $linea = $_GET['linea'];
}
?>
<link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">
<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Buscar Existente</strong></h2>			
		</div>
	</div>
</section>
<div style="height: 30px;"></div>
<section id="basic-datatable">

	<div class="row">
        <div class="col-sm-12">
                <div class="card p-1">
                    <div class="row">
                        <div class="col-md-6 col-5">
                            <fieldset class="form-group">
                                <label for="basicInput">LINEA DE PRODUCTO:</label>
                                <select class="form-control filtro" name="linea" id="linea" require="true">
                                    <option value="0">Seleccionar Linea</option>
                                    <?php 
                                        foreach($data['linea'] as $v){
                                    ?>
                                    <option <?php if($linea == $v['idlinea']){ echo 'selected=""'; } ?> value="<?=$v['idlinea']?>"><?=$v['linea']?></option>							
                                    <?php
                                        }
                                    ?>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-5">
                            <fieldset class="form-group">
                                <label for="basicInput">TIPO ARCHIVO:</label>
                                <select class="form-control filtro" name="tipo" id="tipo"  require="true">
                                    <option value="0">Seleccionar Tipo</option>
                                    <?php 
                                        foreach($data['tipo'] as $v){
                                    ?>
                                    <option <?php if($tipo == $v['idtipo']){ echo 'selected=""'; } ?> value="<?=$v['idtipo']?>"><?=$v['tipo']?></option>							
                                    <?php
                                        }
                                    ?>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                </div>
        </div>

		<div class="col-sm-12">
			<div class="card p-1">
				<table class="table table-striped table-bordered complex-headers table-responsive">
					<thead>
						<tr>
                            <th>TITULO</th>
                            <th>CATEGORIA</th>
                            <th>MODELO</th>
                            <th>LINEA</th>
                            <th>TIPO</th>
                            <th>COMENTARIOS</th>						
                            <th>FECHA ACTUALIZACION</th>
						</tr>
					</thead>
					<tbody>
						@foreach($get_records as $get_records)						
						<tr>                        
                            <td><a target="_blank" href="{{	url('ingexp/visor/'.$get_records['idregistro']) }}"><?=substr($get_records['titulo'],0,40)?></a></td>
							<td>{{ $get_records['categoria'] }}</td>
							<td><?=substr($get_records['modelo'],0,40)?></td>
							<td>{{ $get_records['linea'] }}</td>
                            <td>{{ $get_records['tipo'] }}</td>											
                            <td>{{ $get_records['comentarios'] }}</td>
                            <td>{{ $get_records['fecha'] }}</td>					                           		
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

<script>    

        $('.filtro').on('change',function(){
            var tipo = $('#tipo').val();
            var linea = $('#linea').val();
            window.location = '<?php echo url('/ingexp/buscar/'); ?>?tipo='+tipo+'&linea='+linea
        });

        $('.table').DataTable({
			"responsive":true,
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            }
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
