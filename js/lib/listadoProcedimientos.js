function eliminarProcedimiento(idprocedimiento){
    $("#listadoProcedimientos").html("<center><img src='/dentista/images/loading.gif' /></center>");
    $.ajax({
      url: 'eliminaProcedimiento',
      data: {
        idprocedimiento:idprocedimiento
      },
      type:"POST",
      success: function(data) {
        if(data == 'OK'){
            $.ajax({
              url: 'listadoProcedimientos',
              success: function(data) {
                $("#listadoProcedimientos").html(data);
              }
            });
        }else{
            alert("No se pudo eliminar el procedimiento. Favor de intentarlo mas tarde.");
        }
      }
    });
}

function editarProcedimiento(procedimiento){
    location.href="#tituloAltaProcedimiento";
    $.ajax({
      url: 'getProcedimientoJSON/'+procedimiento,
      dataType: "json",
	  success: function(data) {
                altaProcedimiento.reset();
	  	$("#idprocedimiento").val(data.idprocedimiento);
	  	$("#nombre").val(data.nombre);
	  	$("#precio").val(data.precio);
	  	$("#descripcion").val(data.descripcion);
                if(data.tratamiento == true){
                    $("#tratamiento").attr("checked","checked");
                } else {
                    $("#tratamiento").removeAttr("checked");
                }
	  	$("#tipo").val("editar");
	  	$('#cancelar').html("<span onclick='altaProcedimiento.reset();\n\
                                                  $(\"#cancelar\").html(\"\");\n\
                                                  $(\"#idprocedimiento\").val(\"\");\n\
                                                  $(\"#tipo\").val(\"\");' class='boton'>Cancelar</span>");
          }
    });
}
