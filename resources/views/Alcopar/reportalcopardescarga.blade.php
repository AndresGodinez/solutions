@extends("layouts.app")

@section("content")

    <section id="basic-datatable">
        <div class="row">
            <div class="col-sm-12">
                <h2><strong>Descargar Reporte</strong></h2>
            </div>
        </div>
    </section>
    <div style="height: 30px;"></div>

    <div class="card">
        <div class="card-body">
            <form name='forma' action="{{ url('/alcopar/classat/guardar/')}}" id='formID' method='POST'>
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
                                                    Atención! El tiempo de descarga de este archivo es elevado.
                                                </span>
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <center>
                                <a class="btn btn-primary" value="" href="{{ url('/alcopar/reportalcopar')}}">Descargar
                                    Reporte</a>
                            </center>
                        </fieldset>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
