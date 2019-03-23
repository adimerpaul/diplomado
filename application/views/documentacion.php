<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de personal
            </small>
        </h1>

        <form method="post" style="padding-top: 20px" action="<?=base_url()?>Documentacion/update">
            <input type="text" name="idestudiante" value="<?=$idestudiante?>" hidden>
            <?php
            $query = $this->db->query("SELECT * FROM documento ");

            foreach ($query->result() as $row)
            {
                $query2 = $this->db->query("SELECT * FROM estudiantedocumento WHERE iddocumento='".$row->iddocumento."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                //echo $cantidad." ".$row2->estado;
                $sw="";
                if ($cantidad==1 && $row2->estado=='SI'){
                    $sw="<input type='radio' name='d".$row->iddocumento."' checked  value='SI'> SI "."<input type='radio' name='d".$row->iddocumento."'  value='NO'>NO";
                }else{
                    $sw="<input type='radio' name='d".$row->iddocumento."'  value='SI'> SI "."<input type='radio' name='d".$row->iddocumento."'checked    value='NO'>NO";
                }
                echo " <div class=\"form-group row\">
                            <label  class=\"col-sm-4 col-form-label\">".$row->nombre."</label>
                            <div class=\"col-sm-8\">
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