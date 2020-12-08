<H2>WHIRLPOOL MEXICO</H2>
<h3>CONCILIACION INVENTARIO CICLICO DEL DIA {{ $date }}</h3>
<h3>ALMACEN {{ $planta }}</h3>
<br>
<table>
    <tr>
        <th>MATERIAL</th>
        <th>DESCRIPCION</th>
        <th>INV RECORD</th>
        <th>BIN</th>
        <th>INVENTARIO SISTEMA</th>
        <th>C UNIT ($)</th>
        <th>VALOR INV ($)</th>
        <th>PRIMER CONTEO</th>
        <th>VARIACION</th>
        <th>SEGUNDO CONTEO</th>
        <th>AJUSTE INV</th>
        <th>IMPORTE AJUSTE ($)</th>
        <th>INVENTARIO FINAL</th>
        <th>VALOR INV ($)</th>
    </tr>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $value->material }}</td>
            <td>{{ $value->descripcion }}</td>
            <td>{{ $value->invrec }}</td>
            <td>{{ $value->bin }}</td>
            <td>{{ $value->stock }}</td>
            <td>{{ $value->costo }}</td>
            <td>{{ '=E'. ($key+2) . '*F'. ($key+2) }}</td>
            <td></td>
            <td>{{ '=H'. ($key+2) . '-E'. ($key+2) }}</td>
            <td></td>
            <td>{{ '=IF(J'.($key+2).'="", 0,J'.($key+2).'-E'.($key+2).')' }}</td>
            <td>{{ '=K'.($key+2).'*F'.($key+2) }}</td>
            <td>{{ '=E'.($key+2).'+K'.($key+2) }}</td>
            <td>{{ '=M'.($key+2).'*F'.($key+2) }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td>ELABORO</td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            JEFE ALMACEN
        </td>
    </tr>
</table>
