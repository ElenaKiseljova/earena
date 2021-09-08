<?php
  global $games;
  global $game_index;

  global $games_desktop;
  global $games_mobile;
  global $games_xbox;
  global $games_playstation;

  // Сокрытие никнейма в попапе
  global $no_nickname;
  $no_nickname = true;
?>

<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--game">
  <div class="popup__template popup__template--game" id="game-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'game' );
    }
  ?>

  <!-- Шаблоны попапов добавления-->
  <template id="popup-game-add-desktop">
    <div class="popup__header popup__header--game">
      <h2 class="popup__title popup__title--game">
        Desktop
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Выберите игру', 'earena_2' ); ?>
        </span>
      </div>

      <div class="platform platform--game-popup">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-desktop"></use>
        </svg>
      </div>
    </div>

    <div class="popup__content popup__content--game">
      <ul class="popup__list popup__list--game">
        <?php
          $game_index = 0;

          $games = $games_desktop;

          foreach ($games as $game) {
            ?>
              <li class="popup__item popup__item--col-2">
                <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
              </li>
            <?php
            $game_index++;
          }
        ?>
      </ul>

      <form class="form form--popup" data-prefix="" id="form-game" action="/" method="post">
        <input type="hidden" name="game-name" value="">
        <input type="hidden" name="game-platform" value="desktop">

        <div class="form__row">
          <input class="form__field form__field--popup" id="game-nickname" type="text" name="game-nickname" required placeholder="<?php _e( 'Ваш никнейм', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__buttons form__buttons--game">
          <button class="form__popup-close form__popup-close--buttons button button--gray">
            <?php _e( 'Назад', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="game-submit">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-game-add-mobile">
    <div class="popup__header popup__header--game">
      <h2 class="popup__title popup__title--game">
        Mobile
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Выберите игру', 'earena_2' ); ?>
        </span>
      </div>

      <div class="platform platform--game-popup">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-mobile"></use>
        </svg>
      </div>
    </div>

    <div class="popup__content popup__content--game">
      <ul class="popup__list popup__list--game">
        <?php
          $game_index = 0;

          $games = $games_mobile;

          foreach ($games as $game) {
            ?>
              <li class="popup__item popup__item--col-2">
                <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
              </li>
            <?php
            $game_index++;
          }
        ?>
      </ul>

      <form class="form form--popup" data-prefix="" id="form-game" action="/" method="post">
        <input type="hidden" name="game-name" value="">
        <input type="hidden" name="game-platform" value="mobile">

        <div class="form__row">
          <input class="form__field form__field--popup" id="game-nickname" type="text" name="game-nickname" required placeholder="<?php _e( 'Ваш никнейм', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__buttons form__buttons--game">
          <button class="form__popup-close form__popup-close--buttons button button--gray">
            <?php _e( 'Назад', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="game-submit">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-game-add-xbox">
    <div class="popup__header popup__header--game">
      <h2 class="popup__title popup__title--game">
        XBOX
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Выберите игру', 'earena_2' ); ?>
        </span>
      </div>

      <div class="platform platform--game-popup">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>
      </div>
    </div>

    <div class="popup__content popup__content--game">
      <ul class="popup__list popup__list--game">
        <?php
          $game_index = 0;

          $games = $games_xbox;

          foreach ($games as $game) {
            ?>
              <li class="popup__item popup__item--col-2">
                <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
              </li>
            <?php
            $game_index++;
          }
        ?>
      </ul>

      <form class="form form--popup" data-prefix="" id="form-game" action="/" method="post">
        <input type="hidden" name="game-name" value="">
        <input type="hidden" name="game-platform" value="xbox">

        <div class="form__row">
          <input class="form__field form__field--popup" id="game-nickname" type="text" name="game-nickname" required placeholder="<?php _e( 'Ваш никнейм', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__buttons form__buttons--game">
          <button class="form__popup-close form__popup-close--buttons button button--gray">
            <?php _e( 'Назад', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="game-submit">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-game-add-playstation">
    <div class="popup__header popup__header--game">
      <h2 class="popup__title popup__title--game">
        PlayStation
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Выберите игру', 'earena_2' ); ?>
        </span>
      </div>

      <div class="platform platform--game-popup">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-playstation"></use>
        </svg>
      </div>
    </div>

    <div class="popup__content popup__content--game">
      <ul class="popup__list popup__list--game">
        <?php
          $game_index = 0;

          $games = $games_playstation;

          foreach ($games as $game) {
            ?>
              <li class="popup__item popup__item--col-2">
                <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
              </li>
            <?php
            $game_index++;
          }
        ?>
      </ul>

      <form class="form form--popup" data-prefix="" id="form-game" action="/" method="post">
        <input type="hidden" name="game-name" value="">
        <input type="hidden" name="game-platform" value="playstation">

        <div class="form__row">
          <input class="form__field form__field--popup" id="game-nickname" type="text" name="game-nickname" required placeholder="<?php _e( 'Ваш никнейм', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__buttons form__buttons--game">
          <button class="form__popup-close form__popup-close--buttons button button--gray">
            <?php _e( 'Назад', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="game-submit">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-game-success">
    <div class="popup__content popup__content--game">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Игра добавлена', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( '', 'earena_2' ); ?>
      </div>

      <!-- <a class="form__submit form__submit--accept button button--blue" href="chat/?type=game">
        <?php _e( '', 'earena_2' ); ?>
      </a> -->
    </div>
  </template>
  <template id="form-game-beforesend">
    <div class="popup__content popup__content--game">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-game-error">
    <div class="popup__content popup__content--game">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Игра не добавлена', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, попробуйте повторить позже.', 'earena_2' ); ?>
      </div>

      <!-- <a class="popup__go-to-button button button--gray" href="#">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a> -->

      <!-- <button class="form__popup-close form__popup-close--cross">
        <span class="visually-hidden">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button> -->
    </div>
  </template>
</div>
