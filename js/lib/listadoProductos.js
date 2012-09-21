function eliminarProducto(idproducto){
    $("#listadoProcedimientos").html("<center><img src='/dentista/images/loading.gif' /></center>");
    $.ajax({
      url: 'eliminaProducto',
      data: {
        idproducto:idproducto
      },
      type:"POST",
      success: function(data) {
        if(data == 'OK'){
            $.ajax({
              url: 'listadoProductos',
              success: function(data) {
                $("#listadoProductos").html(data);
              }
            });
        }else{
            alert("No se pudo eliminar el producto. Favor de intentarlo mas tarde.");
        }
      }
    });
}

function editarProducto(producto){
    location.href="#tituloAltaProducto";
    $.ajax({
      url: 'getProductoJSON/'+producto,
      dataType: "json",
	  success: function(data) {
                altaProducto.reset();
	  	$("#idproducto").val(data.idproducto);
	  	$("#nombre").val(data.nombre);
	  	$("#precio").val(data.precio);
	  	$("#descripcion").val(data.descripcion);
                $("#tipo").val("editar");
	  	$('#cancelar').html("<span onclick='altaProcedimiento.reset();\n\
                                                  $(\"#cancelar\").html(\"\");\n\
                                                  $(\"#idprocedimiento\").val(\"\");\n\
                                                  $(\"#tipo\").val(\"\");' class='boton'>Cancelar</span>");
          }
    });
}