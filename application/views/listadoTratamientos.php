<script src="<?=base_url()?>js/lib/listadoTratamientos.js"></script>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tratamiento</th>
            <th scope="col">Paciente</th>
            <th scope="col">Costo</th>
            <th scope="col">Liquidado</th>
            <th scope="col">Realizados</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($tratamientos->result() as $tratamiento) { ?>
            <tr>
                <th scope="row"><?=$tratamiento->idtratamiento?></th>
                <th scope="row"><?=anchor(base_url()."index.php/personal/seguimientoTratamiento/".$tratamiento->idtratamiento,$tratamiento->nombreTratamiento)?></th>
                <th scope="row"><?=anchor(base_url()."index.php/personal/expediente/".$tratamiento->idpaciente,$tratamiento->nombre.' '.$tratamiento->apellidoPaterno.' '.$tratamiento->apellidoMaterno)?></th>
                <td scope="row">$<?=number_format($tratamiento->costo,2,".",",")?></td>
                <td scope="row">$<?=number_format($tratamiento->pagado,2,".",",")?></td>
                <td scope="row"><?=$tratamiento->citas?> / <?=$tratamiento->pendientes?></td>
                <td scope="row">
                    <div style="width:80px;" class="ui-widget icon-collection">
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-trash" onclick="eliminarTratamiento(<?=$tratamiento->idtratamiento?>)">Eliminar</span>
                        </div>
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-pencil" onclick="editarTratamiento(<?=$tratamiento->idtratamiento?>)">Editar</span>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>