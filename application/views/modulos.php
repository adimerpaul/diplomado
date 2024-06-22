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
        <i class="fa fa-anchor"></i>
        Registrar Modulo
    </button>
    <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Nombre Modulo</th>
                <th>Codigo</th>
                <th>Fechas</th>
                <th>Programa</th>
                <th>Docente</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = $this->db->query("SELECT 
m.nombre,m.codigo,m.fechainicio,m.fechafin,p.nombre as nombreprograma,pe.paterno,pe.materno,pe.nombres,m.idmodulo FROM modulo m 
INNER JOIN docente d ON m.iddocente=d.idpersona 
INNER JOIN persona pe ON pe.idpersona=d.idpersona 
INNER JOIN programa p ON p.idprograma=m.idprograma");

            foreach ($query->result() as $row)
            {
                echo "<tr>
                    <td>".$row->nombre."</td>
                    <td>".$row->codigo."</td>
                    <td>$row->fechainicio $row->fechafin</td>
                    <td>".$row->nombreprograma."</td>
                    <td>$row->paterno $row->materno $row->nombres</td>
                    
                    <td>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-id='$row->idmodulo'> <i class='fa fa-pencil-square-o'></i>Modificar</button>
                    <a href='".base_url()."Modulos/delete/$row->idmodulo' type='button' class='btn btn-danger btn-mini eli' > <i class='fa fa-trash-o'></i>Eliminar</a>        
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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR MODULO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Modulos/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Nombre del modulo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Codigo del modulo</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="codigo" name="codigo" required>
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
                            <select type="text" class="form-control" placeholder="iddocente" name="iddocente" id="iddocenteseacrh" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM docente d 
INNER JOIN persona p ON p.idpersona=d.idpersona");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpersona'> $row->paterno $row->materno $row->nombres</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Programa</label>
                        <div class="col-sm-9">
                            <select type="text" class="form-control" placeholder="idprograma" name="idprograma" id="iddocentesearch" required>
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
                <h5 class="modal-title" id="exampleModalLabel">MODIFICAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Modulos/update">
                    <div class="form-group row">
                        <label for="nombre"  class="col-sm-3 col-form-label">Nombre del modulo</label>
                        <div class="col-sm-9">
                            <input type="text" id="idmodulo" name="idmodulo" hidden>
                            <input id="nombre" type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="codigo"  class="col-sm-3 col-form-label">Codigo del modulo</label>
                        <div class="col-sm-9">
                            <input id="codigo" type="text" class="form-control" placeholder="codigo" name="codigo" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechainicio"  class="col-sm-3 col-form-label">Fecha inicio</label>
                        <div class="col-sm-9">
                            <input id="fechainicio" type="date" class="form-control" placeholder="fechainicio" value="<?=date('Y-m-d')?>" name="fechainicio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechafin" class="col-sm-3 col-form-label">Fecha Fin</label>
                        <div class="col-sm-9">
                            <input id="fechafin" type="date" class="form-control" placeholder="fechafin" value="<?=date('Y-m-d')?>" name="fechafin" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="iddocente" class="col-sm-3 col-form-label">Docente</label>
                        <div class="col-sm-9">
                            <select id="iddocente" type="text" class="form-control select2" placeholder="iddocente" name="iddocente" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM docente d 
INNER JOIN persona p ON p.idpersona=d.idpersona");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpersona'> $row->paterno $row->materno $row->nombres</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idprograma"  class="col-sm-3 col-form-label">Programa</label>
                        <div class="col-sm-9">
                            <select id="idprograma" type="text" class="form-control select2" placeholder="idprograma" name="idprograma" required>
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-trash-o"></i> Cerrar</button>
                        <button type="submit" class="btn btn-warning"> <i class="fa fa-edit"></i> Modificar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script !src="">
    window.onload=function (e) {
        $('.select2').select2();
        $('#iddocenteseacrh').select2();
        $('#iddocentesearch').select2();
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
            var parametros = {
                "table" : "modulo",
                "where":"idmodulo",
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
                    //$("#resultado").html(response);
                    console.log(response);
                    var datos = JSON.parse(response);
                    $('#idmodulo').prop('value',datos.idmodulo);
                    $('#nombre').prop('value',datos.nombre);
                    $('#idprograma').prop('value',datos.idprograma);
                    $('#codigo').prop('value',datos.codigo);
                    $('#fechainicio').prop('value',datos.fechainicio);
                    $('#fechafin').prop('value',datos.fechafin);
                    $('#iddocente').prop('value',datos.iddocente);
                }
            });

        })
    }
</script>
