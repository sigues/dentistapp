<table id="reporte">
    <thead>
        <tr>
            <th scope="col">Procedimiento</th>
            <th scope="col">Costo</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">Endodoncia</td>
            <td scope="row">$700.00</td>
            <td scope="row">Todo salió bien</td>
            <td scope="row">05/04/2012</td>
            <td scope="row">
                <ul class="ui-widget ui-helper-clearfix">
                    <li class="ui-state-default ui-corner-all">
                        <?=anchor(base_url().'index.php/personal/cita/999#tabs-2',
                                '<span class="ui-icon ui-icon-zoomin">Ver Cita</span>')?>
                    </li>
                </ul>
            </td>
        </tr>
        <tr>
            <td scope="row">Limpieza</td>
            <td scope="row">$500.00</td>
            <td scope="row">Limpieza bucal general</td>
            <td scope="row">05/03/2012</td>
            <td scope="row">
                <ul class="ui-widget ui-helper-clearfix">
                    <li class="ui-state-default ui-corner-all">
                        <?=anchor(base_url().'index.php/personal/cita/999#tabs-2',
                                '<span class="ui-icon ui-icon-zoomin">Ver Cita</span>')?>
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>Total:</th>
            <td>$1200.00</td>
            <th>Restante:</th>
            <td>$2400.00</td>
            <th>50%</th>
        </tr>
    </tfoot>
</table>