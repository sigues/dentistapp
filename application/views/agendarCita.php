<html>
<!--
<script type='text/javascript' src='<?=base_url()?>js/jquery/jquery-1.7.1.min.js'></script>
<script type='text/javascript' src='<?=base_url()?>js/jquery/jquery-ui-1.8.18.custom.min.js'></script>
<link type="text/css" href="<?=base_url()?>css/redmond/jquery-ui-1.8.18.custom.css" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url()?>css/colorbox.css" />
<script src="<?=base_url()?>js/jquery.colorbox-min.js"></script>
<link href="<?=base_url();?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?=base_url();?>css/barra.css" rel="stylesheet" type="text/css" media="screen" />

!-->

<script src="<?=base_url()?>js/jquery.validate.min.js"></script>
<script src="<?=base_url()?>js/lib/agendarCita.js"></script>

<h3>Agendar Cita</h3>

<form action="" name="" class="frm" method="post" onsubmit="return false;" name="agendarCita" id="agendarCita">
    <table width="500px">
        <tr class="frm-non">
            <td>
                <label for="paciente">Paciente: </label> <div id="paciente_error"></div>
            </td>
            <td>
                <input type="text" id="paciente" name="paciente" value="" />
            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="tratamiento">Tratamiento</label> <div id="tratamiento_error"></div>
            </td>
            <td>
                <span id="tratamientos" value="" ></span>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="doctor">Doctor</label> <div id="doctor_error"></div>
            </td>
            <td>
                <select name="doctor" id="doctor">
                    <option value=""> Seleccione </option>
                    <? foreach($doctores->result() as $doctor) {?>
                        <option value="<?=$doctor->idempleado?>"><?=$doctor->nombre.' '.$doctor->apellidos?></option>
                    <? } ?>
                </select>
                <span id="tratamientos" value="" ></span>
            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="fecha">Fecha</label> <div id="fecha_error"></div>
            </td>
            <td>
                <input type="text" id="fecha" value="<?=(!$fecha)?date('d/m/Y'):date('d/m/Y',strtotime($fecha));?>" />
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="hora">Hora:</label> <div id="hora_error"></div>
            </td>
            <td>
                <table>
                    <tr>
                        <td>
                            <div id="hora_inicio" style="width:150px;"></div>
                            <div id="minuto_inicio" style="width:150px;"></div>
                            <input type="text" size="2" id="h_inicio" name="h_inicio" />:
                            <input type="text" size="2" id="m_inicio" name="m_inicio" />

                            <div id="hora_fin" style="width:150px;"></div>
                            <div id="minuto_fin" style="width:150px;"></div>
                            <input type="text" size="2" id="h_fin" name="h_fin" />:
                            <input type="text" size="2" id="m_fin" name="m_fin" />
                            <br><br>
                            <div id="hora_cita" name="hora_cita"></div>
                        </td>
                        <td>
                            <div id="diaDoctor"></div>
                        </td>
                    </tr>
                </table>
                

            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="procedimiento">Procedimiento</label> <div id="procedimiento_error"></div>
            </td>
            <td>
                <select name="procedimiento" id="procedimiento">
                    <option value="">Seleccione un procedimiento</option>
                    <? foreach($procedimientos->result() as $procedimiento) { ?>
                    <option value="<?=$procedimiento->idprocedimiento?>"><?=$procedimiento->nombre?></option>
                    <? } ?>
                </select>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <label for="costo">Costo</label> <div id="costo_error"></div>
            </td>
            <td>
                $<input type="text" name="costo" id="costo"/> <div id="costoSugerido"></div>

            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="observaciones">Observaciones</label> <div id="observaciones_error"></div>
            </td>
            <td>
                <textarea rows="5" cols="20" name="observaciones" id="observaciones"></textarea>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                &nbsp;
            </td>
            <td>
                <center>
                    <button class="boton" id="guardarCita" value="Guardar">Guardar Cita</button>
                </center>
            </td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>
<!--
<div id="costoSugerido"></div> <br/>
<strong>Costo: </strong> $500.00 <br/>
<strong>Mas información: </strong> Mas información <br/>
<strong>Mas información: </strong> Mas información <br/>
<strong>Obervaciones: </strong> <textarea cols="15" rows="10"> Escribir observaciones sobre la cita</textarea><br/><br/><br/>
<center><button class="boton" id="verExpediente">Guardar Cita</button></center>!-->

</html>