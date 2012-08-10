/**
 * @author svillegas
 */
    $(document).ready(function() {
    	//$('#fechaNacimiento').datepicker({ dateFormat: "mm/dd/yy" });
        var idCita = $("#idCita").val();
    	$.ajax({
                  url : 'listadoPagos',
                  data : {
                      idCita : idCita
                  },
                  success: function(data) {
                    $("#listadoPagos").html(data);
                  }
                });
        var restante = $("#cantidad").attr("max-cant");
        $("#altaPagos").validate({
            rules: {
                cantidad: {
                        required : true,
                        min : .01,
                        max : restante,
                        number : true
                }
            },
              submitHandler: function(form) {
                    $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
	            var cantidad = $("#cantidad").val();
	            var referencia = $("#referencia").val();
	            
	            $.ajax({
	              type: "POST",
	              url: 'altaPago',
	              data: {
	                cantidad : cantidad,
	                referencia : referencia,
	                idCita : idCita
	              },
	              success: function(data) {
	              	$('#respuesta').html("");
	                var datos = data.split("###");
	                if (datos[0]=="KO"){
	                	$('#respuesta').append("Se han encontrado errores al momento de guardar la información.");
	                } else {
	                	$("#listadoPagos").html("<center><img src='/dentista/images/loading.gif' /></center>");
                                var nuevo_restante = restante - cantidad;
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