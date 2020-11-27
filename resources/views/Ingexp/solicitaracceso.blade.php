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
                                    <div class="registrocardd">
                                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                            <div class="card-header" style="padding:0 px;">
                                                <div class="card-title">
                                                    <h4 class="text-center">Solicitar Acceso</h4>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <p> <small> Hola, llene el formulario para solicitar el acceso a la búsqueda del catálogo de Ingeniería.</small>
                                                </p>
                                            </div>

                                            <div class="card-content">
                                                <div class="card-body">
                                                    <form action="" class="formdeaccesosolicitud" style=" height:60vh; overflow-y:auto; padding:5px;">
                                                        @csrf
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputfirstname4">Nombre comercial</label>
                                                                <input type="text" class="form-control" name="nombre_comercial" id="inputfirstname4" placeholder="Nombre comercial" require="true">
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputlastname4">Nombre del dueño</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="nombre_del_dueno" placeholder="Nombre del dueño" require="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="exampleInputEmail1">Email</label>
                                                            <input type="email" class="form-control emailregistro" id="exampleInputEmail1" name="email" placeholder="Email" require="true">
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputfirstname4">Teléfono del dueño</label>
                                                                <input type="email" class="form-control" id="inputfirstname4" name="telefono_dueno" placeholder="Teléfono del dueño" require="true">
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputlastname4">Teléfono centro de servicio</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="telefono_centro_servicio" placeholder="Teléfono centro de servicio" require="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">

                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">Dirección de ubicación del taller </label>
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputfirstname4">Calle y número</label>
                                                                <input type="text" class="form-control" id="inputfirstname4" name="dir_taller_calle" placeholder="Calle y  número" require="true">
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputlastname4">Colonia</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_colonia" placeholder="Colonia" require="true">
                                                            </div>

                                                            <div class="form-group col-md-4 mb-50">
                                                                <label for="inputfirstname4">Ciudad</label>
                                                                <input type="text" class="form-control" id="inputfirstname4" name="dir_taller_ciudad" placeholder="Ciudad" require="true">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-50">
                                                                <label for="inputlastname4">Estado</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_estado" placeholder="Estado" require="true">
                                                            </div>
                                                            <div class="form-group col-md-4 mb-50">
                                                                <label for="inputlastname4">Código postal</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_codigopostal" placeholder="Código postal" require="true">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Brinda atención Multimarca?</label>
                                                                <select class="form-control" name="multimarca" require="true">
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputlastname4">¿A qué marcas atiende?</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="multimarca_marcas_atiende" placeholder="¿A qué marcas atiende?" require="false">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Se especializa en algún tipo de producto? Lavandería, Refrigeración, Cocina, Otra especifique</label>
                                                                <textarea class="form-control" rows="5" name="espacializa_producto" require="true"></textarea>
                                                            </div>

                                                        </div>

                                                        <div class="form-row">                                                           
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Zona de cobertura?</label>
                                                                <input type="text" class="form-control" id="inputfirstname4" name="zona_cobertura" placeholder="¿Qué zona de cobertura atiende?" require="true">
                                                            </div>
                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputlastname4">N° de técnicos</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="num_tecnicos" placeholder="Número de técnicos con los que cuenta" require="true">
                                                            </div>

                                                            <div class="form-group col-md-6 mb-50">
                                                                <label for="inputlastname4">Promedio servicios mes</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="promedio_mes" placeholder="Promedio de servicios que atiende al mes" require="true">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputlastname4">¿Los técnicos cuentan con formación en alguna escuela técnica o aprendieron de forma empírica?</label>
                                                                <input type="text" class="form-control" id="inputlastname4" name="formacion_tenica" placeholder="¿Los técnicos cuentan con formación en alguna escuela técnica o aprendieron de forma empírica?" require="true">
                                                            </div>
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Atiende servicios en garantía con alguna marca?</label>
                                                                <select class="form-control" name="garantia_marca" require="true">
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12 mb-50 cualmarca">
                                                                <label for="inputlastname4">¿cuál marca?</label>
                                                                <textarea class="form-control" rows="3" name="garantia_cual_marca" require="false"></textarea>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Le interesa pertenecer a la red de servicio Whirlpool?</label>
                                                                <select class="form-control" name="red_whirlpool" require="true">
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Cuenta con personal administrativo?</label>
                                                                <select class="form-control" name="personal_administrativo" require="true">
                                                                    <option value="1">Si</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-50">
                                                                <label for="inputfirstname4">¿Desde dónde opera?</label>
                                                                <select class="form-control" name="donde_opera" require="true">
                                                                    <option>Desde Local Comercial</option>
                                                                    <option>Desde Casa </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <hr>
                                                        <center>
                                                            <a class="btn btn-primary glow position-relative w-100 white solicitaracceso" rel="0">
                                                                <div class="spinner-border spinner-border-sm solicitaracceso_load" role="status" style="display:none;">
                                                                    <span class="sr-only">Loading...</span>
                                                                </div>
                                                                <font class="solicitaracceso_inter">
                                                                    Crear Solicitud <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                                                </font>

                                                            </a>
                                                        </center>
                                                    </form>
                                                    <hr>
                                                    <div class="text-center"><small class="mr-25">¿Ya tienes cuenta?</small><a href="javascrip:void(0)" onclick="changecard('login')"><small>Acceder al sistema</small> </a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="logincardd" style="display: none;">
                                        <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center ">

                                            <div class="card-header pb-1">
                                                <div class="card-title">
                                                    <h4 class="text-center mb-2">Bienvenido</h4>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body">

                                                    <div class="divider">
                                                        <div class="divider-text text-uppercase text-muted"><small>Entrar al Sistema</small>
                                                        </div>
                                                    </div>
                                                    <form action="" class="formlogin" style=" height:60vh; overflow-y:auto; padding:5px;">
                                                        @csrf
                                                        <div class="form-group mb-50">
                                                            <label class="text-bold-600" for="exampleInputEmail1">Correo</label>
                                                            <input type="email" class="form-control login_user" id="exampleInputEmail1" name="login" placeholder="Email address"></div>
                                                        <div class="form-group">
                                                            <label class="text-bold-600" for="exampleInputPassword1">Contraseña</label>
                                                            <input type="password" class="form-control login_pass" id="exampleInputPassword1" name="pass" placeholder="Password">
                                                        </div>
                                                        <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">

                                                        </div>
                                                        
                                                        <a  class="btn btn-primary glow w-100 position-relative hacerlogin white">
                                                            <div class="spinner-border spinner-border-sm solicitaracceso_load" role="status" style="display:none;">
                                                                        <span class="sr-only">Loading...</span>
                                                            </div>
                                                            <font class="solicitaracceso_inter">
                                                                Entrar <i id="icon-arrow" class="bx bx-right-arrow-alt"></i>
                                                            </font>    
                                                        </a>
                                                        
                                                    </form>
                                                    <hr>
                                                    <div class="text-center"><small class="mr-25">¿No tienes una cuenta?</small><a href="javascrip:void(0)" onclick="changecard('registro')"><small>Solicitar Acceso</small></a></div>
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
                    $.post("{{url('ingexp/solicitaraccesologin')}}",form,function(data){
                        if(data.status =='si'){
                            if(data.cuenta == 3){
                                location.href = "{{url('ingexp/acceso')}}"
                            }else{
                                if(data.cuenta == 0){
                                    var msgacceso = "Solicitud nueva, aún no aprobada.";
                                }
                                else if(data.cuenta == 1){
                                    var msgacceso = "Aguardando pago para liberación de cuenta.";
                                }else if(data.cuenta == 2){
                                    var msgacceso = "Aguardando liberación.";
                                }else if(data.cuenta == 4){
                                    var msgacceso = "Cuenta inactiva o rechazada.";
                                }else if(data.cuenta == 5){
                                    var msgacceso = "Cuenta expirada.";
                                }else{
                                    var msgacceso = "Cuenta inactiva";
                                }


                                Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: msgacceso,
                                    confirmButtonClass: 'btn btn-error',
                                });
                                $('.solicitaracceso_inter').show();
                                $('.solicitaracceso_load').hide();
                                $(this).addClass('w-100');
                                $(this).attr('rel','0');
                            }
                            
                        }else{                            
                            if(data.f == "0"){
                                Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: 'Cuenta expirada',
                                    confirmButtonClass: 'btn btn-error',
                                });
                            }else{
                                Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: 'Usuário o contraseña inválido.',
                                    confirmButtonClass: 'btn btn-error',
                                });
                            }
                            $('.solicitaracceso_inter').show();
                            $('.solicitaracceso_load').hide();
                            $(this).addClass('w-100');
                            $(this).attr('rel','0');
                            
                        }
                    },'json');
                }else{
                    Swal.fire({
                        type: "error",
                        title: '¡Atención!',
                        text: "Llene todos los campos.",
                        confirmButtonClass: 'btn btn-error',
                    });
                    $('.solicitaracceso_inter').show();
                    $('.solicitaracceso_load').hide();
                    $(this).addClass('w-100');
                    $(this).attr('rel','0');
                }
        });

        $('.solicitaracceso').click(function() {
            required = true;
            $('.formdeaccesosolicitud .form-control').each(function(index) {
                var req = $(this).attr('require');

                if (req == "true") {
                    if ($(this).val().trim() == '') {
                        $(this).removeClass('is-valid');
                        $(this).addClass('is-invalid');
                        required = false;
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).addClass('is-valid');
                    }
                }
            });

            if($(".emailregistro").val().indexOf('@', 0) == -1 || $(".emailregistro").val().indexOf('.', 0) == -1) {
                $(".emailregistro").removeClass('is-valid');
                $(".emailregistro").addClass('is-invalid');
                required = false;
                Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: 'Ingresa un correo válido',
                                    confirmButtonClass: 'btn btn-error',
                                });
                                return;
                
            }

            if (!required) {
                Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: 'LLene todos los campos requeridos',
                                    confirmButtonClass: 'btn btn-error',
                                });
            } else {
                
        
        
                var rel = $(this).attr('rel');
                if (rel == '0') {

                    $('.solicitaracceso_inter').hide();
                    $('.solicitaracceso_load').show();
                    $(this).removeClass('w-100');
                    $(this).attr('rel','1');
                    var form = $('.formdeaccesosolicitud').serialize();
                    $('.form-control').attr('disabled', true);
                    $.post("{{url('ingexp/solicitaracceso_procesar')}}", form, function(data) {
                        if(data.status == 0){
                            $('.emailregistro').removeClass('is-valid');
                            $('.emailregistro').addClass('is-invalid');
                            $('.form-control').attr('disabled', false);
                            // $('.emailregistro').val('');
                            
                            Swal.fire({
                                    type: "error",
                                    title: '¡Atención!',
                                    text: data.error,
                                    confirmButtonClass: 'btn btn-error',
                                });

                                $(this).addClass('w-100');
                                $(this).attr('rel','0');
                                $('.solicitaracceso_inter').show();
                                $('.solicitaracceso_load').hide();    
                        }else{
                            <?php $urldirv = url('/ingexp/solicitaracceso'); ?>
                            window.location = '<?=$urldirv?>?solicitado=1';  
                        }
                    },'json');
                }
            }

        });


        function changecard(val) {
            if (val == 'login') {
                $('.registrocardd').slideUp();
                $('.logincardd').slideDown();
            } else {

                $('.registrocardd').slideDown();
                $('.logincardd').slideUp();
            }
        }

        <?php
        if ($modo == 'login') {
        ?>
            changecard('login');
        <?php
        }
        ?>

        <?php 
        if(isset($_GET['solicitado'])){
            ?>
             Swal.fire({
                    type: "success",
                    title: '¡Muy bien!',
                    text: 'Solicitud enviada con éxito.',
                    confirmButtonClass: 'btn btn-success',
                });
            
            <?php
        }
        
        ?>
    </script>

</body>
<!-- END: Body-->

</html>