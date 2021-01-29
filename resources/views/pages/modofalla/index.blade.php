@extends("layouts.app")

@section("content")
<div class="text-center">
	<div class="card-body">
		<h4 class="card-title">{{ config('Pages.modofalla.view.index.title') }}</h4>
		<br>
		<form class="justify-content-center" id="form-dispatch" enctype="multipart/form-data" method="post" action="{{ url('solicitudes-a-ingenieria/modo-falla/create') }}" onsubmit="event.preventDefault(); questions();">
			@csrf
			<div class="row d-flex justify-content-center">
				<div class="col-md-4">
					<div class="form-group">
						<label for="fails">{{ config('Pages.modofalla.view.index.form.fail') }}</label>
						<select name="fails" id="fails" class="form-control" required>
							<option value=""> {{ config('Pages.modofalla.view.controls.empty_select') }} </option>
							@foreach ($mode_fail as $fails)
								<option value="{{ $fails->id_modofalla }}">{{ $fails->modo_falla }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="line">{{ config('Pages.modofalla.view.index.form.line') }}</label>
						<select name="line" id="line" class="form-control" required>
							<option value=""> {{ config('Pages.modofalla.view.controls.empty_select') }} </option>
							@foreach ($line as $line)
								<option value="{{ $line->id }}">{{ $line->linea }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="information">{{ config('Pages.modofalla.view.index.form.type') }}</label>
						<select name="information" id="information" class="form-control" required>
							<option value=""> {{ config('Pages.modofalla.view.controls.empty_select') }} </option>
							@foreach ($information as $information)
								<option value="{{ $information->id }}">{{ $information->informacion }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class=" justify-content-center">
				<div class="form-group">
					<button type="submit">{{ config('Pages.modofalla.view.index.form.button') }}</button>
				</div>
			</div>
		</form>
		<hr>
		<h4 class="card-title">{{ config('Pages.modofalla.view.index.subtitle') }}</h4>
		<br>
			<div id="questions"></div>
		<hr>
	</div>
</div>

<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-keyboard="true"  tabindex="-1">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		<h4 class="modal-title">{{ config('Pages.modofalla.view.index.popup.title_edit') }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<form id="question_edit" method="post" enctype="multipart/form-data" >
				<input id="id_question" name="id_question" type="hidden">
				<div class="form-group">
					<label for="question">{{ config('Pages.modofalla.view.index.popup.label_question') }}</label>
					<input type="text" name="question" id="question" class="form-control">
				</div>
				<div class="form-group">
					<label for="tooltip">{{ config('Pages.modofalla.view.index.popup.label_comment') }}</label>
					<input type="text" name="tooltip" id="tooltip" class="form-control">
				</div>
                <div class="form-group">
                <label for="questionType">{{ config('Pages.modofalla.view.index.popup.label_tipo') }}</label>
                {{Form::select('questionType',$questionType,null,array('id' => 'questionType','required' => 'required','class' => 'form-control') )}}
                 </div>
				<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ config('Pages.modofalla.view.index.popup.cancel') }}</button>
					<button type="submit" class="btn btn-success" id="save">{{ config('Pages.modofalla.view.index.popup.button') }}</button>
				</div>
			</form>
        </div>
      </div>
    </div>
  </div>
</div>


@section('scripts')
<script>
	function EditQuestions(id_question){
		var data =
		{
			id_question:	id_question,
		}
		$.ajax({
			url: "{{ url('solicitudes-a-ingenieria/modo-falla/search-one') }}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			data: data,
			success: function( data )
			{
				if( data.ok != false)
				{
					document.getElementById('id_question').value = id_question;
					document.getElementById('question').value = data.data_search['question'];
                    document.getElementById('tooltip').value = data.data_search['tooltip'];
					document.getElementById('questionType').value  = data.data_search['tipo'] ;
				}
				else
				{
					showNotification('Error','{{ config('Pages.modofalla.view.scripts.succcess.without_data') }}', 'warning');
				}
			},
			error: function(jq,status,message)
			{
				showNotification('Error',"Error al cargar datos...", 'error');
			}
		});
	}
	function agregarFila(){
		document.getElementById("table_preguntas").insertRow(-1).innerHTML = '<td><input type="text" name="pregunta" id="pregunta" class="form-control"></td>'+
			'<td><input type="text" name="tooltip" id="tooltip" class="form-control"></td>'+
			'<td><input type="checkbox" name="type" id="type" value="archivo" style="width: 16px; height: 16px;"></td>';
	}
	function eliminarFila(){
		var table = document.getElementById("table_preguntas");
		var rowCount = table.rows.length;
		if(rowCount <= 1)
			alert('No se puede eliminar el encabezado');
		else
			table.deleteRow(rowCount -1);
	}

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

    function questions ()
    {
        var data =
        {
            id_fallo: 			$("#fails").val(),
            id_lineaproducto:	$("#line" ).val(),
            id_tiposolicitud:	$("#information").val(),
        }
        $.ajax({
            url: "{{ url('solicitudes-a-ingenieria/modo-falla/questions') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: 'POST',
            data: data,
            success: function( data )
            {
                $('#questions' ).html( data.html );
            },
            error: function(jq,status,message)
            {
                alert('Error al cargar datos...');
            }
        });
    }
    $(document).ready(function(){
        $( "#question_edit" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('solicitudes-a-ingenieria/modo-falla/update') }}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: $(this).serialize(),
                success: function( data )
                {
                    var message = ( !data.message ) ? 'Creado Correctamente' : data.message;
                    var ok 		= ( !data.ok ) ? 'success' : data.ok;
                    showNotification('Mode de Falla',message, ok);
                    $('#myModal').modal('hide')
                    questions ();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { showNotification('Warning', 'Al parece algo salio mal, intenta más tarde y/o notifica a sistemas', 'error'); }
            });
        });
    });
</script>
@endsection
@endsection
