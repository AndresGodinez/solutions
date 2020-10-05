@canany(['crear usuarios', 'editar usuarios', 'ver usuarios', 'eliminar usuarios'])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
               Fecha promesas
            </span>
        </a>
        <ul class="menu-content">
            <li class="active is-shown">
                <a href="{{route('fechas-promesa.search')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Consulta
                    </span>
                </a>
            </li>
        </ul>
    </li>
@endcan
