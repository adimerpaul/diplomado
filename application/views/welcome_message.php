
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Post Grado UTO</title>
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/uto.png" />

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- text fonts -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-part2.min.css" />
    <![endif]-->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?=base_url()?>assets/js/html5shiv.min.js"></script>
    <script src="<?=base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="ace-icon fa fa-leaf green"></i>
                            <span class="red">POST</span>
                            <span class="white" id="id-text2">GRADO</span>
                        </h1>
                        <h4 class="blue" id="id-company-text">&copy; Sistema de diplomado</h4>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-coffee green"></i>
                                        Por favor ingrese sus datos
                                    </h4>

                                    <div class="space-6"></div>
<!--@action="--><?php //=base_url()?><!--Welcome/login"-->
                                    <form method="post" id="form" >
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control" name="name" placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
                                            </label>

                                            <label class="block clearfix">
                                                <span class="block input-icon input-icon-right">
                                                    <input type="password" class="form-control" name="password" placeholder="Password" />
                                                    <i class="ace-icon fa fa-eye" onclick="showPassword = !showPassword; this.className = showPassword ? 'ace-icon fa fa-eye' : 'ace-icon fa fa-eye-slash'; this.previousElementSibling.type = showPassword ? 'text' : 'password';"></i>
                                                </span>
                                            </label>

                                            <div class="space"></div>

                                            <div class="clearfix">
                                                <label class="inline">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"> Recuerdame</span>
                                                </label>

                                                <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                                    <i class="ace-icon fa fa-key"></i>
                                                    <span class="bigger-110">Ingresar</span>
                                                </button>
                                            </div>

                                            <div class="space-4"></div>
                                        </fieldset>
                                    </form>

                                </div><!-- /.widget-main -->

                                <div class="toolbar clearfix">
                                    <div>

                                        <a data-target="#forgot-box" class="forgot-password-link" href="https://api.whatsapp.com/send?phone=59172358466&text=Hola%20quiero%20recuperar%20mi%20contrase%C3%B1a"
                                           target="_blank"
                                        >
<!--                                            <i class="ace-icon fa fa-arrow-left"></i>-->
                                            Olvide mi password
                                        </a>
                                    </div>

                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.login-box -->

                        <div id="forgot-box" class="forgot-box widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header red lighter bigger">
                                        <i class="ace-icon fa fa-key"></i>
                                        Retrieve Password
                                    </h4>

                                    <div class="space-6"></div>
                                    <p>
                                        Enter your email and to receive instructions
                                    </p>

                                    <form>
                                        <fieldset>
                                            <label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control" placeholder="Email" />
															<i class="ace-icon fa fa-envelope"></i>
														</span>
                                            </label>

                                            <div class="clearfix">
                                                <button type="button" class="width-35 pull-right btn btn-sm btn-danger">
                                                    <i class="ace-icon fa fa-lightbulb-o"></i>
                                                    <span class="bigger-110">Send Me!</span>
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div><!-- /.widget-main -->

                                <div class="toolbar center">
                                    <a href="#" data-target="#login-box" class="back-to-login-link">
                                        Back to login
                                        <i class="ace-icon fa fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-body -->
                        </div><!-- /.forgot-box -->

                    </div><!-- /.position-relative -->

                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.main-content -->
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?=base_url()?>assets/js/jquery-2.1.4.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?=base_url()?>assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var showPassword = false;
    if('ontouchstart' in document.documentElement) document.write("<script src='<?=base_url()?>assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    window.onload = function() {


        document.getElementById('form').onsubmit = function() {
            var name = document.getElementsByName('name')[0].value;
            var password = document.getElementsByName('password')[0].value;
            if (name == '' || password == '') {
                alert('Por favor, rellene todos los campos');
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '<?=base_url()?>Welcome/login',
                data: {name: name, password: password},
                success: function(data) {
                    if (data == '1') {
                        window.location.href = '<?=base_url()?>Main';
                    } else {
                        alert('Usuario o contraseña incorrectos');
                    }
                }
            });
            return false;
        }
    }
</script>
</body>
</html>
