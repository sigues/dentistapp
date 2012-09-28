<table id="reporte">
    <thead>
        <tr>
            <th scope="col">Procedimiento</th>
            <th scope="col">Costo</th>
            <th scope="col">Pagado</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado / Estado Financiero</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <? 
        $totalAbonado = 0;
        foreach($citas as $cita){ 
            $abonoCita = ($cita->cantidad>$cita->costo)?$cita->costo:$cita->cantidad;
            $totalAbonado += $abonoCita;
            ?>
            <tr>
                <td scope="row"><?=$cita->nombreProcedimiento?></td>
                <td scope="row">$<?=number_format($cita->costo,2,".",",")?></td>
                <td scope="row">$<?=number_format($abonoCita,2,".",",")?></td>
                <td scope="row"><?=$cita->observaciones?></td>
                <td scope="row"><?= date("d/m/Y",strtotime($cita->fecha)) ?></td>
                <td scope="row"><?=$cita->estado." / ".$cita->estadoFinanciero?></td>
                <td scope="row">
                    <ul class="ui-widget ui-helper-clearfix">
                        <li class="ui-state-default ui-corner-all">
                            <?=anchor(base_url().'index.php/personal/cita/'.$cita->idcita.'#tabs-2',
                                    '<span class="ui-icon ui-icon-zoomin">Ver Cita</span>')?>
                        </li>
                    </ul>
                </td>
            </tr>

        
<?      } 
//var_dump($tratamiento);
        
?>
        
       <!-- <tr>
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
        </tr> !-->
    </tbody>
    <?
    $restante = $tratamiento->costo-$totalAbonado;
    $porcentaje = ($totalAbonado/$tratamiento->costo) * 100;
    ?>
    <tfoot>
        <tr>
            <th>&nbsp;</th>
            <th>Total:</th>
            <td>$<?=number_format($totalAbonado,2,".",",")?></td>
            <th>Restante:</th>
            <td>$<?=number_format($restante,2,".",",")?></td>
            <th><?=number_format($porcentaje,2,".",",")?>%</th>
            <th>&nbsp;</th>
        </tr>
    </tfoot>
</table>