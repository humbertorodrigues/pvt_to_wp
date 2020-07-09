<?php
ini_set("display_errors","On");
show_admin_bar( false );
date_default_timezone_set('America/Sao_Paulo');

define('tpl_path',get_stylesheet_directory_uri());

add_action('after_switch_theme', 'setup_tema');
add_action( 'wp_enqueue_scripts', 'default_css' );
//add_action( 'admin_menu', 'geraNovaPagina' );

function geraNovaPagina() {

}

function setup_tema(){


    // Create homepage
    $login = array(
        'post_type'    => 'page',
        'post_title'    => 'Login',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1
    );
    // Insert the post into the database
    $login_id =  wp_insert_post( $login );
    //set the page template
    //assuming you have defined template on your-template-filename.php
    update_post_meta($login_id, '_wp_page_template', 'templates/login.php');

    $dashboard = array(
        'post_type'    => 'page',
        'post_title'    => 'Dashboard',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1
    );
    // Insert the post into the database
    $dashboard_id =  wp_insert_post( $dashboard );
    //set the page template
    //assuming you have defined template on your-template-filename.php
    update_post_meta($dashboard_id, '_wp_page_template', 'templates/dashboard.php');

   
    $logout = array(
        'post_type'    => 'page',
        'post_title'    => 'Logout',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1
    );
    // Insert the post into the database
    $logout_id =  wp_insert_post( $logout );
    //set the page template
    //assuming you have defined template on your-template-filename.php
    update_post_meta($logout_id, '_wp_page_template', 'templates/logout.php');

    $cadastro = array(
        'post_type'    => 'page',
        'post_title'    => 'Cadastro',
        'post_content'  => '',
        'post_status'   => 'publish',
        'post_author'   => 1
    );
    // Insert the post into the database
    $cadastro_id =  wp_insert_post( $cadastro );
    //set the page template
    //assuming you have defined template on your-template-filename.php
    update_post_meta($cadastro_id, '_wp_page_template', 'templates/cadastro.php');

  
}

function default_css() {
	/*Registrados todos os styles. Fazemos enqueue quando necesssário*/
	wp_register_style( 'theme-main-style', get_stylesheet_directory_uri().'/style.css');
	wp_register_style( 'bootstrap-css', get_stylesheet_directory_uri().'/assets/plugins/bootstrap/css/bootstrap.css');
	wp_register_style( 'bootstrap-grid', get_stylesheet_directory_uri().'/assets/plugins/bootstrap/css/bootstrap-grid.css', array("bootstrap-css"));
	wp_register_style( 'bootstrap-reboot', get_stylesheet_directory_uri().'/assets/plugins/bootstrap/css/bootstrap-reboot.css',array("bootstrap-grid","bootstrap-css"));

    //wp_register_style( 'select-css', get_stylesheet_directory_uri().'/assets/plugins/bootstrap-select/css/bootstrap-select.min.css', array("select-css"));
    //wp_register_style( 'emoji_css', get_stylesheet_directory_uri().'/assets/emoji/css/emoji.css', array("emoji_css"));

	wp_register_style( 'theme-colors', get_stylesheet_directory_uri().'/assets/css/colors.css',array("bootstrap-grid", "bootstrap-css", "bootstrap-reboot"));
	wp_register_style( 'theme-style', get_stylesheet_directory_uri().'/assets/css/style.css',array("bootstrap-grid", "bootstrap-css", "bootstrap-reboot", "theme-colors"));

    wp_deregister_script('jquery');
	wp_register_script( 'theme-jquery', get_stylesheet_directory_uri().'/assets/plugins/jquery/jquery-3.2.1.min.js');
	wp_register_script( 'theme-jquery-bundle', get_stylesheet_directory_uri().'/assets/plugins/bootstrap/js/bootstrap.bundle.js',array("theme-jquery"));
	wp_register_script( 'theme-jquery-backstretch', get_stylesheet_directory_uri().'/assets/plugins/jquery.backstretch/jquery.backstretch.js',array("theme-jquery","theme-jquery-bundle"));
	wp_register_script( 'theme-toaster', get_stylesheet_directory_uri().'/assets/plugins/toastr/toastr.min.js',array("theme-jquery","theme-jquery-bundle",'theme-jquery-backstretch'));
    wp_register_script( 'theme-bootstrap-notify', get_stylesheet_directory_uri().'/assets/plugins/bootstrap-notify/bootstrap-notify.js',array("theme-jquery","theme-jquery-bundle",'theme-jquery-backstretch',"theme-toaster"));
	wp_register_script( 'theme-mask', "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js",array("theme-jquery"));


    wp_register_script('perfect-scrollbar', get_stylesheet_directory_uri().'/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js',array('theme-jquery'));
    wp_register_script('pvr_lite_app', get_stylesheet_directory_uri().'/assets/js/pvr_lite_app.js',array('perfect-scrollbar'));
    wp_register_script('active_menu', get_stylesheet_directory_uri().'/assets/js/active_menu.js',array('theme-jquery'));
    wp_register_script('selectjs', get_stylesheet_directory_uri().'/assets/plugins/bootstrap-select/js/bootstrap-select.min.js',array('theme-jquery'));

    wp_register_script('dashboard_js',get_stylesheet_directory_uri().'/assets/js/dashboard.js',array('theme-jquery'));

    wp_register_script('moment','https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js');
    wp_register_script('datatables', get_stylesheet_directory_uri().'/assets/plugins/DataTables/media/js/jquery.dataTables.js',array('theme-jquery'));
    wp_register_script('datatables_bootstrap', get_stylesheet_directory_uri().'/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js',array('datatables'));
    wp_register_script('datatables_keytable', get_stylesheet_directory_uri().'/assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js',array('datatables'));
    wp_register_script('datatables_responsive', get_stylesheet_directory_uri().'/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js',array('datatables'));
    wp_register_script('datatables_moment','https://cdn.datatables.net/plug-ins/1.10.13/sorting/datetime-moment.js',array('moment'));

    wp_register_script('importar_numeros_js',get_stylesheet_directory_uri().'/assets/js/importar-numeros.js',array('theme-jquery'));

    wp_register_script('enviar_js',get_stylesheet_directory_uri().'/assets/js/enviar.js',array('jquery'));

    wp_register_script('meu_numero_js',get_stylesheet_directory_uri().'/assets/js/meu-numero.js',array('jquery'));

    wp_register_script('pesquisa_js',get_stylesheet_directory_uri().'/assets/js/pesquisa.js',array('theme-jquery-bundle'));



    wp_register_script('emoji_config_js', get_stylesheet_directory_uri().'/assets/emoji/js/config.js',array('theme-jquery'));
    wp_register_script('emoji_util_js', get_stylesheet_directory_uri().'/assets/emoji/js/util.js',array('theme-jquery'));
    wp_register_script('emoji_emojiarea_js', get_stylesheet_directory_uri().'/assets/emoji/js/jquery.emojiarea.js',array('theme-jquery'));
    wp_register_script('emoji_emojipicker_js', get_stylesheet_directory_uri().'/assets/emoji/js/emoji-picker.js',array('theme-jquery'));

	/*login page*/

	wp_register_style( 'toaster-style', get_stylesheet_directory_uri().'/assets/plugins/toastr/toastr.min.css',array("bootstrap-grid", "bootstrap-css", "bootstrap-reboot", "theme-colors"));

	wp_register_script( 'theme-login-script', get_stylesheet_directory_uri().'/assets/js/pvr_lite_login_v1.js',array("theme-jquery","theme-jquery-bundle",'theme-jquery-backstretch'));
    wp_localize_script( 'theme-login-script', 'tpl_path',tpl_path);

    wp_enqueue_style( 'theme-main-style' );
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'bootstrap-grid' );
    wp_enqueue_style( 'bootstrap-reboot' );
    wp_enqueue_style( 'theme-colors' );
    wp_enqueue_style( 'theme-style' );
    wp_enqueue_style( 'select-css' );

    wp_enqueue_script( 'theme-jquery' );
    wp_enqueue_script( 'theme-jquery-bundle' );
    wp_enqueue_script( 'theme-jquery-backstretch' );

    wp_enqueue_script( 'perfect-scrollbar' );
    wp_enqueue_script( 'pvr_lite_app' );
    wp_enqueue_script( 'active_menu' );
    wp_enqueue_script( 'selectjs' );
    wp_enqueue_script( 'dashboard_js' );

	if ( is_page_template( 'templates/login.php' ) ) {
    	wp_enqueue_script( 'theme-login-script' );
	}
	if ( is_page_template( 'templates/cadastro.php' ) ) {
      wp_enqueue_script( 'theme-login-script' );
    	wp_enqueue_script( 'theme-mask' );
	}
    if ( is_page_template( 'templates/dashboard.php' ) ) {
        wp_enqueue_script( 'dashboard_js' );
    }
    if ( is_page_template( 'templates/importar_numeros.php' ) ) {
            wp_enqueue_script( 'moment' );
            wp_enqueue_script( 'datatables' );
            wp_enqueue_script( 'datatables_bootstrap' );
            wp_enqueue_script( 'datatables_keytable' );
            wp_enqueue_script( 'datatables_responsive' );
            wp_enqueue_script( 'datatables_moment' );

            wp_enqueue_script( 'importar_numeros_js' );
    }

    if ( is_page_template( 'templates/meu_numero.php' ) ) {
            wp_enqueue_script( 'theme-mask' );
            wp_enqueue_script( 'meu_numero_js' );
    }
    if ( is_page_template( 'templates/enviar.php' ) ) {

            wp_enqueue_script( 'moment' );
            wp_enqueue_script( 'datatables' );
            wp_enqueue_script( 'datatables_bootstrap' );
            wp_enqueue_script( 'datatables_keytable' );
            wp_enqueue_script( 'datatables_responsive' );

            wp_enqueue_script('emoji_config_js');
            wp_enqueue_script('emoji_util_js');
            wp_enqueue_script('emoji_emojiarea_js');
            wp_enqueue_script('emoji_emojipicker_js');

            wp_enqueue_script( 'datatables_moment' );

            //wp_enqueue_style( 'emoji_css' );

            wp_enqueue_script( 'enviar_js' );
    }
    if ( is_page_template( 'templates/pesquisa.php' ) ) {
            wp_enqueue_script( 'pesquisa_js' );
    }

}
function somente_logado(){
	if(!is_user_logged_in()){
		wp_redirect( site_url("login"));
		exit();
	}
}

add_filter('init','flushRules');
function flushRules(){
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}



    
