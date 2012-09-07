<script src="<?=base_url()?>js/lib/altaProductos.js"></script>

<form action="" class="frm" id="altaProducto"  method="post" name="altaProducto" onsubmit="return false;" >
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
            <td><label for="descripcion" class="frm-label" />Descripción:</td>
            <td><textarea rows="7" cols="50" name="descripcion" id="descripcion">Escribir descripción sobre el producto</textarea>
            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <input type="hidden" id="tipo" name="tipo">
                <input type="hidden" id="idproducto" name="idproducto">
                <div id="cancelar"></div>
            </td>
            <td><button class="boton" id="guardarProducto">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>