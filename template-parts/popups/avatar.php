<?php
  /**
    * Hook: earena_2_bp_change_avatar.
    *
    * @hooked earena_2_bp_change_avatar_function - 10
  */
  do_action( 'earena_2_bp_change_avatar' );
?>

<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--avatar scroll-content">
  <div class="popup__template popup__template--avatar" id="avatar-popup">
    <div class="popup__header popup__header--avatar">
      <h2 class="popup__title popup__title--avatar">
        <?php _e( 'Изменить картинку профиля', 'earena_2' ); ?>
      </h2>
    </div>

    <div class="popup__content popup__content--avatar">
      <?php bp_attachments_get_template_part( 'avatars/index' );?>
    </div>
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'avatar' );
    }
  ?>
</div>
