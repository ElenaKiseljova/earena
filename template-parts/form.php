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
      <input class="form__field form__field--popup" id="birthday" type="date" name="birthday" required placeholder="<?php _e( 'Дата рождения (дд/мм/гггг)', 'earena_2' ); ?>">
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Вам не будут доступны игры на деньги так, как вам не исполнилось 18 лет', 'earena_2' ); ?></span>

    <div class="form__row">
      <input class="form__field form__field--popup" list="country-list" id="country" name="country" required placeholder="<?php _e( 'Страна', 'earena_2' ); ?>" />

      <datalist id="country-list">
          <option value="Chocolate">
          <option value="Coconut">
          <option value="Mint">
          <option value="Strawberry">
          <option value="Vanilla">
      </datalist>
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <button class="form__submit button button--blue" type="submit" name="call-submit">
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

<!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
<template id="form-login-success">
  <h2 class="popup__title popup__title--call">
    Ваша заявка
    <br>
    отправлена
  </h2>

  <p class="popup__text">
    Ожидайте звонка
    <br>
    от нашего менеджера
  </p>
</template>
<template id="form-login-beforesend">
  <h2 class="popup__title popup__title--call">
    Пожалуйста
    <br>
    подождите
  </h2>

  <p class="popup__text">
    Ваша заявка
    <br>
    отправляется...
  </p>
</template>
<template id="form-login-error">
  <h2 class="popup__title popup__title--call">
    Что-то пошло
    <br>
    не так
  </h2>

  <p class="popup__text">
    Пожалуйста, повторите отправку формы.
    <br>
    Либо свяжитесь с нами другим способом.
  </p>
</template>
