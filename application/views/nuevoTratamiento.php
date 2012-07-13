<form action="" method="post" class="frm">
    <table>
        <tr class="frm-non">
            <td><label for="nombre" class="frm-label">Paciente</label></td>
            <td><input type="text" name="nombre" class="frm-text" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="tratamiento" class="frm-label">Tratamiento</label></td>
            <td><select name="tratamiento">
                    <option value="0">Seleccione</option>
                    <option value="0">Ortodoncia</option>
                    <option value="0">Implante</option>
                </select></td>
        </tr>
        <tr class="frm-non">
            <td><label for="costo" class="frm-label">Costo Total</label></td>
            <td>$<input type="text" name="costo" class="frm-text" size="5" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="duracion" class="frm-label">Duración Estimada (meses)</label></td>
            <td><input type="text" name="duracion" class="frm-text" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="fechaInicio" class="frm-label">Fecha de Inicio</label></td>
            <td><input type="text" name="fechaInicio" class="frm-text" /></td>
        </tr>
        <tr class="frm-par">
            <td>&nbsp;</td>
            <td><button type="submit" name="guardar" value="Guardar" class="boton">Guardar</button></td>
        </tr>
    </table>
</form>
