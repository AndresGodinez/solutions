<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="whirlpool consiss">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name', 'Centro de Soluciones') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        @if(Auth::check())
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">{{ Auth::user()->username }}</span><span class="user-status text-muted">Disponible</span></div><span><img class="round" src="{{ asset('assets') }}/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="{{ route('usuario.editPassword')}}"><i class="bx bx-user mr-50"></i> Editar Perfil</a>
                                <div class="dropdown-divider mb-0"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="bx bx-power-off mr-50"></i> {{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('home') }}">
                        <div class="brand-logo">
                            <img class="logo logona" style="margin-top: -20px; height:70px;" src="{{ asset('assets') }}/app-assets/images/logo/logo.png" />
                            <img class="logo loguito" style="margin-left:-17px; margin-top: -15px; height:60px; display:none;" src="{{ asset('assets') }}/app-assets/images/logo/loguito.png" />
                        </div>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="bx bx-x d-block d-xl-none font-medium-4 primary" style="color:#da9c09"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block " style="color:#da9c09" data-ticon="bx-disc"></i></a></li>
            </ul>
        </div>
        @if(Auth::check())
        <div class="shadow-bottom"></div>
        <div class="main-menu-content" style="margin-top: 20px;;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" nav-item"><a href="#"><i class="bx bx-home" data-icon="envelope-pull"></i>
                        <span class="menu-title" data-i18n="Email">Dashboard</span>
                    </a>
                </li>
                <li class=" navigation-header"><span>Whirlpool</span>
                </li>

                <li class="nav-item">
                    <a href="">
                        <i class="bx bx-home" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Usuarios</span></a>
                    <ul class="menu-content">
                        <li class="active is-shown"><a href="{{route('usuarios.index')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Lista</span></a>
                        </li>
                        <li class="active is-shown"><a href="{{route('usuario.create')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Nuevo</span></a>
                        </li>
                    </ul>
                </li>

                <li class=" nav-item">
                    <a href="">
                        <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Stock</span></a>
                    <ul class="menu-content">
                        <li><a href="{{url('stocks')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Inicial</span></a></li>
                        <li><a href="{{url('stocks/final')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Final</span></a></li>
                        <li><a href="{{url('stocks/cargas')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Carga</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item">
                    <a href="">
                        <i class="bx bx-box" data-icon="box"></i><span class="menu-title" data-i18n="Stocks">Stock Técnico</span></a>
                    <ul class="menu-content">
                        <li><a href="{{url('stock-basico-tecnico')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Stock Básico de Técnicos</span></a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="">
                        <i class="bx bx-home" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Sustitutos</span></a>
                    <ul class="menu-content">
                        <li class="active is-shown"><a href="{{route('materiales-sustitutos.solicitud')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">
                                    Solicitud
                                </span></a>
                        </li>

                        <li class="active is-shown"><a href="{{url('sustitutos')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">
                                    Lista solicitudes
                                </span></a>
                        </li>

                        <li class="active is-shown"><a href="{{route('materiales.search')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Busqueda</span></a>
                        </li>
                        <li class="active is-shown"><a href="{{route('materiales-sustitutos.cargaSustitutos')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">
                                    Carga Masiva
                                </span></a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        @endif
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <script src="{{ asset('assets') }}/app-assets/vendors/js/vendors.min.js"></script>
            <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
            <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
            <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>

            <div class="content-body">
                @include('Partials.message')
                @include('Partials.errors')
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- demo chat-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-left d-inline-block">2020 &copy; WhirlPool</span><span class="float-right d-sm-inline-block d-none">Powered by<a class="text-uppercase">CONSISS</a></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->

    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets') }}/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets') }}/app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
