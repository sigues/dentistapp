<script src="<?=base_url()?>js/lib/listadoProcedimientos.js"></script>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Procedimiento</th>
            <th scope="col">Costo</th>
            <th scope="col">Descripción</th>
            <th scope="col">Realizados</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <? foreach($procedimientos->result() as $procedimiento) { ?>
            <tr>
                <th scope="row"><?=$procedimiento->idprocedimiento?></th>
                <th scope="row"><?=$procedimiento->nombre?></th>
                <td scope="row">$<?=number_format($procedimiento->precio,2,".",",")?></td>
                <td scope="row"><?=$procedimiento->descripcion?></td>
                <td scope="row">8</td>
                <td scope="row">
                    <div style="width:80px;" class="ui-widget icon-collection">
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-trash" onclick="eliminarProcedimiento(<?=$procedimiento->idprocedimiento?>)">Eliminar</span>
                        </div>
                        <div class="ui-state-default ui-corner-all boton boton20">
                            <span class="ui-icon ui-icon-pencil" onclick="editarProcedimiento(<?=$procedimiento->idprocedimiento?>)">Editar</span>
                        </div>
                    </div>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>