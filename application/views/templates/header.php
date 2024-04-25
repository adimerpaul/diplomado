
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="icon" type="image/png" href="<?=base_url()?>assets/images/uto.png" />
    <meta charset="utf-8" />
    <title><?=$title?></title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/jquery.dataTables.min.css" />


    <!-- ace styles -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?=base_url()?>assets/css/ace-ie.min.css" />
<style>
.zero{
    padding: 0px !important;
    margin: 0px !important;
}
</style>
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?=base_url()?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?=base_url()?>assets/js/html5shiv.min.js"></script>
    <script src="<?=base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default          ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="<?=base_url()?>Main" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Post Grado UTO
                </small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?=base_url()?>assets/images/avatars/user.jpg" alt="Jason's Photo" />
                        <span class="user-info">
									<small>Bienvenido,</small>
									<?=$this->User->consulta('nombre','usuario','idusuario',$_SESSION['idusuario'])?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="ace-icon fa fa-cog"></i>-->
<!--                                Settings-->
<!--                            </a>-->
<!--                        </li>-->

                        <li>
                            <a href="<?=base_url()?>Welcome/cambiar">
                                <i class="ace-icon fa fa-key"></i>
                                Cambiar contraseña
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?=base_url()?>Welcome/logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Salir
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

<!--        <div class="sidebar-shortcuts" id="sidebar-shortcuts">-->
<!--            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">-->
<!--                <button class="btn btn-success">-->
<!--                    <i class="ace-icon fa fa-signal"></i>-->
<!--                </button>-->
<!---->
<!--                <button class="btn btn-info">-->
<!--                    <i class="ace-icon fa fa-pencil"></i>-->
<!--                </button>-->
<!---->
<!--                <button class="btn btn-warning">-->
<!--                    <i class="ace-icon fa fa-users"></i>-->
<!--                </button>-->
<!---->
<!--                <button class="btn btn-danger">-->
<!--                    <i class="ace-icon fa fa-cogs"></i>-->
<!--                </button>-->
<!--            </div>-->
<!---->
<!--            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">-->
<!--                <span class="btn btn-success"></span>-->
<!---->
<!--                <span class="btn btn-info"></span>-->
<!---->
<!--                <span class="btn btn-warning"></span>-->
<!---->
<!--                <span class="btn btn-danger"></span>-->
<!--            </div>-->
<!--        </div>-->

        <ul class="nav nav-list">
            <?php if ($_SESSION['idrol']==1):?>
            <li class="">
                <a href="<?=base_url()?>Docentes">
                    <i class="menu-icon fa fa-user"></i>
                    <span class="menu-text"> Docentes </span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Alumno" >
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Alumnos </span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Programas" >
                    <i class="menu-icon fa fa-pencil-square-o"></i>
                    <span class="menu-text"> Programas </span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Modulos">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text"> Modulos </span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Tipopagos">
                    <i class="menu-icon fa fa-calendar"></i>
                    <span class="menu-text">Tipo pagos</span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Listas" >
                    <i class="menu-icon fa fa-file-o"></i>
                    <span class="menu-text"> Listas </span>
                </a>
            </li>
            <li class="">
                <a href="<?=base_url()?>Documentos" >
                    <i class="menu-icon fa fa-tag"></i>
                    <span class="menu-text"> Documentos </span>
                </a>
            </li>
            <?php endif?>
            <?php if ($_SESSION['idrol']==2):?>
                <li class="">
                    <a href="<?=base_url()?>Datos/index/<?=$_SESSION['idpersona']?>">
                        <i class="menu-icon fa fa-user"></i>
                        <span class="menu-text"> Datos personales </span>
                    </a>
                </li>
                <li class="">
                    <a href="<?=base_url()?>Alumno" >
                        <i class="menu-icon fa fa-list"></i>
                        <span class="menu-text"> Alumnos </span>
                    </a>
                </li>
<!--                <li class="">-->
<!--                    <a href="--><?php //=base_url()?><!--Documentacion/index/--><?php //=$_SESSION['idestudiante']?><!--" >-->
<!--                        <i class="menu-icon fa fa-list"></i>-->
<!--                        <span class="menu-text"> Documentacion  </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="">-->
<!--                    <a href="--><?php //=base_url()?><!--Pagos/index/--><?php //=$_SESSION['idestudiante']?><!--" >-->
<!--                        <i class="menu-icon fa fa-pencil-square-o"></i>-->
<!--                        <span class="menu-text"> Pagos efectuados </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="">-->
<!--                    <a href="--><?php //=base_url()?><!--Pagospormultas">-->
<!--                        <i class="menu-icon fa fa-list-alt"></i>-->
<!--                        <span class="menu-text"> Pagos por multas </span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="">-->
<!--                    <a href="--><?php //=base_url()?><!--Calificacion/index/--><?php //=$_SESSION['idestudiante']?><!--" >-->
<!--                        <i class="menu-icon fa fa-calendar"></i>-->
<!--                        <span class="menu-text"> Calificacion</span>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="">-->
<!--                    <a href="--><?php //=base_url()?><!--Tramitedetitulo">-->
<!--                        <i class="menu-icon fa fa-file"></i>-->
<!--                        <span class="menu-text"> Tramite de titulo </span>-->
<!--                    </a>-->
<!--                </li>-->
            <?php endif?>
            <?php if ($_SESSION['idrol']==3):?>
                <li class="">
                    <a href="<?=base_url()?>Listas" >
                        <i class="menu-icon fa fa-file-o"></i>
                        <span class="menu-text"> Listas </span>
                    </a>
                </li>
            <?php endif?>

        </ul><!-- /.nav-list -->

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="<?=base_url()?>Main">Home</a>
                    </li>

                    <li class="active"><?=$title?></li>
                </ul><!-- /.breadcrumb -->

            </div>
