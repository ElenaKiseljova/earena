<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--login">
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
    <?php get_template_part( 'template-parts/form', 'login' ); ?>
  </div>
  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'login' );
    }
  ?>

  <!-- Шаблоны попапов вход/регистрация/восстановление -->
  <template id="popup-login-header-signin">
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
  </template>
  <template id="popup-login-header-signup">
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
  </template>
  <template id="popup-login-header-forgot">
    <h2 class="popup__title popup__title--login">
      <?php _e( 'Забыли пароль?', 'earena_2' ); ?>
    </h2>

    <div class="popup__information">
      <span>
        <?php _e( 'Укажите электронную почту', 'earena_2' ); ?>
      </span>
    </div>
  </template>
</div>
