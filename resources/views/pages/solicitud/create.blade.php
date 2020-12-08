@extends("layouts.app")

@section("content")
	<div class="text-center">
		<div class="card-body">
			<h4 class="card-title">{{ config('Pages.solicitud.title') }}</h4>
			<h6 class="card-subtitle mb-2 text-muted">{{ config('Pages.solicitud.subtitle') }}</h6>
			<form method="post" id="form-sol" enctype="multipart/form-data">
			@csrf
        <div id="datosgenerales" class="row mb-4 mt-3">
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.dispatch') }}</div>
                    <div class = "col-md-12 p-2 striped"><input autofocus type="text" name="dispatch" id="dispatch" class="form-control" {{ ($region != 1) ? 'readonly ':''}} value="{{$dispatch}}" onchange="search()"></div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.model') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="model" id="model" class="form-control" onchange="info_help()"></div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.serie') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="serie" id="serie" class="form-control" ></div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.brand') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="brand" id="brand" class="form-control" ></div>
            </div>
            <div class="col-md-4 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.problem') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="problem" id="problem" class="form-control" ></div>
            </div>
        </div>

        @if($region != 1)
        <div id="datosgenerales" class="row mb-4 mt-3">
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">Orden de Servicio</div>
                    <div class = "col-md-12 p-2 striped"><input autofocus type="text" name="os_cca" id="os_cca" class="form-control" value=""></div>
            </div>
        </div>
        @endif
        <div id="datosgenerales" class="row mb-4 mt-3">
            <div class="col-md-3 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.fail') }}</div>
                    <div class = "col-md-12 p-2 striped">
                    <select name="fail" id="fail" class="form-control" onchange="questions()" >
									<option value=""> Seleccione </option>
									@foreach ($mode_fail as $mode_fail)
										<option value="{{ $mode_fail->id_modofalla }}">{{ $mode_fail->modo_falla }}</option>
									@endforeach
								</select>
                    </div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.line') }}</div>
                    <div class = "col-md-12 p-2 striped">
                    <select name="line" id="line" class="form-control" onchange="questions()" >
									<option value=""> Seleccione </option>
                                    @foreach ($line as $line)
										<option value="{{ $line->id }}">{{ $line->linea }}</option>
									@endforeach
								</select>
                    </div>
            </div>
            <div class="col-md-3 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.type') }}</div>
                    <div class = "col-md-12 p-2 striped">
                    <select name="information" id="information" class="form-control" onchange="questions()" >
									<option value=""> Seleccione </option>
									@foreach ($information as $information)
										<option value="{{ $information->id }}">{{ $information->informacion }}</option>
									@endforeach
								</select>
                    </div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.name') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="name" id="name" class="form-control" ></div>
            </div>
            <div class="col-md-2 p-0 border">
                    <div class = "col-md-12 p-3 font-weight-bold">{{ config('Pages.solicitud.table.phone') }}</div>
                    <div class = "col-md-12 p-2 striped"><input type="text" name="phone" id="phone" class="form-control" onkeypress="isInputNumber(event)"></div>
            </div>
        </div>

				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label>{{ config('Pages.solicitud.table.comment') }}</label>
							<textarea id="comment" name="comment"class="form-control" rows="4"></textarea>
						</div>
						<div class="form-group">
							<label>{{ config('Pages.solicitud.table.file') }}</label>
							<input type="file" name="file" id="file">
						</div>
					</div>
					<div id="help" class="col-md-4"></div>
					<div id="faqs" class="col-md-3"></div>
				</div>
				<hr>
				<div class="row">
					<h4 class="card-title">{{ config('Pages.solicitud.table.info') }}</h4>
				</div>
				<input id="_questions" name="_questions" type="hidden" value="">
				<div class="row" id="info-solicitud"></div>
				<div class="card-footer bg-transparent">
					<div class="form-group text-center">
						<div class="col-lg-2 col-md-4 float-right">
							<button type="submit" id="save">{{ config('Pages.solicitud.table.save') }}</button>
						</div>
						<div class="col-lg-2 col-md-4 float-right">
							<button type="button" id="saved" onclick="salvado()">{{ config('Pages.solicitud.table.doubt') }}</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@section('scripts')
<script type="text/javascript">
function search(){
	var data =
	{
		dispatch:	$("#dispatch").val(),
	}
	$.ajax({
		url: "{{ url('solicitud/search') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		type: 'POST',
		data: data,
		success: function( data )
		{
			if( data.ok != false)
			{
				document.getElementById('model').value = data.data_search['modelo'];
				document.getElementById('serie').value = data.data_search['serie'];
				document.getElementById('brand').value = data.data_search['marca'];
				document.getElementById('problem').value = data.data_search['descripcion_problema'];
				info_help();
			}
			else
			{
                document.getElementById('model').value = '';
				document.getElementById('serie').value = '';
				document.getElementById('brand').value = '';
				document.getElementById('problem').value = '';
                var msj = data.message ? data.message:'{{ config('Pages.solicitud.scripts.succcess.without_data') }}';
				showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}',msj, 'warning');
			}
		},
		error: function(jq,status,message)
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}','{{ config('Pages.solicitud.scripts.errors.db') }}', 'error');
		}
	});
}
function salvado(){
	var data =
	{
		dispatch:	$("#dispatch").val(),
		model:		$("#model").val(),
		fail:		$("#fail").val(),
		serie:		$("#serie").val(),
		problem:	$("#problem").val(),
		line:		$("#line").val(),
		information:$("#information").val(),
		phone:		$("#phone").val(),
		name:		$("#name").val(),
	}
	$.ajax({
		url: "{{ url('solicitud/saved') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		type: 'POST',
		data: data,
		success: function( data )
		{
			if( data.ok != false)
			{
				showNotification('success',data.message, 'success');
				setTimeout(function(){
					location.reload();
				}, 5000);
			}
			else
			{
				showNotification('warning','Problemas al cargar los datos', 'warnig');
			}
		},
		error: function(jq,status,message)
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}','{{ config('Pages.solicitud.scripts.errors.db') }}', 'error');
		}
	});
}

function info_help(){
	var data =
	{
		model:	$("#model").val(),
	}
	$.ajax({
		url: "{{ url('solicitud/info-help-documents') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		type: 'POST',
		data: data,
		success: function( data )
		{
			if( data.html != '')
			{
				$('#help' ).html( data.html );
			}
			else
			{
				showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.succcess.no_info') }}', 'warning');
				$('#help' ).html( '<div></div>' );
			}
		},
		error: function(jq,status,message)
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.errors.db') }}', 'error');
			$('#help' ).html( '<div></div>' );
		}
	});

    $.ajax({
		url: "{{ url('solicitud/info-solved-cases') }}",
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
		type: 'POST',
		data: data,
		success: function( data )
		{
			if( data.html != '')
			{
				$('#faqs' ).html( data.html );
			}
			else
			{
				showNotification('Error',"Sin informacion de ayuda.", 'warning');
				$('#faqs' ).html( '<div></div>' );
			}
		},
		error: function(jq,status,message)
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.errors.db') }}', 'error');
			$('#faqs' ).html( '<div></div>' );
		}
	});
}

function validateForm()
{
	var inputs = [ 'dispatch', 'model', 'serie', 'brand', 'problem', 'fail', 'line', 'information', 'name', 'phone', 'comment', 'file'];

	const keys = Object.keys(inputs);
	var questions_validis = 0;
	var inputs_validis    = 0;

	inputs.forEach(function(element)
	{
		var action = ( $("#"+element).val() != '' ) ? 'remove' : 'add';
		removeOrAddStyleClass(element,style='is-invalid', action);
		if( $("#"+element).val() != '' ) inputs_validis++;
	});
	var inputs_dynamics = validateDynamicsInputs();
	return ( inputs_validis == inputs.length && inputs_dynamics == true );
}


function validateDynamicsInputs(){
    var invalids = 0;
    var divs = $("#info-solicitud").find("div");
    if(divs.length==0)
        return true;
    $.each(divs,function(i,x){
        var inputs = $(x).find("input");
        $.each(inputs,function(key,value){
            var input = $(value);
            var isvalid  = input.val() != ''
            switch(input.attr('type')){
                case 'file':
                    var s = $(x).find("span");
                    if(isvalid)
                        s.addClass('hidden');
                    else{
                        s.removeClass('hidden');
                        invalids ++;
                    }
                    break;
                case 'text':
                    if(isvalid)
                        input.removeClass('is-invalid');
                    else{
                        input.addClass('is-invalid');
                        invalids ++;
                    }
                    break;
            }
        });

    });
    return invalids == 0;
}

function questions(){
	var fail,line,information;
	$('#_questions').val( '' );
	removeOrAddStyleClass(element='fail',style='is-invalid', action='remove');
	removeOrAddStyleClass(element='line',style='is-invalid', action='remove');
	removeOrAddStyleClass(element='information',style='is-invalid', action='remove');
	if( $("#fail").val() == '' ){ removeOrAddStyleClass(element='fail',style='is-invalid', action='add'); fail=false; }
	if( $("#line").val() == '' ){ removeOrAddStyleClass(element='line',style='is-invalid', action='add'); line=false; }
	if( $("#information").val() == '' ){ removeOrAddStyleClass(element='information',style='is-invalid', action='add'); information=false; }

	if( fail == false || line == false || information == false )
	{
		var container = document.getElementById('info-solicitud');
		while (container.hasChildNodes()){ container.removeChild(container.lastChild); }
		return false;
	}
	if( $("#fail").val() != '' && $("#line" ).val() != '' && $("#information").val() != '' )
	{
		var data = { id_fail: $("#fail").val(), id_line: $("#line" ).val(), id_info: $("#information").val(), }
		$.ajax({
			url: "{{ url('solicitud/questions') }}",
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
			type: 'POST',
			data: data,
			success: function( data )
			{
				if( data.html != '' )
				{
					var data_string = data.html;
					$('#_questions').val( JSON.stringify(data_string) );
					addNewCustomInput( data.html, 'info-solicitud' );
                    showNotification('{{ config('Pages.solicitud.scripts.questions.form') }}','{{ config('Pages.solicitud.scripts.questions.succcess') }}', 'info');
                    $('#info-solicitud input[type=file]').on("change", function(){ uploadfile(this); })
				}
				else
				{
					showNotification('{{ config('Pages.solicitud.scripts.questions.without') }}', '{{ config('Pages.solicitud.scripts.questions.error') }}', 'warning');
					var container = document.getElementById('info-solicitud');
					while (container.hasChildNodes()){ container.removeChild(container.lastChild); }
					return false;
				}
			},
			error: function(jq,status,message){ showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.errors.db') }}', 'error'); }
		});
	}
	else{ return false; }
}

function uploadfile(input){
    var formdt = new FormData();
      var parent = $(input).parent();
      var doc = $(input)[0].files[0];
      var label = parent.find("label");

      ignoreLoading = true;

      if(!doc){
         return false;
      }
      label.addClass('progress-bar progress-bar-striped progress-bar-animated');
      var hidden = parent.find("[type=hidden]");
      var campo = this.name;
      formdt.append('documento', doc, doc.name);
      formdt.append('campo', campo);

     //debugger;
      $.ajax({
         url: "{{ url('solicitud/subir') }}",
         method: 'POST',
         data: formdt,
         dataType: 'JSON',
         contentType: false,
         cache: false,
         processData: false,
         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }


      }).done(function(data){
         if(!data.errors){
            hidden.val(data.documento);
         }else{
            showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.fileError') }}'+  data.message, 'error');
         }
         label.removeClass('progress-bar progress-bar-striped progress-bar-animated');
      }).fail(function(jqXHR){
         var mensaje = '';
         var errors = [];
         if(jqXHR.responseJSON){
            if(jqXHR.responseJSON.errors){
               err = jqXHR.responseJSON.errors;
               for(var i in err){
                  errors.push(err[i]);
               }
               mensaje = errors.join(', ');
            }else{
               if(jqXHR.responseJSON.message){
                  jqXHR = jqXHR.responseJSON.message;
               }
            }
         }
         showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.fileError') }}'+ mensaje, 'error');
         label.removeClass('progress-bar progress-bar-striped progress-bar-animated');
      });


}

$(document).ready(function()
{
	$('#form-sol').on('submit', function(event)
	{
		event.preventDefault();
		var ok = validateForm();
		if( ok )
		{
			$.ajax({
				url:"{{ url('solicitud/create') }}",
				method:"POST",
				data:new FormData(this),
				dataType:'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success:function(data)
				{
					var message = ( !data.message ) ? '{{ config('Pages.solicitud.scripts.form.success') }}' : data.message;
					var ok 		= ( !data.ok ) ? 'success' : data.ok;
					showNotification('{{ config('Pages.solicitud.scripts.notifications.title.form') }}', message, ok);
                    showNotification('Dispatch creado', data.dispatch, ok);
					$('#form-sol').trigger("reset");
					$('#help' ).html( '<div></div>' );
					$('#faqs' ).html( '<div></div>' );
					$('#info-solicitud').html( '<div></div>' );

				},
				error: function(jq,status,message){ showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.form.error') }}', 'error'); }
			})
		}
		else
		{
			showNotification('{{ config('Pages.solicitud.scripts.notifications.title.error') }}', '{{ config('Pages.solicitud.scripts.form.invalid') }}', 'error');
		}
	});
});
</script>
@endsection
@endsection
