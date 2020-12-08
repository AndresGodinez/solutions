<table id="table_questions_exists" class=" justify-content-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Pregunta</th>
            <th>Comentario</th>
            <th>Archivo adjunto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tfoot>
    </tfoot>
    @foreach ($question as $question)
    <tbody>
        <tr>
            <td><label>{{$question->pregunta}}</label>
            <td><label>{{$question->tooltip}}</label></td>
            <td><label>{{$question->tipo}}</label></td>
            <td>
                <a onclick="EditQuestions({{$question->id_pregunta}})" data-toggle="modal" data-target="#myModal" data-original-title="Editar" class="btn btn btn-default btn-lg">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
