$('#update').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#idestudiante').prop('value', button.data('idestudiante')) // Extract info from data-* attributes

})
$('#historial').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var idestudiante = button.data('idestudiante') // Extract info from data-* attributes
    $('#idestudiante2').prop('value', button.data('idestudiante'))
    var parametros = {
        "idestudiante": idestudiante
    };
    $.ajax({
        data:  parametros,
        url:   'Alumno/datos',
        type:  'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success:  function (response) {
            //$("#resultado").html(response);
            //console.log(response);
            $('#contenedor').html(response);
        }
    });

})