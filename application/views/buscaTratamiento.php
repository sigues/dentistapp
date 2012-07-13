<script>
$(document).ready(function() {
		$('#timepicker').datepicker({ dateFormat: "dd/mm/yy" });
$('#timepicker').datepicker({ dateFormat: "dd/mm/yy" });
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#paciente" ).autocomplete({
			source: availableTags,
			select: function(event, ui) {
                            //alert('"'+<?=base_url()?>+'"'+"personal/getTratamiento/"+ui.item.value);
                            var respuesta = pideAjax("<?=base_url()?>personal/getTratamiento/"+ui.item.value);
                            $("#tratamientos").html(respuesta);
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