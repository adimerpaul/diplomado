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
<!--    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">-->
<!--        <i class="fa fa-money"></i>-->
<!--        Registrar Tipo pago-->
<!--    </button>-->
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Programa</th>
            <th>Version</th>
            <th>Cuota</th>
            <th>Monto</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = $this->db->query("SELECT programa.nombre as nombreprograma,
       programa.version as version,
       tipopago.idtipopago as idtipopago,
       tipopago.nombre as nombre,
       tipopago.monto as monto
            FROM tipopago
            inner join programa on tipopago.idprograma=programa.idprograma");

        foreach ($query->result() as $index => $row)
        {
            echo "<tr>
                    <td>".($index+1)."</td>
                    <td>".$row->nombreprograma."</td>
                    <td>".$row->version."</td>
                    <td>".$row->nombre."</td>
                    <td>".$row->monto."</td>
                    <td>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-idtipopago='".$row->idtipopago."' data-nombre='".$row->nombre."' data-monto='".$row->monto."'> <i class='fa fa-pencil'></i>Modificar</button>
                    <a href='".base_url()."Tipopagos/delete/".$row->idtipopago."' class='btn btn-danger btn-mini eli' > <i class='fa fa-trash'></i>Eliminar</a>
                    </td>
                </tr>";
        }
        ?>

        </tbody>
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
                <form method="post" action="<?=base_url()?>Tipopagos/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">nombre</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">monto</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="monto" name="monto">
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
                <form method="post" action="<?=base_url()?>Tipopagos/update">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">nombre</label>
                        <div class="col-sm-9">
                            <input type="text" id="idtipopago2" name="idtipopago" hidden>
                            <input type="text" id="nombre2" class="form-control" placeholder="nombre" name="nombre">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">monto</label>
                        <div class="col-sm-9">
                            <input type="number" id="monto2" class="form-control" placeholder="monto" name="monto">
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
