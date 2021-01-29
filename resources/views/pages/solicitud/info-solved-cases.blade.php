<table id="table" class=" justify-content-center table-striped table-bordered" cellspacing="0" style="width:100%">
<thead>
	<tr>
		<th>Casos resueltos</th>
	</tr>
</thead>
<tfoot>
</tfoot>
<tbody>
    @foreach($faqs as $fq)

	<tr>
		<td><a href="{{url('solicitudes-a-ingenieria/solicitud/show').'/'.$fq->id_sol}}" target="_blank">{{$fq->id_sol}}</a></td>
	</tr>
    @endforeach
</tbody>
</table>
