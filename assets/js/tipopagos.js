$('#update').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#idtipopago2').prop('value', button.data('idtipopago'))
    $('#nombre2').prop('value', button.data('nombre'))
    $('#monto2').prop('value', button.data('monto'))
})
