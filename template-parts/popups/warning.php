<div class="popup popup--warning">
  <div class="popup__template popup__template--warning" id="warning-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'warning' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-warning-add">
    <div class="popup__header popup__header--warning">
      <h2 class="popup__title popup__title--warning">
        <?php _e( 'Предупреждение', 'earena_2' ); ?>
      </h2>
    </div>

    <div class="popup__content popup__content--warning">
      <form class="form form--popup" data-prefix="add" id="form-warning" action="/" method="post">
        <div class="form__row">
          <div class="select select--warning">

            <button class="select__button select__button--warning" type="button" name="button">
              <?php _e( 'Причина', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="reason" value="1" id="select-reason-1" required>
                <label class="select__label" for="select-reason-1">
                  <?php _e('Неуважение соперника', 'earena'); ?>
                </label>
              </li>
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="reason" value="2" id="select-reason-2" required>
                <label class="select__label" for="select-reason-2">
                  <?php _e('Нарушение правил', 'earena'); ?>
                </label>
              </li>
            </ul>
          </div>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
        <input type="hidden" name="user" value="">
        <input type="hidden" name="username" value="">
        <input type="hidden" name="match_id" value="">
        <input type="hidden" name="match_thread_id" value="">
        <input type="hidden" name="tournament" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="warning-submit-next">
            <span>
              <?php _e( 'Выдать', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-warning-success">
    <div class="popup__content popup__content--warning">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Предупреждение', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы добавили успешно предупреждение!', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-warning-beforesend">
    <div class="popup__content popup__content--warning">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-warning-error">
    <div class="popup__content popup__content--warning">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Предупреждение', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не добавили предупреждение. <br>Пожалуйста, попробуйте повторить позже.', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
