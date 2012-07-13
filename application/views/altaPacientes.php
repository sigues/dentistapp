<script src="<?=base_url()?>js/lib/altaPacientes.js"></script>
<form action="" method="post" name="altaPaciente" id="altaPaciente" onsubmit="return false" class="frm">
    <table>
        <tr class="frm-non">
            <td><label for="nombre" >Nombre</label></td>
            <td><input type="text" name="nombre" id="nombre" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="apellidoPaterno" >Apellido Paterno</label></td>
            <td><input type="text" name="apellidoPaterno" id="apellidoPaterno" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="apellidoMaterno" >Apellido Materno</label></td>
            <td><input type="text" name="apellidoMaterno" id="apellidoMaterno" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="correo" >Correo Electrónico</label></td>
            <td><input type="text" name="correo" id="correo" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="telefono" >Teléfono</label></td>
            <td><input type="text" name="telefono" id="telefono" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="celular" >Celular</label></td>
            <td><input type="text" name="celular" id="celular" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="direccion" >Dirección</label></td>
            <td><input type="text" name="direccion" id="direccion" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="fechaNacimiento">Fecha de Nacimiento</label></td>
            <td><input type="text" id="fechaNacimiento" name="fechaNacimiento" /></td>
        </tr>
        <tr class="frm-non">
            <td>
                <span id="cancelar"></span>
            	<input type="hidden" name="idpaciente" id="idpaciente">
            	<input type="hidden" name="tipo" id="tipo">
            </td>
            <td><button class="boton">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>
