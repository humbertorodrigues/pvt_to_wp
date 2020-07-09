<?php
  if(is_user_logged_in()){
  	header("location:".site_url("dashboard"));
  	exit();
  }
  if(isset($_POST['usuario'])){
    	$usuario = $_POST['usuario'];
    	$senha = $_POST['senha'];
    	if(isset($_POST['manter'])){
    		$manter = true;
    	}else{
    		$manter=false;
    	}


  	 $creds = array(
          'user_login'    => $usuario,
          'user_password' => $senha,
          'remember'      => $manter
      );

      $user = wp_signon( $creds, false );

      if ( !is_wp_error( $user ) ) {

    	  wp_redirect( 'dashboard');
        exit();

      }

  }


    get_header('login');
?>
<div class="auth animated slideInRight">
    <div class="pvr_card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header">
                        <div class="logo m-t-15">
                            <img class="w-in-22" src="http://via.placeholder.com/80x80" alt="PVR">
                        </div>
                        <h1 class="text-white">WPY Admin</h1>
                    </div>
                </div>
                <?php
                        if ( isset($user) && is_wp_error( $user ) ) {
                          ?>
                            <div class="alert alert-danger m-5">
                              <?php echo $user->get_error_message() ?>
                            </div>
                          <?php
                        }
                ?>
                <form class="col-lg-12" id="sign_in" action="<?php echo site_url('login') ?>" method="post">
                    <h5 class="title">Faça login em sua conta</h5>
                    <div class="form-group-pvr form-float">
                        <div class="form-line-pvr">
                            <input type="text" name="usuario" class="form-control">
                            <label class="form-label">Login</label>
                        </div>
                    </div>
                    <div class="form-group-pvr form-float">
                        <div class="form-line-pvr">
                            <input type="password" class="form-control" name="senha" >
                            <label class="form-label">Senha</label>
                        </div>
                    </div>
                    <div class="form-group-pvr form-check pull-left">
                        <label class="form-check-label">
                            <input name="manter" class="form-check-input" type="checkbox" value="">
                            <span class="form-check-sign"></span>
                            Manter-me conectado
                        </label>
                    </div>
                    <div class="form-group-pvr">
                        <input type="submit" class="btn btn-purple waves-effect" value="Acessar" />
                        <a href="<?php echo site_url("cadastro") ?>" class="btn btn-raised btn-purple waves-effect">Cadastrar-se</a>
                    </div>
                </form>
                <div class="col-lg-12 m-t-20">
                    <a class="" href="<?php echo site_url("esqueceu-senha") ?>">Esqueceu sua senha?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="auth_bg"></div>
<?php get_footer('login'); ?>
