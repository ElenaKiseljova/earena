<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;

  if (!isset($ea_user)) {
    return;
  }
?>
<div class="popup popup--block">
  <div class="popup__template popup__template--block" id="block-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'block' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-block-add">
    <div class="popup__header popup__header--block">
      <h2 class="popup__title popup__title--block">
        <?php _e( 'Блокировка', 'earena_2' ); ?>
      </h2>
    </div>

    <div class="popup__content popup__content--block">
      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вы действительно хотите заблокировать игрока %s?', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <form class="form form--popup" data-prefix="add" id="form-block" action="/" method="post">
        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
        <input type="hidden" name="user" value="<?= $ea_user->ID; ?>">
        <input type="hidden" name="username" value="<?= $ea_user->nickname; ?>">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--red" type="submit" name="block-submit-next">
            <span>
              <?php _e( 'Заблокировать', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-block-delete">
    <div class="popup__header popup__header--block">
      <h2 class="popup__title popup__title--block">
        <?php _e( 'Разблокировка', 'earena_2' ); ?>
      </h2>
    </div>

    <div class="popup__content popup__content--block">
      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вы действительно хотите разблокировать игрока %s?', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <form class="form form--popup" data-prefix="delete" id="form-block" action="/" method="post">
        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
        <input type="hidden" name="user" value="<?= $ea_user->ID; ?>">
        <input type="hidden" name="username" value="<?= $ea_user->nickname; ?>">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--green" type="submit" name="block-submit-next">
            <span>
              <?php _e( 'Разблокировать', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-block-success-add">
    <div class="popup__content popup__content--block">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Блокировка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вы успешно заблокировали игрока %s.', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--block button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-block-success-delete">
    <div class="popup__content popup__content--block">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Разблокировка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вы успешно разблокировали игрока %s.', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--block button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-block-error-add">
    <div class="popup__content popup__content--block">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Блокировка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вам не удалось заблокировать игрока %s.', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--block button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-block-error-delete">
    <div class="popup__content popup__content--block">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Разблокировка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?=
          sprintf( __( 'Вам не удалось разблокировать игрока %s.', 'earena_2' ), $ea_user->nickname);
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--block button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-block-beforesend">
    <div class="popup__content popup__content--block">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
