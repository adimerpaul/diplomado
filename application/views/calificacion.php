<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de personal
            </small>
        </h1>

        <form method="post" style="padding-top: 20px" action="<?=base_url()?>Calificacion/update">
            <input type="text" name="idestudiante" value="<?=$idestudiante?>" hidden>
            <?php
            $co=0;
            $q = $this->db->query("SELECT * FROM estudianteprograma e INNER JOIN programa p ON e.idprograma=p.idprograma
 WHERE idestudiante='$idestudiante'");
            foreach ($q->result() as $r) {
                $co++;
                echo "<p><h4>Programa : $r->nombre</h4></p>";
                $query=$this->db->query("SELECT m.idmodulo,m.nombre,
(
CASE
    WHEN (SELECT count(*) FROM estudiantemodulo
          WHERE idmodulo=m.idmodulo AND idestudiante='$idestudiante'AND idprograma='$r->idprograma')=0 THEN ''
    ELSE (SELECT nota FROM estudiantemodulo
          WHERE idmodulo=m.idmodulo AND idestudiante='$idestudiante'AND idprograma='$r->idprograma')
END
)
as nota
FROM modulo m
WHERE m.idprograma='$r->idprograma'");

                foreach ($query->result() as $row) {
                    echo " <div class='form-group row'>
                            <label  class='col-sm-4 col-form-label'>" . $row->nombre . "</label>
                            <div class='col-sm-8'>
                            $row->nota
                            </div>
                        </div>";
                }
            }
            ?>
            <?php if ($_SESSION['idrol']=="1"):?>
            <div style="text-align: center; width: 100%" >
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="<?=base_url()?>Alumno" type="button" class="btn btn-danger" >Cancelar</a>
            </div>
            <?php endif;?>
        </form>
    </div>
</div>