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
                Control de alumnos
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <?php if ($_SESSION['idrol']==1):?>
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-user"></i>
        Registrar alumno
    </button>
    <?php endif;?>
    <div class="table-responsive">
        <table id="example" class="table" style="width:100%">
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
            if ($_SESSION['idrol'] == 1){
                $query = $this->db->query("SELECT * FROM persona WHERE idpersona in (select idpersona FROM estudiante)");
            }else{
                $query = $this->db->query("SELECT * FROM persona WHERE idpersona=".$_SESSION['idpersona']);
            }

            foreach ($query->result() as $row)
            {
                if ($_SESSION['idrol'] == 1){
                    $botonAdd="<button type=\"button\" class=\"btn btn-success btn-mini\" data-toggle=\"modal\" data-target=\"#update\" data-idestudiante=".$this->User->consulta("idestudiante","estudiante","idpersona",$row->idpersona)."> <i class='fa fa-history'></i>Add Programa</button>";
                }else{
                    $botonAdd="";
                }
                echo "<tr>
                    <td>".$row->paterno." ".$row->materno." ".$row->nombres."</td>
                    <td>".$row->ci."</td>
                    <td>".$row->telefono."</td>
                    <td>".$row->email."</td>
                    <td>".$row->sexo."</td>
                    <td>
                    $botonAdd
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
<!--                            Acaba va el codigo-->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times-circle-o"></i> Cerrar</button>
                    </div>
            </div>
        </div>
    </div>
</div>

