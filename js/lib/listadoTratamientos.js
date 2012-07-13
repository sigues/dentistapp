function eliminarTratamiento(idtratamiento){
    $("#listadoTratamientos").html("<center><img src='/dentista/images/loading.gif' /></center>");
    $.ajax({
      url: 'eliminaTratamiento',
      data: {
        idtratamiento:idtratamiento
      },
      type:"POST",
      success: function(data) {
        if(data == 'OK'){
            $.ajax({
              url: 'listadoTratamientos',
              success: function(data) {
                $("#listadoTratamientos").html(data);
              }
            });
        }else{
            alert("No se pudo eliminar el tratamiento. Favor de intentarlo mas tarde.");
        }
      }
    });
}

function editarTratamiento(tratamiento){
    location.href="#tituloAltaTratamiento";
    $.ajax({
      url: 'getTratamientoJSON/'+tratamiento,
      dataType: "json",
	  success: function(data) {
                altaTratamiento.reset();
	  	$("#idtratamiento").val(data.idtratamiento);
	  	$("#nombre").val(data.nombre+" "+data.apellidoPaterno+" "+data.apellidoMaterno);
	  	$("#tratamiento").val(data.idprocedimiento);
	  	$("#descripcion").val(data.descripcion);
                $("#duracion").val(data.duracion);
                $("#citas").val(data.citas);
                $("#costo").val(data.costo);
                $("#fechaInicio").val(data.fechaInicio);
                $("#tipo").val("editar");
	  	$('#cancelar').html("<span onclick='altaTratamiento.reset();\n\
                                                  $(\"#cancelar\").html(\"\");\n\
                                                  $(\"#idtratamiento\").val(\"\");\n\
                                                  $(\"#tipo\").val(\"\");' class='boton'>Cancelar</span>");
          }
    });
}

