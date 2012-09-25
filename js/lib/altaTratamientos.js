$(document).ready(function() {
    $('#fechaInicio').datepicker({ dateFormat: "mm/dd/yy" });
    $( "#nombre" ).autocomplete({
        source:"buscaPaciente",
        width: 260
    });
    $.ajax({
                  url: 'listadoTratamientos',
                  success: function(data) {
                    $("#listadoTratamientos").html(data);
                  }
                });
                $.validator.addMethod("valueNotEquals", function(value, element, arg){
     return arg != value;
    }, "Value must not equal arg.");
            $("#altaTratamiento").validate({
            rules: {
                            nombre: {
                                    required : true,
                                    minlength : 9,
                                    maxlength : 137
                            },
                            tratamiento: {
                                    //required : true,
                                    valueNotEquals : "default"
                            },
			    costo : {
			    	required : true,
			    	number : true
			    },
			    citas : {
			    	required : true,
			    	digits : true
			    },
			    fechaInicio : {
			    	required : true,
                                date : true
			    },
			    duracion : {
			    	required : true,
                                digits : true
			    }
		  	},
              submitHandler: function(form) {
                    $('#respuesta').html("<center><img src='../../images/loading.gif' /></center>");
	            var nombre = $("#nombre").val();
	            var tratamiento = $("#tratamiento").val();
	            var costo = $("#costo").val();
	            var citas = $("#citas").val();
	            var fechaInicio = $("#fechaInicio").val();
	            var duracion = $("#duracion").val();
	            var tipo = $("#tipo").val();
                    var idtratamiento = $("#idtratamiento").val();

	            $.ajax({
	              type: "POST",
	              url: 'altaTratamiento',
	              data: {
	                nombre : nombre,
	                tratamiento : tratamiento,
	                costo : costo,
	                citas : citas,
	                fechaInicio : fechaInicio,
	                duracion : duracion,
	                tipo : tipo,
	                idtratamiento : idtratamiento
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
	                		if(datos[x]=="tratamiento"){
	                			$('#respuesta').append("<br>Seleccione un tratamiento.");
	                		}
	                		$('#'+datos[x]).css("border","solid thin #ff566f");
	                	}
	                } else {
	                	$("#listadoTratamientos").html("<center><img src='../../images/loading.gif' /></center>");
	                	$.ajax({
			              url: 'listadoTratamientos',
			              success: function(data) {
			              	$("#listadoTratamientos").html(data);
			              }
			            });
	                	$('#respuesta').append("Se ha guardado correctamente el tratamiento <span onclick='altaTratamiento.reset();' class='boton'>Limpiar formulario</span>");
	                }
	              }
	            });
              }
    	});
});
