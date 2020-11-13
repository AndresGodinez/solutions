{{--@canany(['subir archivo LX02', 'carga inventario a nivel bin', 'carga inventario recibo bins'])--}}
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
            Recibo Materiales
        </span>
        </a>
        <ul class="menu-content">
            <li class="is-shown">
                <a href="{{route('recibo-materiales.index')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                    Recibo
                </span>
                </a>
            </li>
            <li class="is-shown">
                <a href="{{route('recibo-materiales.carga-factura')}}">
                    <i class="bx bx-right-arrow-alt"></i>
                    <span class="menu-item" data-i18n="eCommerce">
                    Carga Facturas
                </span>
                </a>
            </li>
        </ul>
    </li>
{{--@endcanany--}}
