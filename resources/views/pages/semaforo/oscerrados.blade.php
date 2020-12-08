@extends("layouts.app")

@section("content")
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>{{ $title }}</h2>
			<h5>({{ $subtitle }})</h5>
		</div>	
	</div>
</div>
<div style="height: 30px;"></div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<table class="table">
				<thead>
					<tr>
					    <th>No</th>
					    <th>Dispatch</th>
					    <th>Pedido</th>
					    <th>Fecha pedido</th>
					    <th>Días</th>
					</tr>
				</thead>
				<tbody>
					<?php $count = 1;?>
					@foreach($data as $data)
					<tr>
					    <td>{{ $count++ }}</td>
					    <td>{{ $data['dispatch'] }}</td>
					    <td>{{ $data['pedido'] }}</td>
					    <td>{{ $data['pedido_date'] }}</td>
					    <?php 
                            $date_one = new DateTime($data['pedido_date']);
                            $date_two = new DateTime(date("Y-m-d"));
                            $diff = $date_one->diff($date_two);
                        ?>
					    <td style="{{ ($diff->days > 30 ? 'background: red; color: #FFFFFF;' : '') }}">
					    	<strong>{{ $diff->days }}</strong>
					    </td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
