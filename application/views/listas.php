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
<!--        <pre>--><?php //echo $_SESSION['idrol'];?><!--</pre>-->
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
            if ($_SESSION['idrol']==1)
                $query = $this->db->query("SELECT * FROM programa");
            else if ($_SESSION['idrol']==3){
                $query = $this->db->query("SELECT * FROM programa WHERE idprograma in (SELECT idprograma FROM modulo WHERE iddocente = ".$_SESSION['idusuario'].")");
            }
//            $query = $this->db->query("SELECT * FROM programa");

            foreach ($query->result() as $row)
            {
                if ($_SESSION['idrol']==1){
                    $modulosQuery = $this->db->query("SELECT m.nombre, concat(p.paterno,' ',p.materno,' ',p.nombres) docente, m.idmodulo
                    FROM modulo m
                    inner join usuario u on m.iddocente = u.idusuario
                    inner join persona p on u.idpersona = p.idpersona
                    WHERE idprograma='$row->idprograma'");
                    $botonNotas="<a type='button' class='btn btn-primary btn-mini' target='_blank'  href='".base_url()."Programas/archivo/$row->idprograma' > <i class='fa fa-file-pdf-o'></i> Notas</a>";
                }
                else if ($_SESSION['idrol']==3){
                    $modulosQuery = $this->db->query("SELECT m.nombre, concat(p.paterno,' ',p.materno,' ',p.nombres) docente, m.idmodulo
                    FROM modulo m
                    inner join usuario u on m.iddocente = u.idusuario
                    inner join persona p on u.idpersona = p.idpersona
                    WHERE idprograma='$row->idprograma' and iddocente=".$_SESSION['idusuario']);
                    $botonNotas="";
                }

                $modulos="<table style='padding: 0px;margin: 0px'>";
                foreach ($modulosQuery->result() as $modulo) {
                    $modulos.="<tr style='padding: 0px;margin: 0px'>
                                    <td style='padding: 0px;margin: 0px'>
                                        $modulo->nombre
                                    </td>
                                    <td style='padding: 0px;margin: 0px'>
                                        <button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->idprograma' data-version='$row->version' data-estado='$row->estado' data-idModulo='$modulo->idmodulo' data-moduloNombre='$modulo->nombre'> <i class='fa fa-pencil-square-o'></i> Nota</button>
                                        <a type='button' class='btn btn-success btn-mini' target='_blank'  href='".base_url()."Programas/listaNotas/$row->idprograma/$modulo->idmodulo' > <i class='fa fa-file-pdf-o'></i> Alumnos</a>
                                        $modulo->docente
                                    </td>
                                </tr>";
                }
                $modulos.="</table>";
                echo "<tr>
                    <td>".$row->nombre."</td>
                    <td>$modulos</td>
                    <td>
                    <!--button type='button' class='btn btn-warning btn-mini' data-toggle='modal' data-target='#update' data-nombre='$row->nombre' data-id='$row->idprograma' data-version='$row->version' data-estado='$row->estado'> <i class='fa fa-pencil-square-o'></i> Modificar</button><br-->
                    $botonNotas
                    <a type='button' class='btn btn-success btn-mini' target='_blank'  href='".base_url()."Programas/lista/$row->idprograma' > <i class='fa fa-file-pdf-o'></i> Alumnos</a>
                    </td>
                </tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
                <h5 class="modal-subtitle">Default Modal</h5>
            </div>
            <div class="modal-body">
                <form method="post" ter="<?=base_url()?>Alumno/update" id="insertProgram">
                    <div class="form-group row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nota</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
<!--                        <button type="submit" class="btn btn-warning">Agregar</button>-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        var idModulo;
        $('#update').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var nombre = button.data('nombre'); // Extract info from data-* attributes
            var moduloNombre = button.data('modulonombre'); // Extract info from data-* attributes
            var idPrograma = button.data('id'); // Extract info from data-* attributes
            var version = button.data('version'); // Extract info from data-* attributes
            var estado = button.data('estado'); // Extract info from data-* attributes
            idModulo = button.data('idmodulo'); // Extract info from data-* attributes
            var modal = $(this);
            modal.find('.modal-title').text('Programa: ' + nombre);
            modal.find('.modal-subtitle').text('Modulo: ' + moduloNombre);
            $.ajax({
                url: '<?=base_url()?>Alumno/estudiantePrograma/'+idPrograma+'/'+idModulo,
                type: 'GET',
                success: function (response) {
                    var data = JSON.parse(response);
                    $('#tbody').html('');
                    for (var i = 0; i < data.length; i++) {
                        var inputHtml = '<input type="number" data-idestudiante="'+data[i].idestudiante+'" value="'+data[i].nota+'" class="form-control input-nota">';
                        var rowHtml = '<tr><td>'+data[i].nombre+'</td><td>'+inputHtml+'</td></tr>';
                        $('#tbody').append(rowHtml);
                    }

                    // Agregar evento keyuppress a los inputs con la clase 'input-nota'
                    $('.input-nota').on('keyup', function(event) {
                        var idEstudiante = $(this).data('idestudiante');
                        var nota = $(this).val();
                        // console.log("Id Estudiante: " + idEstudiante);
                        // console.log("Id Modulo: " + idModulo);
                        if (nota > 100) {
                            alert('La nota no puede ser mayor a 100');
                            $(this).val(100);
                            return;
                        }
                        $.ajax({
                            url: '<?=base_url()?>Alumno/actualizarNota',
                            type: 'POST',
                            data: {
                                idEstudiante: idEstudiante,
                                idModulo: idModulo,
                                nota: nota
                            },
                            success: function (response) {
                                console.log(response);
                            }
                        })
                    });
                }
            });
        });
    };
</script>

