<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--login">
  <div class="popup__template popup__template--login" id="login-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>
  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'login' );
    }
  ?>

  <!-- Шаблоны попапов вход/регистрация/восстановление -->
  <template id="popup-login-signin">
    <div class="popup__header popup__header--login">
      <h2 class="popup__title popup__title--login">
        <?php _e( 'Войти', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Еще нет аккаунта?', 'earena_2' ); ?>
        </span>
        <button class="popup__button popup__button--information" type="button" name="signup">
          <?php _e( 'Создать', 'earena_2' ); ?>
        </button>
      </div>
    </div>

    <div class="popup__content popup__content--login">
      <form class="form form--popup" data-prefix="signin" id="form-login" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <button class="form__forgot popup__button popup__button--information" type="button" name="forgot">
          <?php _e( 'Я забыл пароль', 'earena_2' ); ?>
        </button>

        <button class="form__submit button button--blue disabled" type="submit" name="call-submit">
          <span>
            <?php _e( 'Войти', 'earena_2' ); ?>
          </span>
        </button>
      </form>
    </div>
  </template>
  <template id="popup-login-signup">
    <div class="popup__header popup__header--login">
      <h2 class="popup__title popup__title--login">
        <?php _e( 'Регистрация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Уже есть аккаунт?', 'earena_2' ); ?>
        </span>
        <button class="popup__button popup__button--information" type="button" name="signin">
          <?php _e( 'Войти', 'earena_2' ); ?>
        </button>
      </div>
    </div>

    <div class="popup__content popup__content--login">
      <form class="form form--popup" data-prefix="signup" id="form-login" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>" pattern="[0-9a-zA-Zа-яА-Я ]{2,}">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" id="email" type="email" name="email" required placeholder="<?php _e( 'Электронная почта', 'earena_2' ); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" id="birthday" type="text" name="birthday" onclick="(this.type='date')" required placeholder="<?php _e( 'Дата рождения (дд/мм/гггг)', 'earena_2' ); ?>">
          <span class="form__arrow"></span>
        </div>
        <span class="form__error form__error--popup">
          <span class="form__error-old"><?php _e( 'Вам не будут доступны игры на деньги так, как вам не исполнилось 18 лет', 'earena_2' ); ?></span>
          <span class="form__error-default"><?php _e( 'Error', 'earena_2' ); ?></span>
        </span>

        <div class="form__row">
          <!-- <input class="form__field form__field--popup" list="country-list" id="country" name="country" required placeholder="<?php _e( 'Страна', 'earena_2' ); ?>" />
          <span class="form__arrow"></span>

          <datalist id="country-list">
              <option value="Chocolate">
              <option value="Coconut">
              <option value="Mint">
              <option value="Strawberry">
              <option value="Vanilla">
          </datalist> -->
          <div class="select select--login">
            <!-- Для переключения состояния - добавляется active класс  -->
            <button class="select__button select__button--login" type="button" name="button">
              <?php _e( 'Страна', 'earena_2' ); ?>
            </button>

            <!-- Для переключения состояния - добавляется active класс  -->
            <ul class="select__list">
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="select-country" value="ru" id="select-ru" required>
                <label class="select__label" for="select-ru">
                  <?php _e( 'РФ', 'earena_2' ); ?>
                </label>
              </li>
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="select-country" value="ua" id="select-ua" required>
                <label class="select__label" for="select-ua">
                  <?php _e( 'Украина', 'earena_2' ); ?>
                </label>
              </li>
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="select-country" value="by" id="select-by" required>
                <label class="select__label" for="select-by">
                  <?php _e( 'Беларусь', 'earena_2' ); ?>
                </label>
              </li>
            </ul>
          </div>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <button class="form__submit button button--blue disabled" type="submit" name="call-submit">
          <span>
            <?php _e( 'Создать аккаунт', 'earena_2' ); ?>
          </span>
        </button>

        <p class="form__privacy">
          <?php
            $url_to_rules_page = '#';
            $privacy_policy_url = get_privacy_policy_url();

            echo sprintf( __( 'Нажимая кнопку вы соглашаетесь с <a href="%s">Правилами сервиса</a> и <a href="%s">Политикой конфиденциальности</a>', 'earena_2' ), $url_to_rules_page, $privacy_policy_url );
          ?>
        </p>
      </form>
    </div>
  </template>
  <template id="popup-login-forgot">
    <div class="popup__header popup__header--login">
      <h2 class="popup__title popup__title--login">
        <?php _e( 'Забыли пароль?', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Укажите электронную почту', 'earena_2' ); ?>
        </span>
      </div>
    </div>

    <div class="popup__content popup__content--login">
      <form class="form form--popup" data-prefix="forgot" id="form-login" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="email" type="email" name="email" required placeholder="<?php _e( 'Электронная почта', 'earena_2' ); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <button class="form__submit button button--blue disabled" type="submit" name="call-submit">
          <span>
            <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
          </span>
        </button>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-login-success">
    <div class="popup__content popup__content--login">
      <h2 class="popup__title popup__title--template">
        Alexeyshkitin,
        <br>
        <?php _e( 'добро пожаловать!', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Чтобы начать соревноваться <br> с другими игроками необходимо <br> добавить игры в свою учетную запись.', 'earena_2' ); ?>
      </div>

      <a class="popup__add-button button button--blue" href="/profile">
        <?php _e( 'Добавить сейчас', 'earena_2' ); ?>
      </a>
    </div>
  </template>
  <!-- Успешная форма восстановления пароля -->
  <template id="form-login-success-forgot">
    <div class="popup__content popup__content--login">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'На указанную вами электронную почту отправлен новый пароль.', 'earena_2' ); ?>
      </div>
      <button class="form__popup-close button button--gray" name="close" type="button">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <!-- До отправки -->
  <template id="form-login-beforesend">
    <div class="popup__content popup__content--login">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <!-- При ошибке -->
  <template id="form-login-error">
    <div class="popup__content popup__content--login">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Что-то пошло <br> не так', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, обновите страницу и <br> повторите отправку формы.', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
