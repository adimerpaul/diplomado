<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Control de personal
            </small>
        </h1>

        <form method="post" style="padding-top: 20px" action="<?=base_url()?>pagos/update">
            <input type="text" name="idestudiante" value="<?=$idestudiante?>" hidden>
            <?php
            $query = $this->db->query("SELECT * FROM tipopago ");

            foreach ($query->result() as $row)
            {
                $query2 = $this->db->query("SELECT * FROM pago WHERE idtipopago='".$row->idtipopago."' AND idestudiante='".$idestudiante."'");
                $cantidad=$query2->num_rows();
                $row2=$query2->row();
                $sw="";
                if ($cantidad==1 ){
                    $sw="<input  type='text' class='form-control' name='d".$row->idtipopago."'  value='".$row2->monto."'>";
                }else{
                    $sw="<input  type='text' class='form-control' name='d".$row->idtipopago."'  value='0'>";
                }
                echo " <div class=\"form-group row\">
                            <label  class=\"col-sm-3 col-form-label\">".$row->nombre." (".$row->monto.")</label>
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