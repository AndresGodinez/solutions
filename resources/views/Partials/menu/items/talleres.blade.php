@canany(['crear talleres', 'editar talleres', 'administrar talleres' ,'consulta talleres', 'eliminar talleres'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Talleres
        </span>
    </a>

    <ul class="menu-content">
        @can('consulta talleres')
        <li class="">
            <a href="{{route('talleres.consulta')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Consultar
                </span>
            </a>
        </li>
        @endcan
        @can('administrar talleres')
        <li class="">
            <a href="{{route('talleres.index')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Administrar
                </span>
            </a>
        </li>
        @endcan

        @can('crear talleres')
        <li class="">
            <a href="{{route('taller.create')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Nuevo Taller
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
