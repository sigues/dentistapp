    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        $('#fecha').datepicker({ 
                                dateFormat: "dd/mm/yy",
                                minDate: new Date(y, m, d)
                            });
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
        $(function() {
                $( "#hora_inicio" ).slider({
                    max:24,
                    min:0,
                    slide: function(event, ui) {
                        $("#h_inicio").val($("#hora_inicio").slider('value'));
                    }
                });
        });
        $(function() {
                $( "#minuto_inicio" ).slider({
                    max:60,
                    min:0,
                    slide: function(event, ui) {
                        $("#m_inicio").val($("#minuto_inicio").slider('value'));
                    }
                });
        });
        $(function() {
                $( "#hora_fin" ).slider({
                    max:24,
                    min:0,
                    slide: function(event, ui) {
                        $("#h_fin").val($("#hora_fin").slider('value'));
                    }
                });
        });
        $(function() {
                $( "#minuto_fin" ).slider({
                    max:60,
                    min:00,
                    slide: function(event, ui) {
                        $("#m_fin").val($("#minuto_fin").slider('value'));
                    }
                });
        });
        $(function() {
                $( "#hora_fin" ).slider();
        });
        $(function() {
                $( "#fecha" ).change(function() {
                    var fecha = $( "#fecha" ).val().replace(/\//g,"-");
                    var doctor = $( "#doctor" ).val();
                    var respuesta = pideAjax("diaDoctor/"+fecha+"/"+doctor);
                    $("#diaDoctor").html(respuesta);
                });
        });
        $(function() {
                $( "#doctor" ).change(function() {
                    var fecha = $( "#fecha" ).val().replace(/\//g,"-");
                    var doctor = $( "#doctor" ).val();
                    var respuesta = pideAjax("diaDoctor/"+fecha+"/"+doctor);
                    $("#diaDoctor").html(respuesta);
                });
        });
        $(function() {
                $( "#procedimiento" ).change(function() {
                    var respuesta = pideAjax("costoSugerido/"+$( "#procedimiento" ).val());
                    $("#costoSugerido").html(respuesta);
                });
        });
        $("#agendarCita").validate({
        rules: {
                    paciente: {
                            required : true,
                            minlength : 3,
                            maxlength : 45
                    },
                    doctor: {
                            required : true
                    },
                    h_inicio: {
                            required : true,
                            range : [0, 23],
                            digits : true
                    },
                    h_fin: {
                            required : true,
                            range : [0, 23],
                            digits : true
                    },
                    m_inicio: {
                            required : true,
                            range : [0, 59],
                            digits : true
                    },
                    m_fin: {
                            required : true,
                            range : [0, 59],
                            digits : true
                    },
                    procedimiento: {
                            required: true
                    },
                    costo: {
                            required: true,
                            number: true
                    }
                },
        submitHandler: function(form) {
            $('#respuesta').html("<center><img src='/dentista/images/loading.gif' /></center>");
            $.ajax({
              type: "POST",
              url: 'validaCita',
              dataType: "json",
              data: {
                paciente : $("#paciente").val(),
                tratamiento : $("#tratamiento").val(),
                doctor : $("#doctor").val(),
                fecha : $("#fecha").val(),
                h_inicio : $("#h_inicio").val(),
                m_inicio : $("#m_inicio").val(),
                h_fin : $("#h_fin").val(),
                m_fin : $("#m_fin").val(),
                procedimiento : $("#procedimiento").val(),
                costo : $("#costo").val(),
                observaciones : $("#observaciones").val()
              },
              success: function(data) {
                  if(data.tipo == "error"){
                    for (var key in data) {
                        if (data.hasOwnProperty(key)) {
                            window.location = "#"+key+"_error";
                            $("#"+key+"_error").html(data[key]);
                        }
                    }
                    $('#respuesta').html("<center>No se pudo guardar la cita</center>");
                  } else {
                    $('#respuesta').html("<center>La cita se guard\u00f3 satisfactoriamente</center>");
                  }
              }
            });
          }
    	});
});

function actualizaHoras(horas){
    var hora = horas.replace(" ","");
    hora = hora.split('- ');
    var hora_inicio = hora[0].split(":");
    var hora_fin = hora[1].split(":");
    $("#h_inicio").val(hora_inicio[0]);
    $( "#hora_inicio" ).slider({ value: hora_inicio[0] });
    $("#m_inicio").val(hora_inicio[1]);
    $( "#minuto_inicio" ).slider({ value: hora_inicio[1] });
    $("#h_fin").val(hora_fin[0]);
    $( "#hora_fin" ).slider({ value: hora_fin[0] });
    $("#m_fin").val(hora_fin[1]);
    $( "#minuto_fin" ).slider({ value: hora_fin[1] });
}

function pideAjax(vurl){
	var html = $.ajax({
        url: vurl,
        async: false
        }).responseText;//oncomplete
	return html;
}
