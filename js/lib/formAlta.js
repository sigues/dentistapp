$(document).ready(function() {
    //$('#fechaNacimiento').datepicker({ dateFormat: "mm/dd/yy" });
    var idCita = $("#idCita").val();

    $("#altaPagos").validate({
            rules: {
                cantidad: {
                        required : true,
                        min : .01,
                        max : $("#cantidad").attr("max-cant"),
                        number : true
                }
            },
              submitHandler: function(form) {
                    $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
	            var cantidad = $("#cantidad").val();
	            var referencia = $("#referencia").val();

                    if(referencia == ""){
                        referencia = '';
                    }

	            $.ajax({
	              type: "POST",
	              url: 'altaPago',
	              data: {
	                cantidad : cantidad,
	                referencia : referencia,
	                cita_idcita : idCita
	              },
	              success: function(data) {
	              	$('#respuesta').html("");
	                var datos = data.split("###");
	                if (datos[0]=="KO"){
	                	$('#respuesta').append("Se han encontrado errores al momento de guardar la información.");
	                } else {
	                	$("#listadoPagos").html("<center><img src='/dentista/images/loading.gif' /></center>");
                                var nuevo_restante = $("#cantidad").attr("max-cant") - cantidad;
                                $("#cantidad").attr("max-cant",nuevo_restante);
	                	$.ajax({
                                      url : 'listadoPagos',
                                      data : {
                                          idCita : idCita
                                      },
                                      success: function(data) {
                                        $("#listadoPagos").html(data);
                                      }
                                    });

	                	$('#respuesta').append("Se ha guardado correctamente el pago <span onclick='altaPagos.reset();' class='boton'>Limpiar formulario</span>");
	                }
	              }
	            });
              }
    	});
});