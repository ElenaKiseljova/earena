<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;

  if (!isset($ea_user)) {
    return;
  }
?>
<div class="popup popup--balance">
  <div class="popup__template popup__template--balance" id="balance-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'balance' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-balance-add">
    <div class="popup__header popup__header--balance">
      <h2 class="popup__title popup__title--balance">
        <?php _e( 'Баланс', 'earena_2' ); ?>
      </h2>
    </div>

    <div class="popup__content popup__content--balance">
      <form class="form form--popup" data-prefix="add" id="form-balance" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="balance" type="number" name="amount" required placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
        <input type="hidden" name="user" value="<?= $ea_user->ID; ?>">
        <input type="hidden" name="username" value="<?= $ea_user->nickname; ?>">

        <div class="popup__ajax-message"></div>
        <div class="form__buttons form__buttons--balance">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="balance-submit-next">
            <span>
              <?php _e( 'Пополнить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-balance-success">
    <div class="popup__content popup__content--balance">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Баланс', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Баланс игрока успешно изменен!', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--balance button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-balance-error">
    <div class="popup__content popup__content--balance">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Баланс', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Баланс игрока не изменен. <br>Пожалуйста, попробуйте повторить позже.', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--balance button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-balance-beforesend">
    <div class="popup__content popup__content--balance">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
