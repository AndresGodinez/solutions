@extends("layouts.app")

@section("content")
<div class="text-center">
	<div class="card-body">
		<h4 class="card-title">{{ config('pages.solicitud.index_view.title') }}</h4>
		<h6 class="card-subtitle mb-2 text-muted">{{ config('pages.solicitud.index_view.subtitle') }}</h6>
		<form class="form-inline justify-content-center" id="form-dispatch" enctype="multipart/form-data" method="get" action="{{url('solicitud')}}">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<input type="text" id="dispatch" name="dispatch" class="form-control" placeholder="No. DISPATCH" autofocus>
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<div class="form-group text-center">
					<button type="submit" id="save" >{{ config('pages.solicitud.index_view.button') }}</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
