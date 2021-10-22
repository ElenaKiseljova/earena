<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--stream">
  <div class="popup__template popup__template--stream" id="stream-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'stream' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-stream-source">
    <div class="popup__header popup__header--stream">
      <h2 class="popup__title popup__title--stream">
        <?php _e( 'Трансляция', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Пожалуйста укажите ссылку на источник трансляции , чтобы другие игроки могли наблюдать за вашей игрой.', 'earena_2' ); ?>
        </span>
      </div>
    </div>

    <div class="popup__content popup__content--stream">
      <form class="form form--popup" data-prefix="" id="form-stream" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="stream-source" type="text" name="stream-source" required placeholder="<?php _e( 'Ссылка на источник', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="stream-submit-next">
            <span>
              <?php _e( 'Добавить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-stream-success">
    <div class="popup__content popup__content--stream">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ссылка на стрим добавлена', 'earena_2' ); ?>
      </h2>
    </div>
  </template>
  <template id="form-stream-beforesend">
    <div class="popup__content popup__content--stream">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-stream-error">
    <div class="popup__content popup__content--stream">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ссылка на стрим не добавлена', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, попробуйте повторить позже.', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
