<style>
   table{
       font-family: Arial,serif;
       font-size: 14px;
       border-left: 0.01em solid black;
       border-right: 0;
       border-top: 0.01em solid black;
       border-bottom: 0;
       border-collapse: collapse;
   }
   table td,
   table th {
       border-left: 0;
       border-right: 0.01em solid #ccc;
       border-top: 0;
       border-bottom: 0.01em solid #ccc;
   }

</style>

<h2>WHIRLPOOL MEXICO</h2>
<h4>HOJA DE CONTEO DE INVENTARIO CICLICO {{ $date }}</h4>
<h4>ALMACEN {{ $planta }}</h4>

<table >
    <tr style="border: 1px solid black;">
        <th>MATERIAL</th>
        <th>DESCRIPCION</th>
        <th>INV RECORD</th>
        <th>NIVEL</th>
        <th>BIN</th>
        <th>PRIMER CONTEO</th>
        <th>SEGUNDO CONTEO</th>
    </tr>
    @foreach($data as $key => $value)
        @if(($key % $prom) == 0 && $key != 0 )
            <tr>
                <td></td>
                <td>ELABORO</td>
                <td></td>
                <td>
                    JEFE ALMACEN
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>____________</td>
                <td></td>
                <td>
                    _____________
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <div style="page-break-after:always;"></div>

        <table style="border: 1px solid; font-family: Arial,serif; font-size: 14px ">
            <tr>
                <th>MATERIAL</th>
                <th>DESCRIPCION</th>
                <th>INV RECORD</th>
                <th>NIVEL</th>
                <th>BIN</th>
                <th>PRIMER CONTEO</th>
                <th>SEGUNDO CONTEO</th>
            </tr>

        @endif
        <tr>
            <td>{{ $value->material }}</td>
            <td>{{ $value->descripcion }}</td>
            <td>{{ $value->invrec }}</td>
            <td>{{ $value->type }}</td>
            <td>{{ $value->bin }}</td>
            <td></td>
            <td></td>
        </tr>
            @if($key == $totalRecords - 1)
                <tr>
                    <td></td>
                    <td>ELABORO</td>
                    <td></td>
                    <td>
                        JEFE ALMACEN
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>____________</td>
                    <td></td>
                    <td>
                        _____________
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
            @endif
    @endforeach
