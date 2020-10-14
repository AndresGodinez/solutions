@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header h5">
                {{ 'Editar Usuario' }}
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('usuario.update', ['usuario'=> $usuario->id]) }}" method="post">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="username">Nombre del usuario</label>
                        <input type="text"
                               id="username"
                               name="username"
                               class="form-control"
                               value="{{ $usuario->username }}"
                        >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="nombre">Nombre</label>
                        <input type="text"
                               id="nombre"
                               name="nombre"
                               class="form-control"
                               value="{{ $usuario->nombre }}"
                        >
                    </div>
                </div>
                <div class="form-group">
                    @foreach($roles as $role)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="role"
                                value="{{ $role->name }}"
                                {{ $usuario->hasRole($role->name) ? 'checked' : '' }}
                            >
                            <label class="form-check-label">
                                {{ ucfirst($role->name) }}
                            </label>
                        </div>

                    @endforeach
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="mail">Correo Eléctronico</label>
                        <input type="email"
                               id="mail"
                               name="mail"
                               class="form-control"
                               value="{{ $usuario->mail }}"
                        >
                    </div>

                    <div class="form-group col-md-4">
                        <label for="depto">Departamento</label>
                        <select name="depto" id="depto" class="form-control">
                            <option value="">Seleccione un departamento</option>
                            @foreach($departamentos as $depto)
                                <option value="{{ $depto->id }}"
                                    {{ $usuario->depto == $depto->departamento ? 'selected' : '' }}
                                >
                                    {{ $depto->departamento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="country_id">País</label>
                        <select name="country_id" id="country_id" class="form-control">
                            <option value="">Seleccione una opcion</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                        {{ $usuario->id_contry == $country->id ? 'selected' : '' }}
                                >
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="region_id">Región</label>
                        <select name="region_id" id="region_id" class="form-control">
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="cliente">Cliente</label>
                        <input type="text"
                               id="cliente"
                               name="cliente"
                               class="form-control"
                               value="{{ $usuario->cliente }}"
                        >
                    </div>
                    <div class="form-group col-md-4">
                        <label for="planta">Planta</label>
                        <select name="planta" id="planta" class="form-control">
                            <option value="">Seleccione una planta</option>
                            <option value="RS01"
                                {{ $usuario->planta == 'RS01' ? 'selected' : '' }}
                            >
                                RS01
                            </option>
                            <option value="RS02"
                                {{ $usuario->planta == 'RS02' ? 'selected' : '' }}
                            >
                                RS02
                            </option>
                            <option value="RS03"
                                {{ $usuario->planta == 'RS03' ? 'selected' : '' }}
                            >
                                RS03
                            </option>
                            <option value="RS04"
                                {{ $usuario->planta == 'RS04' ? 'selected' : '' }}
                            >
                                RS04
                            </option>
                            <option value="RS05"
                                {{ $usuario->planta == 'RS05' ? 'selected' : '' }}
                            >
                                RS05
                            </option>
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <input type="submit" class="btn btn-primary" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            if (!! $('#country_id').val()){
                let region = $('#region_id');
                let country = $('#country_id');
                ff();
                async function ff (){
                    try {
                        let response = await axios.get('/get-regiones', {
                            params:{
                                country :country.val()
                            }
                        });
                        response.data.forEach((item) => {
                            region.append(`<option value="${item.id}">
                                       ${item.short_name}
                                  </option>`);
                        });

                    }catch (e) {
                        console.error(e)
                    }
                }


            }

            $('#country_id').change(async function() {
                let region = $('#region_id');
                let country = $('#country_id');
                try {
                    let response = await axios.get('/get-regiones', {
                        params:{
                            country :country.val()
                        }
                    });
                    region.empty();
                    region.append(`<option value="">
                                       Seleccione una opción
                                  </option>`);
                    response.data.forEach((item) => {
                        region.append(`<option value="${item.id}">
                                       ${item.short_name}
                                  </option>`);
                    });

                }catch (e) {
                    console.error(e)
                }

            })
        });

    </script>
@endsection
