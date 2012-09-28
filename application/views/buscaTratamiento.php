<script src="<?=base_url()?>js/lib/buscaTratamiento.js"></script>

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