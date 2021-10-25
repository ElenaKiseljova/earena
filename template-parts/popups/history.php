
<div class="popup popup--history">
  <div class="popup__template popup__template--history" id="history-popup">
    <div class="popup__content popup__content--history">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Удалить историю', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          $user_delete_name = 'Grtteeww';

          echo sprintf(
            __( 'Вы действительно хотите удалить историю сообщений с игроком %s? <br>Восстановить ее будет невозможно.', 'earena_2' ),
            $user_delete_name
          );
        ?>
      </div>

      <form class="form" action="index.html" method="post" data-prefix="" id="form-delete-history">
        <input type="hidden" name="id-friend" value="999">
        <input type="hidden" name="accept-remove" value="true">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--red" type="submit" name="history-delete-submit">
            <span>
              <?php _e( 'Удалить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>

  <template id="form-delete-history-beforesend">
    <div class="popup__content popup__content--history">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-delete-history-error">
    <div class="popup__content popup__content--history">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка удаления', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, повторите попытку позже', 'earena_2' ); ?>
      </div>

      <button class="popup__close popup__close--cross button button--popup-close">
        <span class="visually-hidden">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </template>
</div>
