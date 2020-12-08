@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2><strong>Semáforo Tracking Tickets (ISC)</strong></h2>
			<h4><strong>[{{ $type }}]</strong></h4>
		</div>	
	</div>
</div>
<div class="container">
  	<div class="row">
     	<div class="col-sm-8">
     		<i class="square-black" style="padding: 1px 10px; background: black;"></i> &nbsp; <strong>Total de tickets:</strong> {{ $get_all_records['count'] }}<br />
            <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets K:</strong> {{ $get_all_records['count_kmodel'] }}<br />
            <i class="square-red" style="padding: 1px 10px; background: red;"></i> &nbsp; <strong>Tickets mayor 25 días:</strong> {{ $get_all_records['count_25days'] }}<br />
            <i class="square-yellow" style="padding: 1px 10px; background: yellow;"></i> &nbsp; <strong>Tickets entre 25-15 días:</strong> {{ $get_all_records['count_25_15days'] }}<br />
            <i class="square-green" style="padding: 1px 10px; background: green;"></i> &nbsp; <strong>Tickets menor 15 días:</strong> {{ $get_all_records['count_15days'] }}<br /><br />
     	</div>    
     	<div class="col-sm-4 text-right">
     		<a class="btn btn-primary" href="{{ url('semaforo/') }}">
     			< Regresar
     		</a>
     	</div>    
    </div>
</div>
<hr>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
					    <th>Ticket</th>
					    <th>Sub estatus</th>
					    <th>Tipo de pago</th>
					    <th>Muebleria</th>
					    <th>Modelo</th>
					    <th>Pedido/Reserva</th>
					    <th>Fecha Pedido/Reserva</th>
					    <th>Días</th>
					    <th></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$count_1 = $get_all_records_list[4][0]['pos_k'];
					$count_2 = $get_all_records_list[4][0]['pos_25'];
            		$count_3 = $get_all_records_list[4][0]['pos_25_15'];
            		$count_4 = $get_all_records_list[4][0]['pos_15'];

            		for ($i=0; $i<=$count_1; $i++) 
            		{ 
            		?>
            		<tr>
					    <td>{{ $get_all_records_list[0][$i]['ticket'] }}</td>
					    <td>{{ $get_all_records_list[0][$i]['sub_status'] }}</td>
					    <td>{{ $get_all_records_list[0][$i]['payment_type'] }}</td>
					    <td>{{ $get_all_records_list[0][$i]['tp'] }}</td>
					    <td><strong>{{ $get_all_records_list[0][$i]['model'] }}</strong></td>
					    <td>{{ $get_all_records_list[0][$i]['pedido_reserva'] }}</td>
					    <td>{{ $get_all_records_list[0][$i]['pedido_reserva_date'] }}</td>
					    <td>{{ $get_all_records_list[0][$i]['diff_days'] }}</td>
					    <td style="{{$get_all_records_list[0][$i]['style'] }}">
					    </td>
					</tr>
            		<?php	
            		}

            		for ($i=0; $i<=$count_2; $i++) 
            		{ 
            		?>
            		<tr>
					    <td>{{ $get_all_records_list[1][$i]['ticket'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['sub_status'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['payment_type'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['tp'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['model'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['pedido_reserva'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['pedido_reserva_date'] }}</td>
					    <td>{{ $get_all_records_list[1][$i]['diff_days'] }}</td>
					    <td style="{{$get_all_records_list[1][$i]['style'] }}">
					    </td>
					</tr>
            		<?php	
            		}

            		for ($i=0; $i<=$count_3; $i++) 
            		{ 
            		?>
            		<tr>
					    <td>{{ $get_all_records_list[2][$i]['ticket'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['sub_status'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['payment_type'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['tp'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['model'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['pedido_reserva'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['pedido_reserva_date'] }}</td>
					    <td>{{ $get_all_records_list[2][$i]['diff_days'] }}</td>
					    <td style="{{$get_all_records_list[2][$i]['style'] }}">
					    </td>
					</tr>
            		<?php	
            		}

					for ($i=0; $i<=$count_4; $i++) 
            		{ 
            		?>
            		<tr>
					    <td>{{ $get_all_records_list[3][$i]['ticket'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['sub_status'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['payment_type'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['tp'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['model'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['pedido_reserva'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['pedido_reserva_date'] }}</td>
					    <td>{{ $get_all_records_list[3][$i]['diff_days'] }}</td>
					    <td style="{{$get_all_records_list[3][$i]['style'] }}">
					    </td>
					</tr>
            		<?php	
            		}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12 text-center">
     		<a class="btn btn-primary" href="{{ url('semaforo/') }}">
     			< Regresar
     		</a>
     	</div>
	</div>
</div>
<div style="height: 60px;"></div>
@endsection


