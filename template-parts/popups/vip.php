<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;
?>
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
  <?php if (isset($ea_user)): ?>
    <template id="popup-vip-gift">
      <div class="popup__content popup__content--vip">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'VIP в подарок', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
            <?php _e( 'Вы хотите подтвердить дарение VIP статуса игроку?', 'earena_2' ); ?>
        </div>

        <form class="form form--popup" data-prefix="gift" id="form-vip" action="/" method="post">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
          <input type="hidden" name="user" value="<?= $ea_user->ID; ?>">
          <input type="hidden" name="username" value="<?= $ea_user->nickname; ?>">

          <div class="form__buttons">
            <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--blue" type="submit" name="vip-apply">
              <span>
                <?php _e( 'Подтвердить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>
    <template id="form-vip-success-gift">
      <div class="popup__content popup__content--vip">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'VIP в подарок', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'VIP статус успешно подарен игроку!', 'earena_2' ); ?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--vip button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-vip-error-gift">
      <div class="popup__content popup__content--vip">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'VIP в подарок', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'VIP статус не подарен игроку! Попробуйте повторить позже.', 'earena_2' ); ?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--vip button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-vip-beforesend">
      <div class="popup__content popup__content--vip">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
        </div>
      </div>
    </template>
  <?php endif; ?>
</div>
