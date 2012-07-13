<script src="<?=base_url()?>js/lib/altaEmpleados.js"></script>
<form action="" onsubmit="return false;" method="post" id="altaEmpleado" class="frm">
    <table>
        <tr class="frm-non">
            <td><label for="nombre">Nombre</label></td>
            <td><input type="text" id="nombre" name="nombre"/></td>
        </tr>
        <tr class="frm-par">
            <td><label for="apellidos">Apellidos</label></td>
            <td><input type="text" id="apellidos" name="apellidos" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="correo">Correo Electrónico</label></td>
            <td><input type="text" id="correo" name="correo" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="contrasena" >Contraseña</label></td>
            <td><input type="password" id="contrasena" name="contrasena" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="contrasena2">Confirmar Contraseña</label></td>
            <td><input type="password" id="contrasena2" name="contrasena2" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="fechaNacimiento">Fecha de Nacimiento</label></td>
            <td><input type="text" id="fechaNacimiento" name="fechaNacimiento" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="puesto">Puesto</label></td>
            <td><select id="puesto" name="puesto" class="frm-text" >
            		<option value=""> - Seleccione - </option>
                    <option value="dentista">Dentista</option>
                    <option value="recepcionista">Recepcionista</option>
                </select>
            </td>
        </tr>
        <tr class="frm-par">
            <td>
            	<span id="cancelar"></span>
            	<input type="hidden" name="idempleado" id="idempleado">
            	<input type="hidden" name="tipo" id="tipo">
            </td>
            <td><button id="guardarEmpleado" class="boton" value="Guardar">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>