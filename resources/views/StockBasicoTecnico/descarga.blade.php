<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<table rder="1" cellpadding="2" cellspacing="0" width="100%">

    <table>

        <tr>
            <th class="text-center">BIN</th>
            <th class="text-center">SLOC</th>
            <th class="text-center">MATERIAL</th>
            <th class="text-center">MAX</th>
            <th class="text-center">STOCK</th>
            <th class="text-center">SURTIR</th>
        </tr>

    
  
        <?php $n = 1; ?>
        @foreach($get_records as $get_records)
        <tr>            
            <td>{{ $get_records->bin }}</td>
            <td>{{ $get_records->sloc }}</td>
            <td>{{ $get_records->material }}</td>
            <td>{{ $get_records->max }}</td>
            <td>{{ $get_records->stock }}</td>
            <td>{{ $get_records->surtir }}</td>            
        </tr>
        @endforeach
    
</table>