$('#update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var idpersona = button.data('idpersona') // Extract info from data-* attributes
    var parametros = {
        "table" : "persona",
        "where":"idpersona",
        "dato": idpersona
    };
    $.ajax({
        data:  parametros,
        url:   'Persona/datos',
        type:  'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success:  function (response) {
            //$("#resultado").html(response);
            //console.log(response);
            var datos = JSON.parse(response);
            $('#apellido_paterno').prop('value',datos.apellido_paterno);
            $('#apellido_materno').prop('value',datos.apellido_materno);
            $('#nombres').prop('value',datos.nombres);
            $('#ci').prop('value',datos.ci);
            $('#profesion').prop('value',datos.profesion);
            $('#telefono').prop('value',datos.telefono);
            $('#celular').prop('value',datos.celular);
            $('#email').prop('value',datos.email);
            $('#genero').prop('value',datos.genero);
            $('#idpersona').prop('value',datos.idpersona);
        }
    });

})