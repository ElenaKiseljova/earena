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

  /* ==============================================
  ********  //Смена аватара
  =============================================== */

  function ea_avatar_script_data( $script_data, $object ) {
    $user_id  = get_current_user_id();

    if ( ! empty( $user_id ) ) {
      // Should we load the the Webcam Avatar javascript file.
      if ( bp_avatar_use_webcam() ) {
        $script_data['extra_js'] = array_merge( $script_data['extra_js'], array( 'bp-webcam' ) );
      }

      $script_data['bp_params'] = array(
        'object'	 => 'user',
        'item_id'	=> $user_id,
        'has_avatar' => bp_get_user_has_avatar( $user_id ),
        'nonces'	 => array(
          'set'	=> wp_create_nonce( 'bp_avatar_cropstore' ),
          'remove' => wp_create_nonce( 'bp_delete_avatar_link' ),
        ),
      );

      // Set feedback messages.
      $script_data['feedback_messages'] = array(
        1 => __( 'There was a problem cropping your profile photo.', 'buddypress' ),
        2 => __( 'Your new profile photo was uploaded successfully.', 'buddypress' ),
        3 => __( 'There was a problem deleting your profile photo. Please try again.', 'buddypress' ),
        4 => __( 'Your profile photo was deleted successfully!', 'buddypress' ),
      );
    }

    return $script_data;
  }
  add_filter( 'bp_attachment_avatar_script_data', 'ea_avatar_script_data', 10, 2 );

  add_action( 'earena_2_bp_change_avatar', 'earena_2_bp_change_avatar_function', 10 );

  function earena_2_bp_change_avatar_function () {
    $ea_bp = buddypress();
    bp_core_register_common_scripts();
    wp_enqueue_style( 'thickbox' );
    wp_enqueue_script( 'media-upload' );

    bp_core_add_jquery_cropper();

    bp_attachments_enqueue_scripts( 'BP_Attachment_Avatar' );
  }
?>
