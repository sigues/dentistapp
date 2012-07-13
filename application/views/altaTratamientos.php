<script src="<?=base_url()?>js/lib/altaTratamientos.js"></script>

<form action="" method="post" class="frm" id="altaTratamiento" name="altaTratamiento" onsubmit="return false;">
    <table>
        <tr class="frm-non">
            <td><label for="nombre" class="frm-label">Paciente</label></td>
            <td><input type="text" id="nombre" name="nombre" class="frm-text" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="tratamiento" class="frm-label">Tratamiento</label></td>
            <td><select nombre="tratamiento" id="tratamiento">
                    <option value="default">Seleccione</option>
                    <? foreach($procedimientos->result() as $procedimiento) { ?>
                        <option value="<?=$procedimiento->idprocedimiento?>"><?=$procedimiento->nombre?></option>
                    <? } ?>
                </select>
            </td>
        </tr>
        <tr class="frm-non">
            <td><label for="costo" >Costo Total</label></td>
            <td>$<input type="text" name="costo" id="costo" size="5" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="duracion" >Duración Estimada (meses)</label></td>
            <td><input type="text" name="duracion" id="duracion"  /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="citas" class="frm-label">Número de Citas</label></td>
            <td><input type="text" name="citas" id="citas" class="frm-text" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="fechaInicio" class="frm-label">Fecha de Inicio</label></td>
            <td><input type="text" id="fechaInicio" name="fechaInicio" class="frm-text" /></td>
        </tr>
        <tr class="frm-non">
            <td>
                <span id="cancelar"></span>
            	<input type="hidden" name="idtratamiento" id="idtratamiento">
            	<input type="hidden" name="tipo" id="tipo">
            </td>
            <td><button type="submit" name="guardar" value="Guardar" class="boton">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>
