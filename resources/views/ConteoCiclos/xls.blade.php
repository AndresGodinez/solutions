<table>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">
            <H2> <strong>WHIRLPOOL MEXICO</strong></H2>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="6">
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">
            <h3><strong>CONCILIACION INVENTARIO CICLICO DEL DIA {{ $date }}</strong></h3>
        </td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">
            <h3><strong>ALMACEN {{ $planta }}</strong></h3>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>
<br>
<table>
    <tr>
        <th><strong>ID</strong></th>
        <th><strong>MATERIAL</strong></th>
        <th><strong>DESCRIPCION</strong></th>
        <th><strong>INV RECORD</strong></th>
        <th><strong>BIN</strong></th>
        <th><strong>INVENTARIO SISTEMA</strong></th>
        <th><strong>C UNIT ($)</strong></th>
        <th><strong>VALOR INV ($)</strong></th>
        <th><strong>PRIMER CONTEO</strong></th>
        <th><strong>VARIACION</strong></th>
        <th><strong>SEGUNDO CONTEO</strong></th>
        <th><strong>AJUSTE INV</strong></th>
        <th><strong>IMPORTE AJUSTE ($)</strong></th>
        <th><strong>INVENTARIO FINAL</strong></th>
        <th><strong>VALOR INV ($)</strong></th>
    </tr>
    @foreach($data as $key => $value)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $value->material }}</td>
            <td>{{ $value->descripcion }}</td>
            <td>{{ $value->invrec }}</td>
            <td>{{ $value->bin }}</td>
            <td>{{ $value->stock }}</td>
            <td>{{ $value->costo }}</td>
            <td>{{ '=F'. ($key+10) . '*G'. ($key+10) }}</td>
            <td></td>
            <td>{{ '=I'. ($key+10) . '-F'. ($key+10) }}</td>
            <td></td>
            <td>{{ '=IF(K'.($key+10).'="", 0,K'.($key+10).'-F'.($key+10).')' }}</td>
            <td>{{ '=L'.($key+10).'*G'.($key+10) }}</td>
            <td>{{ '=F'.($key+10).'+L'.($key+10) }}</td>
            <td>{{ '=N'.($key+10).'*G'.($key+10) }}</td>
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
