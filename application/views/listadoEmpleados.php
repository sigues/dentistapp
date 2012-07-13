<script src="<?=base_url()?>js/lib/listadoEmpleados.js"></script>

<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Puesto</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
		<?
			foreach($empleados->result() as $empleado){?>
				<tr>
					<th scope="row"><?=$empleado->idempleado?></th>
					<th scope="row"><?=$empleado->nombre." ".$empleado->apellidos?></th>
					<td><?=$empleado->puesto?></td>
					<td><?=$empleado->correo?></td>
					<td><?=$empleado->fechaNacimiento?></td>
					<td><div style="width:80px;" class="ui-widget icon-collection">
                                                <? if($idpersonal != $empleado->idempleado) { ?>
                                                <div class="ui-state-default ui-corner-all boton boton20">
						        <span class="ui-icon ui-icon-trash" onclick="eliminarEmpleado(<?=$empleado->idempleado?>)">Eliminar</span>
					        </div>
                                                <? } ?>
                                                <div class="ui-state-default ui-corner-all boton boton20">
						        <span class="ui-icon ui-icon-pencil" onclick="editarEmpleado(<?=$empleado->idempleado?>)">Editar</span>
                                                </div>
                                        </div>
                	</td>
				</tr>
			<?}
		?>    	
    </tbody>
</table>
