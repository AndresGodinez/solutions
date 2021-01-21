@canany(['crear solicitudes ing', 'solicitudes ing canceladas y rechazadas', 'solicitudes ing abiertas y revisión' ,'modo de falla ing', 'reporte solicitudes ing'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Solicitudes a Ing
        </span>
    </a>

    <ul class="menu-content">
        @can('crear solicitudes ing')
        <li class="">
            <a href="{{route('crear-solicitudes-ing')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Crear Solicitud
                </span>
            </a>
        </li>
        @endcan
        @can('solicitudes ing canceladas y rechazadas')
        <li class="">
            <a href="{{route('solicitudes-ing-canceladas-y-rechazadas')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Canceladas y Rechazadas                    
                </span>
            </a>
        </li>
        @endcan

        @can('solicitudes ing abiertas y revisión')
        <li class="">
            <a href="{{route('solicitudes-ing-abiertas-y-revision')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Abiertas y Revisión
                </span>
            </a>
        </li>
        @endcan

        @can('modo de falla ing')
        <li class="">
            <a href="{{route('modo-de-falla-ing')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Modo de Falla
                </span>
            </a>
        </li>
        @endcan

        @can('reporte solicitudes ing')
        <li class="">
            <a href="{{route('reporte-solicitudes-ing')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Reporte
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
