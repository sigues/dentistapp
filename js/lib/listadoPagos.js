

function generarRecibo(cita){
    $.ajax({
        url : '../imprimirRecibo',
        data : {
            idCita : cita
        },
        type : "POST",
        success: function(data) {
            $("#resultado").html(data);
        }
    });    
}