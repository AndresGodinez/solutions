<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Solicitar Acceso</title>
    <link rel="apple-touch-icon" href="{{ asset('assets') }}/app-assets/images/ico/apple-icon-120.png">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        .card-header {
            padding: 0.2rem 0.2rem;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">                                   

                                    <div class="logincardd">
                                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center ">

                                            <div class="card-header pb-1">
                                                <div class="card-title">
                                                    <h4 class="text-center mb-2">Hola <?=$confirmarpago['nombre']?></h4>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">

                                                    <div class="divider">
                                                        <div class="divider-text text-uppercase text-muted"><small>Confirmar Pago</small>
                                                        </div>
                                                    </div>
                                                    <form action="" class="formlogin" style=" height:60vh; overflow-y:auto; padding:5px;">
                                                        @csrf
                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="exampleInputEmail1">Referencia</label>
                                                            <textarea rows="5" class="form-control" name="recibodepago"></textarea>
                                                            <input value="<?=$confirmarpago['id']?>" class="form-control" name="id" hidden />
                                                        </div>
                                                       
                                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">

                                                        </div>
                                                        
                                                        <a  class="btn btn-primary glow w-100 position-relative hacerlogin white">
                                                            <div class="spinner-border spinner-border-sm solicitaracceso_load" role="status" style="display:none;">
                                                                        <span class="sr-only">Loading...</span>
                                                            </div>
                                                            <font class="solicitaracceso_inter">
                                                                Enviar <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                                            </font>    
                                                        </a>
                                                        
                                                    </form>
                                                   
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">

                                    <img class="img-fluid" src="{{ asset('assets') }}/app-assets/images/logo/logo2.png" style="position:absolute; width:200px; top:-40px; left:30px;">
                                    <img class="img-fluid" src="{{ asset('assets') }}/app-assets/images/pages/register.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets') }}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="{{ asset('assets') }}/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets') }}/app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app-menu.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/core/app.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/scripts/components.js"></script>
    <script src="{{ asset('assets') }}/app-assets/js/scripts/footer.js"></script>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>

    <script>
        $('.hacerlogin').click(function(){
                $('.solicitaracceso_inter').hide();
                $('.solicitaracceso_load').show();
                $(this).addClass('w-100');
                $(this).attr('rel','1');

                var login = $('.login_user').val();
                var pass = $('.login_pass').val();

                if(login != '' && pass != ''){
                    var form = $('.formlogin').serialize();
                    $.post("{{url('ingexp/confirmarpagopost')}}",form,function(data){
                        Swal.fire({
                                    type: "success",
                                    title: '¡Muy bien!',
                                    text: 'La confirmación de pago fue registrada con éxito, pronto recibirá un correo de confirmación.',
                                    confirmButtonClass: 'btn btn-info',
                                }).then((result) => {
                                    location.href="{{url('ingexp/solicitaracceso/login')}}";
                                });
                    });
                }
        });

    </script>

</body>
<!-- END: Body-->

</html>