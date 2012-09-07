<a href="<?=base_url()?>index.php/personal/cita/<?=$_POST["idCita"]?>#tabs-2">Regresar a Cita</a>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Fecha</th>
            <th scope="col">Empleado</th>
            <th scope="col">Imprimir Recibos</th>
        </tr>
    </thead>
    <tbody>
<?php
/* 
 * cantidad | fechaHora | referencia | cita | empleado
 */
$total=0;
    foreach($pagos as $c=>$pago){
        $total += $pago->cantidad;?>
            <tr>
                <th scope="row"><?=$pago->idpago?></th>
                <td scope="row">$<?=number_format($pago->cantidad,2,".",",")?></td>
                <th scope="row"><?=$pago->fechaHora?></th>
                <td scope="row"><?=$pago->nombre." ".$pago->apellidos?></td>
                <td scope="row">
                    <div style="width:80px;" class="ui-widget icon-collection">
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-print" onclick="generarRecibo(<?=$pago->idpago?>)" alt="Generar Recibo">Generar Recibo</span>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Total:</td>
            <td>$<?=number_format($total,2,".",",")?></td>
            <td>
            <? if($costo-$total > 0){ ?>
                Restante: $<?=number_format($costo-$total,2,".",",");?>
            <? } else { ?>
                <div style="width:80px;" class="ui-widget icon-collection">
                    <div class="ui-state-default ui-corner-all boton boton20">
                        <span class="ui-icon ui-icon-print" onclick="generarRecibo(<?=$pago->idpago?>)" alt="Generar Recibo">Generar Recibo</span>
                    </div>
                </div> Imprimir Recibo
            <? } ?>
            </td>
            <td colspan="3">&nbsp;</td>
        </tr>
    </tfoot>
</table>
