@canany(['catalogo ing'])

    <li class=" nav-item">
        <a href="">
            <i class="bx bx-book-bookmark" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Catalogo Ing</span></a>
        <ul class="menu-content">    
            @can('cargar al catálogo')    
                <li><a href="{{url('ingexp/cargar')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Cargar al Catalogo</span></a></li>        
            @endcan
            @can('Editar existente')                
                <li><a href="{{url('ingexp/editar')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Editar uno Existente</span></a></li>        
            @endcan
            @can('buscar')
                <li><a href="{{url('ingexp/buscar')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Buscar</span></a></li>        
            @endcan
            @can('solicitudes de acceso')
                <li><a href="{{url('ingexp/listadeacceso')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Solicitudes de Acceso</span></a></li>
            @endcan
                <li><a href="{{url('ingexp/solicitaracceso')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Solicitar Acceso (Ejemplo)</span></a></li>
        </ul>
    </li>


    
@endcanany

