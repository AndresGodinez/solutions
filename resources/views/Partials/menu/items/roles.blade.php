@canany(['crear roles', 'editar roles', 'ver roles', 'eliminar roles'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i>
        <span class="menu-title" data-i18n="Dashboard">
            Roles
        </span>
    </a>

    <ul class="menu-content">
        @can('ver roles')
        <li class="active is-shown">
            <a href="{{route('roles.index')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Lista
                </span>
            </a>
        </li>
        @endcan
        @can('crear roles')
        <li class="active is-shown">
            <a href="{{route('role.create')}}">
                <i class="bx bx-right-arrow-alt"></i>
                <span class="menu-item" data-i18n="eCommerce">
                    Nuevo role
                </span>
            </a>
        </li>
        @endcan
    </ul>
</li>
@endcan
