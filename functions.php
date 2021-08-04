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
    wp_enqueue_script('popup-script', get_template_directory_uri() . '/assets/js/popup.min.js', $deps = array(), $ver = null, $in_footer = true );
    wp_enqueue_script('remove-active-class-elements-script', get_template_directory_uri() . '/assets/js/remove-active-class-elements.min.js', $deps = array(), $ver = null, $in_footer = true );
    //wp_enqueue_script('form-script', get_template_directory_uri() . '/assets/js/form.min.js', $deps = array(), $ver = null, $in_footer = true );

    //$args = array();

    //$args['url'] = admin_url('admin-ajax.php');

    //wp_localize_script( 'form-script', 'earena_2_ajax', $args);
  }
?>
