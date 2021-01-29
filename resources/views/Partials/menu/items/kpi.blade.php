@canany(['carga de informacion', 'descargar'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Reporte KPI
        </span>
    </a>

    <ul class="menu-content">
        @can('carga de informacion')
        <li class="">
            <a href="{{route('reporte-kpi.carga-de-informacion')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Cargas
                </span>
            </a>
        </li>
        @endcan
        @can('descargar')
        <li class="">
            <a href="{{route('reporte-kpi.descargar')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Descarga
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
