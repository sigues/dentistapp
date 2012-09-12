<?php

function separaHoras($horaInicio,$horaFin,$parametro = 30,$debug=FALSE){
/*        $datetime1 = new DateTime($horaInicio);
        $datetime2 = new DateTime($horaFin);
        $interval = $datetime1->diff($datetime2);
        $hDiferencia = $interval->format('%H');
        $mDiferencia = $interval->format('%i');
        $diferencia = $mDiferencia+($hDiferencia*60);
*/
        $to_time = strtotime(date("Y-m-d")." $horaFin");
        $from_time = strtotime(date("Y-m-d")." $horaInicio");
        $diferencia = abs($to_time - $from_time) / 60;
        if($debug==TRUE){
            echo "::$diferencia::";
        }
        $horaFinLibre = false;
        $tabla = false;
        if($diferencia>1){
            if($diferencia > $parametro){
                while($diferencia > 1){
                    if($horaFinLibre === false){
                        $horaInicioLibre = date("H:i",strtotime($horaInicio." +1 minute"));
                        $horaFinLibre="00:00";

                        if($debug==TRUE){
                            echo "::1 - $horaInicioLibre - $horaFinLibre::";
                        }


                    } else {
                        $horaInicioLibre = date("H:i",strtotime($horaFinLibre." +1 minute"));
                    }
                    if(strtotime(date("H:i",strtotime($horaFinLibre." +".($parametro-1)." minutes")))>strtotime($horaFin)){
                        //echo date("H:i",strtotime($horaFinLibre." +".($parametro-1)." minutes"))." -- ".$horaFin."<br>";
                        $horaFinLibre = date("H:i",strtotime($horaFin." -1 minute"));$die=true;
                        if($debug==TRUE){
                            echo "::2 - $horaFinLibre +30 > $horaFin::";
                        }
                        //echo $horaFinLibre."<br>";
                    } else {
                        $horaFinLibre = date("H:i",strtotime($horaInicioLibre." +29 minutes"));

                        if($debug==TRUE){
                            echo "::3 - $horaFinLibre::";
                        }

                    }
                    /*$datetime1 = new DateTime($horaFinLibre);
                    $datetime2 = new DateTime($horaFin);
                    $interval = $datetime1->diff($datetime2);
                    $hDiferencia = $interval->format('%H');
                    $mDiferencia = $interval->format('%i');
                    $diferencia = $mDiferencia+($hDiferencia*60);
*/
                    $to_time = strtotime(date("Y-m-d")." $horaFinLibre");
                    $from_time = strtotime(date("Y-m-d")." $horaFin");
                    $diferencia = abs($to_time - $from_time) / 60;
                    //echo $to_time."($horaFinLibre) - ".$from_time."($horaFin) - ".$diferencia." <br>";
                    //var_dump($diferencia);
                    $tabla.="<tr>
                                <td><span onclick='actualizaHoras(this.innerHTML);'>".$horaInicioLibre." - ".$horaFinLibre."</span></td><td>Libre</td>
                            </tr>";
                }
            } else {
                $horaInicioLibre = date("H:i",strtotime($horaInicio));
                $horaFinLibre = date("H:i",strtotime($horaFIn));
                $tabla.="<tr>
                            <td><span onclick='actualizaHoras(this.innerHTML);'>".$horaInicioLibre." - ".$horaFinLibre."</span></td><td>Libre</td>
                        </tr>";
            }
        }
        return $tabla;
}

$tabla="<table>";
$i=0;
foreach($citas as $cita){
    if($cita->horaInicio>"08:00"&&$i==0){
        $tabla.=separaHoras("07:59",$cita->horaInicio);
        $i++;
    }
    $horaInicio = $cita->horaInicio;
    if(isset($horaFin)){
/*        $datetime1 = new DateTime($horaInicio);
        $datetime2 = new DateTime($horaFin);
        $interval = $datetime1->diff($datetime2);
        $hDiferencia = $interval->format('%H');
        $diferencia = $interval->format('%i');
*/
        $to_time = strtotime(date("Y-m-d")." $horaInicio");
        $from_time = strtotime(date("Y-m-d")." $horaFin");
        $diferencia = abs($to_time - $from_time) / 60;


        //echo "-".$diferencia."<br>";
        if($diferencia>1){
            $horaInicioLibre = date("H:i",strtotime(date("Y-m-d")." ".$horaFin." +1 minute"));
            $horaFinLibre = date("H:i",strtotime(date("Y-m-d")." ".$horaInicio." -1 minute"));
            $tabla.=separaHoras($horaFin,$horaInicio);
        }
    }
    $horaFin    = $cita->horaFin;
    $tabla.="<tr>
                <td>".date("H:i",strtotime($horaInicio))." - ".date("H:i",strtotime($horaFin))."</td><td>Ocupado</td>
            </tr>";
}
if(isset($horaFin) && $horaFin<"19:00"){
    $tabla .= separaHoras($horaFin,"19:00");
}

if(!isset($horaFin) && !isset($horaInicio)){
    $tabla .= separaHoras("07:59","19:00");
}

$tabla.="</table>";
echo $tabla;
?>
