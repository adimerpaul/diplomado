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
    <table id="example" class="display" style="width:100%">
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
                    <td>".$row->apellido_paterno." ".$row->apellido_materno." ".$row->nombres."</td>
                    <td>".$row->ci."</td>
                    <td>".$row->telefono."</td>
                    <td>".$row->email."</td>
                    <td>".$row->genero."</td>
                    <td>
                    <button type=\"button\" class=\"btn btn-warning btn-mini\" data-toggle=\"modal\" data-target=\"#update\" data-id='$row->idusuario'> <i class='fa fa-pencil'></i>Modificar</button>
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Docentes/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Persona </label>
                        <div class="col-sm-9">
                            <select name="idpersona" required class="form-control">
                                <option value="">Seleccionar</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM persona WHERE idpersona NOT IN (SELECT idpersona FROM docente)");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpersona'>$row->apellido_paterno $row->apellido_materno $row->nombres</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Nombre</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Clave</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" placeholder="clave" name="clave">
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
                            <input id="clave" type="password" class="form-control" placeholder="clave" name="clave">
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