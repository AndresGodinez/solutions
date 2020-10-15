@canany([
    'solicitud de sustitutos',
    'ver sustitutos',
    'carga fecha creacion piezas',
    'carga inventarios',
    'carga masiva sustitutos',
    'busqueda materiales',
    'descarga de materiales',
    'carga sustituto'
    ])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
                Sustitutos
            </span>
        </a>

        <ul class="menu-content">
            <li class="">
                <a href="{{route('materiales-sustitutos.solicitud')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                      Solicitud
                    </span>
                </a>
            </li>

            <li class="">
                <a href="{{url('sustitutos')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                       Lista solicitudes
                    </span>
                </a>
            </li>

            <li class="">
                <a href="{{route('materiales.search')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">Busqueda</span>
                </a>
            </li>

            <li class="">
                <a href="{{route('materiales-sustitutos.cargaSustitutos')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Carga Masiva
                    </span>
                </a>
            </li>
        </ul>
    </li>
@endcan
