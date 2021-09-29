<?php
  // Страница Акаунта
  global $is_account_page;
  global $games, $ea_icons;

  if (earena_2_current_page('user')) {
    // Эта переменная используется в шаблонах 'public'
    global $earena_2_user_public;
    $ea_user = $earena_2_user_public;
  }

  if (earena_2_current_page('profile')) {
    // Эта переменная используется в шаблонах 'private'
    global $earena_2_user_private;
    $ea_user = $earena_2_user_private;
  }

  // Для страниц Профиля (публичного и приватного)
  if ($ea_user) {
    $nicknames = $ea_user->get('nicknames')? $ea_user->get('nicknames') : [];

    $nicknames_by_platforms = [];
    foreach( $nicknames as $game=>$platforms ) {
        foreach( $platforms as $platform=>$nickname ) {
            $nicknames_by_platforms[$platform][$game] = $nickname;
        }
    }
  }

  $games = get_site_option( 'games' );

  $games_by_platforms = [];
  foreach( array_column($games,'platforms') as $game=>$platforms ) {
      foreach( $platforms as $platform ) {
          $games_by_platforms[$platform][] = $game;
      }
  }

  $platforms = get_site_option( 'platforms' );
?>
  <script type="text/javascript">
    var data = {};
      data['games'] = <?= json_encode( $games ) ?>;
  </script>

<?php if ($is_account_page): ?>
  <?php foreach ($platforms as $key => $value): ?>
    <div class="section section--games" id="games-<?= mb_strtolower($value); ?>">
      <header class="section__header">
        <h2 class="section__title section__title--games-account">
          <svg width="40" height="40">
            <use xlink:href="#icon-platform-<?= mb_strtolower($value); ?>"></use>
          </svg>

          <?= $value; ?>
        </h2>

        <div class="section__header-right">
          <?php if (earena_2_current_page('profile')): ?>
            <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-<?= mb_strtolower($value); ?>">
              <span>
                <?php _e( 'Добавить игру', 'earena_2' ); ?>
              </span>
            </button>
          <?php endif; ?>
        </div>
      </header>

      <?php if (!empty($nicknames_by_platforms[$key])) : ?>
          <ul class="section__list">
            <?php
              $row_index = 1;

              // Перебираем игры
              foreach ($nicknames_by_platforms[$key] as $game => $name) {
                // Для корректной работы шаблона
                global $game_id, $game_user_name;
                $game_id = $game;
                $game_user_name = $name;
                ?>
                  <li class="section__item section__item--col-6">
                    <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
                  </li>
                <?php
                if ($row_index % 6 === 0) {
                  $row_index = 1;
                } else {
                  $row_index++;
                }
              }

              // Оставшееся (до 6 шт) заполняется пустыми карточками
              while ( $row_index <= 6 && $row_index > 1 ) {
                ?>
                  <li class="section__item section__item--col-6">
                    <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
                  </li>
                <?php
                $row_index++;
              }
            ?>
          </ul>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <section class="section section--games" id="games">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--games">
          <?php _e( 'Игры', 'earena_2' ); ?>
          <span class="section__amount">
            <?= $games_amount; ?>
          </span>
        </h2>

        <div class="section__header-right">
          <!-- Табы игровых платформ -->
          <?php get_template_part( 'template-parts/tabs/platform' ); ?>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list" id="content-platform-games">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
    </div>

    <template id="platform-all">
      <!-- <ul class="section__list"> -->
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $row_index = 1;

          // Перебираем игры все
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive' ); ?>
              </li>
            <?php
            if ($row_index % 6 === 0) {
              $row_index = 1;
            } else {
              $row_index++;
            }

            $game_index++;
          }

          // Оставшееся (до 6 шт) заполняется пустыми карточками
          while ( $row_index <= 6 && $row_index > 1 ) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      <!-- </ul> -->
    </template>
    <template id="platform-desktop">
      <ul class="section__list">
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $games = $games_desktop;

          $row_index = 1;

          // Перебираем игры десктопные
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive' ); ?>
              </li>
            <?php
            if ($row_index % 6 === 0) {
              $row_index = 1;
            } else {
              $row_index++;
            }

            $game_index++;
          }

          // Оставшееся (до 6 шт) заполняется пустыми карточками
          while ( $row_index <= 6 && $row_index > 1 ) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      <!-- </ul> -->
    </template>
    <template id="platform-mobile">
      <!-- <ul class="section__list"> -->
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $games = $games_mobile;

          $row_index = 1;

          // Перебираем игры мобильные
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive' ); ?>
              </li>
            <?php
            if ($row_index % 6 === 0) {
              $row_index = 1;
            } else {
              $row_index++;
            }

            $game_index++;
          }

          // Оставшееся (до 6 шт) заполняется пустыми карточками
          while ( $row_index <= 6 && $row_index > 1 ) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      <!-- </ul> -->
    </template>
    <template id="platform-xbox">
      <!-- <ul class="section__list"> -->
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $games = $games_xbox;

          $row_index = 1;

          // Перебираем игры xbox
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive' ); ?>
              </li>
            <?php
            if ($row_index % 6 === 0) {
              $row_index = 1;
            } else {
              $row_index++;
            }

            $game_index++;
          }

          // Оставшееся (до 6 шт) заполняется пустыми карточками
          while ( $row_index <= 6 && $row_index > 1 ) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      <!-- </ul> -->
    </template>
    <template id="platform-playstation">
      <!-- <ul class="section__list"> -->
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $games = $games_playstation;

          $row_index = 1;

          // Перебираем игры playstation
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive' ); ?>
              </li>
            <?php
            if ($row_index % 6 === 0) {
              $row_index = 1;
            } else {
              $row_index++;
            }

            $game_index++;
          }

          // Оставшееся (до 6 шт) заполняется пустыми карточками
          while ( $row_index <= 6 && $row_index > 1 ) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      <!-- </ul> -->
    </template>
  </section>
<?php endif; ?>
