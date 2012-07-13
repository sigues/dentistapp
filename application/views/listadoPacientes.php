<script src="<?=base_url()?>js/lib/listadoPacientes.js"></script>
<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Correo</th>
            <th scope="col">Fecha de Nacimiento</th>
            <th scope="col">Contacto</th>
            <th scope="col">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
		<?
			foreach($pacientes->result() as $paciente){?>
				<tr>
					<th scope="row"><?=$paciente->idpaciente?></th>
					<th scope="row"><?=$paciente->nombre." ".$paciente->apellidoPaterno." ".$paciente->apellidoMaterno?></th>
					<td><?=$paciente->correo?></td>
					<td><?=$paciente->fechaNacimiento?></td>
					<td>Tel: <?=$paciente->telefono?><br>
						Cel: <?=$paciente->celular?><br>
						Dirección: <?=$paciente->direccion?><br>
					</td>
					<td>
                                            <div style="width:80px;" class="ui-widget icon-collection">
                                                <div class="ui-state-default ui-corner-all boton boton20">
                                                    <span class="ui-icon ui-icon-trash" onclick="eliminarPaciente(<?=$paciente->idpaciente?>)">Eliminar</span>
                                                </div>
                                                <div class="ui-state-default ui-corner-all boton boton20">
                                                    <span class="ui-icon ui-icon-pencil" onclick="editarPaciente(<?=$paciente->idpaciente?>)">Editar</span>
                                                </div>
                                                <div class="ui-state-default ui-corner-all boton boton20">
                                                    <span class="ui-icon ui-icon-contact" onclick="location.href='<?=base_url()?>index.php/personal/expediente/<?=$paciente->idpaciente?>';">Ver Expediente</span>
                                                </div>
                                            </div>
                                        </td>
				</tr>
			<?}
		?>    	
    </tbody>
</table>