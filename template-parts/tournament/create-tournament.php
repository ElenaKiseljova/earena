<?php
  /*
    Создание Турнира
  */
?>

<section class="tournament tournament--create">
  <form class="form form--create" data-prefix="tournament" id="form-create" action="/" method="post">
    <div class="form__left form__left--create-image">
      <div class="files files--images">
        <div class="files__picture">
          <img class="files__img" src="" alt="img">
          <input class="files__input visually-hidden" type="file" id="image-1" name="image-1" accept=".png, .jpg, .jpeg">
        </div>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение карточки', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
      </div>
    </div>

    <div class="form__right form__right--create-image">
      <div class="files files--images">
        <div class="files__picture">
          <img class="files__img" src="" alt="img">
          <input class="files__input visually-hidden" type="file" id="image-2" name="image-2" accept=".png, .jpg, .jpeg">
        </div>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение в лобби', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
      </div>
    </div>

    <div class="form__left form__left--create-info">
      <div class="form__checkbox form__checkbox--left">
        <div class="checkbox checkbox--create-left">
          <input class="visually-hidden" type="checkbox" name="top" value="1" id="top">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="top">
            <?php _e( 'Топовый', 'earena_2' ); ?>
          </label>
        </div>
        <div class="checkbox checkbox--create-left">
          <input class="visually-hidden" type="checkbox" name="brand" value="1" id="brand">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="brand">
            <?php _e( 'Брендированный', 'earena_2' ); ?>
          </label>
        </div>
      </div>

      <div class="form__row form__row--create-name">
        <input class="form__field form__field--create" id="name" type="text" name="name" required placeholder="<?php _e( 'Название турнира', 'earena_2' ); ?>">
      </div>

      <div class="form__row form__row--message-create">
        <textarea class="form__field form__field--message-create" name="description" placeholder="Описание турнира"></textarea>
      </div>
    </div>

    <div class="form__right form__right--create-info">
      <div class="form__checkbox form__checkbox--right">
        <div class="checkbox checkbox--create-right">
          <input class="visually-hidden" type="radio" name="vip" value="1" id="vip-1" checked>
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="vip-1">
            <?php _e( 'Для всех', 'earena_2' ); ?>
          </label>
        </div>
        <div class="checkbox checkbox--create-right">
          <input class="visually-hidden" type="radio" name="vip" value="2" id="vip-2">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="vip-2">
            <?php _e( 'VIP', 'earena_2' ); ?>
          </label>
        </div>
        <div class="checkbox checkbox--create-right">
          <input class="visually-hidden" type="radio" name="vip" value="3" id="vip-3">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="vip-3">
            <?php _e( 'Верифицированные', 'earena_2' ); ?>
          </label>
        </div>
      </div>

      <div class="form__row form__row--create-name">
        <input class="form__field form__field--create" id="commission" type="text" name="commission" required placeholder="<?php _e( 'Комиссия (%)', 'earena_2' ); ?>">
      </div>
      <p class="form__text form__text--create">
        <?php _e( 'Комиссия, которая будет взиматься с каждого игрока за участие', 'earena_2' ); ?>
      </p>

      <div class="form__row form__row--create-name">
        <input class="form__field form__field--create" id="guaranty" type="text" name="guaranty" required placeholder="<?php _e( 'Гарантийная сумма)', 'earena_2' ); ?>">
      </div>
      <p class="form__text form__text--create">
        <?php _e( 'Гарантированный призовой фонд турнира', 'earena_2' ); ?>
      </p>

      <div class="form__checkbox form__checkbox--private checkbox checkbox--left">
        <input class="visually-hidden" data-control-field-id="password" data-control-toggle="on" type="checkbox" name="private-match-create" value="1" id="private-match-create">
        <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="private-match-create">
           <?= __( 'Приватный матч', 'earena_2' ); ?>
        </label>
      </div>
      <div class="form__row">
        <input class="form__field form__field--popup" id="password" type="password" name="password" required disabled placeholder="<?= __( 'Пароль', 'earena_2' ); ?>">
      </div>
    </div>
    <button class="form__submit form__submit--create button button--blue disabled" type="submit" name="create-submit">
      <span>
        <?php _e( 'Создать Турнир', 'earena_2' ); ?>
      </span>
    </button>
  </form>
</section>
