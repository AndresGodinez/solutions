@canany(['crear usuarios', 'editar usuarios', 'ver usuarios', 'eliminar usuarios'])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
                Conteo Ciclos
            </span>
        </a>
        <ul class="menu-content">
            <li class="">
                <a href="{{route('conteo-ciclos.index')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Carga Cicliclos
                    </span>
                </a>
            </li>

            <li class="">
                <a href="{{route('hojas-conteo-ciclicos')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                        Hojas Conteo
                    </span>
                </a>
            </li>
        </ul>
    </li>

@endcan
