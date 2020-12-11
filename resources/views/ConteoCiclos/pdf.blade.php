<style>

    table
    {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #000;

    }


    label {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        font-weight: bold;
    }




</style>

<h2>WHIRLPOOL MEXICO</h2>
<h4>HOJA DE CONTEO DE INVENTARIO CICLICO {{ $date }}</h4>
<h4>ALMACEN {{ $planta }}</h4>

<table >
    <tr style="border:1px solid black;
        font-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        text-align: center;
        height:12px;">
        <td style="border: 1px solid black; width: 100px; align-content: center; font-size: 10px">
            <h4>MATERIAL</h4>
        </td>
        <td style="border: 1px solid black; width: 200px; align-content: center; font-size: 10px">
            <h4>DESCRIPCION</h4>
        </td>
        <td style="border: 1px solid black; width: 50px; align-content: center; font-size: 10px">
            <h4>INV RECORD</h4>
        </td>
        <td style="border: 1px solid black; width: 75px; align-content: center; font-size: 10px">
            <h4>NIVEL</h4>
        </td>
        <td style="border: 1px solid black; width: 50px; align-content: center; font-size: 10px">
            <h4>BIN</h4>
        </td>
        <td style="border: 1px solid black; width: 75px; align-content: center; font-size: 10px">
            <h4>PRIMER CONTEO</h4>
        </td>
        <td style="border: 1px solid black; width: 75px; align-content: center; font-size: 10px">
            <h4>SEGUNDO CONTEO</h4>
        </td>
    </tr>
    @foreach($data as $key => $value)
        @if(($key % $prom) == 0 && $key != 0 )

            <tr>
                <td colspan='7' style="align-content: center">FIRMA CONTADORES</td>
            </tr>
            <tr>
                <td colspan='3'>PRIMER CONTEO &nbsp;&nbsp;:</td>
                <td colspan='4'>ELABORO :</td>
            </tr>
            <tr>
                <td colspan='3'>SEGUNDO CONTEO :</td>
                <td colspan='4'>FECHA DEL CONTEO: {{ $date }}</td>
            </tr>

        </table>

        <div style="page-break-after:always;"></div>

        <table style="border: 1px solid; font-family: Arial,serif; font-size: 14px ">
            <tr style="border:1px solid black;
        font-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        font-style: normal;
        text-align: center;
        height:12px;">
                <td style="border: 1px solid black; width: 100px; align-content: center; font-size: 10px">
                    <h4>MATERIAL</h4>
                </td>
                <td style="border: 1px solid black; width: 200px; align-content: center; font-size: 10px">
                    <h4>DESCRIPCION</h4>
                </td>
                <td style="border: 1px solid black; width: 50px; align-content: center; font-size: 10px">
                    <h4>INV RECORD</h4>
                </td>
                <td style="border: 1px solid black; width: 75px; align-content: center; font-size: 10px">
                    <h4>NIVEL</h4>
                </td>
                <td style="border: 1px solid black; width: 50px; align-content: center; font-size: 10px">
                    <h4>BIN</h4>
                </td>
                <td style="border: 1px solid black; width: 100px; align-content: center; font-size: 10px">
                    <h4>PRIMER CONTEO</h4>
                </td>
                <td style="border: 1px solid black; width: 100px; align-content: center; font-size: 10px">
                    <h4>SEGUNDO CONTEO</h4>
                </td>
            </tr>

        @endif
            <tr>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">{{ $value->material }}</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">{{ $value->descripcion }}</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">{{ $value->invrec }}</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">{{ $value->type }}</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">{{ $value->bin }}</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">&nbsp;</td>
                <td style="border: 1px solid black; align-content: center ; font-size: 10px">&nbsp;</td>
            </tr>
            @if($key == $totalRecords - 1)
                <tr>
                    <td colspan='7' style="align-content: center ">FIRMA CONTADORES</td>
                </tr>
                <tr>
                    <td colspan='4'>PRIMER CONTEO &nbsp;&nbsp;:</td>
                    <td colspan='3'>ELABORO :</td>
                </tr>
                <tr>
                    <td colspan='4'>SEGUNDO CONTEO :</td>
                    <td colspan='3'>FECHA DEL CONTEO : {{ $date }}</td>
                </tr>
            </table>
            @endif
    @endforeach
