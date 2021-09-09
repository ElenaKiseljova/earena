<?php

/**
 * REGISTRATION
 */
if (!is_user_logged_in()) {

if(isset($_GET['ref'])){
	$ref_id=sanitize_text_field($_GET['ref']);
	setcookie('ref_id', $ref_id, time()+60*60*24*30);
}

add_action( 'wp_ajax_nopriv_register_check', 'register_check' );
function register_check () {
	check_ajax_referer( 'ea_register', 'reg_security' );
	$key = $_POST['key'];
	$value = $_POST['value'];
	switch ( $key ) {
		case 'email':
			if ( is_email($value) ) {
				if ( email_exists($value) ) {
					wp_send_json_success( ['checked'=>false, 'message'=> __( 'Такой адрес электронной почты уже зарегистрирован', 'earena_plugin' ) ] );
				}
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Некорректный емейл', 'earena_plugin' )] );
			}
		break;
		case 'username':
			if ( validate_username($value) ) {
				if ( strlen($value) < 5 ) {
					wp_send_json_success( ['checked'=>false, 'message'=> __( 'Никнейм должен быть не менее 5 символов', 'earena_plugin' )] );
				}elseif ( strlen($value) > 25 ) {
					wp_send_json_success( ['checked'=>false, 'message'=> __( 'Никнейм должен быть не более 25 символов', 'earena_plugin' )] );
				}elseif ( username_exists($value) ) {
					wp_send_json_success( ['checked'=>false, 'message'=> __( 'Такой никнейм уже зарегистрирован', 'earena_plugin' )] );
				}
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Некорректный никнейм', 'earena_plugin' )] );
			}
		break;
		case 'password':
		case 'pass1':
			if ( 8 <= strlen($value) ) {
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Пароль должен быть не менее 8 символов', 'earena_plugin' )] );
			}
		break;
		case 'confirm_password':
		case 'pass2':
			if ( 8 >= strlen($value[0]) ||  8 >= strlen($value[1]) ) {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Пароль должен быть не менее 8 символов', 'earena_plugin' )] );
			} elseif ( $value[0] ==  $value[1] ) {
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Пароли не совпадают', 'earena_plugin' )] );
			}
		break;
		case 'country':
			if ( !empty($value) ) {
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Выберите страну', 'earena_plugin' )] );
			}
		break;
		case 'birth_date':
			if ( !empty($value) && strtotime($value)<time() ) {
				wp_send_json_success( ['checked'=>true] );
			} else {
				wp_send_json_success( ['checked'=>false, 'message'=> __( 'Некорректная дата', 'earena_plugin' )] );
			}
		break;
	}
}

add_action( 'wp_ajax_nopriv_ajax_register', 'ajax_register' );
function ajax_register () {
	global $login, $password, $email, $country, $birth_date, $reg_errors;
	$password   =   isset($_POST['password'])?esc_attr( $_POST['password'] ):null;
	$email      =   isset($_POST['email'])?sanitize_email( $_POST['email'] ):null;
	$login      =   isset($_POST['username'])?$_POST['username']:null;
	$country	=   isset($_POST['country'])?sanitize_text_field( $_POST['country'] ):null;
	$confirm_password = isset($_POST['confirm_password'])?esc_attr( $_POST['confirm_password'] ):null;
	$birth_date = isset($_POST['birth_date']) ? date("Y-m-d",strtotime($_POST['birth_date'])) : null;

	registration_validation(
		$login,
		$email,
		$password,
		$confirm_password,
		$country,
		$birth_date
	);

	complete_registration(
		$login,
		$email,
		$password,
		$country,
		$birth_date
	);

	if ( $reg_errors->has_errors() ){
		wp_send_json_success( $reg_errors );
	} else {
		wp_send_json_success( ['registered'=>true, 'message'=> __( 'Вы зарегистрировались!', 'earena_plugin' )] );
	}

	die();
}

} else {

	$ea_user = wp_get_current_user();
	if ($ea_user->get('vt')<=time()){
		update_metadata( 'user', $ea_user->ID, 'vip', 0 );
	}
	$blocked = $ea_user->get('blocked')?:false;
	$yellow_cards = $ea_user->get('yc')?:0;
	$blocked = $yellow_cards>=3?true:$blocked;
	if( !current_user_can('edit_posts') && $blocked && $_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'] !== $_SERVER["HTTP_HOST"].'/profile/ban/' && $_SERVER["HTTP_HOST"].explode('?',$_SERVER['REQUEST_URI'])[0] !== $_SERVER["HTTP_HOST"].'/wp-login.php' && $_SERVER["HTTP_HOST"].explode('?',$_SERVER['REQUEST_URI'])[0] !== $_SERVER["HTTP_HOST"].'/profile/messages/' && $_SERVER["HTTP_HOST"].explode('?',$_SERVER['REQUEST_URI'])[0] !== $_SERVER["HTTP_HOST"].'/profile/administration/' ){
		wp_redirect( home_url('profile/ban/') );
		exit;
	}

}



function ea_add_rand_ava($user_id = 0) {
    global $wp_filesystem;
    $user_id = $user_id > 0 ? $user_id : get_current_user_id();
    $dir = wp_get_upload_dir()['basedir'].'/avatars/_default/';
    $count = 0;
    $dirs = [];
    $dir_file_cnt = scandir($dir);
    unset($dir_file_cnt[0], $dir_file_cnt[1]);
    foreach ($dir_file_cnt as $val) {
        if (is_dir($dir.$val)) {
            $count++;
            $dirs[] = $val;
        }
    }
    $from = $dir.$dirs[array_rand($dirs)];
    // $to не может быть прямым путем к папке, иначе методы FTP и SSH остаются в нерабочими
    $to   = $wp_filesystem->find_folder( wp_get_upload_dir()['basedir'].'/avatars/'.$user_id.'/' );
    if ( wp_mkdir_p($to) ){
        return copy_dir( $from, $to );
    } else {
        return false;
    }
}

function ea_check_user_age($user_id = 0) {
	$user_id = $user_id > 0 ? $user_id : get_current_user_id();
	$birth_date = get_user_meta($user_id, 'birth_date', true)?:date("Y-m-d", time());
	$then = strtotime($birth_date);
	$min = strtotime('+18 years', $then);
	return time() < $min ? false : true;
//	return false;
}

function write_new_nicename($user_id){
    global $wpdb;
    return $wpdb->update(
        $wpdb->prefix . 'users',
        array('user_nicename' => $user_id),
        array('ID' => (int)$user_id)
    );
}

function registration_validation( $login, $email, $password, $confirm_password=null, $country, $birth_date = null )  {
	global $reg_errors;
	$reg_errors = new WP_Error;
	if ( empty( $login ) || empty( $email ) || empty( $password )/* || empty( $confirm_password ) */|| empty( $country ) ) {
		$reg_errors->add('field', __( 'Все поля обязательные', 'earena_plugin'  ));
	}
	if ( 5 > strlen( $login ) ) {
		$reg_errors->add( 'short_username', __( 'Никнейм должен быть не менее 5 символов', 'earena_plugin'  ) );
	}
	if ( 25 < strlen( $login ) ) {
		$reg_errors->add( 'long_username', __( 'Никнейм должен быть не более 25 символов', 'earena_plugin'  ) );
	}
	if ( !validate_username( $login ) ) {
		$reg_errors->add( 'username_invalid', __( 'Некорректный никнейм', 'earena_plugin'  ));
	}
	if ( !is_email( $email ) ) {
		$reg_errors->add( 'wrong_username', __( 'Некорректный емейл.', 'earena_plugin'  ) );
	}
	if ( email_exists( $email ) ) {
		$reg_errors->add( 'email', __( 'Такой адрес электронной почты уже зарегистрирован', 'earena_plugin'  ) );
	}
	if ( 8 > strlen( $password ) ) {
		$reg_errors->add( 'password', __( 'Пароль должен быть не менее 8 символов', 'earena_plugin'  ) );
	}
/*	if ( $password !== $confirm_password ) {
		$reg_errors->add( 'password_mismath', __( 'Пароли не совпадают', 'earena_plugin'  ) );
	}
*/
}

function complete_registration( $login, $email, $password, $country, $birth_date = null ) {
	global $reg_errors, $wpdb;
	if ( 1 > count( $reg_errors->get_error_messages() ) ) {
		$userdata = array(
		'user_login'   =>   sanitize_user( $email ),
		'nickname'     =>   $login,
		'display_name' =>   $login,
		'user_email'   =>   $email,
		'user_pass'	   =>   $password,
		);
		$user_id = wp_insert_user( $userdata );
		if( !is_wp_error( $user_id ) ) {

            $birth_date = $birth_date ?? date("Y-m-d", time());
			update_user_meta( $user_id, 'birth_date', $birth_date );
			update_user_meta( $user_id, 'country', $country );
			update_user_meta( $user_id, 'rating', 500 );
			update_user_meta( $user_id, 'mig', 0 );//money in games
            update_user_meta( $user_id, 'notification_messages_new_message', 'no' );
            if(isset($_COOKIE['ref_id'])){
                $ref_id = sanitize_text_field($_COOKIE['ref_id']);
                update_user_meta( $user_id, 'ref', $ref_id );
            }
			wp_new_user_notification( $user_id, null, 'user' );
			$info = array();
			$info['user_login'] = $email;
			$info['user_password'] = $password;
			$info['remember'] = true;
			$user_signon = wp_signon( $info, false );
			wp_set_current_user( $user_signon->ID, $user_signon->user_login );
			
			write_new_nicename($user_id);
            ea_add_rand_ava($user_id);
			return true;
		} else {
			return $user_id;
		}
	}
}


add_action('user_register','write_new_nicename');


add_filter( 'auth_cookie_expiration', 'extend_login_cookie' );
function extend_login_cookie( $expirein ) {
    return 1209600;
}

add_filter( 'register_url', 'filter_function_name_4794' );
function filter_function_name_4794( $register ){
	return '/?action=register';
}

add_filter( 'login_url', 'filter_function_name_3304', 10, 3 );
function filter_function_name_3304( $login_url, $redirect, $force_reauth ){
	return '/?action=login';
}
add_filter( 'wp_mail_content_type', 'filter_function_name_4869' );
function filter_function_name_4869( $content_type ){
	return 'text/html';
}

add_filter( 'wp_new_user_notification_email', 'filter_function_name_1306', 10, 3 );
function filter_function_name_1306( $wp_new_user_notification_email, $user, $blogname ){
	$wp_new_user_notification_email['subject'] = __( 'Регистрация на сайте', 'earena_plugin' ) .' ' . wp_specialchars_decode( $blogname );
	$wp_new_user_notification_email['message'] = 
		get_custom_logo().
		'<br><br>
		'. __( 'Добро пожаловать на сайт', 'earena_plugin' ) .' '. get_bloginfo('name') . '<br>
		'. __( 'Ваш логин для входа:', 'earena_plugin' ) .' '.$user->user_email.'<br>
		'. __( 'Вход:', 'earena_plugin' ) .' <a href="'.home_url('?action=login').'">'.home_url('?action=login').'</a>';
	
	return $wp_new_user_notification_email;
}