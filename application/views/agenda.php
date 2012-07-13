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
                  personal : $("#personal").val()
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
<select name="personal" id="personal">
    <option value="0"> - Todos - </option>
<? foreach($empleados as $empleado){ ?>
    <option value="<?=$empleado->idempleado?>"><?=$empleado->nombre?></option>
<? } ?>
</select>
<div id = "divcalendar">
    <div id = 'calendar'></div>
</div>


