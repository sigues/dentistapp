    <script>
        $(document).ready(function() {
            $("#cerrar_<?=$idcita?>").click( function(){
                var selected = $("#tabs").tabs('option', 'selected');
                $("#tabs").tabs("remove",selected);
            });
            $("#guardaProducto_<?=$idcita?>").click(function(){
                var idproducto = $("#productosActivos_<?=$idcita?>").val();
                var costo = $("#costoProducto_<?=$idcita?>").val();
                $.ajax({
                    type:"POST",
                    url:'<?=base_url()?>index.php/personal/agregaProductoCita',
                    data: {
                        idcita: <?=$idcita?>,
                        idproducto: idproducto,
                        costo: costo
                    },
                    success: function(data){
                        if(data == 'OK'){
                            var nombreProducto = $("#nombreProductos").attr("prod"+idproducto);
                            $("#productosCita").append("<br>$"+costo+" - "+nombreProducto);
                            var pendiente = parseFloat($("#pendienteTotal").attr("total"))
                            var pendienteTotal = pendiente+parseFloat(costo);                            
                            $("#pendienteTotal").attr("total",pendienteTotal);
                            $("#pendienteTotal").html(pendienteTotal);
                        } else {
                            
                        }
                    }
                });
            });
            $("#guardarCita_<?=$idcita?>").click( function(){
                $('#respuesta_<?=$idcita?>').html("<center><img src='/dentista/images/loading.gif' /></center>");
                $.ajax({
                  type: "POST",
                  dataType:"json",
                  url: '<?=base_url()?>index.php/personal/actualizaCita',
                  data: {
                    estado : $("#estado_<?=$idcita?>").val(),
                    observacion : $("#observacion_<?=$idcita?>").val(),
                    idcita : "<?=$idcita?>"
                  },
                  success: function(data) {
                      if(data.tipo == "OK"){
                          $('#observaciones_<?=$idcita?>').html("<center><img src='/dentista/images/loading.gif' /></center>");
                          $('#respuesta_<?=$idcita?>').html("<center>La observaci\u00f3n se guard\u00f3 satisfactoriamente</center>");
                          var respuesta = pideAjax("<?=base_url()?>index.php/personal/cargaObservaciones/<?=$idcita?>");
                          $("#observaciones_<?=$idcita?>").html(respuesta);
                          if($("#estado_<?=$idcita?>").val() == "realizada"){
                              $("#estado_<?=$idcita?>").attr("disabled","disabled");
                              $("#registraPago_<?=$idcita?>").css("display","block");
                          }
                      } else {
                        /*for (var key in data) {       //se deja comentado para cuando pongamos la opción de postponer cita
                            if (data.hasOwnProperty(key)) {
                                window.location = "#"+key+"_error";
                                $("#"+key+"_error").html(data[key]);
                            }
                        }*/
                        $('#respuesta_<?=$idcita?>').html("<center>No se pudo guardar la observaci\u00f3n</center>");
                      }
                  }
                });
            });


        });
    </script>
<?
if(isset($citas)){
    foreach($citas as $citaArr){
        if($citaArr->idcita == $idcita) {
            $cita = $citaArr;
        }
    } 
}   
$nombrePaciente = (isset($cita->nombrePaciente)) ? $cita->nombrePaciente." ".$cita->apellidoPaterno." ".$cita->apellidoMaterno : $paciente->nombrePaciente." ".$paciente->apellidoPaterno." ".$paciente->apellidoMaterno;
?>
<form action="" class="frm" onsubmit="return false;">
    <table>
        <tr class="frm-non">
            <td colspan="2"><h3>Cita <?=$idcita?> <span id="cerrar_<?=$idcita?>"><img src="<?=base_url()?>images/close.gif" /></span></h3> </td>
        </tr>
        <tr class="frm-par">
            <td><label for="hora" class="frm-label" />Hora:</td>
            <td><?=$cita->horaInicio?> - <?=$cita->horaFin?></td>
        </tr>
        <tr class="frm-non">
            <td><label for="paciente" class="frm-label" />Paciente:</td>
            <td><?=$nombrePaciente?></td>
        </tr>
        <tr class="frm-par">
            <td><label for="Procedimiento" class="frm-label" />Procedimiento:</td>
            <td><?=$cita->nombreProcedimiento?></td>
        </tr>
        <tr class="frm-non">
            <td><label for="paciente" class="frm-label" />Costo:</td>
            <td>$<?=$cita->costo?></td>
        </tr>
        <tr class="frm-par">
            <td><label for="productos" class="frm-label" />Productos:</td>
            <td>
                <select name="productosActivos_<?=$idcita?>" id="productosActivos_<?=$idcita?>">
                    <option> - Seleccionar - </option>
                    <? foreach($productosActivos as $prodActivo) { 
                        $productosInput .= " prod".$prodActivo->idproducto."='".$prodActivo->nombre."' ";
                    ?>
                        <option value="<?=$prodActivo->idproducto?>"><?=$prodActivo->nombre." ($".$prodActivo->precio.")"?></option>
                    <? } ?>
                </select> 
                <input type="hidden" name="nombreProductos" id="nombreProductos" <?=$productosInput?> />
                $<input type="text" name="costoProducto_<?=$idcita?>" id="costoProducto_<?=$idcita?>" size="3" /> <button name="guardaProducto_<?=$idcita?>" id="guardaProducto_<?=$idcita?>">Agregar</button>
                <div id="productosCita">
                    <?
                    $costoProductos=0;
                    foreach($productos as $producto) { ?>
                        <?="<br>$".$producto->costo." - ".$producto->nombre?>
                        <? $costoProductos += $producto->costo; ?>
                    <? } ?>
                </div>
            </td>
        </tr>
        <tr class="frm-non">
            <td><label for="informacion" class="frm-label" />Información:</td>
            <td><?=$cita->observaciones?></td>
        </tr>
        <tr class="frm-par">
            <td><label for="estado" class="frm-label" />Estado:</td>
            <?php
            $disabled = "";
                if($cita->estado == "realizada"){
                    $disabled = " disabled = 'disabled' ";
                }
            ?>
            <td><select name="estado_<?=$idcita?>" id = "estado_<?=$idcita?>" <?=$disabled?>>
                    <? foreach($estados as $estado){
                        $selected = "";
                        if($estado == $cita->estado){
                            $selected = "selected = 'selected' ";
                        }
                        ?>
                        <option value="<?=$estado?>" <?=$selected?>><?=$estado?></option>
                    <? } ?>
                </select>
                
            </td>
        </tr>
        <tr class="frm-non">
            <td><label for="estado" class="frm-label" />Estado Financiero:</td>
            <?
                $disabled = "";

                if($cita->estadoFinanciero == "pagado"){
                    $disabled = " disabled = 'disabled' ";
                }

                if($cita->estadoFinanciero != "pagado" && $cita->estado == "realizada"){
                    $display = "block";
                }else{
                    $display = "none";
                }
            ?>
            <td><?php
                    $pendiente = ($cita->costo - $cita->cantidad) + $costoProductos;
                ?>
                <?=ucfirst($cita->estadoFinanciero)?>
                <? if($cita->estadoFinanciero == "pendiente" || $cita->estadoFinanciero == "en proceso"){ ?>
                ($<span id="pendienteTotal" total="<?=$pendiente?>"><?=$pendiente?></span>)
                <? }
                if($pendiente>0){?>
                <button class="boton"
                        style="display:<?=$display?>"
                        id="registraPago_<?=$idcita?>"
                        onClick='window.location = "<?=base_url()."index.php/personal/pagos/".$idcita?>";'
                        costoTotal="">
                    Registrar Pago
                </button>
                <? } ?>
            </td>
        </tr>
        <tr class="frm-par">
            <td><label for="observaciones" class="frm-label" />Observaciones:</td>
            <td><textarea rows="7" cols="50" id="observacion_<?=$idcita?>" nombre="observacion_<?=$idcita?>"></textarea></td>
        </tr>
        <tr class="frm-non">
            <td>&nbsp;</td>
            <td><button class="boton" id="guardarCita_<?=$idcita?>">Guardar Cita</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2"><div id="respuesta_<?=$idcita?>"></div></td>
        </tr>

    </table>
</form>
<div id="observaciones_<?=$idcita?>">
<? 
if(isset($observaciones)){
    $data["observaciones"] = $observaciones;
    $this->load->view("observaciones",$data["observaciones"]);
}
?>
</div>