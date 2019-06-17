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
            $('#contenedor').html("Procesando, espere por favor...");
        },
        success:  function (response) {
            $('#contenedor').html(response);
            $('#personal').click(actualizar);
            $('#actualizardoc').click(actualizardocumentos);
        }
    });
})
function actualizardocumentos(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "table": 'documento',
        "where": '1',
        "dato": '1'
    };

    $.ajax({
        data:  parametros,
        url:   'Alumno/dat',
        type:  'post',
        beforeSend: function () {
            $('#opcion').html("Procesando, espere por favor...");
        },
        success:  function (response) {
            $('#opcion').html("        <form method='post' style='padding-top: 20px' >\n" +
                "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>");
            var datos=JSON.parse(response);
            //console.log(datos);
            for (var i=0;i<datos.length;i++){
                var myPromise = new Promise((resolve, reject) => {


                    var si=verificartexto(datos[i].iddocumento,idestudiante,idprograma,datos[i].nombre);

                    // if(/* Termino correctamente */) {
                    //     resolve('Success!');
                    // } else {
                    //     reject('Failure!');
                    // }
                });
            // t+="<div class='form-group row'>"+
            //     "<label  class='col-sm-4 col-form-label'>"+datos[i].nombre+"</label>"+
            //     "<div class='col-sm-8'>"+
            //     texto+
            //     "</div>"+
            //     "</div>";
            };
            myPromise.then(function() {
                $('#opcion').append("<div style='text-align: center; width: 100%' >\n" +
                    "                <button type='submit' class='btn btn-success'>Guardar</button>\n" +
                    "                <a data-dismiss='modal' type='button' class='btn btn-danger' >Cancelar</a>\n" +
                    "            </div>\n" +
                    "        </form>");
            }).catch(function() {
                /* capturar el error */
            })
        }
    });
    // var parametros = {
    //     "table": 'persona',
    //     "where": 'idpersona',
    //     "dato": idpersona,
    //     "where2": 'idpersona',
    //     "dato2": idpersona
    // };
    // $.ajax({
    //     data:  parametros,
    //     url:   'Alumno/dat2',
    //     type:  'post',
    //     beforeSend: function () {
    //         $('#opcion').html("Procesando, espere por favor...");
    //     },
    //     success:  function (response) {
    //     }
    // });
    e.preventDefault();
}
function verificartexto(iddocumento,idestudiante,idprograma,nombre){
    var parametros = {
        "table": 'estudiantedocumento',
        "where": 'iddocumento',
        "dato": iddocumento,
        "where2": 'idestudiante',
        "dato2": idestudiante,
        "where3": 'idprograma',
        "dato3": idprograma
    };
    $.ajax({
        data:  parametros,
        url:   'Alumno/dat3',
        type:  'post',
        success:  function (response) {
            var datos=JSON.parse(response);
            console.log(datos.length)
            if (datos.length==1){
                $('#opcion').append( "<input type='radio' name='d"+iddocumento+"' checked value='SI'> SI <input type='radio' name='d"+nombre+"' value='NO'>NO");
            } else{
                $('#opcion').append( "<input type='radio' name='d"+iddocumento+"' value='SI'> SI <input type='radio' name='d"+nombre+"' checked value='NO'>NO");
            }
        }
    });

}
function actualizar(e) {
    var idpersona=$(this).attr('idpersona');
    var parametros = {
        "table": 'persona',
        "where": 'idpersona',
        "dato": idpersona,
    };
    $.ajax({
        data:  parametros,
        url:   'Alumno/dat',
        type:  'post',
        beforeSend: function () {
            $('#opcion').html("Procesando, espere por favor...");
        },
        success:  function (response) {
            var datos=JSON.parse(response)[0];
            var t='\n' +
                '        <form method="post" style="padding-top: 20px" id="datos">\n' +
                '            <div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">apellido_paterno</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="idpersona"  name="idpersona" hidden value="'+datos.idpersona+'">\n' +
                '                    <input type="text" id="paterno" class="form-control" placeholder="apellido_paterno" name="paterno" required value="'+datos.paterno+'">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">apellido_materno</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="materno" class="form-control" placeholder="apellido_materno" name="materno" value="'+datos.materno+'">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">nombres</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="nombres" class="form-control" placeholder="nombres" name="nombres" required value="'+datos.nombres+'">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">ci</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="ci" class="form-control" placeholder="ci" name="ci" required value="'+datos.ci+'">\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">profesion</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="profesion" class="form-control" placeholder="profesion" name="profesion" value="'+datos.profesion+'">\n' +
                '                </div>\n' +
                '            </div><div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">telefono</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="telefono" class="form-control" placeholder="telefono" name="telefono" value="'+datos.telefono+'">\n' +
                '                </div>\n' +
                '            </div><div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">celular</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="text" id="celular" class="form-control" placeholder="celular" name="celular" value="'+datos.celular+'">\n' +
                '                </div>\n' +
                '            </div><div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">email</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <input type="email" id="email" class="form-control" placeholder="email" name="email" value="'+datos.email+'">\n' +
                '                </div>\n' +
                '            </div><div class="form-group row">\n' +
                '                <label  class="col-sm-3 col-form-label">genero</label>\n' +
                '                <div class="col-sm-9">\n' +
                '                    <select name="genero" id="genero" class="form-control" required>\n' +
                '                        <option value="">Selecionar...</option>\n' +
                '                        <option value="MASCULINO">MASCULINO</option>\n' +
                '                        <option value="FEMENINO">FEMENINO</option>\n' +
                '                    </select>\n' +
                '                </div>\n' +
                '            </div>\n' +
                '            <div style="text-align: center; width: 100%" >\n' +
                '                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Actualizar</button>\n' +
                '                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>\n' +
                '            </div>\n' +
                '        </form>';
            $('#opcion').html(t);
            $('#genero').val(datos.sexo);
            $('#datos').submit(saveestudent);
        }
    });
    e.preventDefault();

}
function saveestudent(e) {
    $.ajax({
        data:  $('#datos').serialize(),
        url:   'Alumno/updatestudent',
        type:  'post',
        success:  function (response) {
            if (response==1){
                $('#opcion').html('');

                alert('Actualizado correctamente');
            } else {
                alert('Algo salio mal');
            }
        }
    });

    //console.log($('#datos').serialize());
    return false;
}
