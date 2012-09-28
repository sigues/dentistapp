<?
    foreach($cita as $c){
        $citaObj = $c;
    }
    $cita = $citaObj;
    
?>
<h3>Cita <?=$id?></h3>
<strong>Hora: </strong> <?=$cita->horaInicio?> - <?=$cita->horaFin?> <br/>
<strong>Paciente: </strong> <?=$cita->nombrePaciente." ".$cita->apellidoPaterno." ".$cita->apellidoMaterno?> <br/>
<strong>Procedimiento: </strong> <?=$cita->nombreProcedimiento?> <br/>
<strong>Costo: </strong> $<?=$cita->costo?> <br/>
<strong>Doctor: </strong> $<?=$cita->nombreEmpleado?> <br/>
<strong>Observaciones: </strong> <?=$cita->observaciones?> <br/>
<center><a href="<?=base_url()?>index.php/personal/cita/<?=$cita->idcita?>#tabs-2"><button class="boton" id="verExpediente">Ver cita y expediente</button></a></center>
<center><a href="<?=base_url()?><?=$eventoIcal?>"><button class="boton" id="verExpediente">Bajar para iphone</button></a></center>