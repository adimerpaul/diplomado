<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de documentos
            </small>
        </h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-file-archive-o"></i>
        Registrar documento
    </button>
    <div class="table-responsive">
        <table id="example" class="table" style="width:100%">
            <thead>
            <tr>
                <th>Nombre documento</th>
                <th>Id documento</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query = $this->db->query("SELECT * FROM documento");

            foreach ($query->result() as $row)
            {
                echo "<tr>
                    <td>".$row->nombre."</td>
                    <td>".$row->iddocumento."</td>
                    <td>
                    <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->iddocumento'> <i class='fa fa-pencil-square-o'></i>Modificar</button>
                    <a href='".base_url()."Documentos/delete/$row->iddocumento' type='button' class='btn btn-danger btn-mini eli' > <i class='fa fa-trash-o'></i>Eliminar</a>        
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
                <h5 class="modal-title" id="exampleModalLabel">Registrar documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Documentos/insert">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Nombre del documento</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="nombre" name="nombre" required>
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
                <form method="post" action="<?=base_url()?>Documentos/update">
                    <div class="form-group row">
                        <label for="nombre" class="col-sm-3 col-form-label">Nombre del documento</label>
                        <div class="col-sm-9">
                            <input type="text" id="iddocumento" name="iddocumento" hidden>
                            <input type="text" id="nombre" class="form-control" placeholder="nombre" name="nombre" required>
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
            $('#nombre').val(nombre);
            $('#iddocumento').val(id);
        })
    }
</script>
