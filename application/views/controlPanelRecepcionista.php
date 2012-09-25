
<table width ="100%">
    <tr>
        <td><?=anchor(base_url().'index.php/personal/agenda','<div class="boton200"><div class="agenda"></div></div>
							    <div class="linkMenu">Agendar Citas</div>')?></td>
        <td><?=anchor(base_url().'index.php/personal/altaTratamientos','<div class="boton200"><div class="tratamientos"></div></div>
							    <div class="linkMenu">Nuevo Tratamiento</div>')?></td>
        <td><?=anchor(base_url().'index.php/personal/seguimientoTratamiento','<div class="boton200"><div class="seguimiento"></div></div>
							    <div class="linkMenu">Seguimiento de Tratamiento</div>')?></td>
            </tr>
    <tr>
        <td><?=anchor(base_url().'index.php/personal/altaPacientes','<div class="boton200"><div class="paciente"></div></div>
							    <div class="linkMenu">Alta de Pacientes</div>')?></td>
        <td><?=anchor(base_url().'index.php/personal/altaEmpleados','<div class="boton200"><div class="empleados"></div></div>
							    <div class="linkMenu">Alta de Empleados</div>')?></td>
        <td><?=anchor(base_url().'index.php/personal/procedimientos','<div class="boton200"><div class="procedimientos"></div></div>
							    <div class="linkMenu">Organizar Procedimientos</div>')?></td>
    </tr>
    <tr>
        <td><?=anchor(base_url().'index.php/personal/productos','<div class="boton200"><div class="productos"></div></div>
							    <div class="linkMenu">Alta de Productos</div>')?></td>
        <td><!--<?=anchor(base_url().'index.php/personal/altaEmpleados','<div class="boton200"></div><br/>
							    <div class="linkMenu">Alta de Empleados</div>')?>!--></td>
        <td><!--<?=anchor(base_url().'index.php/personal/procedimientos','<div class="boton200"></div><br/>
							    <div class="linkMenu">Organizar Procedimientos</div>')?>!--></td>
    </tr>
</table>