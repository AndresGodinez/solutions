<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item current">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="false">
            <i class="bx bx-home align-middle"></i>
            <span class="align-middle">Datos del solicitante</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false">
            <i class="bx bx-user align-middle"></i>
            <span class="align-middle">Estatus y Acciones</span>
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
        <div class="form-row">
            <div class="form-group col-md-6 mb-50">
                <label for="inputfirstname4">Nombre comercial</label>
                <input type="text" class="form-control" name="nombre_comercial" value="<?= $data[0]['nombre_comercial'] ?>" id="inputfirstname4" placeholder="Nombre comercial" require="true">
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="inputlastname4">Nombre del dueño</label>
                <input type="text" class="form-control" id="inputlastname4" name="nombre_del_dueno" value="<?= $data[0]['nombre_del_dueno'] ?>" placeholder="Nombre del dueño" require="true">
            </div>
        </div>

        <div class="form-group mb-50">
            <label class="text-bold-600" for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control emailregistro" id="exampleInputEmail1" name="email" value="<?= $data[0]['email'] ?>" placeholder="Email" require="true">
        </div>

        <div class="form-row">
            <div class="form-group col-md-6 mb-50">
                <label for="inputfirstname4">Teléfono del dueño</label>
                <input type="email" class="form-control" id="inputfirstname4" name="telefono_dueno" value="<?= $data[0]['telefono_dueno'] ?>" placeholder="Teléfono del dueño" require="true">
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="inputlastname4">Teléfono centro de servicio</label>
                <input type="text" class="form-control" id="inputlastname4" name="telefono_centro_servicio" value="<?= $data[0]['telefono_centro_servicio'] ?>" placeholder="Teléfono centro de servicio" require="true">
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">Dirección de ubicación del taller </label>
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="inputfirstname4">Calle y número</label>
                <input type="text" class="form-control" id="inputfirstname4" name="dir_taller_calle" value="<?= $data[0]['dir_taller_calle'] ?>" placeholder="Calle y  número" require="true">
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="inputlastname4">Colonia</label>
                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_colonia" value="<?= $data[0]['dir_taller_colonia'] ?>" placeholder="Colonia" require="true">
            </div>

            <div class="form-group col-md-4 mb-50">
                <label for="inputfirstname4">Ciudad</label>
                <input type="text" class="form-control" id="inputfirstname4" name="dir_taller_ciudad" value="<?= $data[0]['dir_taller_ciudad'] ?>" placeholder="Ciudad" require="true">
            </div>
            <div class="form-group col-md-4 mb-50">
                <label for="inputlastname4">Estado</label>
                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_estado" value="<?= $data[0]['dir_taller_estado'] ?>" placeholder="Estado" require="true">
            </div>
            <div class="form-group col-md-4 mb-50">
                <label for="inputlastname4">Código postal</label>
                <input type="text" class="form-control" id="inputlastname4" name="dir_taller_codigopostal" value="<?= $data[0]['dir_taller_codigopostal'] ?>" placeholder="Código postal" require="true">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Brinda atención Multimarca?</label>
                <select class="form-control" name="multimarca" require="true">
                    <option value="1" <?php if ($data[0]['multimarca'] == 1) {
                                            echo "selected";
                                        } ?>>Si</option>
                    <option value="0" <?php if ($data[0]['multimarca'] == 0) {
                                            echo "selected";
                                        } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12 mb-50">
                <label for="inputlastname4">¿A qué marcas atiende?</label>
                <input type="text" class="form-control" id="inputlastname4" name="multimarca_marcas_atiende" value="<?= $data[0]['multimarca_marcas_atiende'] ?>" placeholder="¿A qué marcas atiende?" require="false">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Se especializa en algún tipo de producto? Lavandería, Refrigeración, Cocina, Otra especifique</label>
                <textarea class="form-control" rows="5" name="espacializa_producto" require="true"><?= $data[0]['espacializa_producto'] ?></textarea>
            </div>

        </div>

        <div class="form-row">
           
            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Zona de cobertura?</label>
                <input type="text" class="form-control" id="inputfirstname4" name="zona_cobertura" value="<?= $data[0]['zona_cobertura'] ?>" placeholder="¿Qué zona de cobertura atiende?" require="true">
            </div>
            <div class="form-group col-md-6 mb-50">
                <label for="inputlastname4">N° de técnicos</label>
                <input type="text" class="form-control" id="inputlastname4" name="num_tecnicos" value="<?= $data[0]['num_tecnicos'] ?>" placeholder="Número de técnicos con los que cuenta" require="true">
            </div>

            <div class="form-group col-md-6 mb-50">
                <label for="inputlastname4">Promedio servicios mes</label>
                <input type="text" class="form-control" id="inputlastname4" name="promedio_mes" value="<?= $data[0]['promedio_mes'] ?>" placeholder="Promedio de servicios que atiende al mes" require="true">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12 mb-50">
                <label for="inputlastname4">¿Los técnicos cuentan con formación en alguna escuela técnica o aprendieron de forma empírica?</label>
                <input type="text" class="form-control" id="inputlastname4" name="formacion_tenica" value="<?= $data[0]['formacion_tenica'] ?>" placeholder="¿Los técnicos cuentan con formación en alguna escuela técnica o aprendieron de forma empírica?" require="true">
            </div>
            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Atiende servicios en garantía con alguna marca?</label>
                <select class="form-control" name="garantia_marca" require="true">
                    <option value="1" <?php if ($data[0]['garantia_marca'] == 1) {
                                            echo "selected";
                                        } ?>>Si</option>
                    <option value="0" <?php if ($data[0]['garantia_marca'] == 0) {
                                            echo "selected";
                                        } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12 mb-50 cualmarca">
                <label for="inputlastname4">¿cuál marca?</label>
                <textarea class="form-control" rows="3" name="garantia_cual_marca" require="false"><?= $data[0]['formacion_tenica'] ?></textarea>
            </div>

            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Le interesa pertenecer a la red de servicio Whirlpool?</label>
                <select class="form-control" name="red_whirlpool" require="true">
                    <option value="1" <?php if ($data[0]['red_whirlpool'] == 1) {
                                            echo "selected";
                                        } ?>>Si</option>
                    <option value="0" <?php if ($data[0]['red_whirlpool'] == 0) {
                                            echo "selected";
                                        } ?>>No</option>
                </select>
            </div>
            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Cuenta con personal administrativo?</label>
                <select class="form-control" name="personal_administrativo" require="true">
                    <option value="1" <?php if ($data[0]['personal_administrativo'] == 1) {
                                            echo "selected";
                                        } ?>>Si</option>
                    <option value="0" <?php if ($data[0]['personal_administrativo'] == 0) {
                                            echo "selected";
                                        } ?>>No</option>
                </select>
            </div>

            <div class="form-group col-md-12 mb-50">
                <label for="inputfirstname4">¿Desde dónde opera?</label>
                <select class="form-control" name="donde_opera" require="true">
                    <option value="Desde Local Comercial" <?php if ($data[0]['donde_opera'] == 'Desde Local Comercial') {
                                                                echo "selected";
                                                            } ?>>Desde Local Comercial</option>
                    <option value="Desde Casa" <?php if ($data[0]['donde_opera'] == 'Desde Casa') {
                                                    echo "selected";
                                                } ?>>Desde Casa </option>
                </select>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
        <div class="row">
            <div class="col-12">
                <h4>Status</h4>
                <hr>
            </div>
            <div class="col-4">
                <form id="changestatus">
                    @csrf
                    <input value="<?= $data[0]['id'] ?>" hidden name="id" />
                    <input value="status" hidden name="accion" />
                    <label>Estatus</label>
                    <select class="form-control changeselect" name="statuschange">
                        <option <?php if ($data[0]['status'] == 0) {
                                    echo "selected";
                                } ?> value="0">Solicitado</option>
                        <option <?php if ($data[0]['status'] == 1) {
                                    echo "selected";
                                } ?> value="1">Aguardando Pago</option>
                        <option <?php if ($data[0]['status'] == 2) {
                                    echo "selected";
                                } ?> value="2">Confirmación de Pago</option>
                        <option <?php if ($data[0]['status'] == 3) {
                                    echo "selected";
                                } ?> value="3">Aceptado</option>
                        <option <?php if ($data[0]['status'] == 4) {
                                    echo "selected";
                                } ?> value="4">Rechazado</option>
                        <option <?php if ($data[0]['status'] == 5) {
                                    echo "selected";
                                } ?> value="5">Expirado</option>
                    </select>
                    <div class="mostrarinputrechazo" <?php if ($data[0]['status'] != 4) { ?>style="display:none;" <?php } ?>>
                        <label> Razón de Rechazo </label>
                        <textarea class="form-control" name="motivorechazo"><?= $data[0]['motivo_rechazo'] ?></textarea>
                        <br>
                        <a class="enviarrechazo btn btn-success white">Enviar Rechazo</a>
                        <a class="cancelarrechazo btn btn-grey">Cancelar</a>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <form id="changefechaexpira">
                    <?php
                    $fechaexpire = @explode('-', $data[0]['fecha_expire']);
                    $fechaexpire = @$fechaexpire[2] . '/' . @$fechaexpire[1] . '/' . @$fechaexpire[0];
                    if ($fechaexpire == '//') {
                        $fechaexpire = '';
                    }
                    ?>
                    @csrf
                    <input value="<?= $data[0]['id'] ?>" hidden name="id" />
                    <input value="expire" hidden name="accion" />
                    <label>Fecha de expiración <font style="color:red">*</font></label>
                    <input class="form-control datepicker" onchange="expliraccion()" name="fechaexpira" value="<?= $fechaexpire ?>" placeholder="Fecha de Expiración" />
                </form>
            </div>

            <div class="col-4">
                <form id="changepassword">
                    @csrf
                    <input value="<?= $data[0]['id'] ?>" hidden name="id" />
                    <label>Password</label>
                    <input value="<?= $data[0]['password'] ?>" onchange="changepass()" placeholder="Password" class="form-control passwordcliente" name="password" />
                </form>
            </div>


            <div class="col-12">
                <br>
                <h4>Confirmación de pago</h4>
                <hr>
                <?php if ($data[0]['status'] >= 2) {
                    echo $data[0]['recibodepago'];
                } else { ?>
                    <p>Aguardando pago...</p>
                <?php } ?>

                <p class="linkdepagoref" <?php if ($data[0]['status'] == 1) { ?> style="display: block;" <?php } else {
                                                                                                        echo 'style="display: none;"';
                                                                                                    } ?>>
                    Link para Pago: <a target="_blank" href="{{url('ingexp/confirmarpago')}}/<?= $data[0]['id'] ?>/<?= $data[0]['_token'] ?>">{{url('ingexp/confirmarpago')}}/<?= $data[0]['id'] ?>/<?= $data[0]['_token'] ?></a> </p>
            </div>
        </div>
    </div>
</div>

<script>
    $('.datepicker').pickadate({
        format: 'dd/mm/yyyy'
    });

    function expliraccion() {

        var form = $('#changefechaexpira').serialize();
        $.post("{{ url('/ingexp/changeestatussolicitud') }}", form, function(data) {
            console.log(data);
        });
        Swal.fire({
            type: "success",
            title: '¡Muy bien!',
            text: 'Fecha cambiada con éxito',
            confirmButtonClass: 'btn btn-success',
        });
    }

    function changepass() {


        var form = $('#changepassword').serialize();
        $.post("{{ url('/ingexp/changeestatussolicitud') }}", form, function(data) {
            console.log(data);

        });
        Swal.fire({
            type: "success",
            title: '¡Muy bien!',
            text: 'Contraseña cambiada con éxito',
            confirmButtonClass: 'btn btn-success',
        });
    }

    $('.enviarrechazo').click(function() {
        var form = $('#changestatus').serialize();
        $.post("{{ url('/ingexp/changeestatussolicitud') }}", form, function(data) {

            Swal.fire({
                type: "success",
                title: '¡Muy bien!',
                text: "Correo de rechazo enviado.",
                confirmButtonClass: 'btn btn-success',
            });

        });
    });

    $('.cancelarrechazo').click(function() {
        $('.mostrarinputrechazo').hide();
    });


    $('.changeselect').on('change', function(data) {
        var v = $(this).val();
        var form = $('#changestatus').serialize();
        var value = $(this).val();
        $('.mostrarinputrechazo').hide();
        if (value == 4) {
            $('.mostrarinputrechazo').show();
        } else {
            aprobado = 0;
            if(value == 3){                
                if($('.datepicker').val() == ''){
                    aprobado =1;
                }
            }

            if(aprobado == 0){            
                $.post("{{ url('/ingexp/changeestatussolicitud') }}", form, function(data) {
                    if (value == 3) {
                        $('.passwordcliente').val(data);
                        Swal.fire({
                            type: "success",
                            title: '¡Muy bien!',
                            text: 'Correo enviado y contraseña actualizada.',
                            confirmButtonClass: 'btn btn-success',
                        });
                    }
                    if (value == 1) {
                        Swal.fire({
                            type: "success",
                            title: '¡Muy bien!',
                            text: "Correo enviado con link para confirmación de pago.",
                            confirmButtonClass: 'btn btn-success',
                        });

                        $('.linkdepagoref').show();
                    }
                });
            }else{
                $(".changeselect").val("2");
                Swal.fire({
                            type: "error",
                            title: '¡Atención!',
                            text: "Elija una fecha de expiración.",
                            confirmButtonClass: 'btn btn-danger',
                        });
            }
        }
    });
</script>