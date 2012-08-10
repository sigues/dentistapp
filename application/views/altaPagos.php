<script src="<?=base_url()?>js/lib/altaPagos.js"></script>

<?php
    $restante = $cita->costo - $cita->cantidad;
?>

<form action="" class="frm" id="altaPagos"  method="post" name="altaPagos" onsubmit="return false;" >
    <table>
        <tr class="frm-non">
            <td><label for="cantidad" />Cantidad:</td>
            <td>$<input type="text" name="cantidad" id="cantidad" max-cant="<?=$restante?>" /></td>
        </tr>
        <tr class="frm-par">
            <td><label for="referencia" />Referencia:</td>
            <td><input type="text" name="precio" id="precio" size="5" /></td>
        </tr>
        <tr class="frm-non">
            <td>
                <input type="hidden" id="idCita" name="idCita" value="<?=$cita->idcita?>">
            </td>
            <td><button class="boton" id="guardarPago">Guardar</button></td>
        </tr>
        <tr class="frm-non">
            <td colspan="2">
                <div id="respuesta"></div>
            </td>
        </tr>
    </table>
</form>