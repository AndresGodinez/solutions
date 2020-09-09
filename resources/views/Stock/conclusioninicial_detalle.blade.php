<?php 
use App\Stock;
        $row = Stock::query()
            ->selectRaw('
            stock_inicial.id,
            stock_inicial.no_parte,
            stock_inicial.descripcion,
            stock_inicial.tipo_material,
            stock_inicial.precio_usd,
            stock_inicial.sir_anual,
            stock_inicial.proyecto,
            stock_inicial.categoria,
            stock_inicial.proveedor,
            stock_inicial.ots,
            stock_inicial.modelo,
            stock_inicial.produccion_inicial,
            stock_inicial.fecha_carga,
            stock_inicial.usuario,
            usuarios.nombre,
            stock_inicial.garantia,
            stock_inicial.comentario,
            stock_inicial.vol_vta_anual
            ')
            ->from('stock_inicial')
            ->leftJoin('usuarios', 'stock_inicial.usuario', '=', 'usuarios.username')
            ->whereRaw('stock_inicial.id=' . $_POST['id'])
            ->get();

        $row = $row[0];

    ?>
    <form class="formenvio">
        <div class="row">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <input type="hidden" name="stock_id" value="<?=$_POST['id']?>">
            
                
                   <div class="col-3">
                        <fieldset class="form-group">
                            <label for="basicInput">No Parte:</label>
                            <input class="form-control"  name="parte" type="text" readonly id="parte" size="40" value="<?php echo($row['no_parte']);?>">
                        </fieldset>
                    </div>
                  
                    <div class="col-3">
                        <fieldset class="form-group">
                            <label for="basicInput">Descripci&oacute;n:</label> 
                            <input class="form-control"  name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo($row['descripcion']);?>">
                        </fieldset>
                    </div>
                  
                    <div class="col-3">
                        <fieldset class="form-group">
                            <label for="basicInput">Tipo Material:</label> 
                            <input class="form-control"  name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo($row['tipo_material']);?>">
                        </fieldset>
                    </div>
                  
                <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">Precio USD:</label> 
                    <input class="form-control"  name="descripcion" type="text" readonly id="descripcion" size="40" value="<?php echo($row['precio_usd']);?>">
                 </fieldset>
                </div>  
                
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">SIR Anual:</label> 
                    <input class="form-control"  name='username' type='text' readonly id='username' size="40" value='<?php echo($row['sir_anual']);?>'>
                   </fieldset>
                </div>
                
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">Proyecto:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['proyecto']);?>'>
                </fieldset>
                </div>
                 
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">Categor&iacute;a:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['categoria']);?>'>
                </fieldset>
                </div>
                 
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">Proveedor:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['proveedor']);?>'>
                </fieldset>
                </div>
                 
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">OTS:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['ots']);?>'>
                </fieldset>
                </div>
                  
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">Producci&oacute;n Inicial:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['produccion_inicial']);?>'>
                </fieldset>
                </div>
                  
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">A&ntilde;os de Garant&iacute;a:</label> 
                    <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['garantia']);?>'>
                </fieldset>
                </div>
                
                    <div class="col-3">
                    <fieldset class="form-group">
                        <label for="basicInput">V&oacute;lumen de Venta Anual</label> 
                        <input class="form-control"  name='motivo' type='text' readonly id='motivo' size='40' value='<?php echo($row['vol_vta_anual']);?>' required />
                    </fieldset>
                    </div>
                 
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label for="basicInput">Comentarios Ingeniero:</label> 
                            <textarea class="form-control" name="comentario" readonly id="comentario" rows="4" cols="41" style="text-transform:uppercase" ><?php echo($row['comentario']);?></textarea>                                 
                        </fieldset>
                    </div>
                             
                    <div class="col-12">
                    <fieldset class="form-group">
                        <label for="basicInput">Conclusi&oacute;n</label>                    
                            <select  name="conclusion" id="conclusion" onChange="return validateR(this.value);" class="validate[required] textarea form-control formulariovalidacion"> 
                                <option value="">Selecciona </option>
                                <option value="PO COLOCADA">PO Colocada</option>
                            <!-- <option value="PIEZA NO REQUERIDA POR MATERIALES">PIEZA NO REQUERIDA POR MATERIALES</option>-->
                                <option value="RECHAZADA">Rechazo de Compra</option>
                            </select>
                        </label>
                   </fieldset>
                </div>

                <div id="otros" style="display:none" class="col-12">                                      
                    <fieldset class="form-group">
                        <label for="basicInput">PO:</label>                                         
                        <input class="form-control"  type="text" maxlength="20" id="po" name="po" style="text-transform:uppercase"/>                       
                    </fieldset>
                </div>
                 
                <div id="otros2" style="display:none" class="col-12"  >                    
                    <fieldset class="form-group">
                        <label for="basicInput">Tipo:</label>                                                        
                        <select align="right" name="tipo_conclusion" id="tipo_conclusion" onChange="return validateR(this.value);" class="validate[required] textarea form-control">  
                            <option value="">Selecciona </option>
                            <option value="2">Sustituto Activo Disponible (Con Proveedor)</option>
                            <option value="3">Stock Suficiente (Inv Disponible)</option>
                            <option value="4">Pieza con SIR 0  (Sin Consumo)</option>
                            <option value="5">Sin Espacio En Almacén/MOQ Grande (Compra No Rentable)</option>
                            <option value="6">Error En El Número De Parte</option>
                            <option value="7">Otro</option>
                        </select>                              
                    </fieldset>
                </div>
                <div id="otros3" style="display:none" class="col-12">                                         
                        <fieldset class="form-group">
                            <label for="basicInput">No. Sustituto:</label>                                        
                            <input class="form-control"  type="text" maxlength="20" id="no_sust" name="no_sust" style="text-transform:uppercase"/>
                        </fieldset>                    
                </div>
            
                
                <div class="col-12">
                    <fieldset class="form-group">
                        <label for="basicInput">Comentarios</label>                                                    
                            <textarea name="comentario" id="comentario" rows="5" style="text-transform:uppercase" class="validate[required] textarea form-control formulariovalidacion"></textarea>                      
                    </fieldset>
                </div>
        
                  
                <div class="col-12">
                    <fieldset class="form-group">                                            
                        <a class="btn btn-success autorizarpk" onclick="autorizando()" style="width: 100%;">
                            Autorizar
                        </a>
                    </fieldset>
                </div>
        


        </div>            
    </form>



    <script>


function validateR() {            
        var conclusion = document.getElementById("conclusion").value;
        var tipo_conclusion = document.getElementById("tipo_conclusion").value;

        if (conclusion == "PO COLOCADA" || conclusion == 'PO COLOCADA') {            

            document.getElementById('otros').style.display = 'block';
            
        }
        else {

            document.getElementById('otros').style.display = 'none';            
            
        }
        if (conclusion == 'RECHAZADA') {

            document.getElementById('otros2').style.display = 'block';
        }
        else {

            document.getElementById('otros2').style.display = 'none';
            
        }
        if (tipo_conclusion == '2') {

            document.getElementById('otros3').style.display = 'block';
        }
        else {

            document.getElementById('otros3').style.display = 'none';
        }
    }

    </script>