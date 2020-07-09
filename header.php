<!DOCTYPE html>
<html class="no-js chrome" lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php bloginfo('name'); ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet">
    <script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
    <script>var url_base = "<?php echo site_url('/');?>";</script>
    <script>var logged_user_id = "<?php echo get_current_user_id(); ?>";</script>
    <?php wp_head(); ?>

</head>
<body>
  <!--Begin Loading-->
  <div class="preloader">
      <div class="loading">
          <h2>
              Carregando...
          </h2>
          <span class="progress"></span>
      </div>
  </div>
  <!--Begin wrapper-->
  <div class="wrapper">
        <!--Begin Sidebar-->
        <div class="sidebar" data-color="purple">
            <div class="sidebar-wrapper">
                <!--Begins Logo start-->
                <div class="logo">
                    <a href="javascript:void(0)" class="simple-text logo-mini">
                        <!--<img alt="" src="assets/img/icon.png" />-->
                    </a>
                    <a href="javascript:void(0)" class="simple-text logo-normal">
                        WPY
                    </a>
                </div>
                <!--End Logo start-->

                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('/'); ?>">
                            <i class="material-icons">home</i>
                            <p>Início</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('importar-numeros'); ?>">
                            <i class="material-icons">call</i>
                            <p>Importar Números</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('pesquisa'); ?>">
                            <i class="material-icons">search</i>
                            <p>Buscar Grupos Whatsapp</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('enviar'); ?>">
                            <i class="material-icons">textsms</i>
                            <p>Enviar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('meu-numero'); ?>">
                            <i class="material-icons">phone_iphone</i>
                            <p>Meu número</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!--Begin Main Panel-->
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" data-color="orange"
                                    class="btn btn-fill btn-round btn-icon d-none d-lg-block">
                                <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                                <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                            </button>
                        </div>
                        <a class="navbar-brand" id="page_header_title" href="javascript:void(0)">

                            <?php the_title() ?>
                        </a>
                    </div>
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown dropdown-slide">
                            <a href="<?php echo site_url("logout") ?>" class="dropdown-item">
                                 <i class="material-icons align-middle">power_settings_new</i> Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
