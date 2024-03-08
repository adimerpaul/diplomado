<style>
.modal-lg{
    width: 100%;
}
</style>
<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de listas
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <?php if ($_SESSION['idrol']==1):?>
<!--    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">-->
<!--        <i class="fa fa-user"></i>-->
<!--        Registrar alumno-->
<!--    </button>-->
    <?php endif;?>
    <div class="table-responsive">
        <table id="example" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Nombre programa</th>
<!--                <th>Version</th>-->
<!--                <th>Estado</th>-->
                <th>Modulos</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = $this->db->query("SELECT * FROM programa");

            foreach ($query->result() as $row)
            {
                $query2 = $this->db->query("SELECT m.nombre, concat(p.paterno,' ',p.materno,' ',p.nombres) docente
                    FROM modulo m
                    inner join usuario u on m.iddocente = u.idusuario
                    inner join persona p on u.idpersona = p.idpersona
                    WHERE idprograma='$row->idprograma'");
                $modulos="<table style='padding: 0px;margin: 0px'>";
                foreach ($query2->result() as $row2) {
                    $modulos.="<tr style='padding: 0px;margin: 0px'>
                                    <td style='padding: 0px;margin: 0px'>
                                        $row2->nombre
                                    </td>
                                    <td style='padding: 0px;margin: 0px'>
                                        <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->idprograma' data-version='$row->version' data-estado='$row->estado'> <i class='fa fa-pencil-square-o'></i> Nota</button>
                                        $row2->docente
                                    </td>
                                </tr>";
                }
                $modulos.="</table>";
                echo "<tr>
                    <td>".$row->nombre."</td>
                    <td>$modulos</td>
                    <td>
                    <!--button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->idprograma' data-version='$row->version' data-estado='$row->estado'> <i class='fa fa-pencil-square-o'></i> Modificar</button><br-->
                    <a type='button' class='btn btn-primary btn-mini' target='_blank'  href='".base_url()."Programas/archivo/$row->idprograma' > <i class='fa fa-file-pdf-o'></i> Notas</a>
                    <a type='button' class='btn btn-success btn-mini' target='_blank'  href='".base_url()."Programas/lista/$row->idprograma' > <i class='fa fa-file-pdf-o'></i> Alumnos</a>
                    </td>
                </tr>";
            }
            ?>

            </tbody>
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
                <form method="post" action="<?=base_url()?>Alumno/insert">
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
                            <input type="text" class="form-control" placeholder="email" name="email" >
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
                        <label class="col-sm-1 col-form-label">sexo</label>
                        <div class="col-sm-3">
                            <select name="sexo" class="form-control" required>
                                <option value="">Selecionar...</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="FEMENINO">FEMENINO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">beca</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="beca" name="beca" >
                        </div>
                        <label class="col-sm-1 col-form-label">observacion</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" placeholder="observacion" name="observacion" >
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Registrar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Seleccionar programa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" ter="<?=base_url()?>Alumno/update" id="insertProgram">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label"> Seleccione Programa</label>
                        <div class="col-sm-9">
                            <input type="text" id="idestudiante"  name="idestudiante" hidden>
                            <select name="idmodulo"  class="form-control" required >
                                <?php
                                $query = $this->db->query("SELECT * FROM programa  ");

                                foreach ($query->result() as $row)
                                {
                                    echo "<option value='".$row->idprograma."'>".$row->nombre."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Historial programa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <h6  class="col-form-label">Programas:</h6>
                            <input type="text" id="idestudiante2"  name="idestudiante" hidden>
                            <p id="contenedor"></p>
                        </div>
                        <div id="opcion"  class="col-sm-10">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times-circle-o"></i> Cerrar</button>
                    </div>
            </div>
        </div>
    </div>
</div>

