<?php
$data = $datos;

$tipo = 0;
$linea = 0;

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
}
if (isset($_GET['linea'])) {
    $linea = $_GET['linea'];
}
?>

<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Whirlpool</title>
    <link rel="apple-touch-icon" href="{{ asset('assets') }}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets') }}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/ui/prism.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/themes/semi-dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/vendors/css/tables/datatable/datatables.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav nav-back">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main hidden-xs font-small-3 d-flex align-items-center" href="sk-layout-2-columns.html"><i class="bx bx-left-arrow-alt"></i>Back</a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block">
                            <img class="img-fluid" src="{{ asset('assets') }}/app-assets/images/logo/logo2.png" style="width:100px; margin-top:10px; margin-left:5px;">
                            </li>                            
                        </ul>
                        
                    </div>
                    <ul class="nav navbar-nav float-right">                       
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">John Doe</span><span class="user-status">Activo</span></div><span>
                                    </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="bx bx-power-off mr-50"></i> Salir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            
            <div class="content-body">
                <!-- Description -->
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="card-title">Lista Existente</h4>
                    </div>                                         -->
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="row">
                                        <div class="col-md-6 col-5">
                                            <fieldset class="form-group">
                                                <label for="basicInput">LINEA DE PRODUCTO:</label>
                                                <select class="form-control filtro" name="linea" id="linea" require="true">
                                                    <option value="0">Seleccionar Linea</option>
                                                    <?php
                                                    foreach ($data['linea'] as $v) {
                                                    ?>
                                                        <option <?php if ($linea == $v['idlinea']) {
                                                                    echo 'selected=""';
                                                                } ?> value="<?= $v['idlinea'] ?>"><?= $v['linea'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-5">
                                            <fieldset class="form-group">
                                                <label for="basicInput">TIPO ARCHIVO:</label>
                                                <select class="form-control filtro" name="tipo" id="tipo" require="true">
                                                    <option value="0">Seleccionar Tipo</option>
                                                    <?php
                                                    foreach ($data['tipo'] as $v) {
                                                    ?>
                                                        <option <?php if ($tipo == $v['idtipo']) {
                                                                    echo 'selected=""';
                                                                } ?> value="<?= $v['idtipo'] ?>"><?= $v['tipo'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="card">
                                    <table class="table table-striped table-bordered complex-headers table-responsive">
                                        <thead>
                                            <tr>
                                                <th>TITULO</th>
                                                <th>CATEGORIA</th>
                                                <th>MODELO</th>
                                                <th>LINEA</th>
                                                <th>TIPO</th>
                                                <th>COMENTARIOS</th>
                                                <th>FECHA ACTUALIZACION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($get_records as $get_records)
                                            <tr>
                                                <td><a target="_blank" href="{{	url('ingexp/visor/'.$get_records['idregistro']) }}"><?= substr($get_records['titulo'], 0, 40) ?></a></td>
                                                <td>{{ $get_records['categoria'] }}</td>
                                                <td><?= substr($get_records['modelo'], 0, 40) ?></td>
                                                <td>{{ $get_records['linea'] }}</td>
                                                <td>{{ $get_records['tipo'] }}</td>
                                                <td>{{ $get_records['comentarios'] }}</td>
                                                <td>{{ $get_records['fecha'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
    </div>
    </div>
    <!--/ HTML Markup -->

    </div>
    </div>
    </div>
    <!-- END: Content-->



    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets') }}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('assets') }}/app-assets/vendors/js/ui/prism.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets') }}/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app.js"></script>

    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

    <script>
        $('.filtro').on('change', function() {
            var tipo = $('#tipo').val();
            var linea = $('#linea').val();
            window.location = '<?php echo url('/ingexp/buscar/'); ?>?tipo=' + tipo + '&linea=' + linea
        });

        $('.table').DataTable({
            "responsive": true,
            "language": {
                "url": "{{ asset('assets') }}/dt-lang/Spanish.json"
            }
        });

        <?php
        if (@$_GET['success'] == 1) {
        ?>
            Swal.fire({
                type: "success",
                title: '¡Ejecutado con éxito!',
                text: '',
                confirmButtonClass: 'btn btn-success',
            });
        <?php
        }
        ?>
    </script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>