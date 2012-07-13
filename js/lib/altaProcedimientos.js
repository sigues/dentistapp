/**
 * @author svillegas
 */
    $(document).ready(function() {
    	$.ajax({
                  url: 'listadoProcedimientos',
                  success: function(data) {
                    $("#listadoProcedimientos").html(data);
                  }
                });
            $("#altaProcedimiento").validate({
            rules: {
                        nombre: {
                                required : true,
                                minlength : 2,
                                maxlength : 80
                        },
                        precio: {
                                required : true,
                                minlength : 1,
                                maxlength : 8
                        },
                        descripcion: {
                                required : false,
                                maxlength : 255
                        }
                    },
                submitHandler: function(form) {
                    $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
	            var nombre = $("#nombre").val();
	            var precio = $("#precio").val();
	            var tratamiento = $("#tratamiento").attr('checked');
	            var descripcion = $("#descripcion").val();
	            var tipo = $("#tipo").val();
	            var idprocedimiento = $("#idprocedimiento").val();
	            $.ajax({
	              type: "POST",
	              url: 'altaProcedimiento',
	              data: {
	                nombre : nombre,
	                precio : precio,
	                tratamiento : tratamiento,
	                descripcion : descripcion,
                        tipo : tipo,
                        idprocedimiento : idprocedimiento
	              },
	              success: function(data) {
	              	$('#respuesta').html("");
	                var datos = data.split("###");
	                if (datos.length > 1 && datos[0]=="KO"){
	                	if(datos.length==2){
	                		var campo = "el campo";
	                		var marca = "marcará";
	                	}else{
	                		var campo = "los campos";
	                		var marca = "marcarán";
	                	}
	                	$('#respuesta').append("Se han encontrado errores al momento de guardar la información, "+campo+" con error se "+marca+" en rojo.");
	                	var longitud = datos.length-1;
	                	for(var x=1;x<=longitud;x++){
	                		if(datos[x]=="nombre"){
	                			$('#respuesta').append("<br>Ya existe un procedimiento con el nombre especificado. \""+nombre+"\"");
	                		}
	                		$('#'+datos[x]).css("border","solid thin #ff566f");
	                	}
	                } else {
	                	$("#listadoProcedimientos").html("<center><img src='/dentista/images/loading.gif' /></center>");
	                	$.ajax({
			              url: 'listadoProcedimientos',
			              success: function(data) {
			              	$("#listadoProcedimientos").html(data);
			              }
			            });
	                	$('#respuesta').append("Se ha guardado correctamente el procedimiento <span onclick='altaProcedimiento.reset();' class='boton'>Limpiar formulario</span>");
	                }
	              }
	            });
                }
    	});
    });


