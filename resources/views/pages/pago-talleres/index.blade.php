@extends("layouts.app")

@section("content")
<div style="height: 30px;"></div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>
			  <strong>Pago a talleres</strong>
			</h2>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-3 text-center" style="font-weight: 600; font-size: 24px; background: #CCCCCC; border: 1px solid #C3C3C3; padding: 30px; border-radius: 4px;">
			<a href="{{ url('pago-a-talleres/recepcion-de-facturas/') }}" style="color: #FFFFFF;">
				Recepción de facturas
			</a>
		</div>
	</div>
</div>
@endsection
