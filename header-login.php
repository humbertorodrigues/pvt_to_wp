<!DOCTYPE html>
<html class="no-js chrome" lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="http://via.placeholder.com/32x32">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?php bloginfo('name'); ?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900" rel="stylesheet">
    <!-- CSS Files -->
    <?php wp_head(); ?>
    <?php do_action( 'theme-header-login' ); ?>
</head>
<body class="theme-orange" style="overflow: auto;">