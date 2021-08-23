<?php
  /* earena_2 */
  add_action('wp_enqueue_scripts', 'earena_2_styles', 3);
  add_action('wp_enqueue_scripts', 'earena_2_scripts', 5);

  add_action( 'after_setup_theme', 'after_setup_theme_function' );

  if (!function_exists('after_setup_theme_function')) :
    function after_setup_theme_function () {
      load_theme_textdomain('earena_2', get_template_directory() . '/languages');

      //register_nav_menu( 'top_menu', 'Навигация в шапке сайта' );
      //register_nav_menu( 'bottom_menu', 'Навигация в подвале сайта' );

      add_theme_support( 'custom-logo' );
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
    wp_enqueue_script('form-script', get_template_directory_uri() . '/assets/js/form.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('filter-script', get_template_directory_uri() . '/assets/js/filter.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/popup.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('files-script', get_template_directory_uri() . '/assets/js/files.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('toggle-active-script', get_template_directory_uri() . '/assets/js/toggle-active.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('progress-script', get_template_directory_uri() . '/assets/js/progress.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('update-clipboard-script', get_template_directory_uri() . '/assets/js/update-clipboard.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('select-script', get_template_directory_uri() . '/assets/js/select.min.js', $deps = array(), $ver = null, $in_footer = true );

    $args = array();

    $args['url'] = admin_url('admin-ajax.php');

    wp_localize_script( 'form-script', 'earena_2_ajax', $args);
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
        $is_current = strpos($_SERVER['REQUEST_URI'], $page_slug);

        // Если есть - добавляем активный класс
        if ($is_current) {
          echo 'active';
        }
      }
    }
  }

  /*
    *** Ф-я вывода шаблона меню залогиненного пользователя
  */
  if (! function_exists( 'earena_2_menu_loged_user' )) {
    function earena_2_menu_loged_user ( $personal_place ) {
      global $place_personal;

      $place_personal = $personal_place;

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
      }

      echo $money_value;
    }
  }
?>
