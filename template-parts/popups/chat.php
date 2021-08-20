<?php
  global $is_chat_page;
  $is_chat_page = false;
  global $is_account_page;
  $is_account_page = false;
?>
<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--chats">
  <div class="popup__wrapper popup__wrapper--chats">
    <div class="popup__content popup__content--chats">
      <h2 class="popup__title popup__title--chats">
        <?php _e( 'Общий чат игроков', 'earena_2' ); ?>
      </h2>

      <?php get_template_part( 'template-parts/chat' ); ?>

      <?php
        if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
          earena_2_get_popup_close_button_html( 'chats' );
        }
      ?>
    </div>
  </div>
</div>
