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

  /* ==============================================
  ********  //Регистрируем меню
  =============================================== */
  function register_my_menus()
  {
      register_nav_menus(array(
          'header-menu' => 'Main Menu',
          'footer-menu-1' => 'Footer Menu 1',
          'footer-menu-2' => 'Footer Menu 2'
      ));
  }

  if (function_exists('register_nav_menus')) {
      add_action('init', 'register_my_menus');
  }

  // Styles theme
  function earena_2_styles () {
    wp_enqueue_style('earena_2-style', get_stylesheet_uri());
    wp_enqueue_style('swiper-style', 'https://unpkg.com/swiper/swiper-bundle.min.css');
  }

  // Scripts theme
  function earena_2_scripts () {
    if ( is_ea_admin() ) {
      wp_enqueue_script('earena_2_admin_functions-script', get_template_directory_uri() . '/assets/js/ajax/earena_2_admin_functions.min.js', $deps = array('jquery'), $ver = null, $in_footer = true );
    }
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

    if (is_user_logged_in() && is_page(527)) {
      wp_enqueue_script('clipboard-script', 'https://cdn.jsdelivr.net/npm/clipboard@2.0.6/dist/clipboard.min.js', $deps = array(), $ver = null, $in_footer = true );
      wp_enqueue_script('update-clipboard-script', get_template_directory_uri() . '/assets/js/update-clipboard.min.js', $deps = array(), $ver = null, $in_footer = true );
    }

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
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $actual_link = explode('?', $actual_link);
        $actual_link = $actual_link[0];

        $is_current = strpos($actual_link, $page_slug) ? strpos($actual_link, $page_slug) : strpos($page_slug, $actual_link);

        if ($is_current !== false) {
          return true;
        }
      }
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

  # Отключение провайдера карт сайтов: пользователи и таксономии
  add_filter('wp_sitemaps_add_provider', 'ea_remove_sitemap_provider', 10, 2);
  function ea_remove_sitemap_provider($provider, $name)
  {
      // отключаем архивы пользователей
      if (in_array($name, ['users'])) {
          return false;
      }
      return $provider;
  }

  add_filter('wp_sitemaps_posts_query_args', 'ea_sitemaps_posts_query_args', 10, 2);
  function ea_sitemaps_posts_query_args($args, $post_type)
  {

      if ('page' !== $post_type) {
          return $args;
      }

      // учтем что этот параметр может быть уже установлен
      if (!isset($args['post__not_in'])) {
          $args['post__not_in'] = array();
      }

      // Исключаем посты
      foreach ([
                   8,
                   274,
                   298,
                   552,
                   555,
                   577,
                   637,
                   640,
                   643,
                   646,
                   649,
                   657,
                   907,
                   1569,
                   1710,
                   1716,
                   510,
                   515,
                   518,
                   521,
                   524,
                   527,
                   1169,
                   866,
                   280,
                   503,
                   654
               ] as $post_id) {
          $args['post__not_in'][] = $post_id;
      }

      return $args;
  }

  add_action('init', 'do_rewrite');
  function do_rewrite()
  {
      // Правило перезаписи
      add_rewrite_rule('^(user)/([^/]*)/?', 'index.php?pagename=$matches[1]&username=$matches[2]', 'top');
      // нужно указать ?p=123 если такое правило создается для записи 123
      // первый параметр для записей: p или name, для страниц: page_id или pagename

      // скажем WP, что есть новые параметры запроса
      add_filter('query_vars', function ($vars) {
          $vars[] = 'username';
          return $vars;
      });
  }

  add_filter('woocommerce_get_cart_page_id', function ($page_id) {
      return 1710;
  });
  add_filter('woocommerce_get_myaccount_page_id', function ($page_id) {
      return 1716;
  });


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

  function earena_2_rating($user = false)
  {
      //$user - это либо объект пользователя, либо ID пользователя
      if ($user ===  false) {
        $user = wp_get_current_user();
      } else {
        // Если передан ID юзера
        $user = ($user instanceof WP_User) ? $user : get_user_by( 'id', $user );
      }

      return $user->get('rating') > 0 ? $user->get('rating') : 0;
  }

  // Верификация
  function earena_2_verification_html($verification = false, $type_profile = 'public') {
    if (!$verification && $type_profile === 'public'): ?>
      <span class="verify verify--false">
        <span class="visually-hidden">
          <?php _e( 'Не верифицированный игрок', 'earena_2' ); ?>
        </span>
      </span>
    <?php elseif (!$verification && $type_profile === 'private') : ?>
      <button class="verify openpopup" data-popup="verification" type="button" name="request">
        <span class="visually-hidden">
          <?php _e( 'Верификация', 'earena_2' ); ?>
        </span>
      </button>
    <?php else : ?>
      <span class="verify verify--true">
        <span class="visually-hidden">
          <?php _e( 'Верифицированный игрок', 'earena_2' ); ?>
        </span>
      </span>
    <?php endif;
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

  function earena_2_balance($user_id = false)
  {   if ($user_id === false) {
        $user_id = get_current_user_id();
      }

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

  function is_online($user_id)
  {
      $last_activity = bp_get_user_last_activity($user_id);
      $exact_time = time();
      $time_ago = date("Y-m-d H:i:s", $exact_time - 3 * 60);
      if ($last_activity > $time_ago) {
          return true;
      }
      return false;
  }

  // Статистика на Главной

  add_shortcode('counter1', 'counter1');
  function counter1_value()
  {
  //	return number_format(rand(1000000,10000000), 0, ',', ' ');
  	$qty = wp_cache_get( 'ea_total_matches','ea' );
  	if( empty($qty) ){
  		global $wpdb;
  		$qty = $wpdb->get_var("SELECT count(*) FROM `{$wpdb->base_prefix}earena_matches` WHERE status>=100") + $wpdb->get_var("SELECT count(*) FROM `{$wpdb->base_prefix}earena_tournament_matches` WHERE status>=100");
  		wp_cache_set( 'ea_total_matches', $qty, 'ea', 60 );
  	}
      return number_format($qty, 0, ',', ' ');
  }
  function counter1()
  {
      return '<span class="ea-banner-counter1">'.counter1_value().'</span>';
  }

  add_shortcode('counter2', 'counter2');
  function counter2_value()
  {
  //	return number_format((float)rand(1000000,10000000)/100, 2, ',', ' ');
      return number_format((float)get_site_option('total_win'), 0, ',', ' ');
  }
  function counter2()
  {
      return '<span class="ea-banner-counter2">'.counter2_value().'</span>';
  }

  // Статистика в Аккаунте
  function ea_get_user_stat($user_id = 0) {
      $user_id = $user_id > 0 ? $user_id : get_current_user_id();
      $ea_user = get_user_by('id', (int)$user_id);
      $user_stat = wp_cache_get( 'ea_statistics_user_'.$ea_user->ID, 'ea' );
      if( empty($user_stat) ){
          $nicknames =  ($ea_user instanceof WP_User) ? $ea_user->get('nicknames'):[];
          $games = get_site_option( 'games' );
          $user_stat = [];
          if( !empty($nicknames) ){
              foreach (@$nicknames as $game => $v) {
                  $user_stat[$game]['id'] = $games[$game]['id'];
                  $user_stat[$game]['shortname'] = $games[$game]['shortname'];
                  $user_stat[$game]['m_wins'] = EArena_DB::get_ea_matches_win($ea_user->ID, $game);
                  $user_stat[$game]['m_loses'] = EArena_DB::get_ea_matches_lose($ea_user->ID, $game);

                  $user_stat[$game]['t_wins'] = EArena_DB::get_ea_tournament_matches_win($ea_user->ID, $game);
                  $user_stat[$game]['t_loses'] = EArena_DB::get_ea_tournament_matches_lose($ea_user->ID, $game);
                  $user_stat[$game]['t_draw'] = EArena_DB::get_ea_tournament_matches_draw($ea_user->ID, $game);

                  $user_stat[$game]['gf'] = EArena_DB::get_ea_matches_goals_from($ea_user->ID, $game) + EArena_DB::get_ea_tournament_matches_goals_from($ea_user->ID, $game);
                  $user_stat[$game]['gt'] = EArena_DB::get_ea_matches_goals_to($ea_user->ID, $game) + EArena_DB::get_ea_tournament_matches_goals_to($ea_user->ID, $game);
              }
              wp_cache_set( 'ea_statistics_user_'.$ea_user->ID, $user_stat, 'ea' );
          }
      }
      return $user_stat;
  }

  // Приглашенные в Аккаунте
  function my_referrals()
  {
      if (!is_user_logged_in()) {
          return [];
      }
      $user_id = get_current_user_id();
      $result = get_users(array(
          'meta_key' => 'ref',
          'meta_value' => $user_id,
          'fields' => 'all_with_meta' //['ID','nickname'],
      ));
      return $result;
  }

  // замена bp_core_get_user_domain
  function ea_user_link($id = 0)
  {
      if ($id == get_current_user_id()) {
          return home_url('profile');
      }
      $ea_user = $id == 0 ? wp_get_current_user() : get_user_by('id', $id);
      $username = is_integer($ea_user->user_nicename) ? rawurlencode($ea_user->user_nicename) : $ea_user->ID;
      return home_url('user/' . $username);

      /*
  	$link = EArena_DB::get_ea_user_link( $id );
  	return home_url('user/'.$link);
  	*/
  }

  /*INCLUDE WALLET EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_wallet.php' );

  /*INCLUDE BP_BETTER_MESSAGE EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_bp_better_messages.php' );

  /*INCLUDE AJAX EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_ajax.php' );

  /*INCLUDE USER EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_user.php' );

  /*INCLUDE ADMIN EARENA FUNCTIONS.PHP*/
  require_once( get_template_directory() . '/functions_admin.php' );
?>
