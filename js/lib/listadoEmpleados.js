function eliminarEmpleado(idempleado){
    $("#listadoEmpleados").html("<center><img src='/dentista/images/loading.gif' /></center>");
    $.ajax({
      url: 'eliminaEmpleado',
      data: {
        idempleado:idempleado
      },
      type:"POST",
      success: function(data) {
        if(data == 'OK'){
            $.ajax({
              url: 'listadoEmpleados',
              success: function(data) {
                $("#listadoEmpleados").html(data);
              }
            });
        }else{
            alert("No se pudo eliminar el empleado. Favor de intentarlo mas tarde.");
        }
      }
    });



}

function editarEmpleado(empleado){
	location.href="#tituloAltaEmpleado";
	$.ajax({
      url: 'getEmpleadoJSON/'+empleado,
      dataType: "json",
	  success: function(data) {
	  	$("#idempleado").val(data.idempleado);
	  	$("#nombre").val(data.nombre);
	  	$("#apellidos").val(data.apellidos);
	  	$("#correo").val(data.correo);
	  	$("#contrasena").val("");
	  	$("#contrasena2").val("");
	  	$("#fechaNacimiento").val(data.fechaNacimiento);
	  	$("#puesto").val(data.puesto);
	  	$("#tipo").val("editar");
	  	$('#cancelar').html("<span onclick='altaEmpleado.reset();\n\
                                    $(\"#cancelar\").html(\"\");\n\
                                    $(\"#idempleado\").val(\"\");\n\
                                    $(\"#tipo\").val(\"\");' class='boton'>Cancelar</span>");
      }
    });
}
