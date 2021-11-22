<?php
  global $match, $match_id, $ea_user;
?>

<div class="popup popup--complaint">
  <div class="popup__template popup__template--complaint" id="complaint-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'complaint' );
    }
  ?>

  <template id="popup-complaint-create">
    <div class="popup__content popup__content--complaint">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Жалоба судье', 'earena_2' ); ?>
      </h2>
      <form class="form form--popup" data-prefix="create" id="form-complaint" action="/" method="post">
        <div class="form__row">
          <textarea class="form__field form__field--popup form__field--message" name="message" required placeholder="<?php _e( 'Сообщение...', 'earena_2' ); ?>"></textarea>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
        <input type="hidden" name="user_id" value="<?= $ea_user->ID; ?>">
        <input type="hidden" name="id" value="<?= $match_id; ?>">
        <input type="hidden" name="type" value="<?= $match->type; ?>">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="complaint-close">
            <span>
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </span>
          </button>

          <button class="form__submit form__submit--buttons button button--red" type="submit" name="complaint-submit">
            <span>
              <?php _e( 'Отправить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-complaint-success">
    <div class="popup__content popup__content--complaint">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Жалоба судье', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша жалоба успешно отправлена', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--complaint button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-complaint-beforesend">
    <div class="popup__content popup__content--complaint">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша жалоба отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-complaint-error">
    <div class="popup__content popup__content--complaint">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка отправки', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Попробуйте повторить позже', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--complaint button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
