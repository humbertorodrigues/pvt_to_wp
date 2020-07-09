<?php /* Template Name: Cadastro */


$nome="";
$email="";
if(isset($_POST['nome'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
  $senha = $_POST['senha'];
	$login = $_POST['login'];


    	$userdata = array(
        'user_login'            => $login,
        'user_email'            => $email,
        'user_pass'             => $senha,
        'user_nicename'         => $nome,
        'display_name'          => $nome,
        'first_name'            => $nome
        );
        $user = wp_insert_user($userdata);

    if(!is_wp_error( $user )){

      $user_id = $user;

      $grupos_controller = new \wpy\Controllers\Grupos();

    	$creds = array(
	        'user_login'    => $email,
	        'user_password' => $senha,
	        'remember'      => true
	    );

      $user = wp_signon( $creds );

      $grupo = array(
        'nome' => "Grupo Padrão",
        'user_id' => $user_id
      );

      $grupos_controller->save( $grupo );

    	header("location:".site_url("dashboard"));
    	exit();
    }else{
    	$mensagem = $user->get_error_message();
    }

}
get_header('login');

?>
<div class="auth_reg animated slideInRight">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-signup">
                    <img class="cadastro_logo m-auto mb-5 pb-5 pt-5" src="<?php echo tpl_path ?>/assets/img/logo.svg" alt="WPY">
                    <div class="row">

                        <div class="col-md-10 m-auto">
                        	<?php if(isset($mensagem)): ?>
	                            <div class="alert alert-danger rounded">
	                            	<?php echo $mensagem; ?>
	                            </div>
                        	<?php endif; ?>
                            <form class="col-lg-12" id="sign_in" method="POST">
                            	<div class="form-group-pvr form-float">
                                    <div class="form-line-pvr">
                                        <input type="text" name="nome" required class="form-control" value="<?php echo $nome ?>">
                                        <label class="form-label">Nome</label>
                                    </div>
                                </div>
                                <div class="form-group-pvr form-float">
                                    <div class="form-line-pvr">
                                        <input type="email" name="email" required class="form-control" value="<?php echo $email ?>">
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="form-group-pvr form-float">
                                    <div class="form-line-pvr">
                                        <input type="text" name="login" required class="form-control">
                                        <label class="form-label">Login</label>
                                    </div>
                                </div>
                                <div class="form-group-pvr form-float">
                                    <div class="form-line-pvr">
                                        <input type="password" name="senha" required class="form-control">
                                        <label class="form-label">Senha</label>
                                    </div>
                                </div>
                                <div class="form-check d-none">
                                    <label class="form-check-label" style="text-transform: inherit;">
                                        <input class="form-check-input" type="checkbox" value="">
                                        <span class="form-check-sign"></span>
                                        Eu aceito os termos e condições.
                                    </label>
                                </div>
                                <div class="m-b-30 text-center m-t-20 pt-5">
                                    <button id="btSalvar" class="btn btn-primary btn-round">Efetuar cadastro</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer('login'); ?>
