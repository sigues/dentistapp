<?php
$tabla="<table>";

foreach($citas as $cita){
    $horaInicio = $cita->horaInicio;
    if(isset($horaFin)){
        $datetime1 = new DateTime($horaInicio);
        $datetime2 = new DateTime($horaFin);
        $interval = $datetime1->diff($datetime2);
        $hDiferencia = $interval->format('%H');
        $diferencia = $interval->format('%i');
        //echo "-".$diferencia."<br>";
        if($diferencia+($hDiferencia*60)>1){
            $horaInicioLibre = date("H:i",strtotime($horaFin." +1 minute"));
            $horaFinLibre = date("H:i",strtotime($horaInicio." -1 minute"));
            $tabla.="<tr>
                        <td><span onclick='actualizaHoras(this.innerHTML);'>".$horaInicioLibre." - ".$horaFinLibre."</span></td><td>Libre</td>
                    </tr>";
        }
    }
    $horaFin    = $cita->horaFin;
    $tabla.="<tr>
                <td>".date("H:i",strtotime($horaInicio))." - ".date("H:i",strtotime($horaFin))."</td><td>Ocupado</td>
            </tr>";
}

if(isset($horaFin)){
    $datetime1 = new DateTime("19:00:00");
    $datetime2 = new DateTime($horaFin);
    $interval = $datetime1->diff($datetime2);
    $hDiferencia = $interval->format('%H');
    $diferencia = $interval->format('%i');
    if($diferencia+($hDiferencia*60)>1){
        $horaInicioLibre = date("H:i",strtotime($horaFin." +1 minute"));
        $horaFinLibre = date("H:i",strtotime("19:00:00"." -1 minute"));
        $tabla.="<tr>
                    <td><span onclick='actualizaHoras(this.innerHTML);'>".$horaInicioLibre." - ".$horaFinLibre."</span></td><td>Libre</td>
                </tr>";
    }
}


$tabla.="</table>";
echo $tabla;
?>
