@extends('layouts.app')

@section('content')
<?php 
$sol_ing = true;
?>
<div class="text-center">
	<div class="card-body">
		<div class="row d-flex justify-content-center">
			<div class="card bg-light" style="width: 60rem;">
				<div class="card-header">Reporte de Solicitudes Generadas</div>
				<div class="card-body">
					<h6 class="card-subtitle mb-2 text-muted">Seleccion el rango de fechas y region</h6>
					<br>
					<form class="form-inline justify-content-center" id="form-dispatch" enctype="multipart/form-data" method="post" action="{{ url('solicitudes-a-ingenieria/reporte/generate') }}" onsubmit="send();">
					@csrf
						<div class="row">
							<div class="form-group">
								<div class="row d-flex justify-content-center" style="width: 20rem;">
									<label for="date_start">Fecha Inicial:&nbsp;</label>
									<input type="date" name="date_start" id="date_start" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="row d-flex justify-content-center" style="width: 20rem;">
									<label for="date_end">Fecha Final:&nbsp;</label>
									<input type="date" name="date_end" id="date_end" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="row d-flex justify-content-center" style="width: 20rem;">
										<label for="region">País:&nbsp;</label>
										<select name="region" id="region" class="form-control" onchange="send()">
											<option value="">Todas</option>
											@foreach ($regions as $region)
                                                <option value="{{$region->id}}">{{$region->name}}</option>
                                            @endforeach
										</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="footer bg-transparent">
								<div class="justify-content-center">
									<br>
									<button type="submit" id="cancel">Generar Reporte</button>
								</div>
							</div>
						</div>
					</form>
					<div id="report"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
function send ()
{
	removeOrAddStyleClass(element='date_start',style='is-invalid', action='remove');
	removeOrAddStyleClass(element='date_end',style='is-invalid', action='remove');
	if( $("#date_start").val() != '' && $("#date_end").val() != '' )
	{
		$("#form-dispatch").submit();
	}
	else
	{
		event.preventDefault();
		showNotification('Error',"Indique el rango de fechas.", 'error');
		if( $("#date_start").val() == '') removeOrAddStyleClass(element='date_start',style='is-invalid', action='add');
		if( $("#date_end").val() == '' ) removeOrAddStyleClass(element='date_end',style='is-invalid', action='add');
	}
}
</script>
@endsection
@endsection
