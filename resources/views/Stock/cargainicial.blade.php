@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('assets') }}/jsdropzone/jsdropz.min.css">



<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <center>
                        <h2 class="card-title"><i>Reporte Stock Inicial</i></h2>
                        <p><i>Formato <code>CSV</code> | Stock Inicial</i> </p>
                    </center>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard jsdzformcargando">

                        <form method="post" action="{{ url('stock/cargainicialapi')}}" enctype="multipart/form-data" novalidate id="jsteste" class="jsdropz" style="display: block; height:25vw; ">
                            <input type="hidden" name="action" value='CargaMasiva_Subir'>
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="lang" class="valorlang" value="">
                            <div class="jsdropz__input">
                                <input type="file" name="archivo_csv" id="file" class="jstesteinp" accept=".csv" class="jsdropz__file" data-multiple-caption="{count} files selected" multiple style=" display:none;" />
                                <center>
                                    <label for="file"><strong style=" cursor: pointer">Elija su archivo</strong><span class="jsdropz__dragndrop"> o arrástrelo
                                            aquí</span>.</label>
                                </center>
                            </div>
                        </form>
                    </div>
                    <div class="card-body card-dashboard jsdzformcargado" style="display: none;">
                        <center>
                            <style>
                                .spinner-border {
                                    display: inline-block;
                                    width: 10rem;
                                    height: 10rem;
                                    }
                            </style>
                            <div class="spinner-border text-danger" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </center>
                    </div>

                    <div class="card-body card-dashboard jsdzlisto" style=" display:none;">
                        <center>
                            <span class="bx bx-check chat-sidebar-toggle chat-start-icon p-3 mb-1 success" style="font-size: 200px;"></span>
                        </center>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('assets') }}/jsdropzone/jsdropz.min.js"></script>
<script>
    

    $("#jsteste").JSdropz({
        callback: function(ajax, data, respuesta) {
            $('.jsdzformcargado').hide();
            $('.jsdzlisto').show();
            console.log(respuesta);
            
        }
    });
</script>
@endsection