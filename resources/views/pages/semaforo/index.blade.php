@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Semáforo Tracking Tickets (ISC)</strong></h2>
		</div>	
	</div>
</div>
<div class="container">
  	<div class="row">
     		<div class="col-sm-4 square" style="padding: 15px;">
            <div style="border: 1px solid #CCCCCC !important; padding: 15px; border-radius: 5px;">
                <h4 style="text-align: center; border-bottom: 2px solid #000000; padding-bottom: 10px;"><strong>Todos los Tickets</strong></h4>
                <i class="square-black" style="padding: 1px 10px; background: black;"></i> &nbsp; <strong>Total de tickets:</strong> {{ $get_all_records['count'] }}<br />
                <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets K:</strong> {{ $get_all_records['count_kmodel'] }}<br />
                <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets mayor 25 días:</strong> {{ $get_all_records['count_25days'] }}<br />
                <i class="square-yellow" style="padding: 1px 10px; background: yellow;"></i> &nbsp; <strong>Tickets entre 25-15 días:</strong> {{ $get_all_records['count_25_15days'] }}<br />
                <i class="square-green" style="padding: 1px 10px; background: green;"></i> &nbsp; <strong>Tickets menor 15 días:</strong> {{ $get_all_records['count_15days'] }}<br /><br />
                <a href="{{ url('semaforo/list/all-records') }}"><strong>Ver más detalle ></strong></a>
            </div>
        </div>
        <div class="col-sm-4 square" style="padding: 15px;">
            <div style="border: 1px solid #CCCCCC !important; padding: 15px; border-radius: 5px;">
                <h4 style="text-align: center; border-bottom: 2px solid #000000; padding-bottom: 10px;"><strong>Liverpool</strong></h4>
                <i class="square-black" style="padding: 1px 10px; background: black;"></i> &nbsp; <strong>Total de tickets:</strong> {{ $get_all_records_tp['count'] }}<br />
                <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets K:</strong> {{ $get_all_records_tp['count_kmodel'] }}<br />
                <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets mayor 25 días:</strong> {{ $get_all_records_tp['count_25days'] }}<br />
                <i class="square-yellow" style="padding: 1px 10px; background: yellow;"></i> &nbsp; <strong>Tickets entre 25-15 días:</strong> {{ $get_all_records_tp['count_25_15days'] }}<br />
                <i class="square-green" style="padding: 1px 10px; background: green;"></i> &nbsp; <strong>Tickets menor 15 días:</strong> {{ $get_all_records_tp['count_15days'] }}<br /><br />
                <a href="{{ url('semaforo/list/liverpool') }}"><strong>Ver más detalle ></strong></a>
            </div>
        </div>  
    </div>
</div>
<hr>
<div style="height: 60px;"></div>
@endsection


