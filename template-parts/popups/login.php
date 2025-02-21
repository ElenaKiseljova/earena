<?php
  $is_profile = is_page(503);
  $countries = get_site_option( 'countries' );
?>

<?php if (!is_user_logged_in()): ?>
  <div class="popup popup--login">
    <div class="popup__template popup__template--login" id="login-popup">
      <!-- Шаблон подставляется по открытию попапа -->
    </div>
    <?php
      if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
        earena_2_get_popup_close_button_html( 'login' );
      }
    ?>

    <!-- Шаблоны попапов вход/регистрация/восстановление/сброса -->
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
        <div class="popup__ajax-message"></div>
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

          <button class="form__submit form__submit--signin button button--blue disabled" type="submit" name="call-submit">
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
        <div class="popup__ajax-message"></div>
        <form class="form form--popup" data-prefix="signup" id="form-login" action="/" method="post">
          <div class="form__row">
            <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>" minlength="5" maxlength="25">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

          <div class="form__row">
            <input class="form__field form__field--popup" id="email" type="email" name="email" required placeholder="<?php _e( 'Электронная почта', 'earena_2' ); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

          <div class="form__row">
            <input class="form__field form__field--popup" id="password" type="password" name="password" minlength="8" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

          <div class="form__row form__row--date" data-placeholder="<?php _e( 'Дата рождения (дд/мм/гггг)', 'earena_2' ); ?>">
            <input class="form__field form__field--popup" id="birthday" type="date" name="birthday" required placeholder="">
            <span class="form__arrow"></span>
          </div>
          <span class="form__error form__error--popup">
            <?php _e( 'Error', 'earena_2' ); ?>
          </span>

          <div class="form__row">
            <div class="select select--country">

              <button class="select__button select__button--country" type="button" name="button">
                <?php _e( 'Страна', 'earena_2' ); ?>
              </button>


              <ul class="select__list select__list--country">
                <?php foreach ($countries as $country): ?>
                  <li class="select__item">
                    <input class="visually-hidden" type="radio" name="country" value="<?= mb_strtolower($country['slug']); ?>" id="select-<?= mb_strtolower($country['slug']); ?>" required>
                    <label class="select__label" for="select-<?= mb_strtolower($country['slug']); ?>">
                      <?= $country['name']; ?>
                    </label>
                  </li>
                <?php endforeach; ?>
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
              $url_to_rules_page = get_bloginfo( 'url' ) . '/terms-and-rules/';
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

          <button class="form__submit form__submit--forgot button button--blue disabled" type="submit" name="call-submit">
            <span>
              <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </template>
    <template id="popup-login-reset">
      <div class="popup__header popup__header--login">
        <h2 class="popup__title popup__title--login">
          <?php _e( 'Сброс пароля?', 'earena_2' ); ?>
        </h2>

        <div class="popup__information">
          <span>
            <?php _e( 'Укажите новый пароль', 'earena_2' ); ?>
          </span>
        </div>
      </div>

      <div class="popup__content popup__content--login">
        <div class="popup__ajax-message"></div>
        <form class="form form--popup" data-prefix="reset" id="form-login" action="/" method="post">
          <div class="form__row">
            <input class="form__field form__field--popup" id="pass_1" type="password" name="pass_1" minlength="8" required placeholder="<?php _e( 'Новый пароль', 'earena_2' ); ?>">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>
          <div class="form__row">
            <input class="form__field form__field--popup" id="pass_2" type="password" name="pass_2" minlength="8" required placeholder="<?php _e( 'Повтор пароля', 'earena_2' ); ?>">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>
          <p class="form__text form__text--reset">
            <?php _e('Используйте латинские буквы A-z верхнего или нижнего регистра, а так же числа от 1 до 0. Минимальная длина пароля - 8 символов.', 'earena_2') ?>
          </p>

          <input type="hidden" name="user_login" value="<?= $_GET['login'] ?? ''; ?>">
          <input type="hidden" name="user_key" value="<?= $_GET['key'] ?? ''; ?>">

          <button class="form__submit form__submit--reset button button--blue disabled" type="submit" name="call-submit">
            <span>
              <?php _e( 'Изменить пароль', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </template>

    <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
    <!-- Успешная форма восстановления пароля -->
    <template id="form-login-success-forgot">
      <div class="popup__content popup__content--login">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'На указанную вами электронную почту отправлен новый пароль.', 'earena_2' ); ?>
        </div>
        <button class="popup__go-to-button popup__go-to-button--login button button--gray button--popup-close" name="close" type="button">
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

    <!-- Успешная форма восстановления пароля -->
    <template id="form-login-success-reset">
      <div class="popup__content popup__content--login">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Сброс пароля', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Пароль успешно изменён! Закройте окно и войдите в свой аккаунт используя новый пароль.', 'earena_2' ); ?>
        </div>
        <button class="form__popup-close button button--gray button--popup-close" name="close" type="button">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <!-- При ошибке восстановления пароля -->
    <template id="form-login-error-reset">
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
<?php elseif (is_user_logged_in() && isset($_GET['action'])): ?>
  <?php
    $earana_2_user = wp_get_current_user();
  ?>
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
    <template id="popup-login-success">
      <div class="popup__content popup__content--login">
        <h2 class="popup__title popup__title--template">
          <?= $earana_2_user->nickname; ?>,
          <br>
          <?php _e( 'добро пожаловать!', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Чтобы начать соревноваться <br> с другими игроками необходимо <br> добавить игры в свою учетную запись.', 'earena_2' ); ?>
        </div>

        <?php if ($is_profile): ?>
          <button class="popup__go-to-button popup__go-to-button--login button button--blue button--popup-close">
            <?php _e( 'Добавить сейчас', 'earena_2' ); ?>
          </button>
        <?php else: ?>
          <a class="popup__go-to-button popup__go-to-button--login button button--blue" href="/profile">
            <?php _e( 'Добавить сейчас', 'earena_2' ); ?>
          </a>
        <?php endif; ?>
      </div>
    </template>
  </div>
<?php endif; ?>

<?php if (isset($_GET['action'])): ?>
  <?php
    // После загрузки стр - отработать клик открытия попапа
    $type_action = '';
    if ($_GET['action'] === 'fp' || $_GET['action'] === 'forgot') {
      $type_action = 'forgot';
    } else if ($_GET['action'] === 'rp' || $_GET['action'] === 'reset') {
      $type_action = 'reset';
    } else if ($_GET['action'] === 'success' || $_GET['action'] === 'after_registration' ) {
      $type_action = 'success';
    } else if ($_GET['action'] === 'register' ) {
      $type_action = 'signup';
    } else if ($_GET['action'] === 'login' ) {
      $type_action = 'signin';
    }
  ?>
  <button class="openpopup" id="login-<?= $type_action; ?>-button" data-popup="login" type="button" name="<?= $type_action; ?>">
    <span><?= _e('Открыть попап', 'earena_2'); ?> <?= $type_action; ?></span>
  </button>
  <script type="text/javascript">
    window.addEventListener('load', function () {
      try {
        document.querySelector('#login-<?= $type_action; ?>-button').click();

        let url = window.location.href;
        let urlArr = url.split('?');
        let urlGetArr = urlArr[1] ? urlArr[1].split('&') : [];

        urlGetArr.forEach((urlGet, i) => {
          if (urlGet.includes('action')) {
            urlGetArr.splice(i, 1);
          }
        });

        let newURL= (urlGetArr.length > 0) ? urlArr[0] + '?' + urlGetArr.join('&') : urlArr[0];

        window.history.pushState({}, '', newURL);
      } catch (e) {
        console.log(e);
      }
    });
  </script>
<?php endif; ?>
