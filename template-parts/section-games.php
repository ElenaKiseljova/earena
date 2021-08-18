<?php
  // Игры
  global $games;

  global $games_all;
  $games_all = [
    0 => [
      'name' => 'WARZONE',
      'variations' => [1],
      'platforms' => [ 'playstation' ]
    ],
    1 => [
      'name' => 'Dota 2',
      'variations' => [1, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    2 => [
      'name' => 'CS:GO',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    3 => [
      'name' => 'Mortal Combat 11 Ultimate',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    4 => [
      'name' => 'League of Legends',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    5 => [
      'name' => 'Heroes III',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    6 => [
      'name' => 'Warcraft III',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    7 => [
      'name' => 'Starcraft II',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    8 => [
      'name' => 'Playerunknown\'s Battlegrounds',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    9 => [
      'name' => 'Heartstone',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    10 => [
      'name' => 'TEKKEN 7',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation' ]
    ],
    11 => [
      'name' => 'World Of Tanks',
      'variations' => [1, 3, 7],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    12 => [
      'name' => 'World Of Tanks Blitz',
      'variations' => [1, 3, 7],
      'platforms' => [ 'mobile' ]
    ],
    13 => [
      'name' => 'PES 21',
      'variations' => [1, 2, 3],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    14 => [
      'name' => 'FIFA 21',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    15 => [
      'name' => 'FIFA ONLINE 4',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
  ];

  // Записываю все игры в глобальную переменную
  $games = $games_all;

  // Типы игр по платформам
  global $games_desktop;
  global $games_mobile;
  global $games_xbox;
  global $games_playstation;

  $games_desktop = [];
  $games_mobile =  [];
  $games_xbox = [];
  $games_playstation = [];

  for ($k=0; $k < count($games); $k++) {
    if (isset($games[$k]['platforms']) && in_array('desktop', $games[$k]['platforms'])) {
      array_push($games_desktop, $games[$k]);
    }

    if (isset($games[$k]['platforms']) && in_array('mobile', $games[$k]['platforms'])) {
      array_push($games_mobile, $games[$k]);
    }

    if (isset($games[$k]['platforms']) && in_array('xbox', $games[$k]['platforms'])) {
      array_push($games_xbox, $games[$k]);
    }

    if (isset($games[$k]['platforms']) && in_array('playstation', $games[$k]['platforms'])) {
      array_push($games_playstation, $games[$k]);
    }
  }

  // Количество игр
  $game_amounts = count($games);

  // Страница Акаунта
  global $is_account_page;

  // Приватный режим
  global $private;
?>

<?php if ($is_account_page): ?>
  <div class="section section--games" id="games-desktop">
    <header class="section__header">
      <h2 class="section__title section__title--games-account">
        <svg width="40" height="40">
          <use xlink:href="#icon-platform-desktop"></use>
        </svg>

        Desktop
      </h2>

      <div class="section__header-right">
        <?php if ($private): ?>
          <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-desktop">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      </div>
    </header>

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
              <?php get_template_part( 'template-parts/game/game-archive', 'account' ); ?>
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
              <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
            </li>
          <?php
          $row_index++;
        }
      ?>
    </ul>
  </div>
  <div class="section section--games" id="games-mobile">
    <header class="section__header">
      <h2 class="section__title section__title--games-account">
        <svg width="40" height="40">
          <use xlink:href="#icon-platform-mobile"></use>
        </svg>

        Mobile
      </h2>

      <div class="section__header-right">
        <?php if ($private): ?>
          <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-mobile">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      </div>
    </header>

    <ul class="section__list">
      <?php
        global $games;
        global $game_index;

        $game_index = 0;
        $games = $games_mobile;

        $row_index = 1;

        // Перебираем игры mobile
        foreach ($games as $game) {
          ?>
            <li class="section__item section__item--col-6">
              <?php get_template_part( 'template-parts/game/game-archive', 'account' ); ?>
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
              <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
            </li>
          <?php
          $row_index++;
        }
      ?>
    </ul>
  </div>
  <div class="section section--games" id="games-xbox">
    <header class="section__header">
      <h2 class="section__title section__title--games-account">
        <svg width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>

        XBOX
      </h2>

      <div class="section__header-right">
        <?php if ($private): ?>
          <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-xbox">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      </div>
    </header>

    <ul class="section__list">
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
              <?php get_template_part( 'template-parts/game/game-archive', 'account' ); ?>
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
              <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
            </li>
          <?php
          $row_index++;
        }
      ?>
    </ul>
  </div>
  <div class="section section--games" id="games-playstation">
    <header class="section__header">
      <h2 class="section__title section__title--games-account">
        <svg width="40" height="40">
          <use xlink:href="#icon-platform-playstation"></use>
        </svg>

        PlayStation
      </h2>

      <div class="section__header-right">
        <?php if ($private): ?>
          <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-playstation">
            <span>
              <?php _e( 'Добавить игру', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      </div>
    </header>

    <ul class="section__list">
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
              <?php get_template_part( 'template-parts/game/game-archive', 'account' ); ?>
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
              <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
            </li>
          <?php
          $row_index++;
        }
      ?>
    </ul>
  </div>
<?php else : ?>
  <section class="section section--games" id="games">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--games">
          <?php _e( 'Игры', 'earena_2' ); ?>
          <span class="section__amount">
            <?= $game_amounts; ?>
          </span>
        </h2>

        <div class="section__header-right">
          <!-- Табы игровых платформ -->
          <?php get_template_part( 'template-parts/tabs/tabs', 'platform' ); ?>
        </div>
      </header>

      <div class="section__content" id="content-platform">
        <!-- Подстановка содержимого из шаблона -->
      </div>
    </div>

    <template id="platform-all">
      <ul class="section__list">
        <?php
          global $games;
          global $game_index;

          $game_index = 0;
          $row_index = 1;

          // Перебираем игры все
          foreach ($games as $game) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
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
                <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      </ul>
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
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
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
                <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      </ul>
    </template>
    <template id="platform-mobile">
      <ul class="section__list">
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
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
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
                <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      </ul>
    </template>
    <template id="platform-xbox">
      <ul class="section__list">
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
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
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
                <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      </ul>
    </template>
    <template id="platform-playstation">
      <ul class="section__list">
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
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
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
                <?php get_template_part( 'template-parts/game/game-archive', 'empty' ); ?>
              </li>
            <?php
            $row_index++;
          }
        ?>
      </ul>
    </template>
  </section>
<?php endif; ?>
