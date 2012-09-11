<script>
$(document).ready(function() {
        $('#timepicker').datepicker({ dateFormat: "dd/mm/yy" });
        $( "#paciente" ).autocomplete({
            source:"buscaPaciente",
            select: function(event, ui) {
                    var respuesta = pideAjax("getTratamiento/"+ui.item.value);
                    $("#tratamientos").html(respuesta);
                }
        });

        $("#buscarTratamiento").click(function(){
            var tratamiento = $("#tratamiento").val();
            if(tratamiento != ""){
                $.ajax({
                  type: "POST",
                  url: 'seguimientoTratamiento',
                  data: {
                    paciente : $("#paciente").val(),
                    tratamiento : $("#tratamiento").val(),
                  },
                  success: function(data) {
                    $('#respuesta').html("<center>La cita se guard\u00f3 satisfactoriamente</center>");
                  }
                });
            } else {
                alert("Debe seleccionar un tratamiento v\u00e1lido");
            }
        });

});



</script>
<form action="" method="POST" class="frm">
    <table width="500px">
        <tr class="frm-non">
            <td>
                <label for="paciente">Paciente: </label>
            </td>
            <td>
                <input type="text" id="paciente" value="" />
            </td>
        </tr>
        <tr class="frm-par">
            <td>
                <label for="tratamiento">Tratamiento</label>
            </td>
            <td>
                <span id="tratamientos" value="" ></span>
            </td>
        </tr>
        <tr class="frm-non">
            <td>
                &nbsp;
            </td>
            <td>
                <center><button class="boton" id="buscarTratamiento">Ver Tratamiento</button></center>
            </td>
        </tr>
    </table>

</form>