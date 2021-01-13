@extends("layouts.app")

@section("content")
    <?php

    $tipomaterial = $get_records['tipomaterial'];
    $categoria = $get_records['categoria'];
    $marca1 = $get_records['marca'];

    ?>




    <h3>Solicitud de Alta de Partes </h3>

    <h4> Datos del Material </h4>
    <div class="card">
        <div class="card-body">
            <form id="formID" name="forma" method="post" action="{{ url('/alcopar/factible/altamaterialupdate/')}}">
                @csrf
                <div class="form-group row">
                    <label for="parte" class="col-sm-2 col-form-label">Número de Parte</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="parte" name="parte" style="text-transform:uppercase"
                               pattern=".{3,}" required title="Mínimo de 3 caracteres autorizados">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parte" class="col-sm-2 col-form-label">Descripción</label>
                    <div class="col-sm-10">
                        <input type="text" id="descripcion" name="descripcion" class="form-control"
                               style="text-transform:uppercase" pattern=".{5,}" required
                               title="Mínimo de 5 caracteres autorizados">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="parte" class="col-sm-2 col-form-label">Modelo</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="15" id="modelo" name="modelo" style="text-transform:uppercase"
                               class="form-control">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="taller" class="col-sm-2 col-form-label">Taller</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="15" id="taller" name="taller" style="text-transform:uppercase"
                               class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="dispatch" class="col-sm-2 col-form-label">Dispatch</label>
                    <div class="col-sm-10">
                        <input type="text" maxlength="13" id="dispatch" name="dispatch" style="text-transform:uppercase"
                               class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="motivo" class="col-sm-2 col-form-label">Motivo</label>
                    <div class="col-sm-10">
                        <input type="text" id="motivo" name="motivo" size="40" style="text-transform:uppercase"
                               class="form-control" style="text-transform:uppercase" pattern=".{5,}" required
                               title="mMínimo de 5 caracteres autorizados">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="donde" class="col-sm-2 col-form-label">&iquest;De d&oacute;nde obtuviste ese n&uacute;mero?</label>
                    <div class="col-sm-10">
                        <select name='donde' id='donde' onChange='return validateR(this.value);' class='form-control'
                                required>
                            <option value=''>Seleccionar Linea</option>
                            <option value='0'>Del Explosionado</option>
                            <option value='1'>Solicitud de Ingenier&iacute;a (Ing me lo di&oacute;)</option>
                            <option value='2'>Sustitutos de Centro de Soluciones</option>
                            <option value='3'>Zpricep / Sustituto en SAP</option>
                            <option value='4'>Part Smart</option>
                            <option value='5'>Otros</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="otros" style="display:none">
                    <div class="col-sm-10">
                        <label>
                            <textarea name="otro" id="otro" rows="5" style="text-transform:uppercase"
                                      class="form-control"></textarea>
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tipo_material" class="col-sm-2 col-form-label">Tipo de Material:</label>
                    <div class="col-sm-10">
                        <select name='tipo_material' id='tipo_material' onChange='return validateR(this.value);'
                                class='form-control' required>
                            <?php
                            echo "<option   value=''>Seleccionar Tipo de Material</option>";
                            foreach ($tipomaterial as $rowp) {
                                echo "<option   value=".$rowp['id_tipo_material'].">".$rowp['tipo_material']."</option>";
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tipo_material" class="col-sm-2 col-form-label">Categor&iacute;a:</label>
                    <div class="col-sm-10">
                        <select name='categoria' id='categoria' class='validate[required] form-control' required>
                            <?php
                            echo "<option   value=''>Seleccionar Categoria</option>";
                            foreach ($categoria as $rowp) {
                                echo "<option   value=".$rowp['id_categoria'].">".$rowp['categoria']."</option>";
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="tipo_material" class="col-sm-2 col-form-label">Familia:</label>
                    <div class="col-sm-10">
                        <select name="familia" id="familia" class="form-control">
                            <option value=''>Seleccionar Familia</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row otros1" id="" style="display:none">
                    <label for="marca1" class="col-sm-2 col-form-label">Marca:</label>
                    <div class="col-sm-10">
                        <select name='marca1' id='marca1' class="form-control">
                            <?php
                            echo "<option   value='0'>Seleccionar Tipo de Marca</option>";
                            foreach ($marca1 as $rowp) {
                                echo "<option   value=".$rowp['id'].">".$rowp['marca']."</option>";
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row otros1" id="" style="display:none">
                    <label for="marca1" class="col-sm-2 col-form-label">Tipo Categor&iacute;a Extra:</label>
                    <div class="col-sm-10">
                        <select name="categoria_extra" id="categoria_extra" class="form-control">
                            <option value='0'>Seleccionar Categor&iacute;a Extra</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row otros1" id="" style="display:none">
                    <label for="marca1" class="col-sm-2 col-form-label">Tipo Categor&iacute;a Extra:</label>
                    <div class="col-sm-10">
                        <select name="categoria_extra" id="categoria_extra" class="form-control">
                            <option value='0'>Seleccionar Categor&iacute;a Extra</option>
                        </select>
                    </div>
                </div>


                <div class="form-group row otros2" id="" style="display:none">
                    <label for="marca1" class="col-sm-2 col-form-label">Marca:</label>
                    <div class="col-sm-10">
                        <select name='marca2' id='marca2' class="form-control"
                                onChange='return validateR(this.value);'>
                            <?php
                            echo "<option   value='0'>Seleccionar Tipo de Marca</option>";
                            foreach ($marca1 as $rowp) {
                                echo "<option   value=".$rowp['id'].">".$rowp['marca']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <fieldset class="form-group">
                    <input type="submit" id="enviar" name="enviar" value="Solicitar Alta"
                           class="btn btn-primary" style="width: 100%;">
                </fieldset>

            </form>

        </div>
    </div>
    <script src="{{ asset('assets') }}/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script language="javascript">
        function validateR() {
            var donde = document.getElementById('donde').value;
            var tipo_material = document.getElementById('tipo_material').value;
            if (donde == '5') {
                document.getElementById('otros').style.display = 'block';
            } else {
                document.getElementById('otros').style.display = 'none';
            }
            if (tipo_material == '1' || tipo_material == '3') {
                $('.otros1').show();
            } else {
                $('.otros1').hide();
            }
            if (tipo_material == '4') {
                document.getElementById('otros2').style.display = 'block';
            } else {
                document.getElementById('otros2').style.display = 'none';

            }

        }

        $(document).ready(function() {
            $('#categoria').change(function() {
                $('#categoria option:selected').each(function() {
                    id_categoria = $(this).val();
                    $.get("{{ url('/alcopar/reving/jquery/getFamiliaJquery/')}}/" + id_categoria, function(data) {
                        $('#familia').html(data);
                    });
                });
            });
        });

        $(document).ready(function() {
            $('#tipo_material').change(function() {
                $('#tipo_material option:selected').each(function() {
                    id_tipo_material = $(this).val();
                    $.get("{{ url('/alcopar/reving/jquery/getCategoriaExtraJquery/')}}/" + id_tipo_material,
                        function(data) {
                            $('#categoria_extra').html(data);
                        });
                });
            });
        });

        <?php
        if(@$_GET['success'] == 1){
        ?>
        Swal.fire({
            type: 'success',
            title: '¡Ejecutado con éxito!',
            text: '',
            confirmButtonClass: 'btn btn-success',
        });
        <?php
        }
        ?>
    </script>
@endsection
