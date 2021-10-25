<?php
  global $games, $games_by_platforms, $nicknames_by_platforms;

  $games_by_platforms ?? [];
  $nicknames_by_platforms ?? [];

  $platforms = get_site_option( 'platforms' ) ?? [];
?>


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
  <?php foreach ($platforms as $platform_key => $platform): ?>
    <template id="popup-game-add-<?= mb_strtolower($platform); ?>">
      <div class="popup__header popup__header--game">
        <h2 class="popup__title popup__title--game">
          <?= $platform; ?>
        </h2>

        <div class="popup__information">
          <span>
            <?php _e( 'Выберите игру', 'earena_2' ); ?>
          </span>
        </div>

        <div class="platform platform--game-popup">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-<?= mb_strtolower($platform); ?>"></use>
          </svg>
        </div>
      </div>

      <div class="popup__content popup__content--game">
        <ul class="popup__list popup__list--game">
          <?php
            global $game_id, $platform_id;
            $platform_id = $platform_key;
            foreach ($games_by_platforms[$platform_key] as $game_key) {
              $game_id = $game_key;
              ?>
                <li class="popup__item popup__item--col-2">
                  <?php
                    get_template_part( 'template-parts/game/archive', 'popup' );
                  ?>
                </li>
              <?php
            }
          ?>
        </ul>

        <form class="form form--popup" data-prefix="" id="form-game" action="/" method="post">
          <?php
            foreach ($nicknames_by_platforms as $platform_id => $nicknames_by_platform) {
              foreach ($nicknames_by_platform as $nicknames_by_platform_game_id => $nicknames_by_platform_value) {
                ?>
                  <input type="hidden" name="nicknames[<?= $nicknames_by_platform_game_id; ?>][<?= $platform_id; ?>]" value="<?= $nicknames_by_platform_value; ?>">
                <?php
              }
            }
          ?>
          <div class="form__row">
            <input class="form__field form__field--popup" id="game-nickname" type="text" name="game-nickname" required placeholder="<?php _e( 'Ваш никнейм', 'earena_2' ); ?>" >
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

          <div class="form__buttons form__buttons--game">
            <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
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
  <?php endforeach; ?>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-game-success">
    <div class="popup__content popup__content--game">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Игра добавлена', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Перейдите по ссылке, чтобы создать матч. Или закройте попап, чтобы добавить другие игры.', 'earena_2' ); ?>
      </div>

      <a class="form__submit form__submit--accept button button--blue" href="<?= bloginfo( 'url' ); ?>/matches">
        <?php _e( 'Перейти', 'earena_2' ); ?>
      </a>
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
    </div>
  </template>
</div>
