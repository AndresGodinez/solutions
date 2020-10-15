@canany([
    'stock inicial',
    'stock final',
    'stock isc inicial',
    'stock isc final',
    'carga'
    ])
    <li class=" nav-item">
        <a href="">
            <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Stock</span></a>
        <ul class="menu-content">
            @can('stock inicial')
                <li><a href="{{url('stocks')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Inicial</span></a></li>
            @endcan

            @can('stock final')
                <li><a href="{{url('stocks/final')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Final</span></a></li>
            @endcan
            
            @can('carga')
                <li><a href="{{url('stocks/cargas')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Carga</span></a></li>
            @endcan
        </ul>
    </li>
@endcan
