<?php
  /*
    Создание Турнира
  */
?>

<?php
  global $games, $ea_icons, $icons;

  $platforms = get_site_option('platforms') ?? [];
  $games = $games ?? [];
?>

<section class="tournament tournament--create">
  <form class="form form--create" data-prefix="tournament" id="form-create" action="/" method="post">
    <div class="form__left form__left--create-image">
      <div class="files files--create" data-dropbox="1">
        <label class="files__picture" for="image1">
        </label>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение карточки', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
        <input class="files__input visually-hidden" type="file" id="image1" name="image1" accept=".png, .jpg, .jpeg">
      </div>
    </div>
    <div class="form__right form__right--create-image">
      <div class="files files--create" data-dropbox="1">
        <label class="files__picture" for="image2">
        </label>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение в лобби', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
        <input class="files__input visually-hidden" type="file" id="image2" name="image2" accept=".png, .jpg, .jpeg">
      </div>
    </div>

    <div class="form__left form__left--create-info">
      <div class="form__checkbox form__checkbox--left">
        <div class="checkbox checkbox--create-left">
          <input v-model="top" class="visually-hidden" type="checkbox" name="top" value="1" id="top">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="top">
            <?php _e( 'Топовый', 'earena_2' ); ?>
          </label>
        </div>
        <div class="checkbox checkbox--create-left" v-if="activeTab !== 3">
          <input v-model="brand" class="visually-hidden" type="checkbox" name="brand" value="1" id="brand">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="brand">
            <?php _e( 'Брендированный', 'earena_2' ); ?>
          </label>
        </div>
      </div>
    </div>
    <div class="form__right form__right--create-info">
      <div class="form__checkbox form__checkbox--right">
        <div class="checkbox checkbox--create-right">
          <input v-model="vip" class="visually-hidden" type="checkbox" name="vip" value="1" id="vip">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="vip">
            <?php _e( 'VIP', 'earena_2' ); ?>
          </label>
        </div>
        <div class="checkbox checkbox--create-right">
          <input v-model="verification" class="visually-hidden" type="checkbox" name="verification" value="1" id="verification">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="verification">
            <?php _e( 'Верифицированные', 'earena_2' ); ?>
          </label>
        </div>
      </div>
    </div>

    <div class="form__brands" v-show="brand && activeTab !== 3">
      <div class="files files--create files--create-header" data-dropbox="1">
        <label class="files__picture" for="image3">
        </label>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение Header', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
        <input class="files__input visually-hidden" type="file" id="image3" name="image3" accept=".png, .jpg, .jpeg">
      </div>
    </div>
    <div class="form__brands" v-show="brand && activeTab !== 3">
      <div class="files files--create files--create-footer" data-dropbox="1">
        <label class="files__picture" for="image4">
        </label>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Изображение Footer', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Нажмите для загрузки <br>или просто перетащите сюда файл', 'earena_2' ); ?>
          </p>
        </div>
        <input class="files__input visually-hidden" type="file" id="image4" name="image4" accept=".png, .jpg, .jpeg">
      </div>
    </div>
    <div class="form__brands" v-show="brand && activeTab !== 3">
      <div class="files files--create files--create-colorpicker" data-colorpicker="1">
        <label class="files__colorpicker" for="colorpicker">
        </label>
        <div class="files__content">
          <h3 class="files__title">
            <?php _e( 'Цвет фона', 'earena_2' ); ?>
          </h3>
          <p class="files__text">
            <?php _e( 'Выбрать цвет фона страницы', 'earena_2' ); ?>
          </p>
        </div>
        <input class="files__input visually-hidden" type="color" id="colorpicker" name="color">
      </div>
    </div>

    <div class="form__left form__left--create-info">
      <div class="form__row form__row--create-name">
        <input v-model="name" class="form__field form__field--create" id="name" type="text" name="t_name" required placeholder="<?php _e( 'Название турнира', 'earena_2' ); ?>">
      </div>

      <div class="form__row form__row--message-create">
        <textarea v-model="description" class="form__field form__field--message-create" name="description" placeholder="Описание турнира"></textarea>
      </div>
    </div>
    <div class="form__right form__right--create-info">
      <div class="form__row">
        <input v-model="our_percent" class="form__field form__field--create" id="our_percent" type="number" name="our_percent" required placeholder="<?php _e( 'Комиссия (%)', 'earena_2' ); ?>">
      </div>
      <p class="form__text form__text--create">
        <?php _e( 'Комиссия, которая будет взиматься с каждого игрока за участие', 'earena_2' ); ?>
      </p>

      <div class="form__row">
        <input v-model="garant" class="form__field form__field--create" id="garant" type="number" name="garant" required placeholder="<?php _e( 'Гарантийная сумма', 'earena_2' ); ?>">
      </div>
      <p class="form__text form__text--create">
        <?php _e( 'Гарантированный призовой фонд турнира', 'earena_2' ); ?>
      </p>

      <div class="form__checkbox form__checkbox--private checkbox checkbox--left">
        <input v-model="private" class="visually-hidden" data-control-field-id="password" data-control-toggle="on" type="checkbox" name="private-match-create" value="1" id="private-match-create">
        <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="private-match-create">
          <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
            <path d="M17.875 7.5625H4.125C3.7453 7.5625 3.4375 7.8703 3.4375 8.25V17.875C3.4375 18.2547 3.7453 18.5625 4.125 18.5625H17.875C18.2547 18.5625 18.5625 18.2547 18.5625 17.875V8.25C18.5625 7.8703 18.2547 7.5625 17.875 7.5625Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.90625 7.5625V4.46875C7.90625 3.64824 8.2322 2.86133 8.81239 2.28114C9.39258 1.70095 10.1795 1.375 11 1.375C11.8205 1.375 12.6074 1.70095 13.1876 2.28114C13.7678 2.86133 14.0938 3.64824 14.0938 4.46875V7.5625" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 14.0938C11.5695 14.0938 12.0312 13.632 12.0312 13.0625C12.0312 12.493 11.5695 12.0312 11 12.0312C10.4305 12.0312 9.96875 12.493 9.96875 13.0625C9.96875 13.632 10.4305 14.0938 11 14.0938Z" fill="#7B8899"/>
          </svg>
          <?= __( 'Приватный матч', 'earena_2' ); ?>
        </label>
      </div>
      <div class="form__row">
        <input v-model="password" class="form__field form__field--popup" id="password" type="password" name="password" required disabled placeholder="<?= __( 'Пароль', 'earena_2' ); ?>">
      </div>
    </div>

    <div class="form__section">
      <h2 class="form__section-title">
        <?php _e( 'Игра и платформа', 'earena_2' ); ?>
      </h2>

      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--games" data-type="games" data-reset-selects="platforms,game_modes,team_modes">
            <button class="select__button select__button--games" data-text="<?php _e( 'Игра', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Игра', 'earena_2' ); ?>
            </button>

            <ul class="select__list select__list--games">
              <li v-for="(item, index) in gamesArr" class="select__item">
                <input v-model="game" :value="index" :id="'select-games-' + index" class="visually-hidden" type="radio" name="game" required>
                <label class="select__label" :for="'select-games-' + index">
                  {{item.name}}
                </label>
              </li>
            </ul>
          </div>
        </div>
        <span class="form__error form__error--create"><?php _e( 'Выберите игру', 'earena_2' ); ?></span>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--platforms" data-type="platforms">
            <button class="select__button select__button--platforms" data-text="<?php _e( 'Платформа', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Платформа', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li v-for="item in currentGame.platforms" class="select__item">
                <input v-model="platform" :value="item" :id="'select-platform-' + item" class="visually-hidden" type="radio" name="platform" required>
                <label class="select__label" :for="'select-platform-' + item">
                  {{ platformsArr[item] }}
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <input v-model="price" class="form__field form__field--create" id="price" type="number" name="price" required placeholder="<?php _e( 'Сумма участия', 'earena_2' ); ?>">
        </div>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <input v-model="max_players" class="form__field form__field--create" id="max_players" type="number" name="max_players" required
            placeholder="<?php _e( 'Количество участников', 'earena_2' ); ?>"
            :disabled="activeTab === 3">
        </div>
      </div>
    </div>

    <div class="form__section">
      <h2 class="form__section-title">
        <?php _e( 'Режимы игры', 'earena_2' ); ?>
      </h2>

      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--game_modes" data-type="game_modes">
            <button class="select__button select__button--game_modes" data-text="<?php _e( 'Режим игры', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Режим игры', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li v-for="item in currentGame.game_modes" class="select__item">
                <input v-model="game_mode" :value="item" :id="'select-game_mode-' + item" class="visually-hidden" type="radio" name="game_mode" required>
                <label class="select__label" :for="'select-game_mode-' + item">
                  {{ item }} vs {{ item }}
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--team_mode" data-type="team_modes">
            <button class="select__button select__button--team_mode" data-text="<?php _e( 'Режим команды', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Режим команды', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li v-if="!currentGame.team_modes.includes(0)"
                  v-for="mode, i in currentGame.team_modes" class="select__item">
                <input v-model="team_mode" :value="team_modes[mode-1].value" :id="'select-team_mode-' + i" class="visually-hidden" type="radio" name="team_mode" required>
                <label class="select__label" :for="'select-team_mode-' + i">
                  {{team_modes[mode - 1].label}}
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--random" data-type="random">
            <button class="select__button select__button--random" data-text="<?php _e( 'Тип жеребьевки', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Тип жеребьевки', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li v-for="item in this.randomArr" class="select__item">
                <input v-model="random" :id="'select-random-' + item.value" class="visually-hidden" type="radio" name="random" :value="item.value" required>
                <label class="select__label" :for="'select-random-' + item.value">
                  {{ item.label }}
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="form__section-item form__section-item--4">
        <div class="form__row">
          <div class="select select--fast" data-type="fast">
            <button class="select__button select__button--fast" data-text="<?php _e( 'Скорость', 'earena_2' ); ?>" type="button" name="button">
              <?php _e( 'Скорость', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <li v-for="item in this.fastArr" class="select__item">
                <input v-model="fast" :id="'select-fast-' + item.value" class="visually-hidden" type="radio" name="fast" :value="item.value" required>
                <label class="select__label" :for="'select-fast-' + item.value">
                  {{ item.label }}
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="form__section">
      <h2 class="form__section-title">
        <?php _e( 'Регистрация турнира', 'earena_2' ); ?>
      </h2>

      <div class="form__section-item form__section-item--4-small">
        <div class="form__row">

        </div>
        <span class="form__error form__error--create"><?php _e( 'Выберите игру', 'earena_2' ); ?></span>
      </div>
      <div class="form__section-item form__section-item--4-small">
        <div class="form__row">

        </div>
      </div>
      <div class="form__section-item form__section-item--4-small">
        <div class="form__row">

        </div>
      </div>
      <div class="form__section-item form__section-item--4-small">
        <div class="form__row">

        </div>
      </div>
    </div>

    <button class="form__submit form__submit--create button button--blue disabled" type="submit" name="create-submit">
      <span>
        <?php _e( 'Создать Турнир', 'earena_2' ); ?>
      </span>
    </button>
  </form>
</section>
