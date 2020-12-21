@extends("layouts.app")

@section("content")

    <section id="basic-datatable">
        <div class="row">
            <div class="col-sm-12">
                <h2><strong>Alta de Partes - Descargar Reporte</strong></h2>
            </div>
        </div>
    </section>
    <div style="height: 30px;"></div>

    <div class="card">
        <div class="card-body">
            <form name='forma' action="{{ route('report-acoplar')}}" method='get'>
                @csrf
                <div class="row">
                    <div class="col-md-12 col-12 mt-2">
                        <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-error-circle"></i>
                                <span>
                                    &iexcl;Atención! El tiempo de descarga de este archivo es elevado.
                                </span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="modelo">Modelo</label>
                                <input type="text" id="modelo" name="modelo" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Descargar Reporte">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
