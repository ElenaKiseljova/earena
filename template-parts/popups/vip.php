<div class="popup popup--vip">
  <div class="popup__template popup__template--vip" id="vip-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'vip' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-vip-buy">
    <div class="popup__content popup__content--vip">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'VIP статус', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <!-- Этот текст перепишется ответom AJAX -->
        <?php _e( 'Запрос отправляется...', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--vip button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
