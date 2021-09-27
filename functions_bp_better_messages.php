<?php
  function admin_bar_remove_this()
  {
      global $wp_admin_bar;
      $wp_admin_bar->remove_node('my-account-buddypress');
  }

  add_action('wp_before_admin_bar_render', 'admin_bar_remove_this');

  //add_filter( 'bp_core_fetch_avatar_no_grav', '__return_true' );
  if (!defined('BP_AVATAR_THUMB_WIDTH')) {
      define('BP_AVATAR_THUMB_WIDTH', 50);
  } //change this with your desired thumb width

  if (!defined('BP_AVATAR_THUMB_HEIGHT')) {
      define('BP_AVATAR_THUMB_HEIGHT', 50);
  } //change this with your desired thumb height

  if (!defined('BP_AVATAR_FULL_WIDTH')) {
      define('BP_AVATAR_FULL_WIDTH', 250);
  } //change this with your desired full size,weel I changed it to 260 :)

  if (!defined('BP_AVATAR_FULL_HEIGHT')) {
      define('BP_AVATAR_FULL_HEIGHT', 250);
  } //change this to default height for full avatar

  add_filter('bp_core_fetch_avatar_no_grav', '__return_true');
  define('BP_AVATAR_DEFAULT', get_stylesheet_directory_uri() . '/assets/img/avatar-default.svg');
  define('BP_AVATAR_DEFAULT_THUMB', get_stylesheet_directory_uri() . '/assets/img/avatar-default.svg');

  //https://codex.buddypress.org/themes/guides/customizing-buddypress-avatars/ аватарки

?>
