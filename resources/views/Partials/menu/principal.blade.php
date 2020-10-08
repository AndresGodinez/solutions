<div class="shadow-bottom"></div>
<div class="main-menu-content" style="margin-top: 20px;">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
        <li class=" nav-item"><a href="#"><i class="bx bx-home" data-icon="envelope-pull"></i>
                <span class="menu-title" data-i18n="Email">Dashboard</span>
            </a>
        </li>
        <li class=" navigation-header"><span>Whirlpool</span>
        </li>

        @include('Partials.menu.items.usuarios')
        @include('Partials.menu.items.roles')
        <li class=" nav-item">
            <a href="">
                <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Stock</span></a>
            <ul class="menu-content">
                <li><a href="{{url('stocks')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Inicial</span></a></li>
                <li><a href="{{url('stocks/final')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Final</span></a></li>
                <li><a href="{{url('stocks/cargas')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Carga</span></a></li>
            </ul>
        </li>
        @include('Partials.menu.items.stock-basico')

        <li class=" nav-item">
            <a href="">
                <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Alta de Partes</span></a>
            <ul class="menu-content">
                <li><a href="{{url('alcopar/altamaterial')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Solicitud de Alta</span></a></li>
                <li><a href="{{url('alcopar/reving')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Rev Ingenieria/Alta SAP</span></a></li>
                <li><a href="{{url('alcopar/factible')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Rev Materiales/Alta Costo</span></a></li>
                <li><a href="{{url('alcopar/classat')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Clasificación SAT</span></a></li>
                <li><a href="{{url('alcopar/precio')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Alta Precio</span></a></li>
                <li><a href="{{url('alcopar/oow')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Alta OOW</span></a></li>
            </ul>
        </li>

        @include('Partials.menu.items.sustitutos')
        @include('Partials.menu.items.fechas-promesas')
        @include('Partials.menu.items.conteo-ciclicos')
        @include('Partials.menu.items.lx02')

    </ul>
</div>
