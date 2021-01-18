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

        @include('Partials.menu.items.stocks')

        @include('Partials.menu.items.stock-basico')

        @include('Partials.menu.items.alcopar')

        @include('Partials.menu.items.ingexp')

        @include('Partials.menu.items.sustitutos')
        @include('Partials.menu.items.fechas-promesas')
        @include('Partials.menu.items.conteo-ciclicos')
        @include('Partials.menu.items.lx02')
        @include('Partials.menu.items.impresion-etiquetas')
        @include('Partials.menu.items.recibo-materiales')
        @include('Partials.menu.items.talleres')

    </ul>
</div>
