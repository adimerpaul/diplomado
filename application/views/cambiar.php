<div class="page-content">
    <div class="page-header">
        <h1>
            <?=$title?>
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                Cambiar Contraseña
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" role="form" id="cambiarContreseña" >
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contraseña Actual </label>
                    <div class="col-sm-9">
                        <input type="password" id="form-field-1" placeholder="Contraseña Actual" class="col-xs-10 col-sm-5" name="clave" required/>
                    </div>
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nueva Contraseña </label>
                    <div class="col-sm-9">
                        <input type="password" id="form-field-2" placeholder="Nueva Contraseña" class="col-xs-10 col-sm-5" name="clave2" required/>
                    </div>
                    <div class="col-sm-12 center">
                        <button type="submit" class="btn btn-primary">Cambiar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script >
window.onload=function (e) {
    $('#cambiarContreseña').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '<?=base_url()?>Welcome/cambiarPassword',
            type: 'post',
            data: data,
            success: function (response) {
                if (response == 1) {
                    alert('Contraseña cambiada correctamente');
                } else {
                    alert('Contraseña incorrecta');
                }
            }
        });
    });
}
</script>
