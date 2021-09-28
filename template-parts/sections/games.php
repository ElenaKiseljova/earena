<?php
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

  $nicknames = $ea_user->get('nicknames')?:[[[]]];
  $nicknames_by_platforms = [];
  foreach( $nicknames as $game=>$platforms ) {
      foreach( $platforms as $platform=>$nickname ) {
          $nicknames_by_platforms[$platform][$game] = $nickname;
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

<?php
  // Игры
  // global $games;
  //
  // global $games_all;
  // $games_all = [
  //   0 => [
  //     'name' => 'WARZONE',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-0.jpg',
  //     'variations' => [1],
  //     'platforms' => [ 'playstation' ]
  //   ],
  //   1 => [
  //     'name' => 'Dota 2',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-1.jpg',
  //     'variations' => [1, 5],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   2 => [
  //     'name' => 'CS:GO',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-2.jpg',
  //     'variations' => [1, 2, 5],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   3 => [
  //     'name' => 'Mortal Combat 11 Ultimate',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-3.jpg',
  //     'variations' => [1],
  //     'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
  //   ],
  //   4 => [
  //     'name' => 'League of Legends',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-4.jpg',
  //     'variations' => [1, 2, 5],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   5 => [
  //     'name' => 'Heroes III',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-5.jpg',
  //     'variations' => [1, 2],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   6 => [
  //     'name' => 'Warcraft III',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-6.jpg',
  //     'variations' => [1, 2],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   7 => [
  //     'name' => 'Starcraft II',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-7.jpg',
  //     'variations' => [1, 2],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   8 => [
  //     'name' => 'Playerunknown\'s Battlegrounds',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-8.jpg',
  //     'variations' => [1, 2],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   9 => [
  //     'name' => 'Heartstone',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-9.jpg',
  //     'variations' => [1, 2, 5],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   10 => [
  //     'name' => 'TEKKEN 7',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-10.jpg',
  //     'variations' => [1],
  //     'platforms' => [ 'desktop', 'xbox', 'playstation' ]
  //   ],
  //   11 => [
  //     'name' => 'World Of Tanks',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-11.jpg',
  //     'variations' => [1, 3, 7],
  //     'platforms' => [ 'desktop', 'mobile' ]
  //   ],
  //   12 => [
  //     'name' => 'World Of Tanks Blitz',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-12.jpg',
  //     'variations' => [1, 3, 7],
  //     'platforms' => [ 'mobile' ]
  //   ],
  //   13 => [
  //     'name' => 'PES 21',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-13.jpg',
  //     'variations' => [1, 2, 3],
  //     'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
  //   ],
  //   14 => [
  //     'name' => 'FIFA 21',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-14.jpg',
  //     'variations' => [1, 2],
  //     'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
  //   ],
  //   15 => [
  //     'name' => 'FIFA ONLINE 4',
  //     'img' => get_template_directory_uri() . '/assets/img/games/archive/game-15.jpg',
  //     'variations' => [1],
  //     'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
  //   ],
  // ];

  // Записываю все игры в глобальную переменную
  // $games = $games_all;
  ?>
    <!-- <script type="text/javascript">
      var data = {};
        data['games'] = <?php echo json_encode( $games_all ) ?>;
    </script> -->
  <?php
  // Страница Акаунта
  global $is_account_page;
?>

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

      <!-- <ul class="section__list">
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
                <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
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
      </ul> -->
      <?php if (!empty($nicknames_by_platforms[$key])) : ?>
          <div class="games_nicknames--item_wrapper">
          <?php foreach ($nicknames_by_platforms[$key] as $game => $name) : ?>
              <div class="games_nicknames--item">
                  <div class="games_nicknames--image"><img src="<?php bloginfo('template_url'); ?>/images/icons/<?=$ea_icons['game'][$game];?>.svg" class="svg game-icon" alt="game-icon"></div>
                  <div class="games_nicknames--text"><span><?= is_string($name) ? $name : ''; ?></span></div>

              </div>
          <?php endforeach; ?>
          </div>
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
