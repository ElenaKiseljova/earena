<div class="wrapper-form wrapper-form--tournament">
  <!-- Шаблон подставляется по открытию попапа -->
</div>

<!-- Шаблон подставляется по открытию попапа -->
<template id="form-tournament-default">
  <form class="form form--popup" id="form-tournament" action="/" method="post">
    <div class="form__row">
      <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
    </div>
    <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

    <p class="form__text">
      <?php _e( 'Это приватный турнир. Введите пароль.', 'earena_2' ); ?>
    </p>

    <div class="form__buttons">
      <button class="form__submit form__submit--tournaments button button--gray" type="button" name="tournament-cancel">
        <span>
          <?php _e( 'Отменить', 'earena_2' ); ?>
        </span>
      </button>

      <button class="form__submit form__submit--tournaments button button--blue" type="submit" name="tournament-submit">
        <span>
          <?php _e( 'Регистрация', 'earena_2' ); ?>
        </span>
      </button>
    </div>
  </form>
</template>

<!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
<template id="form-tournament-success">
  <h2 class="popup__title popup__title--template">
    <?php _e( 'Регистрация', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Вы успешно зарегистрировались в турнир', 'earena_2' ); ?>
    Championship 2020 Season 2 Premium.
  </div>

  <button class="form__popup-close button button--gray" href="#">
    <?php _e( 'Закрыть', 'earena_2' ); ?>
  </button>
</template>
<template id="form-tournament-cancel">
  <h2 class="popup__title popup__title--template">
    <?php _e( 'Отмена регистрации', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php
      $money_value = '$50';

      echo sprintf( __( 'Вы отменили участие в турнире. <br>Средства в размере %s были возвращены обратно на ваш счет.', 'earena_2' ), $money_value );
    ?>
  </div>

  <button class="form__popup-close button button--gray" href="#">
    <?php _e( 'Закрыть', 'earena_2' ); ?>
  </button>
</template>
<template id="form-tournament-beforesend">
  <h2 class="popup__title popup__title--template">
    <?php _e( 'Пожалуйста <br> подождите', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Ваша заявка <br> отправляется...', 'earena_2' ); ?>
  </div>
</template>
<template id="form-tournament-error">
  <h2 class="popup__title popup__title--template">
    <?php _e( 'Ошибка регистрации', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php _e( 'Вы не можете принять участие в этом турнире, так как у вас нет данной игры и/или платформы. <br>Вы можете добавить ее в профиле.', 'earena_2' ); ?>
  </div>

  <a class="popup__go-to-button button button--gray" href="#">
    <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
  </a>
</template>
<template id="form-tournament-no-old-enough">
  <h2 class="popup__title popup__title--template">
    <?php _e( 'Нет доступа', 'earena_2' ); ?>
  </h2>

  <div class="popup__information popup__information--template">
    <?php
      _e( 'Принимать участие в играх на деньги могут только игроки, которым исполнилось 18 лет. Вы можете принять участие только в бесплатных играх.', 'earena_2' );
    ?>
  </div>

  <button class="form__popup-close button button--gray" href="#">
    <?php _e( 'Закрыть', 'earena_2' ); ?>
  </button>
</template>
