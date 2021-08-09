<div class="wrapper-form wrapper-form--login">
  <form class="form form--popup" id="form-login" action="/" method="post">
    <div class="form__row">
      <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>" pattern="[a-zA-Zа-яА-Я ]{2,}">
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
      <input class="form__field form__field--popup" list="country-list" id="country" name="country" required placeholder="<?php _e( 'Страна', 'earena_2' ); ?>" />
      <span class="form__arrow"></span>

      <datalist id="country-list">
          <option value="Chocolate">
          <option value="Coconut">
          <option value="Mint">
          <option value="Strawberry">
          <option value="Vanilla">
      </datalist>
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <button class="form__submit button button--blue" type="submit" disabled name="login-submit">
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

<!-- Шаблоны форм регистрации/входа/восстановления -->
<template id="form-login-signin">
  <form class="form form--popup" id="form-login" action="/" method="post">
    <div class="form__row">
      <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>" pattern="[a-zA-Zа-яА-Я ]{2,}">
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <div class="form__row">
      <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <button class="form__forgot popup__button popup__button--information" type="button" name="forgot">
      <?php _e( 'Я забыл пароль', 'earena_2' ); ?>
    </button>

    <button class="form__submit button button--blue" type="submit" disabled name="call-submit">
      <span>
        <?php _e( 'Войти', 'earena_2' ); ?>
      </span>
    </button>
  </form>
</template>
<template id="form-login-signup">
  <form class="form form--popup" id="form-login" action="/" method="post">
    <div class="form__row">
      <input class="form__field form__field--popup" id="name" type="text" name="name" required placeholder="<?php _e( 'Имя пользователя', 'earena_2' ); ?>" pattern="[a-zA-Zа-яА-Я ]{2,}">
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
      <input class="form__field form__field--popup" list="country-list" id="country" name="country" required placeholder="<?php _e( 'Страна', 'earena_2' ); ?>" />
      <span class="form__arrow"></span>

      <datalist id="country-list">
          <option value="Chocolate">
          <option value="Coconut">
          <option value="Mint">
          <option value="Strawberry">
          <option value="Vanilla">
      </datalist>
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <button class="form__submit button button--blue" type="submit" disabled name="call-submit">
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
</template>
<template id="form-login-forgot">
  <form class="form form--popup" id="form-login" action="/" method="post">
    <div class="form__row">
      <input class="form__field form__field--popup" id="email" type="email" name="email" required placeholder="<?php _e( 'Электронная почта', 'earena_2' ); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <button class="form__submit button button--blue" type="submit" disabled name="call-submit">
      <span>
        <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
      </span>
    </button>
  </form>
</template>

<!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
<template id="form-login-success">
  <h2 class="popup__title popup__title--login-template">
    Alexeyshkitin,
    <br>
    <?php _e( 'добро пожаловать!', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Чтобы начать соревноваться <br> с другими игроками необходимо <br> добавить игры в свою учетную запись.', 'earena_2' ); ?>
  </div>

  <a class="popup__add-button button button--blue" href="#">
    <?php _e( 'Добавить сейчас', 'earena_2' ); ?>
  </a>
</template>
<template id="form-login-beforesend">
  <h2 class="popup__title popup__title--login-template">
    <?php _e( 'Пожалуйста <br> подождите', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Ваша заявка <br> отправляется...', 'earena_2' ); ?>
  </div>
</template>
<template id="form-login-error">
  <h2 class="popup__title popup__title--login-template">
    <?php _e( 'Что-то пошло <br> не так', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Пожалуйста, обновите страницу и <br> повторите отправку формы.', 'earena_2' ); ?>
  </div>
</template>

<!-- Успешная форма восстановления пароля -->
<template id="form-login-success-forgot">
  <h2 class="popup__title popup__title--login-template">
    <?php _e( 'Восстановить пароль', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'На указанную вами электронную почту отправлен новый пароль.', 'earena_2' ); ?>
  </div>
  <button class="form__popup-close button button--gray" name="close" type="button">
    <?php _e( 'Закрыть', 'earena_2' ); ?>
  </button>
</template>
