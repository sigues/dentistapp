<table id="reporte">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Empleado</th>
            <th scope="col">Fecha</th>
            <th scope="col">Observacion</th>
        </tr>
    </thead>
    <tbody>
		<?
			foreach($observaciones as $observacion){?>
				<tr>
					<th scope="row"><?=$observacion->idobservacion?></th>
					<th scope="row"><?=$observacion->nombre." ".$observacion->apellidos?></th>
					<td><?=$observacion->fechaHora?></td>
					<td><?=$observacion->observacion?></td>
				</tr>
			<?}
		?>
    </tbody>
</table>
