@canany([
    'carga materiales para hojas de conteo cilicos',
    'descarga de hojas conteo ciclicos pdf',
    'descarga de hojas conteo ciclicos xls'
    ])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
                Conteo Ciclicos
            </span>
        </a>
        <ul class="menu-content">
            @can('carga materiales para hojas de conteo cilicos')
            <li class="">
                <a href="{{route('conteo-ciclos.index')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Carga Cicliclos
                    </span>
                </a>
            </li>
            @endcan

            @canany([
                'descarga de hojas conteo ciclicos pdf',
                'descarga de hojas conteo ciclicos xls'
                ])
            <li class="">
                <a href="{{route('hojas-conteo-ciclicos')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Hojas Conteo
                    </span>
                </a>
            </li>
                @endcan
        </ul>
    </li>

@endcan
