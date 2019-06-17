<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                <?=$title?>
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-map-o"></i>
        Registrar Programa
    </button>
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Nombre programa</th>
            <th>Version</th>
            <th>Estado</th>
            <th>Modulos</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = $this->db->query("SELECT * FROM programa");

        foreach ($query->result() as $row)
        {
            $query2 = $this->db->query("SELECT * FROM modulo WHERE idprograma='$row->idprograma'");
        $modulos="<table>";
        foreach ($query2->result() as $row2) {
            $modulos.="<tr><td>$row2->nombre</td><td><!--i class='fa fa-eye btn-mini btn-warning'></i--> <a href='".base_url()."Programas/deletemodulo/$row2->idmodulo'><i class='fa fa-times-circle btn-mini btn-danger eli'></i></a></td></tr>";
        }
        $modulos.="</table>";
            echo "<tr>
                    <td>".$row->nombre."</td>
                    <td>".$row->version."</td>
                    <td>".$row->estado."</td>
                    <td>$modulos</td>
                    <td>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->idprograma' data-version='$row->version' data-estado='$row->estado'> <i class='fa fa-pencil-square-o'></i> Modificar</button><br>
                    <a href='".base_url()."Programas/delete/$row->idprograma' type='button' class='btn btn-danger btn-mini eli' > <i class='fa fa-trash-o'></i> Eliminar</a>        <br>
                    <button type='button' class='btn btn-info btn-mini' data-toggle='modal' data-target='#modulo' data-id='$row->idprograma' > <i class='fa fa-plus'></i> Modulos</button>
                    </td>
                </tr>";
        }
        ?>

        </tbody>
    </table>
</div>
<!-- Modulo -->
<div class="modal fade" id="modulo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar modulo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Programas/insertmodulo">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Nombre del modulo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Codigo del modulo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="codigo" name="codigo" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Fecha inicio</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" placeholder="fechainicio" value="<?=date('Y-m-d')?>" name="fechainicio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Fecha Fin</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" placeholder="fechafin" value="<?=date('Y-m-d')?>" name="fechafin" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Docente</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" placeholder="iddocente" name="iddocente" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM docente d 
INNER JOIN persona p ON p.idpersona=d.idpersona");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpersona'> $row->apellido_paterno $row->apellido_materno $row->nombres</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Programa</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" id="idprograma2" name="idprograma" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM programa WHERE estado='ACTIVO'");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idprograma'> $row->nombre</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Registra</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Insert -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar programa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Programas/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Nombre del programa</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Version</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="version" name="version" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Registra</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Seleccionar Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Programas/update">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre del documento</label>
                        <div class="col-sm-9">
                            <input type="text" id="idprograma" name="idprograma" hidden>
                            <input type="text" id="nombre" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="version"  class="col-sm-3 col-form-label">Version</label>
                        <div class="col-sm-9">
                            <input id="version" type="text" class="form-control" placeholder="version" name="version" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                        <div class="col-sm-9">
                            <select id="estado" type="text" class="form-control" placeholder="estado" name="estado" required>
                                <option value="">Seleccionar..</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Close</button>
                        <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script !src="">
    window.onload=function (e) {
        var eli =document.getElementsByClassName('eli');
        for (var i=0;i<eli.length;i++){
            eli[i].addEventListener('click',function (e) {
                if (!confirm("Segurop de eliminar?")){
                    e.preventDefault();
                }
            })
        }
        $('#update').on('show.bs.modal',function (e) {
            var button=$(e.relatedTarget);
            var id=button.data('id');
            var nombre=button.data('nombre');
            var version=button.data('version');
            var estado=button.data('estado');
            $('#nombre').val(nombre);
            $('#idprograma').val(id);
            $('#estado').val(estado);
            $('#version').val(version);
        })
        $('#modulo').on('show.bs.modal',function (e) {
            var button=$(e.relatedTarget);
            var id=button.data('id');
            $('#idprograma2').val(id);
        })
    }
</script>
