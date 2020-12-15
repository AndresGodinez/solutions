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
        <th class="text-center">NUMERO DE PARTE</th>
        <th class="text-center">DESCRIPCION</th>
        <th class="text-center">MODELO</th>
        <th class="text-center">FECHA CREACION</th>
        <th class="text-center">DIAS CREACION</th>
        <th class="text-center">DIAS C/DEPTO</th>
        <th class="text-center">TIPO MAT.</th>
        <th class="text-center">CATEGORIA</th>
        <th class="text-center">FAM</th>
        <th class="text-center">MARCA</th>
        <th class="text-center">CAT. EXTRA</th>
    </tr>
    @foreach($getRecords as $record)

        <tr>
            <td>
                <strong>{{ $record['parte'] }}</strong>
            </td>
            <td>{{ $record['descripcion'] }}</td>
            <td>{{ $record['modelo'] }}</td>
            <td>{{ $record['fecha'] }}</td>
            <td>{{ $record['dias4'] }}</td>
            <td>{{ $record['diasd'] }}</td>
            <td>{{ $record['tipo_material'] }}</td>
            <td>{{ $record['categoria'] }}</td>
            <td>{{ $record['familia'] }}</td>
            <td>{{ $record['marca'] }}</td>
            <td>{{ $record['tipo_extra'] }}</td>
        </tr>
    @endforeach
</table>

