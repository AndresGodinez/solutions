@foreach($get_records as $record)
<tr>
    <td><a target="_blank"
           href="{{	url('ingexp/visor/'.$record['idregistro']) }}"><?=substr($record->titulo,
                0, 40)?></a></td>
    <td>{{ $record->categoria }}</td>
    <td><?=substr($record->modelo, 0, 40)?></td>
    <td>{{ $record->lineaRel->linea ?? ''}}</td>
    <td>{{ $record->tipoRel->tipo ?? ''}}</td>
    <td>{{ $record->comentarios }}</td>
    <td>{{ $record->fecha }}</td>
</tr>
@endforeach
