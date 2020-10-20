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

<section id="nav-filled">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong><i>**NOTA</i></strong> El archivo TIENE QUE SER en formato <strong>.CSV</strong>  para todas las cargas
            </div>
            <div class="card">
                <div class="card-header">
                <i>    <center><h3 class="card-title">Carga de datos</h3></center></i>
                </div>
                <hr>
                <div class="card-content">
                    <div class="card-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item current">
                                <a class="nav-link active" id="home-tab-fill" data-toggle="tab" href="#home-fill" role="tab" aria-controls="home-fill" aria-selected="true">
                                    Stock Inicial (ING)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">
                                    Conclusión de Stock Inicial (ISC)
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="messages-tab-fill" data-toggle="tab" href="#messages-fill" role="tab" aria-controls="messages-fill" aria-selected="false">
                                    Stock Final
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="settings-tab-fill" data-toggle="tab" href="#settings-fill" role="tab" aria-controls="settings-fill" aria-selected="false">
                                    Conclusión de Stock Final (ISC)
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content pt-1">
                            <div class="tab-pane active" id="home-fill" role="tabpanel" aria-labelledby="home-tab-fill">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('stocks/process/stock-inicial') }}">
                                    {{ csrf_field() }}
                                    <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Stock Inicial</mark></strong> (ING)</h4>

                                    <div class="custom-file">
                                        <input type="file"  name="file" class="custom-file-input" id="file" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Elija el archivo</label>
                                    </div>
                                    {{-- <input type="file" id="file" name="file" class="form-control form-control-input-file"/> --}}
                                 <div style="height: 15px;"></div>
                                 <br>
                                 <center>
                                    <button class="btn btn-success" type="submit">Subir archivo</button>
                                 </center>
                             </form>
                            </div>
                            <div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('stocks/process/stock-inicial-isc') }}">
                                    {{ csrf_field() }}
                                    <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para la Conclusión de <strong><mark>Stock Inicial</mark></strong> (ISC)</h4>
                                 <input type="hidden" name="k" value="upload_file_inicial_isc" />

                                 <div class="custom-file">
                                    <input type="file"  name="file" class="custom-file-input" id="file" required>
                                    <label class="custom-file-label" for="inputGroupFile01">Elija el archivo</label>
                                </div>
                                 <div style="height: 15px;"></div>
                                 <center>
                                    <button class="btn btn-success" type="submit">Subir archivo</button>
                                 </center>
                             </form>
                            </div>
                            <div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('stocks/process/stock-final') }}">
                                    {{ csrf_field() }}
                                    <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para <strong><mark>Stock Final</mark></strong> (ING)</h4>
                                      <input type="hidden" name="k" value="upload_file_final_ing" />

                                      <div class="custom-file">
                                        <input type="file"  name="file" class="custom-file-input" id="file" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Elija el archivo</label>
                                    </div>
                                      <div style="height: 15px;"></div>
                                      <center>
                                    <button class="btn btn-success" type="submit">Subir archivo</button>
                                 </center>
                                  </form>
                            </div>
                            <div class="tab-pane" id="settings-fill" role="tabpanel" aria-labelledby="settings-tab-fill">
                                <form method="POST" enctype="multipart/form-data" action="{{ url('stocks/process/stock-final-isc') }}">
                                    {{ csrf_field() }}
                                    <h4 style="margin-bottom: 15px;">Aquí cargaras el archivo para la Conclusión de <strong><mark>Stock Final</mark></strong> (ISC)</h4>
                                      <input type="hidden" name="k" value="upload_file_final_isc" />

                                      <div class="custom-file">
                                        <input type="file"  name="file" class="custom-file-input" id="file" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Elija el archivo</label>
                                    </div>
                                      <div style="height: 15px;"></div>
                                      <center>
                                    <button class="btn btn-success" type="submit">Subir archivo</button>
                                 </center>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script>
<?php 
if(@$_GET['success'] == 1){ ?>
    Swal.fire({
                            type: "success",
                            title: '¡Carga realizada con éxito!',
                            text: '',
                            confirmButtonClass: 'btn btn-success',
                        });
    <?php
} ?>
<?php 
if(@$_GET['error'] == 1){ ?>
    Swal.fire({
            type: "error",
            title: '¡Error en la carga!',
            text: 'Este tipo de archivo no está permitido',
            confirmButtonClass: 'btn btn-danger',
        });
    <?php
} ?>

<?php 
if(@$_GET['error'] == 2){ ?>
    Swal.fire({
            type: "error",
            title: '¡Error en la carga!',
            text: 'Archivo mal formateado.',
            confirmButtonClass: 'btn btn-danger',
        });
    <?php
} ?>
</script>

@endsection


