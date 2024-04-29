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
                        <input type="password" id="form-field-1" placeholder="Contraseña Actual" name="clave" required/>
                        <i class="ace-icon fa fa-eye" onclick="cambioPass()"></i>
                    </div>
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nueva Contraseña </label>
                    <div class="col-sm-9">
                        <input type="password" id="form-field-2" placeholder="Nueva Contraseña" name="clave2" required/>
                        <i class="ace-icon fa fa-eye" onclick="cambioPass2()"></i>
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
    var showPass = false;
    var showPass2 = false;
    cambioPass = function () {
        showPass = !showPass;
        document.getElementById('form-field-1').type = showPass ? 'text' : 'password';
    }
    cambioPass2 = function () {
        showPass2 = !showPass2;
        document.getElementById('form-field-2').type = showPass2 ? 'text' : 'password';
    }
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
