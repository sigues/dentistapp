/**
 * @author svillegas
 */
    $(document).ready(function() {
    	$('#fechaNacimiento').datepicker({ dateFormat: "mm/dd/yy" });
    	$.ajax({
                  url: 'listadoPacientes',
                  success: function(data) {
                    $("#listadoPacientes").html(data);
                  }
                });
            $("#altaPaciente").validate({
            rules: {
                            nombre: {
                                    required : true,
                                    minlength : 3,
                                    maxlength : 45
                            },
                            apellidoPaterno: {
                                    required : true,
                                    minlength : 3,
                                    maxlength : 60
                            },
                            apellidoMaterno: {
                                    required : true,
                                    minlength : 3,
                                    maxlength : 60
                            },
                            correo: {
                                    required : true,
                                    email : true
			  	},
			    fechaNacimiento : {
			    	required : true,
			    	date : true
			    },
			    direccion : {
			    	required : false,
			    	minlength : 3,
			  		maxlength : 60
			    },
			    telefono : {
			    	required : false
			    },
			    celular : {
			    	required : false
			    }
			    
		  	},
			  submitHandler: function(form) {
			  	$('#respuesta').html("<center><img src='../../images/loading.gif' /></center>");
	            var nombre = $("#nombre").val();
	            var apellidoPaterno = $("#apellidoPaterno").val();
	            var apellidoMaterno = $("#apellidoMaterno").val();
	            var correo = $("#correo").val();
	            var direccion = $("#direccion").val();
	            var telefono = $("#telefono").val();
	            var celular = $("#celular").val();
	            var fechaNacimiento = $("#fechaNacimiento").val();
                    var tipo = $("#tipo").val();
                    var idpaciente = $("#idpaciente").val();

	            $.ajax({
	              type: "POST",
	              url: 'altaPacientes',
	              data: {
	                nombre : nombre,
	                apellidoPaterno : apellidoPaterno,
	                apellidoMaterno : apellidoMaterno,
	                correo : correo,
	                fechaNacimiento : fechaNacimiento,
	                telefono : telefono,
	                celular : celular,
	                direccion : direccion,
                        tipo : tipo,
                        idpaciente : idpaciente
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
	                		if(datos[x]=="correo"){
	                			$('#respuesta').append("<br>Ya existe un usuario con la dirección de correo especificada. \""+correo+"\"");
	                		}
	                		$('#'+datos[x]).css("border","solid thin #ff566f");
	                	}
	                } else {
	                	$("#listadoPacientes").html("<center><img src='../../images/loading.gif' /></center>");
	                	$.ajax({
			              url: 'listadoPacientes',
			              success: function(data) {
			              	$("#listadoPacientes").html(data);
			              }
			            });
	                	$('#respuesta').append("Se ha guardado correctamente el paciente <span onclick='altaPaciente.reset();' class='boton'>Limpiar formulario</span>");
	                }
	              }
	            });
			  }
    	});
    });
