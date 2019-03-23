<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de alumnos
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-user"></i>
        Registrar alumno
    </button>
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Ci</th>
            <th>Telefono</th>
            <th>Gmail</th>
            <th>Genero</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = $this->db->query("SELECT * FROM persona WHERE idpersona in (select idpersona FROM estudiante)");

        foreach ($query->result() as $row)
        {
            echo "<tr>
                    <td>".$row->apellido_paterno." ".$row->apellido_materno." ".$row->nombres."</td>
                    <td>".$row->ci."</td>
                    <td>".$row->telefono."</td>
                    <td>".$row->email."</td>
                    <td>".$row->genero."</td>
                    <td>
                    <button type=\"button\" class=\"btn btn-success btn-mini\" data-toggle=\"modal\" data-target=\"#update\" data-idestudiante=".$this->User->consulta("idestudiante","estudiante","idpersona",$row->idpersona)."> <i class='fa fa-history'></i>Add Programa</button>
                    <button type=\"button\" class=\"btn btn-warning btn-mini\" data-toggle=\"modal\" data-target=\"#historial\" data-idestudiante=".$this->User->consulta("idestudiante","estudiante","idpersona",$row->idpersona)."> <i class='fa fa-file-archive-o'></i>Historial</button>        
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
                <form method="post" action="<?=base_url()?>Alumno/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Persona</label>
                        <div class="col-sm-9">
                            <select name="idpersona" class="form-control" required>
                                <?php
                                    $query = $this->db->query("SELECT * FROM persona WHERE idpersona <> '".$_SESSION['idpersona']."' AND idpersona not in (SELECT idpersona FROM estudiante)");

                                    foreach ($query->result() as $row)
                                    {
                                        echo "<option value='".$row->idpersona."'>".$row->apellido_paterno." ".$row->apellido_materno." ".$row->nombres."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Observacion</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="observacion" name="observacion" required>
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
                <h5 class="modal-title" id="exampleModalLabel">Seleccionar programa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Alumno/update">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label"> Seleccione modulo</label>
                        <div class="col-sm-9">
                            <input type="text" id="idestudiante"  name="idestudiante" hidden>
                            <select name="idmodulo" class="form-control" required >
                                <?php
                                $query = $this->db->query("SELECT * FROM modulo  ");

                                foreach ($query->result() as $row)
                                {
                                    echo "<option value='".$row->idmodulo."'>".$row->nombre."</option>";
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Historial programa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Alumno/update">
                    <div class="form-group row">
                        <label  class="col-sm-2 col-form-label"> Programas</label>
                        <div class="col-sm-10">
                            <input type="text" id="idestudiante2"  name="idestudiante" hidden>
                            <p id="contenedor"></p>
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

