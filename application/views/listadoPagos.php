<script src="<?=base_url()?>js/lib/listadoProcedimientos.js"></script>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Fecha</th>
            <th scope="col">Empleado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
<?php
/* 
 * cantidad | fechaHora | referencia | cita | empleado
 */
    foreach($pagos as $c=>$pago){ ?>
            <tr>
                <th scope="row"><?=$pago->idpago?></th>
                <td scope="row">$<?=number_format($pago->cantidad,2,".",",")?></td>
                <th scope="row"><?=$pago->fechaHora?></th>
                <td scope="row"><?=$pago->nombre." ".$pago->apellidos?></td>
                <td scope="row">8</td>
                <td scope="row">
                    <div style="width:80px;" class="ui-widget icon-collection">
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-trash" onclick="eliminarProcedimiento(<?=$pago->idpago?>)">Eliminar</span>
                        </div>
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-pencil" onclick="editarProcedimiento(<?=$pago->idpago?>)">Editar</span>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>