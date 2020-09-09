@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h2 class="text-center">Solicitud de información de producto</h2>
    </div>
    <div class="row">
        <p class="lead text-center">Información del producto</p>
    </div>
    <div class="row">
        <form action="">
            <div class="form-row">
                <div class="form-group">
                    <label for="dispatch">Dispatch</label>
                    <input type="text"
                           id="dispatch"
                           name="dispatch"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <label for="dispatch">Modelo</label>
                    <input type="text"
                           id="modelo"
                           name="modelo"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <label for="dispatch">Serie</label>
                    <input type="text"
                           id="serie"
                           name="serie"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text"
                           id="marca"
                           name="marca"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <label for="descripcionproblema">Descripción del problema</label>
                    <input type="text"
                           id="descripcionproblema"
                           name="descripcionproblema"
                           class="form-control"
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="ordenservicio">Orden de Servicio</label>
                    <input type="text"
                           id="ordenservicio"
                           name="ordenservicio"
                           class="form-control"
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="modofalla">Modo de Falla</label>
                    <select name="modofalla" id="modofalla" class="form-control">
                        <option value="">Seleccione una opción</option>
                        @foreach($modosFalla as $modoFalla)
                            <option value="{{}}"></option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="lineaproducto">Linea del producto</label>
                    <select name="lineaproducto" id="lineaproducto" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="tipoinformacion">Tipo de Información</label>
                    <select name="tipoinformacion" id="tipoinformacion" class="form-control">

                    </select>
                </div>
                <div class="form-group">
                    <label for="nombretecnico">Nombre del Técnico</label>
                    <input type="text"
                           id="nombretecnico"
                           name="nombretecnico"
                           class="form-control"
                    >
                </div>
                <div class="form-group">
                    <label for="telefonotecnico">Teléfono del Técnico</label>
                    <input type="text"
                           id="telefonotecnico"
                           name="telefonotecnico"
                           class="form-control"
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="comentario">Comentario</label>
                    <textarea name="comentario" id="comentario" cols="30" rows="3" class="form-control"></textarea>
                </div>
            </div>
        </form>
    </div>

</div>

@endsection
