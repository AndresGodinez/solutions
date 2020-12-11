<style>
    body {font-family: sans-serif;
        font-size: 10pt;
    }
    p {
        margin: 0pt;
    }
    td { vertical-align: top;
    }

    table
    {
        font-family: arial, serif;
        border-collapse:collapse;

    }



    h1 {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
    }


    label {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        font-weight: bold;
    }



    table {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 10px;
        margin: 1px;
        cellspacing: 1px;
        width:50%;
        padding: 1px;
        /*border-collapse:collapse;*/


    }

    table, td, th , tr
    {
        border:0px solid #666;
    }



</style>

<h2>WHIRLPOOL MEXICO</h2>
<h4>HOJA DE CONTEO DE INVENTARIO CICLICO {{ $date }}</h4>
<h4>ALMACEN {{ $planta }}</h4>

<table >
    <tr style="border:0px solid #666;
        font-color: #FFF;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        text-align: center;
        height:12px;">
        <td style="
        border: 1px solid black;
        width: 100px;
        align-content: center;
         height:15px;
        padding:2px;
">
            <h4>MATERIAL</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>DESCRIPCION</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>INV RECORD</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>NIVEL</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>BIN</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>PRIMER CONTEO</h4>
        </td>
        <td style="border: 1px solid black; width: 100px; align-content: center">
            <h4>SEGUNDO CONTEO</h4>
        </td>
    </tr>
    @foreach($data as $key => $value)
        @if(($key % $prom) == 0 && $key != 0 )

            <tr><td colspan='6'>FIRMA CONTADORES</td></tr>
            <tr>
                <td colspan='3'>PRIMER CONTEO &nbsp;&nbsp;:</td>
                <td colspan='3'>ELABORO :</td>
            </tr>
            <tr>
                <td colspan='3'>SEGUNDO CONTEO :</td>
                <td colspan='3'>FECHA DEL CONTEO :".$date."</td>
            </tr>

        </table>

        <div style="page-break-after:always;"></div>

        <table style="border: 1px solid; font-family: Arial,serif; font-size: 14px ">
            <tr>
                <td align='center'>MATERIAL</td>
                <td align='center'>DESCRIPCION</td>
                <td align='center'>INV <br> RECORD</td>
                <td align='center'>NIVEL</td>
                <td align='center'>BIN</td>
                <td align='center'>PRIMER <br>CONTEO</td>
                <td align='center'>SEGUNDO <br> CONTEO</td>
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
                <tr><td colspan='6'>FIRMA CONTADORES</td></tr>
                <tr>
                    <td colspan='3'>PRIMER CONTEO &nbsp;&nbsp;:</td>
                    <td colspan='3'>ELABORO :</td>
                </tr>
                <tr>
                    <td colspan='3'>SEGUNDO CONTEO :</td>
                    <td colspan='3'>FECHA DEL CONTEO :".$date."</td>
                </tr>
            </table>
            @endif
    @endforeach
