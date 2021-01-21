@canany(['facturas recibidas de pago a talleres', 'facturas aceptadas admin de pago a talleres', 'facturas taller' ,'reporte ts', 'carga de datos talleres'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Pago a Talleres
        </span>
    </a>

    <ul class="menu-content">
        @can('facturas recibidas de pago a talleres')
        <li class="">
            <a href="{{route('facturas-recibidas-de-pago-a-talleres')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Facturas Recibidas
                </span>
            </a>
        </li>
        @endcan
        @can('facturas aceptadas admin de pago a talleres')
        <li class="">
            <a href="{{route('facturas-aceptadas-admin-de-pago-a-talleres')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Facturas Aceptadas Admin
                </span>
            </a>
        </li>
        @endcan

        @can('facturas taller')
        <li class="">
            <a href="{{route('facturas-taller')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Facturas Taller
                </span>
            </a>
        </li>
        @endcan

        @can('reporte ts')
        <li class="">
            <a href="{{route('reporte-ts')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Reporte TS
                </span>
            </a>
        </li>
        @endcan

        @can('carga de datos talleres')
        <li class="">
            <a href="{{route('carga-de-datos-talleres')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Carga de datos Talleres
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
