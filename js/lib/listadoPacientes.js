function eliminarPaciente(idpaciente){
    $("#listadoPacientes").html("<center><img src='../../images/loading.gif' /></center>");
    $.ajax({
      url: 'eliminaPaciente',
      data: {
        idpaciente:idpaciente
      },
      type:"POST",
      success: function(data) {
        if(data == 'OK'){
            $.ajax({
              url: 'listadoPacientes',
              success: function(data) {
                $("#listadoPacientes").html(data);
              }
            });
        }else{
            alert("No se pudo eliminar el paciente. Favor de intentarlo mas tarde.");
        }
      }
    });
}

function editarPaciente(paciente){
    location.href="#tituloAltaPaciente";
    $.ajax({
      url: 'getPacienteJSON/'+paciente,
      dataType: "json",
	  success: function(data) {
	  	$("#idpaciente").val(data.idpaciente);
	  	$("#nombre").val(data.nombre);
	  	$("#apellidoPaterno").val(data.apellidoPaterno);
	  	$("#apellidoMaterno").val(data.apellidoMaterno);
	  	$("#correo").val(data.correo);
	  	$("#fechaNacimiento").val(data.fechaNacimiento);
	  	$("#telefono").val(data.telefono);
	  	$("#celular").val(data.celular);
	  	$("#direccion").val(data.direccion);
	  	$("#tipo").val("editar");
	  	$('#cancelar').html("<span onclick='altaPaciente.reset();\n\
                                                  $(\"#cancelar\").html(\"\");\n\
                                                  $(\"#idpaciente\").val(\"\");\n\
                                                  $(\"#tipo\").val(\"\");' class='boton'>Cancelar</span>");
          }
    });
}
