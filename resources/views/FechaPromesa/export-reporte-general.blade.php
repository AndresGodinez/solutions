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
        <th>Id</th>
        <th class="text-center">PEDIDO</th>
        <th class="text-center">FECHA PEDIDO</th>
        <th class="text-center">STATUS</th>
        <th class="text-center">FECHA PROMESA</th>
        <th class="text-center">CREACION</th>
        <th class="text-center">ACTUALIZACIÓN</th>
    </tr>
    @foreach ($fechasPromesas as  $fP)
    <tr>
        <td>{{$fP->pedido}} </td>
        <td>{{$fP->fecha_pedido}} </td>
        <td>{{$fP->status_pedido}} </td>
        <td>{{$fP->fecha_promesa}} </td>
        <td>{{$fP->created_at}} </td>
        <td>{{$fP->updated_at}} </td>
    </tr>
    @endforeach
</table>
