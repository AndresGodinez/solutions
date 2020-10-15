@canany(['solicitud de alta', 'rev ingenieria/alta sap', 'rev materiales/alta costo', 'clasioficacion sat','alta precio','alta oow'])
<li class=" nav-item">
    <a href="">
        <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Alta de Partes</span></a>
    <ul class="menu-content">
        @can('solicitud de alta')
        <li><a href="{{url('alcopar/altamaterial')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Solicitud de Alta</span></a></li>
        @endcan
        @can('rev ingenieria/alta sap')
        <li><a href="{{url('alcopar/reving')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Rev Ingenieria/Alta SAP</span></a></li>
        @endcan
        @can('rev materiales/alta costo')
        <li><a href="{{url('alcopar/factible')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Rev Materiales/Alta Costo</span></a></li>
        @endcan
        @can('clasioficacion sat')
        <li><a href="{{url('alcopar/classat')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Clasificación SAT</span></a></li>
        @endcan
        @can('alta precio')
        <li><a href="{{url('alcopar/precio')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Alta Precio</span></a></li>
        @endcan
        @can('alta oow')
        <li><a href="{{url('alcopar/oow')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Alta OOW</span></a></li>
        @endcan  
        <li><a href="{{url('alcopar/reportalcopar')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Reporte</span></a></li>        
    </ul>
</li>
@endcan
