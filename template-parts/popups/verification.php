<!-- Для переключения состояния - добавляется active класс  -->
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

      <div class="chat-page chat-page--popup-verification">
        <form class="form form--popup" data-prefix="request" id="form-verification" action="/" method="post">
          <div class="chat-page__form chat-page__form--popup-verification">
            <label class="chat-page__form-field-label chat-page__form-field-label--popup-verification" for="chat-page-result-files">
              <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
            </label>
            <input class="chat-page__form-field-input visually-hidden" type="file" id="chat-page-result-files" name="chat-page-result-files" accept=".png, .jpg, .jpeg" multiple>

            <!-- Сюда попадают скрины, что загрузил игрок подтверждающий себя -->
            <div class="preview">
            </div>
          </div>
          <div class="popup__ajax-message"></div>
          <div class="form__buttons">
            <button class="form__popup-close form__popup-close--buttons button button--gray">
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--blue" type="submit" name="verification-submit">
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
          <button class="form__popup-close form__popup-close--buttons button button--gray">
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
          <button class="form__popup-close form__popup-close--buttons button button--gray">
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

      <button class="form__popup-close button button--gray">
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

      <button class="form__popup-close button button--gray">
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

      <button class="form__popup-close button button--gray">
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
