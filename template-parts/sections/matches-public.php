<?php
  global $games, $game_id, $ea_icons, $matches;

  $count_matches = count($matches);

  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  // $matches_all = [
  //   0 => [
  //     'game_name' => 'WARZONE', // $games_all
  //     'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
  //     'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
  //     'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
  //     'status' => 'future', // present, past, future
  //     'my' => false, // true or false
  //     'user_avatar_1' => null, // URL or null
  //     'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
  //     'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
  //     'result_user_1' => null, // 1 etc.
  //     'result_user_2' => null, // 1 etc.
  //     'stream_1' => null, // null or link
  //     'stream_2' => null, // null or link
  //     'lock' => false, // false or true
  //     'id' => '30204874239',
  //   ],
  // ];


?>
<?php if (earena_2_current_page( 'games' ) && !isset($_GET['toggles']) ): ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches section__title--page">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            <?= $count_matches; ?>
          </span>
        </h2>

        <div class="section__header-right">
          <?php if ( $count_matches > 0 ): ?>
            <a class="button button--more" href="<?=$actual_link;?>&toggles=matches">
              <span>
                <?php _e( 'Все матчи', 'earena_2' ); ?>
              </span>
            </a>
          <?php endif; ?>
        </div>
      </header>
      <div class="section__content">
        <ul class="section__list">
          <?php
            $row_index = 1;

            foreach ($matches as $match_item) {
              global $match;
              $match = $match_item;
              ?>
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/archive' ); ?>
                </li>
              <?php
              if ($row_index % 4 === 0) {
                $row_index = 1;
              } else {
                $row_index++;
              }
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ( $row_index <= 4 && $row_index > 1 ) {
              ?>
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                </li>
              <?php
              $row_index++;
            }
          ?>
        </ul>
      </div>
    </div>
  </section>
<?php else: ?>
  <!-- Тут пока дичь с верстки незазобранная -->
  <section class="section section--matches" id="matches">
    <?php if (! earena_2_current_page( 'profile' ) && ! earena_2_current_page( 'user' ) ): ?>
      <div class="section__wrapper">
    <?php endif; ?>
      <header class="section__header">
        <h2 class="section__title section__title--matches <?php if ( is_page(  ) && ! is_front_page() ) echo 'section__title--page'; ?>">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            <?= $count_matches; ?>
          </span>
        </h2>

        <div class="section__header-right <?php if($is_tab_global) echo 'section__header-right--account-tabs'; ?>">
          <?php if ($header_right_section === 'all_button'): ?>
            <a class="button button--more" href="?toggles=matches">
              <span>
                <?php _e( 'Все матчи', 'earena_2' ); ?>
              </span>
            </a>
          <?php elseif ($header_right_section === 'tabs') : ?>
            <!-- Табы платформ -->
            <?php get_template_part( 'template-parts/tabs/platform' ); ?>
          <?php elseif ($header_right_section === 'filters') : ?>
            <!-- Фильтры ( стр Аккаунта ) -->
            <?php get_template_part( 'template-parts/filters', 'account' ); ?>
          <?php endif; ?>
        </div>
      </header>

      <?php
        if ($filter_section) {
          get_template_part( 'template-parts/filters' );

          if ( is_front_page() && $header_right_section === 'tabs' ) {
            // Если front-page.php с показом Всех Матчей
            ?>
              <div class="section__content" id="content-platform">
                <!-- Подстановка содержимого из шаблона -->
                <ul class="section__list">
                  <!-- Кнопка создания матча -->
                  <li class="section__item section__item--col-4">
                    <?php get_template_part( 'template-parts/match/create' ); ?>
                  </li>
                  <?php
                    global $matches;
                    global $match_index;

                    $match_index = 0;
                    $row_index = 2;

                    // Перебираем матчи все
                    foreach ($matches as $match) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive' ); ?>
                        </li>
                      <?php
                      if ($row_index % 4 === 0) {
                        $row_index = 1;
                      } else {
                        $row_index++;
                      }

                      $match_index++;
                    }

                    // Оставшееся (до 4 шт) заполняется пустыми карточками
                    while ( $row_index <= 4 && $row_index > 1 ) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                        </li>
                      <?php
                      $row_index++;
                    }
                  ?>
                </ul>
              </div>
            <?php
          } else {
            // Матчи на стр Игры (все Матчи).
            // 10 - тестовое число, которое показывает количество матчей этой игровы
            // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
            ?>
              <div class="section__content">
                <ul class="section__list">
                  <?php
                    // Записываю все матчи в глобальную переменную
                    $matches = $matches_all;
                    global $match_index;

                    $row_index = 1;

                    for ($match_index=0; $match_index < 10; $match_index++) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive' ); ?>
                        </li>
                      <?php
                      if ($row_index % 4 === 0) {
                        $row_index = 1;
                      } else {
                        $row_index++;
                      }
                    }

                    // Оставшееся (до 4 шт) заполняется пустыми карточками
                    while ( $row_index <= 4 && $row_index > 1 ) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                        </li>
                      <?php
                      $row_index++;
                    }
                  ?>
                </ul>
              </div>
            <?php
          }
        } else if ( is_front_page() && $header_right_section !== 'tabs' ) {
          // Если front-page.php
          ?>
            <ul class="section__list" id="content-platform-matches">
              <!-- Подстановка содержимого из шаблона -->
            </ul>
          <?php
        } else {
          // Если другие варианты есть
          // стр Игры (матчи + турниры)
          ?>
            <div class="section__content">
              <ul class="section__list">
                <?php
                  // Записываю все матчи в глобальную переменную
                  $matches = $matches_all;
                  global $match_index;

                  $row_index = 1;

                  if ($is_matches_tab) {
                    for ($match_index=0; $match_index < count($matches); $match_index++) {
                      if ($matches[$match_index]['my'] === true) {
                        ?>
                          <li class="section__item section__item--col-4">
                            <?php get_template_part( 'template-parts/match/archive' ); ?>
                          </li>
                        <?php
                        if ($row_index % 4 === 0) {
                          $row_index = 1;
                        } else {
                          $row_index++;
                        }
                      }
                    }

                    // Оставшееся (до 4 шт) заполняется пустыми карточками
                    while ( $row_index <= 4 && $row_index > 1 ) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                        </li>
                      <?php
                      $row_index++;
                    }
                  } else {
                    // Матчи на стр других
                    // 4 - тестовое число, которое показывает количество матчей этой игровы
                    // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
                    for ($match_index=0; $match_index < 4; $match_index++) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive' ); ?>
                        </li>
                      <?php
                      if ($row_index % 4 === 0) {
                        $row_index = 1;
                      } else {
                        $row_index++;
                      }
                    }

                    // Оставшееся (до 4 шт) заполняется пустыми карточками
                    while ( $row_index <= 4 && $row_index > 1 ) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                        </li>
                      <?php
                      $row_index++;
                    }
                  }
                ?>
              </ul>
            </div>
          <?php
        }
      ?>
    <?php if (! earena_2_current_page( 'profile' ) && ! earena_2_current_page( 'user' ) ): ?>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
