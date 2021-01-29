@canany(['consulta de informacion nom', 'carga de informacion nom'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Etiquetas NOM
        </span>
    </a>

    <ul class="menu-content">
        @can('carga de informacion nom')
        <li class="">
            <a href="{{route('carga-de-informacion-nom')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Carga de información
                </span>
            </a>
        </li>
        @endcan
        @can('consulta de informacion nom')
        <li class="">
            <a href="{{route('consulta-de-informacion-nom')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Consilta de información
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
