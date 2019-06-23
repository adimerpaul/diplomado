<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de personal
            </small>
        </h1>
        <?php
        $query = $this->db->query("SELECT * FROM persona WHERE idpersona='$idpersona'");
        $row=$query->row();
        ?>
        <form method="post" style="padding-top: 20px" action="<?=base_url()?>Datos/update">
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">apellido_paterno</label>
                <div class="col-sm-9">
                    <input type="text" id="idpersona"  name="idpersona" hidden value="<?=$idpersona?>">
                    <input type="text" id="apellido_paterno" class="form-control" placeholder="apellido_paterno" name="apellido_paterno" required value="<?=$row->paterno?>">
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">apellido_materno</label>
                <div class="col-sm-9">
                    <input type="text" id="apellido_materno" class="form-control" placeholder="apellido_materno" name="apellido_materno" value="<?=$row->materno?>">
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">nombres</label>
                <div class="col-sm-9">
                    <input type="text" id="nombres" class="form-control" placeholder="nombres" name="nombres" required value="<?=$row->nombres?>">
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">ci</label>
                <div class="col-sm-9">
                    <input type="text" id="ci" class="form-control" placeholder="ci" name="ci" required value="<?=$row->ci?>">
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-3 col-form-label">profesion</label>
                <div class="col-sm-9">
                    <input type="text" id="profesion" class="form-control" placeholder="profesion" name="profesion" value="<?=$row->profesion?>">
                </div>
            </div><div class="form-group row">
                <label  class="col-sm-3 col-form-label">telefono</label>
                <div class="col-sm-9">
                    <input type="text" id="telefono" class="form-control" placeholder="telefono" name="telefono" value="<?=$row->telefono?>">
                </div>
            </div><div class="form-group row">
                <label  class="col-sm-3 col-form-label">celular</label>
                <div class="col-sm-9">
                    <input type="text" id="celular" class="form-control" placeholder="celular" name="celular" value="<?=$row->celular?>">
                </div>
            </div><div class="form-group row">
                <label  class="col-sm-3 col-form-label">email</label>
                <div class="col-sm-9">
                    <input type="email" id="email" class="form-control" placeholder="email" name="email" value="<?=$row->email?>">
                </div>
            </div><div class="form-group row">
                <label  class="col-sm-3 col-form-label">genero</label>
                <div class="col-sm-9">
                    <select name="genero" id="genero" class="form-control" required>
                        <option value="">Selecionar...</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                    <script !src="">
                        window.onload=function() {
                            $('#genero').val('<?=$row->sexo?>');
                        }
                    </script>
                </div>
            </div>
            <?php if ($_SESSION['idrol']==1):?>
            <div style="text-align: center; width: 100%" >
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="<?=base_url()?>Alumno" type="button" class="btn btn-danger" >Cancelar</a>
            </div>
            <?php endif;?>
        </form>
    </div>
</div>
