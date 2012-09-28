<h3> <?=$paciente->nombre.' '.$paciente->apellidoPaterno.' '.$paciente->apellidoMaterno?></h3> <br/>
<strong>ID: </strong> <?=$idpaciente?> <br/>
<strong>Direccion: </strong> <?=$paciente->direccion?> <br/>
<strong>Teléfono: </strong> <?=$paciente->telefono?><br/>
<strong>Cel: </strong> <?=$paciente->celular?> <br/>
<strong>Correo: </strong> <?=$paciente->correo?> <br/>
<!--<strong>Estatura: </strong> 1.70 <br/>
<strong>Peso: </strong> 70 kg <br/>
<strong>Tipo de Sangre: </strong> A+ <br/>
<strong>Observaciones: </strong> Paciente alérgico a la penicilina <br/>!-->
<br/>
<h2 class="demoHeaders">Citas</h2>
<div id="accordion">
    <? foreach($citas as $cita){ ?>
    <script>
        $(document).ready(function() {
            $("#editar_<?=$cita->idcita?>").click( function(){
                $("#accordion").accordion({ header: "h3" });
                $("#tabs").tabs("add","<?=base_url()."index.php/personal/tabCita/".$cita->idcita?>",
                "<?=$cita->idcita." - ".$cita->nombreProcedimiento." (".$cita->fecha.")"?>",<?=$cita->idcita?>);
            });
        });
    </script>
        <div>
                <h3><a href="#"><?=$cita->nombreProcedimiento?> <?=$cita->fecha?> <?=$cita->horaInicio?> (<?=$cita->estado?>)</a></h3>
                <div>
                    <span id="editar_<?=$cita->idcita?>" class="editar">Editar</span><br /><br />
                    <? 
                    $data["cita"] = $cita;
                    $this->load->view("resumenCita",$data);
                    ?>
                </div>
        </div>
    <? } ?>
    <!--<div>
            <h3><a href="#">Limpieza 12-01-2012</a></h3>
            <div>Phasellus mattis tincidunt nibh.</div>
    </div>
    <div>
            <h3><a href="#">Revision 08-05-2011</a></h3>
            <div>Nam dui erat, auctor a, dignissim quis.</div>
    </div>!-->
</div>
