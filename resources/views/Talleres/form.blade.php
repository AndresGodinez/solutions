@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container">
            <h5>
                @if(!$taller->id)
                  Nuevo 
                @else
                  Editar 
                @endif
                Taller
            </h5>
        </div>
    </div>


    <div class="container">

        <form action="{{ ($taller->taller) ? route('taller.update') : route('taller.store') }}" method="post">
            @csrf
            {{ ($taller->taller) ? method_field('PUT') : method_field('POST') }}
            


            <h6 class="pt-2 font-weight-bold">INFORMACIÓN DEL TALLER</h6>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="taller_taller">NÚMERO TALLER </label>
                    <input type="text"
                           id="taller_taller"
                           name="taller[taller]"
                           class="form-control"
                           value="{{ $taller->taller }}" 
                    >
                    <input type="hidden"
                           id="id"
                           name="taller[id]"                          
                           value="{{ $taller->id }}" 
                    >
                    <input type="hidden"
                           id="taller_tmp"
                           name="taller_tmp"                          
                           value="{{ $taller->taller }}" 
                    >
                    <input type="hidden"
                           id="taller_info_taller"
                           name="taller_info[taller]"                
                           value="{{ $taller_info->taller }}" 
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="taller_nombre">NOMBRE TALLER</label>
                    <input type="text"
                           id="taller_nombre"
                           name="taller[nombre]"
                           class="form-control"
                           value="{{ $taller->nombre }}" 
                    >
                </div>
                <div class="form-group col-md-5">
                    <label for="taller_info_correo">CORREO</label>
                    <input type="text"
                           id="taller_info_correo"
                           name="taller_info[correo]"
                           class="form-control"
                           value="{{ $taller_info->correo }}" 
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="taller_info_direccion">DIRECCIÓN </label>
                    <input type="text"
                           id="taller_info_direccion"
                           name="taller_info[direccion]"
                           class="form-control"
                           value="{{ $taller_info->direccion }}" 
                    >
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_info_colonia">COLONIA</label>
                    <input type="text"
                           id="taller_info_colonia"
                           name="taller_info[colonia]"
                           class="form-control"
                           value="{{ $taller_info->colonia }}" 
                    >
                </div>
                <div class="form-group col-md-2">
                    <label for="taller_info_cp">CP</label>
                    <input type="text"
                           id="taller_info_cp"
                           name="taller_info[cp]"
                           class="form-control"
                           value="{{ $taller_info->cp }}" 
                    >
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_info_telefono">TELÉFONO</label>
                    <input type="text"
                           id="taller_info_telefono"
                           name="taller_info[telefono]"
                           class="form-control"
                           value="{{ $taller_info->telefono }}" 
                    >
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="taller_ciudad">CIUDAD </label>
                    <input type="text"
                           id="taller_ciudad"
                           name="taller[ciudad]"
                           class="form-control"
                           value="{{ $taller->ciudad }}" 
                    >
                </div>
                <div class="form-group col-md-2">
                    <label for="taller_info_estado">ESTADO</label>
                    <select name="taller_info[estado]" id="taller_info_estado" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getEstados() as $value)
                            <option value="{{ $value }}" @if($taller_info->estado == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-group col-md-4">
                    <label for="taller_info_contacto">CONTACTO</label>
                    <input type="text"
                           id="taller_info_contacto"
                           name="taller_info[contacto]"
                           class="form-control"
                           value="{{ $taller_info->contacto }}" 
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="taller_info_responsable">RESPONSABLE</label>
                    <input type="text"
                           id="taller_info_responsable"
                           name="taller_info[responsable]"
                           class="form-control"
                           value="{{ $taller_info->responsable }}" 
                    >
                </div>
            </div>

            <h6 class="pt-2 font-weight-bold">INFORMACIÓN ADMINISTRATIVA</h6>
            <div class="form-row">
                <div class="form-group col-md-2">
                    <label for="taller_sbid">SERVICE BENCH ID </label>
                    <input type="text"
                           id="taller_sbid"
                           name="taller[sbid]"
                           class="form-control"
                           value="{{ $taller->sbid }}" 
                    >
                </div>
                <div class="form-group col-md-4">
                    <label for="taller_vendor">VENDOR</label>
                    <input type="text"
                           id="taller_vendor"
                           name="taller[vendor]"
                           class="form-control"
                           value="{{ $taller->vendor }}" 
                    >
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_zona">ZONA</label>
                    <select name="taller[zona]" id="taller_zona" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getZonas() as $key=>$value)
                            <option value="{{ $key }}" @if($taller->zona == $key) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_status">ZONA</label>
                    <select name="taller[status]" id="taller_zona" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getStatus() as $value)
                            <option value="{{ $value }}" @if($taller->status == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>                    
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="taller_tipo">TIPO </label>
                    <select name="taller[tipo]" id="taller_tipo" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getTipos() as $value)
                            <option value="{{ $value }}" @if($taller->tipo == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select> 
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_subtipo">SUBTIPO </label>
                    <select name="taller[subtipo]" id="taller_subtipo" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getSubTipos() as $value)
                            <option value="{{ $value }}" @if($taller->subtipo == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_subzona">SUBZONA </label>
                    <select name="taller[subzona]" id="taller_subzona" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getSubzonas() as $value)
                            <option value="{{ $value }}" @if($taller->subzona == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="form-group col-md-3">
                    <label for="taller_cc">CC </label>
                    <input type="text"
                           id="taller_cc"
                           name="taller[cc]"
                           class="form-control"
                           value="{{ $taller->cc }}" 
                    >
                </div>
            </div>

            <h6 class="pt-2 font-weight-bold">INFORMACIÓN DEL SUPERVISOR</h6>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="taller_supervisor">SUPERVISOR </label>
                    <select name="taller[supervisor]" id="taller_supervisor" class="form-control">
                        <option value="">Seleccione</option>
                        @foreach($taller::getSupervisores() as $value)
                            <option value="{{ $value }}" @if($taller->supervisor == $value) selected="" @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                
            
            </div>
            <div class="form-row">
                <input type="submit" class="btn btn-primary" value="Guardar">
                <input type="button" class="btn btn-warning ml-1" id="btn_cancelar" value="Cancelar">
            </div>
        </form>

    </div>

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"
            integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg=="
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
           

            $('#btn_cancelar').click(function(){
                if(confirm('¿Estás seguro que deseas cancelar y volver al listado?'))
                    $(location).attr('href', '{{ route('talleres.index') }}');
            });
        });

    </script>

@endsection
