@extends("layouts.app")

@section("content")
<div class="modal" tabindex="-1" role="dialog" id="myModal">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-body">
		        
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		    </div>
	    </div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h2>Descarga de reporte</h2>
		</div>	
	</div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <h2>
                <strong>Reporte TS C4/CRM</strong>
            </h2>
        </div>
    </div>
    <div class="row">
        @foreach($data as $data)
        <div class="col-sm-4">
            <div style="background: #C3C3C3; padding: 15px; border: 1px solid #333333; border-radius: 4px;">
                <strong>Nombre reporte: </strong> {{ $data->report_label_name }} <br />
                <strong>Mes: </strong> {{ $data->month }} <br />
                <strong>No reg: </strong> {{ $data->report_n_reg  }} <br />
                <strong>Fecha actualización: </strong> {{ $data->updated_at  }}
            </div>
            <a href="{{ url('pago-a-talleres/reporte-ts-crm/download/ts/'.$data->report_label_name.'.csv') }}" class="btn btn-primary" target="_blank">
                Descargar Archivo {{ $data->report_label_name }}
            </a>
        </div>
        @endforeach
    </div>    
      <div class="pagotaller">
          
           
      </div>
    </div>
    <div class="col-sm-4 text-right">
      @if(isset($log[0]->completed) && $log[0]->completed == 1)
      <?php 
      $old_date = date($log[0]->end_process);
      $new_date = date('Y-m-d', strtotime($old_date));
      ?>
      <a href="{{ url('pago-a-talleres/reporte-ts-crm/download/ts/reporte-ts-'.$new_date.'.csv') }}" class="btn btn-primary" target="_blank">
        Descargar Archivo {{ $log[0]->end_process }}
      </a>
      @endif
    </div>
  </div>
</div>
<hr>
<hr>
<div style="height: 60px;"></div>
@endsection


