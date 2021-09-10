<?php

/* ==============================================
********  //Логин
=============================================== */

if( wp_doing_ajax() ) {
  if (!is_user_logged_in()) {
    add_action('wp_ajax_ajax_login', 'ajax_login');
    add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');

    add_action( 'wp_ajax_earena_2_ajax_register', 'earena_2_ajax_register' );
    add_action( 'wp_ajax_nopriv_earena_2_ajax_register', 'earena_2_ajax_register' );
  }
}

// Signin
function ajax_login()
{
    // Первым делом проверяем параметр безопасности
    check_ajax_referer('form.js_nonce', 'security');
    // Получаем данные из полей формы и проверяем их
    $info = array();
    $info['user_login'] = isset($_POST['name']) ? $_POST['name'] : '';
    $info['user_password'] = isset($_POST['password']) ? $_POST['password'] : '';
    if (empty($info['user_login'])) {
      wp_send_json_error(['loggedin' => false, 'message' => __('Введите ваше имя', 'earena_2')]);
    }
    // if (!is_email($info['user_login'])) {
    //   wp_send_json_error(['loggedin' => false, 'message' => __('Некорректный емейл', 'earena_2')]);
    // }
    if (empty($info['user_password'])) {
      wp_send_json_error(['loggedin' => false, 'message' => __('Введите пароль', 'earena_2')]);
    }
    $info['remember'] = true;
    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
      //	echo json_encode(array('loggedin'=>false, 'message'=>__('Неправильный логин или пароль!')));
      //	if (!email_exists($info['user_login'])) wp_send_json_error( 'Неверный адрес электронной почты' );
        wp_send_json_error([
            'loggedin' => false,
            'message' => __('Неправильное имя или пароль!', 'earena_2')
        ]);
    } else {
        wp_set_current_user($user_signon->ID, $user_signon->user_login);
        wp_set_auth_cookie($user_signon->ID, true);
        //  $_COOKIE['ea_user_time_offset'] = $_POST['user_time_offset_m'];
        //	echo json_encode(array('loggedin'=>true, 'message'=>__('Отлично! Идет перенаправление...')));
        wp_send_json_success(['loggedin' => true, 'message' => __('Отлично! Идет перенаправление...', 'earena_2')]);
    }
    die();
}

/* ==============================================
********  //Забыл пароль
=============================================== */
if (!is_user_logged_in()) {
    add_action('wp_ajax_ajax_forgot', 'ajax_forgot');
    add_action('wp_ajax_nopriv_ajax_forgot', 'ajax_forgot');

    add_action('wp_ajax_ajaxreset_pass', 'ajax_reset_pass');
    add_action('wp_ajax_nopriv_ajaxreset_pass', 'ajax_reset_pass');

    add_action('wp_ajax_earena_2_ajax_reset_pass', 'earena_2_ajax_reset_pass');
    add_action('wp_ajax_nopriv_earena_2_ajax_reset_pass', 'earena_2_ajax_reset_pass');
}
/*
 *	@desc	Process reset password
 */

 function earena_2_ajax_reset_pass()
 {
     $errors = new WP_Error();

     check_ajax_referer('form.js_nonce', 'security');

     $pass1 = $_POST['pass_1'];
     $pass2 = $_POST['pass_2'];
     $key = $_POST['user_key'];
     $login = $_POST['user_login'];

     $user = check_password_reset_key($key, $login);
     if (is_wp_error($user)) {
 //		$errors = $user;
         $errors->add('invalid_key', sprintf(
             __('Некорректные данные для смены пароля. Проверьте, правильно ли вы скопировали ссылку из письма или отправьте <a href="%s">ещё одно</a>.'),
             add_query_arg('action', 'forgot', home_url())
         ));
     }
     /*else {
     echo 'Ключ прошел проверку. Можно высылать новый пароль на почту.';
   }*/
     // check to see if user added some string
     if (empty($pass1) || empty($pass2)) {
         $errors->add('password_required', __('Введите пароль.', 'earena'));
     }
     if (8 >= strlen($pass1)) {
         $errors->add('password_short', __('Пароль должен быть не менее 8 символов.', 'earena'));
     }
     // is pass1 and pass2 match?
     if ($pass1 != $pass2) {
         $errors->add('password_reset_mismatch', __('The passwords do not match.'));
     }

     /**
      * Fires before the password reset procedure is validated.
      *
      * @param object $errors WP Error object.
      * @param WP_User|WP_Error $user WP_User object if the login and reset key match. WP_Error object otherwise.
      * @since 3.5.0
      *
      */
     do_action('validate_password_reset', $errors, $user);

     if ((!$errors->get_error_code()) && isset($pass1) && !empty($pass1)) {
         reset_password($user, $pass1);

         /*		$errors->add( 'password_reset',
       sprintf(
         __( 'Check your email for the confirmation link, then visit the <a href="%s">login page</a>.' ),
         add_query_arg( 'action', 'login', home_url() ) ) );*/

         wp_send_json_error(['message' => __('Your password has been reset.')]);
     }

     // display error message
     if ($errors->get_error_code()) {
       $err = $errors->get_error_message($errors->get_error_code());

       wp_send_json_error(['error' => $err]);
     }

     // return proper result
     die();
 }
function ajax_reset_pass()
{
    $errors = new WP_Error();

    check_ajax_referer('ajax-rp-nonce', 'rp_security');

    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $key = $_POST['user_key'];
    $login = $_POST['email'];

    $user = check_password_reset_key($key, $login);
    if (is_wp_error($user)) {
//		$errors = $user;
        $errors->add('invalid_key', sprintf(
            __('Некорректные данные для смены пароля. Проверьте, правильно ли вы скопировали ссылку из письма или отправьте <a href="%s">ещё одно</a>.'),
            add_query_arg('action', 'forgot', home_url())
        ));
    }
    /*else {
    echo 'Ключ прошел проверку. Можно высылать новый пароль на почту.';
  }*/
    // check to see if user added some string
    if (empty($pass1) || empty($pass2)) {
        $errors->add('password_required', __('Введите пароль.', 'earena'));
    }
    if (8 >= strlen($pass1)) {
        $errors->add('password_short', __('Пароль должен быть не менее 8 символов.', 'earena'));
    }
    // is pass1 and pass2 match?
    if ($pass1 != $pass2) {
        $errors->add('password_reset_mismatch', __('The passwords do not match.'));
    }

    /**
     * Fires before the password reset procedure is validated.
     *
     * @param object $errors WP Error object.
     * @param WP_User|WP_Error $user WP_User object if the login and reset key match. WP_Error object otherwise.
     * @since 3.5.0
     *
     */
    do_action('validate_password_reset', $errors, $user);

    if ((!$errors->get_error_code()) && isset($pass1) && !empty($pass1)) {
        reset_password($user, $pass1);

        /*		$errors->add( 'password_reset',
      sprintf(
        __( 'Check your email for the confirmation link, then visit the <a href="%s">login page</a>.' ),
        add_query_arg( 'action', 'login', home_url() ) ) );*/
        $errors->add('password_reset', __('Your password has been reset.'));
    }

    // display error message
    if ($errors->get_error_code()) {
        echo '<p class="error">' . $errors->get_error_message($errors->get_error_code()) . '</p>';
    }

    // return proper result
    die();
}

function ajax_forgot()
{
    check_ajax_referer('form.js_nonce', 'security');
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $lostpassword = ea_retrieve_password();
    if (is_wp_error($lostpassword)) {
        $err = '';
        foreach ($lostpassword->get_error_messages() as $error) {
            $err .= $error . PHP_EOL;
        }
        wp_send_json_error(['message' => $err]);
    } else {
        wp_send_json_success([
            'retrieve_password' => true,
            'message' => sprintf(
            /* translators: %s: Link to the login page. */
                __('Check your email for the confirmation link, then visit the <a href="%s">login page</a>.'),
                add_query_arg('action', 'login', home_url())
            )
        ]);
    }
    die();
}

/**
 * Handles sending a password retrieval email to a user.
 *
 * @return true|WP_Error True when finished, WP_Error object on error.
 * @since 2.5.0
 *
 */
function ea_retrieve_password()
{
    $errors = new WP_Error();
    $user_data = false;

    if (empty($_POST['email']) || !is_string($_POST['email'])) {
        $errors->add('empty_username', __('Введите ваш адрес электронной почты.', 'earena'));
    } elseif (!is_email($_POST['email'])) {
        $errors->add('wrong_username', __('Некорректный емейл.', 'earena'));
    } elseif (strpos($_POST['email'], '@')) {
        $user_data = get_user_by('email', trim(wp_unslash($_POST['email'])));
        if (empty($user_data)) {
            $errors->add('invalid_email',
                __('Не найден аккаунт с таким адресом электронной почты.', 'earena'));
        }
    }/* else {
    $login	 = trim( wp_unslash( $_POST['email'] ) );
    $user_data = get_user_by( 'login', $login );
  }*/

    /**
     * Fires before errors are returned from a password reset request.
     *
     * @param WP_Error $errors A WP_Error object containing any errors generated
     *                                 by using invalid credentials.
     * @param WP_User|false $user_data WP_User object if found, false if the user does not exist.
     * @since 5.4.0 Added the `$user_data` parameter.
     *
     * @since 2.1.0
     * @since 4.4.0 Added the `$errors` parameter.
     */
    do_action('lostpassword_post', $errors, $user_data);

    /**
     * Filters the errors encountered on a password reset request.
     *
     * The filtered WP_Error object may, for example, contain errors for an invalid
     * username or email address. A WP_Error object should always be returned,
     * but may or may not contain errors.
     *
     * If any errors are present in $errors, this will abort the password reset request.
     *
     * @param WP_Error $errors A WP_Error object containing any errors generated
     *                                 by using invalid credentials.
     * @param WP_User|false $user_data WP_User object if found, false if the user does not exist.
     * @since 5.5.0
     *
     */
    $errors = apply_filters('lostpassword_errors', $errors, $user_data);

    if ($errors->has_errors()) {
        return $errors;
    }

    if (!$user_data) {
        $errors->add('invalidcombo',
            __('Не найден аккаунт с таким адресом электронной почты.', 'earena'));
        return $errors;
    }
    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key = get_password_reset_key($user_data);

    if (is_wp_error($key)) {
        return $key;
    }

    if (is_multisite()) {
        $site_name = get_network()->site_name;
    } else {
        /*
     * The blogname option is escaped with esc_html on the way into the database
     * in sanitize_option. We want to reverse this for the plain text arena of emails.
     */
        $site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    }

    $message = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
    /* translators: %s: Site name. */
    $message .= sprintf(__('Site Name: %s'), $site_name) . "\r\n\r\n";
    /* translators: %s: User login. */
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= network_site_url("?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n\r\n";

    $requester_ip = $_SERVER['REMOTE_ADDR'];
    if ($requester_ip) {
        $message .= sprintf(
            /* translators: %s: IP address of password reset requester. */
                __('This password reset request originated from the IP address %s.'),
                $requester_ip
            ) . "\r\n";
    }

    /* translators: Password reset notification email subject. %s: Site title. */
    $title = sprintf(__('[%s] Password Reset'), $site_name);

    /**
     * Filters the subject of the password reset email.
     *
     * @param string $title Email subject.
     * @param string $user_login The username for the user.
     * @param WP_User $user_data WP_User object.
     * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
     *
     * @since 2.8.0
     */
    $title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);

    /**
     * Filters the message body of the password reset mail.
     *
     * If the filtered message is empty, the password reset email will not be sent.
     *
     * @param string $message Email message.
     * @param string $key The activation key.
     * @param string $user_login The username for the user.
     * @param WP_User $user_data WP_User object.
     * @since 2.8.0
     * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
     *
     */
    $message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);

    if ($message && !wp_mail($user_email, wp_specialchars_decode($title), $message)) {
        $errors->add('retrieve_password_email_failure',
            __('The email could not be sent. Your site may not be correctly configured to send emails.', 'earena_2'));
        return $errors;
    }

    return true;
}

/**
 * REGISTRATION
 */
if (!is_user_logged_in()) {

if(isset($_GET['ref'])){
	$ref_id=sanitize_text_field($_GET['ref']);
	setcookie('ref_id', $ref_id, time()+60*60*24*30);
}

// Signup
function earena_2_ajax_register () {
  check_ajax_referer( 'form.js_nonce', 'security' );

	global $login, $password, $email, $country, $birth_date, $reg_errors;
	$password   =   isset($_POST['password'])?esc_attr( $_POST['password'] ):null;
	$email      =   isset($_POST['email'])?sanitize_email( $_POST['email'] ):null;
	$login      =   isset($_POST['name'])?$_POST['name']:null;
	$country	=   isset($_POST['country'])?sanitize_text_field( $_POST['country'] ):null;
	$confirm_password = null;//isset($_POST['confirm_password'])?esc_attr( $_POST['confirm_password'] ):null;
	$birth_date = isset($_POST['birthday']) ? date("Y-m-d",strtotime($_POST['birthday'])) : null;

	registration_validation(
		$login,
		$email,
		$password,
		$confirm_password,
		$country,
		$birth_date
	);

	earena_2_complete_registration(
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

function earena_2_complete_registration( $login, $email, $password, $country, $birth_date = null ) {
	global $reg_errors, $wpdb;
	if ( 1 > count( $reg_errors->get_error_messages() ) ) {
		$userdata = array(
		'user_login'   =>   sanitize_user( $login ),
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
