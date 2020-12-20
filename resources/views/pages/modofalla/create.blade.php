@extends("layouts.app")

@section("content")
<a href="{{ url('solicitudes-a-ingenieria/modo-falla') }}" class="float">
	<i class="fa fa-backward button-float"></i>
</a>
<div class="text-center">
	<div class="card-body">
		<h4 class="card-title">Modo de Falla</h4>
		<h6 class="card-subtitle mb-2 text-muted">Edicion de Modo de Falla</h6>
		<br>
		<div class="row d-flex justify-content-center">
			<div class="card bg-light mb-3" style="width: 18rem;">
				<div class="card-header">Nuevo modo de falla</div>
				<div class="card-body">
					<h6 class="card-subtitle mb-2 text-muted">Crear un nuevo modo de falla</h6>
					<form class="form-inline justify-content-center" id="form-dispatch" enctype="multipart/form-data" method="post" action="{{ url('solicitudes-a-ingenieria/modo-falla/create-new-mode') }}" onsubmit="event.preventDefault(); send('mode');">
						@csrf
						<div class="row d-flex justify-content-center">
							<input type="text" name="modo_falla" id="modo_falla" placeholder="Nuevo modo de falla" required>
						</div>
						<div class="card-footer bg-transparent">
							<div class="row justify-content-center">
								<button type="submit" id="cancel">Agregar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<form class="justify-content-center" id="form-dispatch-questions" enctype="multipart/form-data" method="post" action="{{ url('solicitudes-a-ingenieria/modo-falla/create') }}" onsubmit="event.preventDefault(); send('questions');">
			@csrf
			<div class="row d-flex justify-content-center">
				<div class="col-md-3">
					<div class="form-group">
						<label for="fail">Modo de Falla</label>
                        {{Form::select('fail',$mode_fail,null ,array('id' => 'fail','required'=>'required','class' => 'form-control') )}}
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="information">Tipo de Informacion</label>
                        {{Form::select('information',$information,null ,array('id' => 'information','required'=>'required','class' => 'form-control') )}}
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="line">Linea de producto</label>
                        {{Form::select('line',$line,null ,array('id' => 'line','required'=>'required','class' => 'form-control') )}}
					</div>
				</div>
			</div>
			<br>
			<hr>
			<br>
			<h4 class="card-title">Nuevas preguntas</h4>
			<br>
			<table id="table_questions" class=" justify-content-center display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>{{ config('pages.modofalla.view.index.popup.label_question') }}</th>
						<th>{{ config('pages.modofalla.view.index.popup.label_comment') }}</th>
						<th>{{ config('pages.modofalla.view.index.popup.label_tipo') }}</th>
					</tr>
				</thead>
				<tfoot>
				</tfoot>
				<tbody>
					<tr>
						<td><input type="text" name="question-1" id="question-1" class="form-control"></td>
						<td><input type="text" name="tooltip-1" id="tooltip-1" class="form-control"></td>
						<td>
                        {{Form::select('filetype-1',$questionType,null ,array('id' => 'filetype-1','required'=>'required','class' => 'form-control') )}}
                        </td>
					</tr>
				</tbody>
			</table>
			<div class="form-group">
				<button type="button" onclick="addRow()">Agregar Fila</button>
				<button type="button" onclick="deleteRow()">Eliminar Fila</button>
			</div>
			<div class="card-footer bg-transparent">
				<div class="form-group text-center">
					<div class="col-lg-2 col-md-4 float-right">
                        <button type="submit" id="save" class="">Guardar</button>
                    </div>
                </div>
			</div>
		</form>
		<hr>
	</div>
</div>
@section('scripts')
<script>
	function addRow(){
		var table = document.getElementById("table_questions");
		var rowCount = table.rows.length;
		var newline = '<td><input type="text" name="question-'+rowCount+'" id="question-'+rowCount+'" class="form-control"></td>'+
			'<td><input type="text" name="tooltip-'+rowCount+'" id="tooltip-'+rowCount+'" class="form-control"></td>'+
			'<td>{{Form::select('filetype-{rowCount}',$questionType,null ,array('id' => 'filetype-{rowCount}','required'=>'required','class' => 'form-control') )}}</td>';
        table.insertRow(-1).innerHTML = newline.replace("{rowCount}", rowCount);
	}
	function deleteRow(){
		var table = document.getElementById("table_questions");
		var rowCount = table.rows.length;
		if(rowCount <= 1)
			alert('No se puede eliminar el encabezado');
		else
			table.deleteRow(rowCount -1);
	}
	function checkValues()
	{
		var table = document.getElementById("table_questions");
		var rowCount = table.rows.length - 1;
		var questions = [ ];
		for (var i = 1; i <= rowCount; i++)
		{
			var question = "question-"+i;
			var tooltip  = "tooltip-"+i;
			var filetype = "filetype-"+i;
			var newElement = {};

			removeOrAddStyleClass(element=question,style='is-invalid', action='remove');
			removeOrAddStyleClass(element=tooltip,style='is-invalid', action='remove')
			if( !$("#"+question).val() ) removeOrAddStyleClass(element=question,style='is-invalid', action='add');
			if( !$("#"+tooltip).val() ) removeOrAddStyleClass(element=tooltip,style='is-invalid', action='add');
			if( $("#"+question).val() && $("#"+tooltip).val() )
			{
				newElement['question'] = $("#"+question).val();
				newElement['tooltip']  = $("#"+tooltip).val();
				newElement['filetype'] = $("#"+filetype).val();
				questions.push(newElement);
			}
		}
		var values = ( rowCount == questions.length) ? questions : false;
		return values;
	}
</script>
<script type="text/javascript">
	function fillSelect( input_id = null, id_element_to_fill, model )
	{
		id = ( input_id != null ) ? $( "#"+input_id ).val() : '';
		$('#'+id_element_to_fill ).html( '<option value=""> Cargando... </option>' );
		$.ajax({
			url: "{{ url('solicitudes-a-ingenieria/modo-falla/get_content_by_id') }}" + "?id=" + id + "&m=" + model,
			method: 'GET',
			success: function( data )
			{
				$('#'+id_element_to_fill ).html( data.html );
			},
			error: function(jq,status,message)
			{
				alert('Error al cargar datos...');
			}
		});
	}
</script>
<script type="text/javascript">
function send( form )
{
	if( form == 'mode' )
	{
		var data =
		{
			modo_falla:  $("#modo_falla").val(),
		}
		var url = "{{ url('solicitudes-a-ingenieria/modo-falla/create-new-mode') }}";
	}
	if( form == 'questions' )
	{
		var values = checkValues();
		if( !values )
		{
			showNotification('Error', 'Por favor llena los campos indicados','error');
			return;
		}
		var data =
		{
			fail: 		$("#fail").val(),
			line:		$("#line").val(),
			information:	$("#information").val(),
			questions:  values,
		}
		var url = "{{ url('solicitudes-a-ingenieria/modo-falla/create') }}";
	}
	$.ajax({
		type: "POST",
		url: url,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		data: data,
		success: function( data )
		{
			var message = ( !data.message ) ? 'Creado Correctamente' : data.message;
			var ok 		= ( !data.ok ) ? 'success' : data.ok;
			showNotification('Mode de Falla',message, ok);
			$('#form-dispatch-questions').trigger("reset");
			if( form == 'mode' ){ fillSelect(null,'fail','mode'); }
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) { showNotification('Warning', 'Al parece algo salio mal, intenta más tarde y/o notifica a sistemas', 'error'); }
	});
}
</script>
@endsection
@endsection
