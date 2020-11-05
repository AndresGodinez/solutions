@extends("layouts.app")

@section("content")

<section id="basic-datatable">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Descargar Reporte</strong></h2>			
		</div>
	</div>
</section>
<div style="height: 30px;"></div>
	
<div class="card">		
	<div class="card-body">
		<form name='forma' action="{{ url('/alcopar/classat/guardar/')}}" id='formID' method='POST'>
		@csrf
			<div class="row">							
				<div class="col-md-12 col-12 mt-2">
						<fieldset class="form-group">
							<center>
							<a class="btn btn-primary"  value="" href="{{ url('/alcopar/reportalcopar')}}">Descargar</a>
							</center>
						</fieldset>
				</div>		
			</div>			
		</form>
	</div>
</div>

@endsection