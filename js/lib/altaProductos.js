/**
 * @author svillegas
 */
    $(document).ready(function() {
    	$.ajax({
                  url: 'listadoProductos',
                  success: function(data) {
                    $("#listadoProductos").html(data);
                  }
                });
            $("#altaProducto").validate({
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
                    //alert(form.nombre.value);
                    $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
	            var nombre = $("#nombre").val();
	            var precio = $("#precio").val();
	            var descripcion = $("#descripcion").val();
	            var tipo = $("#tipo").val();
	            var idproducto = $("#idproducto").val();
	            $.ajax({
	              type: "POST",
	              url: 'altaProducto',
	              data: {
	                nombre : nombre,
	                precio : precio,
	                descripcion : descripcion,
                        tipo : tipo,
                        idproducto : idproducto
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
	                	$("#listadoProductos").html("<center><img src='/dentista/images/loading.gif' /></center>");
	                	$.ajax({
			              url: 'listadoProductos',
			              success: function(data) {
			              	$("#listadoProductos").html(data);
			              }
			            });
	                	$('#respuesta').append("Se ha guardado correctamente el producto <span onclick='altaProducto.reset();' class='boton'>Limpiar formulario</span>");
	                }
	              }
	            });
                }
    	});
    });