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
        <th class="text-center">USERNAME</th>
        <th class="text-center">NOMBRE</th>
        <th class="text-center">CORREO</th>
        <th class="text-center">PAIS</th>
        <th class="text-center">REGION</th>
    </tr>
    @foreach ($usuarios as $k => $v)
    <tr>
        <td>{{$v->id}} </td>
        <td>{{$v->username}} </td>
        <td>{{$v->nombre}} </td>
        <td>{{$v->mail}} </td>
        <td>{{$v->cname}} </td>
        <td>{{$v->rname}} </td>
    </tr>
    @endforeach
</table>
