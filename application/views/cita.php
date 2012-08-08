    <script>
        $(document).ready(function() {
            $("#cerrar_<?=$idcita?>").click( function(){
                var selected = $("#tabs").tabs('option', 'selected');
                $("#tabs").tabs("remove",selected);
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
            <td><label for="informacion" class="frm-label" />Información:</td>
            <td><?=$cita->observaciones?></td>
        </tr>
        <tr class="frm-non">
            <td><label for="estado" class="frm-label" />Estado:</td>
            <?php
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
        <tr class="frm-par">
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
            <td><!--<select name="estadoFinanciero_<?=$idcita?>" id = "estadoFinanciero_<?=$idcita?>" <?=$disabled?>>
                    <? foreach($estadosFinancieros as $estado){
                        $selected = "";
                        if($estado == $cita->estadoFinanciero){
                            $selected = "selected = 'selected' ";
                        }
                        ?>
                        <option value="<?=$estado?>" <?=$selected?>><?=$estado?></option>
                    <? } ?>
                </select>!-->
                <?php
                    $pendiente = $cita->costo - $cita->cantidad;
                ?>
                <?=$cita->estadoFinanciero?> - ($<?=$pendiente?>)
                <a href="<?=base_url()."index.php/personal/pagos/".$idcita?>"><button class="boton" style="display:<?=$display?>" id="registraPago_<?=$idcita?>">Registrar Pago</button></a>
            </td>
        </tr>
        <tr class="frm-non">
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