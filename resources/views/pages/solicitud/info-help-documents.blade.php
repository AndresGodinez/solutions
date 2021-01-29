<table id="table" class=" justify-content-center table-striped table-bordered" cellspacing="0" style="width:100%">
    <thead>
        <tr>
            <th>Información de ayuda</th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>
    <tbody>
            @foreach ($document as $document)
        <tr>
            <td><a href="{{url('ingexp/visor/'.$document->idregistro) }}" target="_blank" >{{$document->titulo}}</a></td>
        </tr>
            @endforeach
    </tbody>
</table>
