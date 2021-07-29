<?php
  /* avocado */
  add_action('wp_enqueue_scripts', 'avocado_styles', 3);
  add_action('wp_enqueue_scripts', 'avocado_scripts', 5);

  add_action( 'after_setup_theme', 'after_setup_theme_function' );

  if (!function_exists('after_setup_theme_function')) :
    function after_setup_theme_function () {
      load_theme_textdomain('avocado', get_template_directory() . '/languages');

      register_nav_menu( 'top_menu', 'Навигация в шапке сайта' );
      register_nav_menu( 'bottom_menu', 'Навигация в подвале сайта' );

      add_theme_support( 'custom-logo' );
      add_theme_support( 'post-thumbnails' );
    }
  endif;

  // Styles theme

  function avocado_styles () {
    wp_enqueue_style('avocado-style', get_stylesheet_uri());
    wp_enqueue_style('swiper-style', get_template_directory_uri() . '/assets/libs/swiper.min.css');
  }

  // Scripts theme

  function avocado_scripts () {
    wp_enqueue_script('swiper-script', get_template_directory_uri() . '/assets/libs/swiper.min.js', $deps = array(), $ver = null, $in_footer = true );
    //wp_enqueue_script('form-script', get_template_directory_uri() . '/assets/js/form.min.js', $deps = array(), $ver = null, $in_footer = true );

    //$args = array();

    //$args['url'] = admin_url('admin-ajax.php');

    //wp_localize_script( 'form-script', 'avocado_ajax', $args);
  }
?>
