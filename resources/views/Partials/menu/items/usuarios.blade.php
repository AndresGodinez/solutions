@canany(['crear usuarios', 'editar usuarios', 'ver usuarios', 'eliminar usuarios'])
<li class="nav-item">
    <a href="">
        <i class="bx bx-home" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Usuarios</span></a>
    <ul class="menu-content">
        @can('ver usuarios')
        <li class="active is-shown"><a href="{{route('usuarios.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Lista</span></a>
        </li>
        @endcan
        @can('crear usuarios')
        <li class="active is-shown"><a href="{{route('usuario.create')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Nuevo</span></a>
        </li>
        @endcan
    </ul>
</li>
@endcan
