@canany(['crear solicitud aduanal', 'ver solicitudes aduanales'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Solicitudes Aduanales
        </span>
    </a>

    <ul class="menu-content">
        @can('crear solicitud aduanal')
        <li class="">
            <a href="{{route('crear-solicitud-aduanal')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Crear Solicitud
                </span>
            </a>
        </li>
        @endcan
        @can('ver solicitudes aduanales')
        <li class="">
            <a href="{{route('ver-solicitudes-aduanales')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Ver Solicitudes
                </span>
            </a>
        </li>
        @endcan

       
    </ul>
</li>
@endcan
