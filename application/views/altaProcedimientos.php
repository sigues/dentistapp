<script src="<?=base_url()?>js/lib/altaProcedimientos.js"></script>

<form action="" class="frm" id="altaProcedimiento"  method="post" name="altaProcedimiento" onsubmit="return false;" >
    <table>
        <tr class="frm-non">
            <td><label for="nombre" />Nombre:</td>
            <td><input type="text" name="nombre" id="nombre" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="precio" />Precio Sugerido:</td>
            <td>$<input type="text" name="precio" id="precio" size="5" /></td>
        </tr>
        <tr class="frm-non">
            <td><label for="tratamiento" />Tratamiento:</td>
            <td><input type="checkbox" name="tratamiento" id="tratamiento" />
            <small>Indica si este procedimiento se realiza en más de una cita.</small></td>
        </tr>
        <tr class="frm-par">
            <td><label for="descripcion" class="frm-label" />Descripción:</td>
            <td><textarea rows="7" cols="50" name="descripcion" id="descripcion">Escribir descripción sobre el procedimiento</textarea>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                <input type="hidden" id="tipo" name="tipo">
                <input type="hidden" id="idprocedimiento" name="idprocedimiento">
                <div id="cancelar"></div>
            </td>
            <td><button class="boton" id="guardarCita">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>