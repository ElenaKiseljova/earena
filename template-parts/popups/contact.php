
<div class="popup popup--contact">
  <div class="popup__template popup__template--contact" id="contact-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'contact' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-contact-success">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Отправлено', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Спасибо за то, что помогаете делать нашу платформу лучше.<br>Наши специалисты ответят на ваш запрос как можно скорее.', 'earena_2' ); ?>
      </div>

      <button class="popup__add-button popup__add-button--contact button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="popup-contact-error">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Не отправлено', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--contact-error">
        <?php _e( 'Что-то пошло не так. Пожалуйста, повторите попытку позже...', 'earena_2' ); ?>
      </div>

      <button class="popup__add-button popup__add-button--contact button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
