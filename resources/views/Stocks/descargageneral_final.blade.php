<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<table rder="1" cellpadding="2" cellspacing="0" width="100%">
    <tr>
        <th>Folio</th>
        <th>No. parte</th>
        <th>Descripción</th>
        <th>Modelo</th>
        <th>Proyecto</th>
        <th>Proveedor</th>
        <th>Solicitante</th>
        <th>Fecha</th>
        <th>Dias</th>
    </tr>        
    <?php $n = 1; ?>
    @foreach($get_records as $get_records)
    <tr>
        <td>{{ $get_records->id }}</td>
        <td>
            <a href="{{	url('stocks/final/detalle/'.$get_records->id) }}">
                <strong>{{ $get_records->material }}</strong>
            </a>
        </td>
        <td>{{ $get_records->descripcion }}</td>
        <td>{{ $get_records->modelo }}</td>
        <td>{{ $get_records->proyecto }}</td>
        <td>{{ $get_records->proveedor }}</td>
        <td>{{ $get_records->user_carga }}</td>
        <td>{{ $get_records->created_at }}</td>
        <td>
            <?php 
            $date_one = new DateTime($get_records->created_at);
            $date_two = new DateTime(date("Y-m-d H:i:s"));
            $diff = $date_one->diff($date_two);
            echo $diff->days;
            ?>
        </td>
        <td>{{ $get_records->usr_request }}</td>
        <td>
            @if($get_records->ok == 0)
                no
                @else
                si
                @endif
        </td>
    </tr>
    @endforeach

</table>