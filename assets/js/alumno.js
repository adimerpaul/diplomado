$('#insertProgram').submit(insertProgram);
function insertProgram() {
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/update'
        })
    ]).then(function (e) {
        if (e[0]==1){
            alert('Actualizado correctamente');
            $('#update').modal('hide');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
}
$('#update').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#idestudiante').prop('value', button.data('idestudiante'));
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
            $('#opcion').html('');
            $('#contenedor').html(response);
            $('#personal').click(actualizar);
            $('.actualizardoc').click(actualizardocumentos);
            $('.actualizarpagos').click(actualizarpagos);
            $('.actualizarnotas').click(actualizarnotas);
            $('.actualizarmulta').click(actualizarmulta);
            $('.actualizartramite').click(actualizartramite);
        }
    });
})
function actualizartramite(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "idestudiante": idestudiante,
        "idprograma": idprograma
    };
    var t="        <form method='post' style='padding-top: 20px' class='updatetramite' >\n" +
        "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>" +
        "<input type='text' name='idprograma' value='"+idprograma+"' hidden>";
    Promise.all([
        $.ajax({
            data: parametros,
            url: 'Alumno/alumnostramites',
            type: 'post'})
    ]).then(function (e) {
        res = JSON.parse(e);
        var documentos=res.row
        idRol = res.idRol;
        var disabled = '';
        if (idRol==='1'){
            disabled = '';
        }else[
            disabled = 'disabled'
        ]
        documentos.forEach(function (documento) {
            if(documento.estado=="SI"){
                t+=" <div class='col-sm-6'>"+documento.nombre+"</div> <div class='col-sm-6'> <input "+disabled+" type='radio' name='d"+documento.idtramite+"' checked value='SI'> SI <input "+disabled+" type='radio' name='d"+documento.idtramite+"' value='NO'>NO </div>";
            }else{
                t+=" <div class='col-sm-6'>"+documento.nombre+"</div> <div class='col-sm-6'><input "+disabled+" type='radio' name='d"+documento.idtramite+"' value='SI'> SI <input "+disabled+" type='radio' name='d"+documento.idtramite+"' checked value='NO'>NO  </div>";
            }
        })
        if (idRol==='1'){
            t+=("<div style='text-align: center; width: 100%' >\n" +
                "                <button type='submit' class='btn btn-success'>Guardar</button>\n" +
                "                <a data-dismiss='modal' type='button' class='btn btn-danger' >Cancelar</a>\n" +
                "            </div>\n" +
                "        </form>");
        }
        $('#opcion').html(t);
        $('.updatetramite').submit(updatetramite);
    })
    e.preventDefault();
}

function updatetramite() {
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/updatetramite'
        })
    ]).then(function (e) {
        //console.log(e);
        if (e[0]==1){
            $('#opcion').html('');
            alert('Actualizado correctamente');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
}
function actualizarmulta(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "idestudiante": idestudiante,
        "idprograma": idprograma
    };
    var t="        <form method='post' style='padding-top: 20px' class='updatemultas' >\n" +
        "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>" +
        "<input type='text' name='idprograma' value='"+idprograma+"' hidden>";
    Promise.all([
        $.ajax({
            data: parametros,
            url: 'Alumno/alumnosmultas',
            type: 'post'})
    ]).then(function (e) {
        res = JSON.parse(e);
        var documentos = res.row
        idRol = res.idRol;

        if (idRol==='1'){
            disabled = '';
        }else{
            disabled = 'disabled';
        }

        documentos.forEach(function (documento) {
            t+="<div class='row'> <div class='col-sm-6'>"+documento.motivo+"</div> <div class='col-sm-4'> <input "+disabled+" class='form-control'  name='m"+documento.idmulta+"' value='"+documento.monto+"'></div></div>";
        })
        if (idRol==='1'){
            t+="<div class='row'> <div class='col-sm-2'>MOTIVO</div><div class='col-sm-3'> <input class='form-control' name='motivo' placeholder='motivo' ></div><div class='col-sm-3'> <input class='form-control' name='monto' placeholder='monto' ></div><div class='col-sm-2'> <button type='submit' class='btn btn-warning'> <i class='fa fa-money'></i> Registrar multa</button></div></div>";
        }
        t+=("        </form>");
        $('#opcion').html(t);
        $('.updatemultas').submit(updatemultas);
    })
    e.preventDefault();
}
function updatemultas(e) {
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/insertmultas'
        })
    ]).then(function (e) {
        //console.log(e);
        if (e[0]==1){
            $('#opcion').html('');
            alert('Actualizado correctamente');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
}
function actualizarnotas(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "idestudiante": idestudiante,
        "idprograma": idprograma
    };
    var t="        <form method='post' style='padding-top: 20px' class='updatenotas' >\n" +
        "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>" +
        "<input type='text' name='idprograma' value='"+idprograma+"' hidden>";
    Promise.all([
        $.ajax({
            data: parametros,
            url: 'Alumno/alumnosnotas',
            type: 'post'})
    ]).then(function (e) {
        res = JSON.parse(e);
        var documentos=res.row
        idRol = res.idRol;
        var disabled = '';
        if (idRol==='1'){
            disabled = '';
        }else{
            disabled = 'disabled';

        }
        documentos.forEach(function (documento) {
            t+="    <div class='row'> <div class='col-sm-6'>"+documento.nombre+"</div> <div class='col-sm-4'> <input "+disabled+" class='form-control'  name='n"+documento.idmodulo+"' value='"+documento.nota+"' placeholder='notas' ></div></div>";
        })
        if (idRol==='1'){
            t+=("<div style='text-align: center; width: 100%' >\n" +
                "                <button type='submit' class='btn btn-success'>Guardar</button>\n" +
                "                <a data-dismiss='modal' type='button' class='btn btn-danger' >Cancelar</a>\n" +
                "            </div>\n" +
                "        </form>");
        }
        $('#opcion').html(t);
        $('.updatenotas').submit(actualizarno);
    })
    e.preventDefault();
}
function actualizarno() {
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/updatenotas'
        })
    ]).then(function (e) {
        //console.log(e);
        if (e[0]==1){
            $('#opcion').html('');
            alert('Actualizado correctamente');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
}
function actualizarpagos(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "idestudiante": idestudiante,
        "idprograma": idprograma
    };
    var t="        <form method='post' style='padding-top: 20px' class='updatepagos' >\n" +
        "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>" +
        "<input type='text' name='idprograma' value='"+idprograma+"' hidden>";
    Promise.all([
        $.ajax({
            data: parametros,
            url: 'Alumno/alumnospagos',
            type: 'post'})
    ]).then(function (e) {
        res = JSON.parse(e);
        var documentos=res.row
        idRol = res.idRol;
        var disabled = '';
        if (idRol==='1'){
            disabled = '';
        }else{
            disabled = 'disabled';
        }
        documentos.forEach(function (documento) {
            t+=" <div class='col-sm-3'>"+documento.nombre+"("+documento.m1+")</div> <div class='col-sm-9'> <input "+disabled+" class='form-control'  name='p"+documento.idtipopago+"' value='"+documento.monto+"' ></div>";
        })
        if (idRol==='1'){
            t+=("<div style='text-align: center; width: 100%' >\n" +
                "                <button type='submit' class='btn btn-success'>Guardar</button>\n" +
                "                <a data-dismiss='modal' type='button' class='btn btn-danger' >Cancelar</a>\n" +
                "            </div>\n" +
                "        </form>");
        }
        $('#opcion').html(t);
        $('.updatepagos').submit(actualizarpa);
    })
    e.preventDefault();
}
function actualizarpa(e){
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/updatepagos'
        })
    ]).then(function (e) {
        //console.log(e);
        if (e[0]==1){
            $('#opcion').html('');
            alert('Actualizado correctamente');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
}
function actualizardocumentos(e) {
    var idestudiante=$(this).attr('idestudiante');
    var idprograma=$(this).attr('idprograma');
    var parametros = {
        "idestudiante": idestudiante,
        "idprograma": idprograma
    };
    var t="        <form method='post' style='padding-top: 20px' class='updatedocuments' >\n" +
        "            <input type='text' name='idestudiante' value='"+idestudiante+"' hidden>" +
                    "<input type='text' name='idprograma' value='"+idprograma+"' hidden>";
    Promise.all([
        $.ajax({
        data: parametros,
        url: 'Alumno/alumnosdocumento',
        type: 'post'})
    ]).then(function (e) {
        res = JSON.parse(e);
        var documentos= res.row;
        idRol = res.idRol;
        disabled = '';
        console.log('idRol',idRol);
        if (idRol==='1'){
            console.log('entro');
            disabled = '';
        }else{
            console.log('no entro');
            disabled = 'disabled';
        }
        documentos.forEach(function (documento) {
            if(documento.tienedocumento=="SI"){
                t+=" <div class='col-sm-6'>"+documento.nombre+"</div> <div class='col-sm-6'><input "+disabled+" type='radio' name='d"+documento.iddocumento+"' checked value='SI'> SI <input "+disabled+" type='radio' name='d"+documento.iddocumento+"' value='NO'>NO </div>";
            }else{
                t+=" <div class='col-sm-6'>"+documento.nombre+"</div> <div class='col-sm-6'><input "+disabled+" type='radio' name='d"+documento.iddocumento+"' value='SI'> SI <input "+disabled+" type='radio' name='d"+documento.iddocumento+"' checked value='NO'>NO  </div>";
            }
        })
        if (idRol==='1'){
            t+=("<div style='text-align: center; width: 100%' >\n" +
                "                <button type='submit' class='btn btn-success'>Guardar</button>\n" +
                "                <a data-dismiss='modal' type='button' class='btn btn-danger' >Cancelar</a>\n" +
                "            </div>\n" +
                "        </form>");
        }
        $('#opcion').html(t);
        $('.updatedocuments').submit(actualizardoc);
    })
    e.preventDefault();
}
function actualizardoc(e) {
    Promise.all([
        $.ajax({
            data:$(this).serialize(),
            type:'POST',
            url:'Alumno/updatedocuments'
        })
    ]).then(function (e) {
        if (e[0]==1){
            $('#opcion').html('');
            alert('Actualizado correctamente');
        } else {
            alert('Algo salio mal');
        }
    });
    return false;
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
        data: parametros,
        url: 'Alumno/dat',
        type: 'post',
        beforeSend: function () {
            $('#opcion').html("Procesando, espere por favor...");
        },
        success: function (response) {
            const res = JSON.parse(response);
            const idRol = res.idRol;
            var datos=res.row[0];
            var botones = '';
            var disabled = '';
            if (idRol==='1'){
                botones = `<button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Actualizar</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Close</button>`;
                disabled = '';
            }else{
                botones = '';
                disabled = 'disabled';
            }
            const t = `
                    <form method="post" style="padding-top: 20px" id="datos">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">paterno</label>
                            <div class="col-sm-9">
                                <input type="text" id="idpersona" name="idpersona" hidden value="${datos.idpersona}">
                                <input ${disabled} type="text" id="paterno" class="form-control" placeholder="paterno" name="paterno" required value="${datos.paterno}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">materno</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="materno" class="form-control" placeholder="materno" name="materno" value="${datos.materno}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">nombres</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="nombres" class="form-control" placeholder="nombres" name="nombres" required value="${datos.nombres}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ci</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="ci" class="form-control" placeholder="ci" name="ci" required value="${datos.ci}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">profesion</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="profesion" class="form-control" placeholder="profesion" name="profesion" value="${datos.profesion}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">telefono</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="telefono" class="form-control" placeholder="telefono" name="telefono" value="${datos.telefono}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">celular</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="text" id="celular" class="form-control" placeholder="celular" name="celular" value="${datos.celular}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">email</label>
                            <div class="col-sm-9">
                                <input ${disabled} type="email" id="email" class="form-control" placeholder="email" name="email" value="${datos.email}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">genero</label>
                            <div class="col-sm-9">
                                <select ${disabled} name="genero" id="genero" class="form-control" required>
                                    <option value="">Selecionar...</option>
                                    <option value="MASCULINO">MASCULINO</option>
                                    <option value="FEMENINO">FEMENINO</option>
                                </select>
                            </div>
                        </div>
                        <div style="text-align: center; width: 100%">
                            ${botones}
                        </div>
                    </form>
                `;
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
