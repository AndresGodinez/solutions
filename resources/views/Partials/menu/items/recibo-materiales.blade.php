@canany(['folios de recibo','recepcion material'])
    <li class="nav-item">
        <a href="">
            <i class="bx bx-home" data-icon="desktop"></i>
            <span class="menu-title" data-i18n="Dashboard">
            Recibo Materiales
        </span>
        </a>
        <ul class="menu-content">
            @can('folios de recibo')
                <li class="is-shown">
                    <a href="{{route('recibo-materiales.index')}}">
                        <i class="bx bx-right-arrow-alt"></i>
                        <span class="menu-item" data-i18n="eCommerce">
                    Recibo
                </span>
                    </a>
                </li>
            @endcan

        </ul>
    </li>
@endcanany
