<script>
    $(document).ready(function() {

	$(function() {
            $('#tabs').tabs({
                add: function(event, ui) {
                    $('#tabs').tabs('select', '#' + ui.panel.id);
                    $("#accordion").accordion({ header: "h3" });
                }});
            $("#accordion").accordion({ header: "h3" });
		
	});
    });
	</script>



    <div id="tabs">
            <ul>
                    <li><a href="#tabs-1">Expediente</a></li>
<?
    if(isset($idcita)){
        ?>
            <li><a href="#tabs-2">Cita</a></li>
        <?
        $data["idcita"]=$idcita;
    }
    $data["idpaciente"]=$idpaciente;
    $data["paciente"]=$paciente;
    $data["citas"]=$citas;
    $data["observaciones"]=$observaciones;
?>
            </ul>
            <div id="tabs-1"><?=$this->load->view('expediente',$data)?></div>
<?
    if(isset($idcita)){
        ?>
            <div id="tabs-2"><?=$this->load->view('cita',$data)?></div>
        <?
    }
    ?>
    </div>
<script>
    $("#accordion").accordion({ header: "h3" });
</script>