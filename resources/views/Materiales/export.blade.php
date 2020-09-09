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
        <th class="text-center">Material</th>
        <th class="text-center">Sustituto</th>
        <th class="text-center">Relacion</th>
    </tr>
    @foreach ($sustitutos as $k => $v)
    <tr>
        <td>{{$v->material}} </td>
        <td>{{$v->sustituto}} </td>
        <td>{{$v->rel}} </td>
    </tr>
    @endforeach
</table>
