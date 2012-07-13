/**
 * @author svillegas
 */
    $(document).ready(function() {
    	$('#fechaNacimiento').datepicker({ dateFormat: "mm/dd/yy" });
    	$.ajax({
          url: 'listadoEmpleados',
          success: function(data) {
            $("#listadoEmpleados").html(data);
          }
        });
        $("#altaEmpleado").validate({
        rules: {
                    nombre: {
                            required : true,
                            minlength : 3,
                            maxlength : 45
                    },
                    apellidos: {
                            required : true,
                            minlength : 3,
                            maxlength : 60
                    },
                    correo: {
                            required : true,
                            email : true
                    },
                    contrasena: {
                            required: function(element) {
                                return $("#tipo").val() == "";
                              },
                            minlength : 6,
                            maxlength : 15
                    },
                    contrasena2: {
                        equalTo: "#contrasena"
                    },
                    fechaNacimiento : {
                        required : true,
                        date : true
                    },
                    puesto : {
                        required : true
                    }
                },
        submitHandler: function(form) {
                        $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
            var nombre = $("#nombre").val();
            var apellidos = $("#apellidos").val();
            var correo = $("#correo").val();
            var contrasena = $("#contrasena").val();
            var fechaNacimiento = $("#fechaNacimiento").val();
            var puesto = $("#puesto").val();
            var tipo = $("#tipo").val();
            var idempleado = $("#idempleado").val();
            $.ajax({
              type: "POST",
              url: 'altaEmpleados',
              data: {
                nombre : nombre,
                apellidos : apellidos,
                correo : correo,
                contrasena : contrasena,
                fechaNacimiento : fechaNacimiento,
                puesto : puesto,
                tipo : tipo,
                idempleado : idempleado
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
                        $("#listadoEmpleados").html("<center><img src='/dentista/images/loading.gif' /></center>");
                        $.ajax({
                              url: 'listadoEmpleados',
                              success: function(data) {
                                $("#listadoEmpleados").html(data);
                              }
                            });
                        $('#respuesta').append("Se ha guardado correctamente el empleado <span onclick='altaEmpleado.reset();' class='boton'>Limpiar formulario</span>");
                }
              }
            });
          }
    	});
    });
