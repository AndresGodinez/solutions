@canany(['imprimir etiquetas'])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
            Impresión etiquetas
        </span>
        </a>
        <ul class="menu-content">
            @can('imprimir etiquetas')
                <li class="is-shown">
                    <a href="{{route('impresion.etiquetas.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        <span class="menu-item" data-i18n="eCommerce">
                    Impresión de etiquetas
                </span>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
