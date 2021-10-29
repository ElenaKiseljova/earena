
<div class="popup popup--verification">
  <div class="popup__template popup__template--verification" id="verification-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'verification' );
    }
  ?>

  <!-- Шаблоны попапа -->
  <template id="popup-verification-request">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
          <?php _e( 'Верификация необходима для подтверждения вашей личности, чтобы совершать операции по выводу средств. <br><br>Пожалуйста прикрепите фото хорошего качества основной страницы паспорта или водительского удостоверения.', 'earena_2' ); ?>
      </div>

      <div class="popup__form popup__form--verification">
        <form class="form form--popup" data-prefix="request" id="form-verification" action="/" method="post">
          <div class="form__row form__row--verification">
            <div class="files files--verification">
              <label class="files__label files__label--verification" for="files-verification">
                <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
              </label>
              <input class="files__input visually-hidden" type="file" id="files-verification" name="files" required accept=".png, .jpg, .jpeg" multiple>

              <!-- Сюда попадают скрины, что загрузил игрок подтверждающий себя -->
              <div class="files__preview">
              </div>
            </div>
          </div>
          <div class="popup__ajax-message"></div>
          <div class="form__buttons">
            <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--blue" type="submit" name="verification-submit" disabled>
              <span>
                <?php _e( 'Отправить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  <template id="popup-verification-apply">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
          <?php _e( 'Вы хотите подтвердить верификацию пользователя <span class="user-name"></span>?', 'earena_2' ); ?>
      </div>

      <form class="form form--popup" data-prefix="apply" id="form-verification" action="/" method="post">
        <input class="user-id" type="hidden" name="user" value="">
        <input class="user-name" type="hidden" name="username" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="verification-apply">
            <span>
              <?php _e( 'Подтвердить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-verification-reject">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
          <?php _e( 'Вы хотите отказать в верификации пользователю <span class="user-name"></span>?', 'earena_2' ); ?>
      </div>

      <form class="form form--popup" data-prefix="reject" id="form-verification" action="/" method="post">
        <input class="user-id" type="hidden" name="user" value="">
        <input class="user-name" type="hidden" name="username" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>

          <button class="form__submit form__submit--buttons button button--red" type="submit" name="verification-reject">
            <span>
              <?php _e( 'Подтвердить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-verification-success-request">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка принята! Мы рассмотрим ее в течение 24-х часов.', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--verification button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-verification-success-apply">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пользователь <span class="user-name"></span> успешно верифицирован!', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--verification button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-verification-success-reject">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Верификация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пользователю <span class="user-name"></span> отказано в верификации!', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--verification button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-verification-beforesend">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-verification-error">
    <div class="popup__content popup__content--verification">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Что-то пошло не так', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, попробуйте повторить позже.', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
