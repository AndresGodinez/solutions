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
        <th class="text-center">Num Parte</th>
        <th class="text-center">Descripción</th>
        <th class="text-center">Fecha Creación</th>
        <th class="text-center">Días Creación</th>
        <th class="text-center">Días c/Depto.</th>
        <th class="text-center">Tipo Mat.</th>
        <th class="text-center">Categoría</th>
        <th class="text-center">Fam</th>
        <th class="text-center">Marca</th>
        <th class="text-center">Cat. Extra</th>
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

