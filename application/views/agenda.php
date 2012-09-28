<link rel='stylesheet' type='text/css' href='<?=base_url()?>css/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='<?=base_url()?>css/fullcalendar.print.css' media='print' />
<script type='text/javascript' src='<?=base_url()?>js/fullcalendar.min.js'></script>
<script>
    $(document).ready(function() {
        $("#personal").change(function(){
            $.ajax({
              type: "POST",
              url: 'agendaAjax',
              data: {
                  personal : $("#personal").val(),
                  estado : $("#estado").val()
              },
              success: function(data) {
                 //alert("balls"); 
                 $("#calendar").html("");
                 $("#scriptAjax").html(data);
              }
          });
        });
        
        $("#estado").change(function(){
            $.ajax({
              type: "POST",
              url: 'agendaAjax',
              data: {
                  personal : $("#personal").val(),
                  estado : $("#estado").val()
              },
              success: function(data) {
                 //alert("balls"); 
                 $("#calendar").html("");
                 $("#scriptAjax").html(data);
              }
          });
        });
    });
</script>
<div name="scriptAjax" id="scriptAjax">
    <?=$scriptAjax?>
</div>
Filtrar por doctor: <select name="personal" id="personal">
    <option value="0"> - Todos - </option>
<? foreach($empleados as $empleado){ ?>
    <option value="<?=$empleado->idempleado?>"><?=$empleado->nombre?></option>
<? } ?>
</select>
&nbsp;&nbsp;&nbsp;&nbsp;
Filtrar por estado de cita:
<select name="estado" id="estado">
    <option value="0"> - Todos - </option>
<? foreach($estados as $estado){ ?>
    <option value="<?=$estado?>"><?=$estado?></option>
<? } ?>
</select><br><br>
<div id = "divcalendar">
    <div id = 'calendar'></div>
</div>


