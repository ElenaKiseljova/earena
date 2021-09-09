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

  // Колличество
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

  function ea_count_verification_requests()
  {
      return count(ea_get_verification_requests());
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
