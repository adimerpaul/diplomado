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
            $query = $this->db->query("SELECT * FROM modulo ");

            foreach ($query->result() as $row)
            {
                $query2 = $this->db->query("SELECT * FROM estudiantemodulo WHERE idmodulo='".$row->idmodulo."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                $sw="";
                if ($cantidad==1 ){
                    $sw="<input  type='text' class='form-control' name='d".$row->idmodulo."'  value='".$row2->nota."'>";
                }else{
                    $sw="<input  type='text' class='form-control' name='d".$row->idmodulo."'  value=''>";
                }
                echo " <div class=\"form-group row\">
                            <label  class=\"col-sm-3 col-form-label\">".$row->nombre."</label>
                            <div class=\"col-sm-9\">
                            $sw
                            </div>
                        </div>";
            }
            ?>
            <div style="text-align: center; width: 100%" >
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="<?=base_url()?>Alumno" type="button" class="btn btn-danger" >Cancelar</a>
            </div>
        </form>
    </div>
</div>