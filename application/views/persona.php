<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de personal
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-user"></i>
        Registrar persona
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
            $query = $this->db->query("SELECT * FROM persona");

            foreach ($query->result() as $row)
            {
                echo "<tr>
                    <td>".$row->apellido_paterno." ".$row->apellido_materno." ".$row->nombres."</td>
                    <td>".$row->ci."</td>
                    <td>".$row->telefono."</td>
                    <td>".$row->email."</td>
                    <td>".$row->genero."</td>
                    <td>
                    <button type=\"button\" class=\"btn btn-warning btn-mini\" data-toggle=\"modal\" data-target=\"#update\" data-idpersona=".$row->idpersona."> <i class='fa fa-pencil'></i>Modificar</button>
                    <a href='".base_url()."Persona/delete/".$row->idpersona."' class=\"btn btn-danger btn-mini eli\" > <i class='fa fa-trash'></i>Eliminar</a>
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
    <script !src="">
        var eli=document.getElementsByClassName("eli");
        for (var i=0;i<eli.length;i++){
            eli[i].addEventListener("click",function (e) {
                if (!confirm("Seguro de eliminar?"))
                e.preventDefault();
            })
        }
    </script>
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
          <form method="post" action="<?=base_url()?>Persona/insert">
              <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">apellido_paterno</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="apellido_paterno" name="apellido_paterno" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">apellido_materno</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="apellido_materno" name="apellido_materno">
                  </div>
              </div>
              <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">nombres</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="nombres" name="nombres" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">ci</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="ci" name="ci" required>
                  </div>
              </div>
              <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">profesion</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="profesion" name="profesion">
                  </div>
              </div><div class="form-group row">
                  <label  class="col-sm-3 col-form-label">telefono</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="telefono" name="telefono">
                  </div>
              </div><div class="form-group row">
                  <label  class="col-sm-3 col-form-label">celular</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="celular" name="celular">
                  </div>
              </div><div class="form-group row">
                  <label  class="col-sm-3 col-form-label">email</label>
                  <div class="col-sm-9">
                      <input type="email" class="form-control" placeholder="email" name="email">
                  </div>
              </div><div class="form-group row">
                  <label  class="col-sm-3 col-form-label">genero</label>
                  <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="genero" name="genero">
                  </div>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Modificar persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Persona/update">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">apellido_paterno</label>
                        <div class="col-sm-9">
                            <input type="text" id="idpersona"  name="idpersona" hidden>
                            <input type="text" id="apellido_paterno" class="form-control" placeholder="apellido_paterno" name="apellido_paterno" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">apellido_materno</label>
                        <div class="col-sm-9">
                            <input type="text" id="apellido_materno" class="form-control" placeholder="apellido_materno" name="apellido_materno">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">nombres</label>
                        <div class="col-sm-9">
                            <input type="text" id="nombres" class="form-control" placeholder="nombres" name="nombres" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">ci</label>
                        <div class="col-sm-9">
                            <input type="text" id="ci" class="form-control" placeholder="ci" name="ci" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">profesion</label>
                        <div class="col-sm-9">
                            <input type="text" id="profesion" class="form-control" placeholder="profesion" name="profesion">
                        </div>
                    </div><div class="form-group row">
                        <label  class="col-sm-3 col-form-label">telefono</label>
                        <div class="col-sm-9">
                            <input type="text" id="telefono" class="form-control" placeholder="telefono" name="telefono">
                        </div>
                    </div><div class="form-group row">
                        <label  class="col-sm-3 col-form-label">celular</label>
                        <div class="col-sm-9">
                            <input type="text" id="celular" class="form-control" placeholder="celular" name="celular">
                        </div>
                    </div><div class="form-group row">
                        <label  class="col-sm-3 col-form-label">email</label>
                        <div class="col-sm-9">
                            <input type="email" id="email" class="form-control" placeholder="email" name="email">
                        </div>
                    </div><div class="form-group row">
                        <label  class="col-sm-3 col-form-label">genero</label>
                        <div class="col-sm-9">
                            <input type="text" id="genero" class="form-control" placeholder="genero" name="genero">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
