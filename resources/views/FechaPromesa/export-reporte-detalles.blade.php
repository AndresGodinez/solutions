<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<table border="1" cellpadding="2" cellspacing="0" width="100%">
    <tr>
        <th class="text-center">PEDIDO</th>
        <th class="text-center">MATERIAL</th>
        <th class="text-center">FECHA PEDIDO</th>
        <th class="text-center">STATUS NP</th>
        <th class="text-center">FECHA PROMESA</th>
        <th class="text-center">CREACIÓN</th>
        <th class="text-center">ACTUALIZACIÓN</th>
        <th class="text-center">WARNING</th>
    </tr>
    @foreach ($fechasPromesasDetalle as  $fP)
    <tr>
        <td>{{$fP->pedido}} </td>
        <td>{{$fP->material}} </td>
        <td>{{$fP->fecha_pedido}} </td>
        <td>{{$fP->status_material}} </td>
        <td>{{$fP->fecha_promesa}} </td>
        <td>{{$fP->created_at}} </td>
        <td>{{$fP->updated_at}} </td>
        <td>{{$fP->warning}} </td>
    </tr>
    @endforeach
</table>
