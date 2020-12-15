@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <div class="card-title">
                        Impresión de Etiquetas
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        {{ $material->descripcion . $material->material }}
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h5>Datos del material</h5>
                        <form action="{{ route('impresion.etiquetas.print') }}" method="post" id="form">
                            @csrf
                            <input type="hidden" name="material-to-print" value="{{ $material->material }}">
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="material">Número de parte</label>
                                    <input type="text"
                                           id="material"
                                           name="material"
                                           class="form-control"
                                           required
                                           disabled
                                           value="{{ $material->material }}"
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="mat_descript">Descripción</label>
                                    <input type="text"
                                           id="mat_descript"
                                           name="mat_descript"
                                           class="form-control"
                                           required
                                           {{ $material->descripcion == '' ? '' : 'disabled' }}
                                           value="{{ $material->descripcion }}"
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="pieces">Piezas</label>
                                    <input type="number"
                                           id="pieces"
                                           name="pieces"
                                           class="form-control"
                                           value="{{ 1 }}"
                                           required
                                    >
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="quantity">Cantidad de etiquetas</label>
                                    <input type="number"
                                           id="quantity"
                                           name="quantity"
                                           class="form-control"
                                           required
                                           value=''
                                    >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <button onclick="sendText()" class="btn btn-info">Imprimir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let exampleSocket = new WebSocket("ws://127.0.0.1:8001");
        $("#form").submit(function(e){
            e.preventDefault();
        });

        function sendText(){
            let description = $('#mat_descript').val();
            let pieces = $('#pieces').val();
            let material = $('#material').val();
            let quantity = $('#quantity').val();
            if (quantity == '')
                quantity = 1

            let sendData = [];
            let data = {
                pieces,
                material,
                description,
                date: '{{ Carbon\Carbon::now()->format('d-m-Y H:s') }}',
            };

            for (let i=0; i<parseInt(quantity); i++){
                sendData.push(data);
            }

            console.log({'text': JSON.stringify(sendData)});

            exampleSocket.send(JSON.stringify(sendData))
        }
    </script>

@endsection
