$(document).ready(function() {
        $('#timepicker').datepicker({ dateFormat: "dd/mm/yy" });
        $( "#paciente" ).autocomplete({
            source:"buscaPaciente",
            select: function(event, ui) {
                    $.ajax({
                      type: "POST",
                      url: 'getTratamiento',
                      data: {
                        paciente : ui.item.value
                      },
                      success: function(data) {
                        $('#tratamientos').html(data);
                      }
                    });
                }
        });

        $("#buscarTratamiento").click(function(){
            var tratamiento = $("#tratamiento").val();
            if(tratamiento != ""){
                $.ajax({
                  type: "POST",
                  url: 'listadoTratamiento',
                  data: {
                    paciente : $("#paciente").val(),
                    tratamiento : $("#tratamiento").val()
                  },
                  success: function(data) {
                    $('#respuesta').html(data);
                  }
                });
            } else {
                alert("Debe seleccionar un tratamiento v\u00e1lido");
            }
            return false;
        });

});



