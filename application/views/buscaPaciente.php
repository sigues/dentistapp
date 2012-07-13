<?
$respuesta="";
foreach ($pacientes->result() as $paciente){
    $respuesta[] = $paciente->nombre." ".$paciente->apellidoPaterno." ".$paciente->apellidoMaterno;
}
echo json_encode($respuesta);
?>