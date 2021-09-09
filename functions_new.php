<?php
  /* earena_2 */
  add_action('wp_enqueue_scripts', 'earena_2_styles', 3);
  add_action('wp_enqueue_scripts', 'earena_2_scripts', 5);

  add_action( 'after_setup_theme', 'after_setup_theme_function' );

  if (!function_exists('after_setup_theme_function')) :
    function after_setup_theme_function () {
      load_theme_textdomain('earena_2', get_template_directory() . '/languages');

      // WooCommerce support
      add_theme_support('woocommerce');

      add_theme_support( 'post-thumbnails' );
    }
  endif;

  // Styles theme
  function earena_2_styles () {
    wp_enqueue_style('earena_2-style', get_stylesheet_uri());
    wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css');
  }

  // Scripts theme
  function earena_2_scripts () {
    wp_enqueue_script('swiper-script', 'https://unpkg.com/swiper/swiper-bundle.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('swiper-init-script', get_template_directory_uri() . '/assets/js/swiper-init.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('remove-active-class-elements-script', get_template_directory_uri() . '/assets/js/remove-active-class-elements.min.js', $deps = array(), $ver = null, $in_footer = true );

    /* Ajax start */
      wp_enqueue_script('global-throttlingg-script', get_template_directory_uri() . '/assets/js/ajax/global-throttlingg.min.js', $deps = array(), $ver = null, $in_footer = true );
      wp_enqueue_script('vip-script', get_template_directory_uri() . '/assets/js/ajax/vip.min.js', $deps = array(), $ver = null, $in_footer = true );
      wp_enqueue_script('form-script', get_template_directory_uri() . '/assets/js/ajax/form.min.js', $deps = array(), $ver = null, $in_footer = true );
    /* Ajax end */

    wp_enqueue_script('filter-script', get_template_directory_uri() . '/assets/js/filter.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/popup.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('files-script', get_template_directory_uri() . '/assets/js/files.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('progress-script', get_template_directory_uri() . '/assets/js/progress.min.js', $deps = array(), $ver = null, $in_footer = true );

    wp_enqueue_script('platforms-script', get_template_directory_uri() . '/assets/js/platforms.min.js', $deps = array(), $ver = null, $in_footer = true );

    wp_enqueue_script('toggle-active-script', get_template_directory_uri() . '/assets/js/toggle-active.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('update-clipboard-script', get_template_directory_uri() . '/assets/js/update-clipboard.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('select-script', get_template_directory_uri() . '/assets/js/select.min.js', $deps = array(), $ver = null, $in_footer = true );

    // С переводами
    wp_set_script_translations('platforms-script', 'earena_2');

    // AJAX
    $args = array(
      'url' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('form.js_nonce'),
      'user_id' => get_current_user_id(),
      'redirecturl' => $_SERVER['REQUEST_URI'],
      'redirecturl_rp' => add_query_arg('action', 'forgot', $_SERVER['REQUEST_URI']),
      'loginurl' => add_query_arg('action', 'login', $_SERVER['REQUEST_URI']),
      'loadingmessage' => __('Проверяются данные...'),
      'invalidkey' => __('Invalid key.')
    );

    wp_localize_script( 'form-script', 'earena_2_ajax', $args);
  }

  // Customizer
  add_action( 'customize_register', 'earena_2_customizer' );

  function earena_2_customizer ( $wp_customize ) {
    /* Create Panel Header */

    $wp_customize->add_panel('header_panel', array(
      'priority' => 50,
      'theme_supports' => '',
      'title' => __('Хедер', 'earena_2'),
      'description' => __('Элементы в Шапке сайта', 'earena_2'),
    ));

    /* Create Sections for Panel Header */

    $wp_customize->add_section('header_logo', array(
      'panel' => 'header_panel',
      'type' => 'theme_mod',
      'priority' => 5,
      'theme_supports' => '',
      'title' => __('Логотип', 'earena_2'),
      'description' => __('', 'earena_2'),
    ));

    /* Create Settings for Panel Header */

    $wp_customize->add_setting('header_logo_settings', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));

    /* Create Controls for Panel Header */

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_logo_image', array(
        'label'    => __('Изображение логотипа', 'earena_2'),
        'section'  => 'header_logo',
        'settings' => 'header_logo_settings',
    )));

    /* Create Panel Footer */

    $wp_customize->add_panel('footer_panel', array(
      'priority' => 51,
      'theme_supports' => '',
      'title' => __('Футер', 'earena_2'),
      'description' => __('Элементы в Подвале сайта', 'earena_2'),
    ));

    /* Create Sections for Panel Footer */

    $wp_customize->add_section('footer_logo', array(
      'panel' => 'footer_panel',
      'type' => 'theme_mod',
      'priority' => 5,
      'theme_supports' => '',
      'title' => __('Логотип', 'earena_2'),
      'description' => __('', 'earena_2'),
    ));

    /* Create Settings for Panel Footer */

    $wp_customize->add_setting('footer_logo_settings', array(
      'default'    =>  '',
			'transport'  =>  'refresh',
    ));

    /* Create Controls for Panel Footer */

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'footer_logo_image', array(
        'label'    => __('Изображение логотипа', 'earena_2'),
        'section'  => 'footer_logo',
        'settings' => 'footer_logo_settings',
    )));
  }

  // Изменение класса пунктов меню
  add_filter( 'nav_menu_css_class', 'add_my_class_to_nav_menu', 10, 4 );

  function add_my_class_to_nav_menu( $classes, $item, $args, $depth ) {
  	/* $classes содержит
  	Array(
  		[1] => menu-item
  		[2] => menu-item-type-post_type
  		[3] => menu-item-object-page
  		[4] => menu-item-284
  	)
  	*/
    //nav-sublist__item
    if ($args->theme_location == 'bottom_menu') {
      foreach ( $classes as $key => $class ) {
    		if ( $class == 'menu-item' ) {
    			$classes[ $key ] = 'navigation__item navigation__item--footer';
    		} else {
          $classes[ $key ] = '';
        }
    	}
    }

  	return $classes;
  }

  // Section functions

  /*
    *** Ф-я подключает нужный шаблон и регулирует отображение шапки/фильтров/табов секции
    * $section_header_right --- принимаемые значения:
    *                             'all_button' - ссфлка на все матчи /  турниры,
    *                             'tabs' - табы платформ
    *                             'filters' - фильтры (на стр Аккаунта например)
    * $section_filter --- отображать ли секцию с фильтрами
    * $section_slug --- слаг однотипных секций с классом .section
  */
  if (! function_exists( 'earena_2_get_section' )) {
    function earena_2_get_section ( $section_slug, $section_filter = false, $section_header_right = 'all_button', $is_tab = '' ) {
      global $filter_section;
      global $header_right_section;
      global $is_tab_global;

      $filter_section = $section_filter;
      $header_right_section = $section_header_right;
      $is_tab_global = $is_tab;

      get_template_part( 'template-parts/sections/' . $section_slug );
    }
  }

  /*
    *** Ф-я подключает нужный шаблон popup
  */
  if (! function_exists( 'earena_2_get_popup' ) ) {
    function earena_2_get_popup ( $popup_slug = '' ) {
      get_template_part( 'template-parts/popups/' . $popup_slug );
    }
  }

  /*
    *** Ф-я выводит кнопку закрытия попапа с нужным модификатором
  */
  if (! function_exists( 'earena_2_get_popup_close_button_html' )) {
    function earena_2_get_popup_close_button_html ( $popup_slug = '' ) {
      global $slug_popup;

      $slug_popup = $popup_slug;

      get_template_part( 'template-parts/popups/button', 'close' );
    }
  }

  /*
    *** Ф-я определения текущей страницы
  */
  if (! function_exists( 'earena_2_current_page' )) {
    function earena_2_current_page ( $page_slug = false ) {
      if ($page_slug) {
        // Проверяем наличие слага с URI
        $is_current = strpos($_SERVER['REQUEST_URI'], $page_slug) ? strpos($_SERVER['REQUEST_URI'], $page_slug) : strpos($page_slug, $_SERVER['REQUEST_URI']);

        // Если есть - добавляем активный класс
        if ($is_current !== false) {
          echo 'active';
        }
      }
    }
  }

  /*
    *** Ф-я вывода шаблона меню залогиненного пользователя
  */
  if (! function_exists( 'earena_2_menu_loged_user' )) {
    function earena_2_menu_loged_user (  ) {
      get_template_part( 'template-parts/personal' );
    }
  }

  /*
    *** Ф-я добавления пробела к суммам на сайте
  */
  if (! function_exists( 'earena_2_nice_money' )) {
    function earena_2_nice_money ( $money_value = 0 ) {
      // Получаю дробную часть
      $money_value_decimal = $money_value - floor($money_value);
      /*
      // Перевожу в целое
      $money_value = floor($money_value);

      // Отделяю тысячи пробелом
      if ($money_value >= 1000) {
        $money_value  = substr($money_value, 0, -3) . ' ' . substr($money_value, -3);
      }

      // Добавляю дробную часть
      if ($money_value_decimal) {
        // Два знака после запятой выводим
        $money_value .= '.' . substr(round($money_value_decimal, 2), 2);
      }*/

      if ( $money_value > 0 && $money_value_decimal > 0 ) {
        $money_value = number_format( $money_value, 2, '.', ',' );
      } else if ($money_value > 0 && $money_value_decimal === 0) {
        $money_value = number_format( $money_value, 0, '', ',' );
      }

      return $money_value;
    }
  }

  /* *** Модификации старого фанкшнс *** */

  /* ==============================================
  ********  //Логин
  =============================================== */

  if( wp_doing_ajax() ) {
    if (!is_user_logged_in()) {
      add_action('wp_ajax_ajax_login', 'ajax_login');
      add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
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

      add_action('wp_ajax_nopriv_ajaxreset_pass', 'ajax_reset_pass');
  }
  /*
   *	@desc	Process reset password
   */
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
              __('<strong>Error</strong>: The email could not be sent. Your site may not be correctly configured to send emails.'));
          return $errors;
      }

      return true;
  }

  // Проверка на админа
  function is_ea_admin()
  {
      return current_user_can('edit_posts');
  }

  // Рейтинг
  function rating()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      $user = wp_get_current_user();
      return $user->get('rating') > 0 ? $user->get('rating') : 0;
  }

  // Баланс
  function balance()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      $user_id = get_current_user_id();
      return woo_wallet()->wallet->get_wallet_balance($user_id, '');
  }

  // Деньги в игре (?)
  function money_in_games()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      $ea_user = wp_get_current_user();
      return $ea_user->get('mig') > 0 ? $ea_user->get('mig') : 0;
  }

  // Время
  function ea_header_time()
  {
      return date('H:i', utc_to_usertime(time())) . '(UTC' . utc_value() . ')';
  }

  function utc_to_usertime($time)
  {
      return isset($_COOKIE['ea_user_time_offset']) ? $time - ($_COOKIE['ea_user_time_offset'] * 60) : $time;
  }

  function usertime_to_utc($time)
  {
      return isset($_COOKIE['ea_user_time_offset']) ? $time + ($_COOKIE['ea_user_time_offset'] * 60) : $time;
  }

  function utc_value()
  {
      return isset($_COOKIE['ea_user_time_offset']) ? (($_COOKIE['ea_user_time_offset'] <= 0 ? '+' : '-') . (!empty($_COOKIE['ea_user_time_offset']) ? gmdate('H:i',
              abs($_COOKIE['ea_user_time_offset'] * 60)) : 0)) : '+0';
  }

  function counter_matches()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      return EArena_DB::count_my_matches();
  }

  function counter_tournaments()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      return EArena_DB::count_my_tournaments();
  }

  function counter_admin()
  {
      if (!is_user_logged_in()) {
          return '';
      }
      $admin_id = (int)get_site_option('ea_admin_id', 27);
      $thread_id = ea_get_thread_id($admin_id);
      return ea_count_unread($thread_id);
  }

  function count_admin_matches_moderate()
  {
      if (!is_ea_admin()) {
          return;
      }
      return EArena_DB::count_ea_admin_matches_moderate();
  }

  function count_admin_tournaments_moderate($type = 0)
  {
      if (!is_ea_admin()) {
          return;
      }
      return EArena_DB::count_ea_admin_tournaments_moderate($type) ?: 0;
  }

  function count_admin_tournaments_not_confirmed($type = 0)
  {
      if (!is_ea_admin()) {
          return;
      }
      return EArena_DB::count_ea_admin_tournaments_not_confirmed($type) ?: 0;
  }

  function count_admin_tournaments($type = 0)
  {
      if (!is_ea_admin()) {
          return;
      }
      return count_admin_tournaments_moderate($type) + count_admin_tournaments_not_confirmed($type);
  }

  /* ==============================================
  ********  //Верификация пользователя
  =============================================== */
  function ea_get_verification_requests()
  {
      return wp_list_pluck(get_users(
          array(
              'meta_query' => [
                  [
                      'key' => 'verification_request',
                      'value' => 1,
                  ],
                  [
                      'key' => 'verification_files',
                      'compare' => 'EXISTS',
                  ],
              ],
              'fields' => ['ID']
          )), 'ID');
  }

  function ea_count_verification_requests()
  {
      return count(ea_get_verification_requests());
  }

  function pluralize($string, $ch1, $ch2, $ch3)
  {
      $ff = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
      if (substr($string, -2, 1) == 1 and strlen($string) > 1) {
          $ry = array("0 $ch3", "1 $ch3", "2 $ch3", "3 $ch3", "4 $ch3", "5 $ch3", "6 $ch3", "7 $ch3", "8 $ch3", "9 $ch3");
      } else {
          $ry = array(
              "0 $ch3",
              "1 $ch1",
              "2 $ch2",
              "3 $ch2",
              "4 $ch2",
              "5 $ch3",
              " 6 $ch3",
              "7 $ch3",
              "8 $ch3",
              " 9 $ch3"
          );
      }
      $string1 = substr($string, 0, -1) . str_replace($ff, $ry, substr($string, -1, 1));
      return $string1;
  }

  // Games
  function ea_count_games()
  {
  	$res = wp_cache_get( 'ea_count_games','ea' );
  	if( empty($res) ){
  		global $wpdb;
  		$res = array_fill(0, 12, ['matches' => 0, 'tournaments' => 0]);
  		$matches = $wpdb->get_results("SELECT game, count(*) as count FROM `{$wpdb->base_prefix}earena_matches` GROUP BY game");
  		$tournaments = $wpdb->get_results("SELECT game, count(*) as count FROM `{$wpdb->base_prefix}earena_tournaments` WHERE status > 1 GROUP BY game");
  		foreach ($matches as $match) {
  			$res[$match->game]['matches'] = $match->count;
  		}
  		foreach ($tournaments as $tournament) {
  			$res[$tournament->game]['tournaments'] = $tournament->count;
  		}
  		wp_cache_set( 'ea_count_games', $res, 'ea', 60 );
  	}
      return $res;
  }

  function ea_count_games_platforms()
  {
  	$res = wp_cache_get( 'ea_count_games_platforms','ea' );
  	if( empty($res) ){
  		global $wpdb;
  		$res = [];
  		$games = get_site_option('games');
  		foreach ($games as $game => $v) {
  	//        foreach ($v['platforms'] as $k => $platform) {
  			for ($i=0;$i<4;$i++) {
  				$res[$game][$i] = ['matches' => 0, 'tournaments' => 0];
  			}
  		}
  		$matches = $wpdb->get_results("SELECT game, platform, count(*) as count FROM `{$wpdb->base_prefix}earena_matches` group by game, platform ORDER BY `{$wpdb->base_prefix}earena_matches`.`game`  ASC");
  		foreach ($matches as $match) {
  			$res[$match->game][$match->platform]['matches'] = $match->count??0;
  		}
  		$tournaments = $wpdb->get_results("SELECT game, platform, count(*) as count FROM `{$wpdb->base_prefix}earena_tournaments` WHERE status > 1 group by game, platform ORDER BY `{$wpdb->base_prefix}earena_tournaments`.`game`  ASC");
  		foreach ($tournaments as $tournament) {
  			$res[$tournament->game][$tournament->platform]['tournaments'] = $tournament->count??0;
  		}
  		wp_cache_set( 'ea_count_games_platforms', $res, 'ea', 60 );
  	}
      return $res;
  }

  function ea_my_games()
  {
      if (!is_user_logged_in()) {
          return [];
      }
      $ea_user = wp_get_current_user();
      $nicknames = $ea_user->get('nicknames');
      if (empty($nicknames)) {
          return [];
      }
      $result = array();
      foreach ($nicknames as $k => $v) {
          if (!empty($v)) {
              $result[] = $k;
          }
      }
      return $result;
  }

  function ea_my_platforms($game)
  {
      if (!is_user_logged_in()) {
          return [];
      }
      $ea_user = wp_get_current_user();
      $nicknames = $ea_user->get('nicknames');
      if (empty($nicknames[$game])) {
          return [];
      }
      $result = array();
      foreach ($nicknames[$game] as $k => $v) {
          if (!empty($v)) {
              $result[] = $k;
          }
      }
      return $result;
  }

  function ea_game_nick($game, $platform, $id = 0)
  {
  //	if (!is_user_logged_in()) return '';
      $user_id = $id > 0 ? $id : get_current_user_id();
      $nicknames = get_user_meta($user_id, 'nicknames', true);
      return (isset($nicknames[$game]) && is_array($nicknames[$game]) && !empty($nicknames[$game][$platform])) ? $nicknames[$game][$platform] : '<span style="color:red;"><i>NO_NAME</i></span>';
  }

  /*INCLUDE USER EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_user.php' );

  /*INCLUDE WALLET EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_wallet.php' );

  /*INCLUDE AJAX EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_ajax.php' );
?>
