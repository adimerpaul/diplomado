<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de docentes
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-users"></i>
        Registrar Docente
    </button>
    <div class="table-responsive">
        <table id="example" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>CI</th>
                <th>Telefono</th>
                <th>Gmail</th>
                <th>Genero</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = $this->db->query("SELECT * FROM persona p 
INNER JOIN docente d ON p.idpersona=d.idpersona
INNER JOIN usuario u ON p.idpersona=u.idpersona
WHERE u.idrol=3");

            foreach ($query->result() as $row)
            {
                echo "<tr>
                    <td>".$row->paterno." ".$row->materno." ".$row->nombres."</td>
                    <td>".$row->ci."</td>
                    <td>".$row->telefono."</td>
                    <td>".$row->email."</td>
                    <td>".$row->sexo."</td>
                    <td>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-id='$row->idusuario'> <i class='fa fa-pencil'></i>Modificar</button>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#actualizar' data-id='$row->idusuario'> <i class='fa fa-pencil'></i>Datos</button>
                    <a href='".base_url()."Docentes/delete/$row->idusuario' class='btn btn-danger btn-mini eli' > <i class='fa fa-trash'></i>Eliminar</a>
                    </td>
                </tr>";
            }
            ?>

            </tbody>
            <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Ci</th>
                <th>Telefono</th>
                <th>Gmail</th>
                <th>Genero</th>
                <th>Opciones</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert" method="post" action="<?=base_url()?>Docentes/insert">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">paterno</label>
                        <div class="col-sm-3">
                            <input type="text" id="paterno" value="" class="form-control" placeholder="paterno" name="paterno" required>
                        </div>
                        <label class="col-sm-1 col-form-label">materno</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="materno" name="materno" required>
                        </div>
                        <label class="col-sm-1 col-form-label">nombres</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="nombres" name="nombres" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ci</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="ci" name="ci" required>
                        </div>
                        <label class="col-sm-1 col-form-label">profesion</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="profesion" name="profesion" >
                        </div>
                        <label class="col-sm-1 col-form-label">email</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">celular</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="celular" name="celular" >
                        </div>
                        <label class="col-sm-1 col-form-label">telefono</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="telefono" name="telefono" >
                        </div>
                        <label class="col-sm-1 col-form-label">Genero</label>
                        <div class="col-sm-3">
                            <select name="sexo" class="form-control" required>
                                <option value="">Selecionar...</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">user</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="user" name="user" required>
                        </div>
                        <label class="col-sm-1 col-form-label">password</label>
                        <div class="col-sm-3">
                            <input type="" class="form-control" placeholder="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Close</button>
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Registrar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="actualizarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actualizarLabel">Editar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="actualizar" method="post" action="<?=base_url()?>Docentes/actualizar">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">paterno</label>
                        <div class="col-sm-3">
                            <input type="text" id="paterno2" value="" class="form-control" placeholder="paterno" name="paterno" required>
                            <input type="hidden" id="id2" name="id">
                        </div>
                        <label class="col-sm-1 col-form-label">materno</label>
                        <div class="col-sm-3">
                            <input type="text" id="materno2" class="form-control" placeholder="materno" name="materno" required>
                        </div>
                        <label class="col-sm-1 col-form-label">nombres</label>
                        <div class="col-sm-3">
                            <input type="text" id="nombres2" class="form-control" placeholder="nombres" name="nombres" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ci</label>
                        <div class="col-sm-3">
                            <input type="text" id="ci2" class="form-control" placeholder="ci" name="ci" required>
                        </div>
                        <label class="col-sm-1 col-form-label">profesion</label>
                        <div class="col-sm-3">
                            <input type="text" id="profesion2" class="form-control" placeholder="profesion" name="profesion" >
                        </div>
                        <label class="col-sm-1 col-form-label">email</label>
                        <div class="col-sm-3">
                            <input type="text" id="email2" class="form-control" placeholder="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">celular</label>
                        <div class="col-sm-3">
                            <input type="text" id="celular2" class="form-control" placeholder="celular" name="celular" >
                        </div>
                        <label class="col-sm-1 col-form-label">telefono</label>
                        <div class="col-sm-3">
                            <input type="text" id="telefono2" class="form-control" placeholder="telefono" name="telefono" >
                        </div>
                        <label class="col-sm-1 col-form-label">Genero</label>
                        <div class="col-sm-3">
                            <select name="sexo" class="form-control" id="sexo2" required>
                                <option value="">Selecionar...</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Cerrae</button>
                        <button type="submit" class="btn btn-warning"> <i class="fa fa-check"></i> Actualizar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Docentes/update">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" id="idusuario" name="idusuario" hidden>
                            <input id="nombre" type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="clave"  class="col-sm-3 col-form-label">Clave</label>
                        <div class="col-sm-9">
                            <input id="clave" type="" class="form-control" placeholder="clave" name="clave">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado"  class="col-sm-3 col-form-label">Estado</label>
                        <div class="col-sm-9">
                            <select id="estado" type="password" class="form-control" placeholder="estado" name="estado">
                                <option value="">Seleccionar</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script >

    window.onload=function (e) {
        var eli=document.getElementsByClassName("eli");
        for (var i=0;i<eli.length;i++){
            eli[i].addEventListener("click",function (e) {
                if (!confirm("Seguro de eliminar?"))
                    e.preventDefault();
            })
        }
        // $("#insert").submit(function (e) {
        //     e.preventDefault();
        //     var formData = new FormData(this);
        //     ///console.log($(this).serialize());
        //     $.ajax({
        //         url: 'Docentes/insert',
        //         type: 'POST',
        //         data: $(this).serialize(),
        //         success:function (e) {
        //             console.log(e);
        //         }
        //     });
        //     return false;
        // });
        $('#actualizar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var parametros = {
                "id": id
            };
            $.ajax({
                data: parametros,
                url: 'Docentes/find',
                type: 'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success: function (response) {
                    var datos = JSON.parse(response)[0];
                    // console.log(datos);
                    $('#id2').val(datos.idpersona);
                    $('#paterno2').val(datos.paterno);
                    $('#materno2').val(datos.materno);
                    $('#nombres2').val(datos.nombres);
                    $('#ci2').val(datos.ci);
                    $('#profesion2').val(datos.profesion);
                    $('#email2').val(datos.email);
                    $('#celular2').val(datos.celular);
                    $('#telefono2').val(datos.telefono);
                    $('#sexo2').val(datos.sexo);
                }
            });

        })


        $('#update').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            var parametros = {
                "table" : "usuario",
                "where":"idusuario",
                "dato": id
            };
            $.ajax({
                data:  parametros,
                url:   'Persona/datos',
                type:  'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                    //console.log(response);
                    var datos = JSON.parse(response);
                    $('#idusuario').prop('value', datos.idusuario);
                    $('#nombre').prop('value', datos.nombre);
                    $('#clave').prop('value', datos.clave);
                    $('#estado').prop('value', datos.estado);
                }
            });

        })
    }

</script>
