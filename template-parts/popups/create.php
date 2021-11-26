
<div class="popup popup--create">
  <div class="popup__template popup__template--create" id="create-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'create' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-create-success">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Создание турнира', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template popup__information--create">
        <?php _e( '', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--create button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="popup-create-error">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Создание турнира', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Что-то пошло не так. Пожалуйста, повторите попытку позже...', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--create button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
