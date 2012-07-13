<?php 

$citasjs="";
foreach($citas as $cita){
    $fecha    = explode("-",$cita->fecha);
    $horaInicio       = explode(":",$cita->horaInicio);
    $horaFin       = explode(":",$cita->horaFin);
    
    $citasjs .= "{
                    id: ".$cita->idcita.",
                    title: '".$cita->nombre." ".$cita->apellidoPaterno." ".$cita->apellidoMaterno."',
                    start: new Date(".$fecha[0].",".($fecha[1]-1).",".$fecha[2].",".$horaInicio[0].",".$horaInicio[1]."),
                    end: new Date(".$fecha[0].",".($fecha[1]-1).",".$fecha[2].",".$horaFin[0].",".$horaFin[1]."),
                    allDay: false
                },";
}
$citasjs = substr($citasjs,0,-1);


?>

<script type='text/javascript'>
	$(document).ready(function() {
		$('#timepicker').datepicker({
                    minDate: new Date(<?=date("Y, m, d")?>)
                });
		$(".group1").colorbox({rel:'group1'});
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			editable: false,
			events: [
                            <?= $citasjs?>
			],
                        eventClick: function(calEvent, jsEvent, view) {
                            //alert('Event: ' + calEvent.title+' - '+calEvent.paciente);
                            $.colorbox({href:"<?=base_url()?>index.php/personal/verCita/"+calEvent.id});
                            // change the border color just for fun
                            $(this).css('border-color', 'red');

                        },
			dayClick: function(date, allDay, jsEvent, view) {
			    var fecha = $.fullCalendar.parseDate( date );
			    var d = fecha.getDate();
			    var m = fecha.getMonth()+1;
			    var y = fecha.getFullYear();
			    $.colorbox({
                                href:"<?=base_url()?>index.php/personal/agendarCita/"+y+'-'+m+'-'+d,width:"630px",
                                onClosed : function(){
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
                                }
                            });

			    //$(this).css('border-color', 'red');
			    //var fecha = date.split('(');
			    //fecha = fecha[0];agendaDay 
			    //$.fullCalendar( 'changeView', 'agendaDay' )
			    //var fecha = date.replace(" ", "-")
			    //var fecha = fecha.replace("(", "")
			    //$.colorbox({href:"<?=base_url()?>index.php/personal/agendarCita/"+fecha});
			}
                });
	});
</script>