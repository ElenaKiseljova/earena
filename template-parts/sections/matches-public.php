<?php if (earena_2_current_page( 'games' ) && !isset($_GET['toggles']) ): ?>
  <?php
    global $games, $game_id, $ea_icons, $matches;

    $count_matches = count($matches ?? []);

    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  ?>
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
          <?php if ( $count_matches > 8 ): ?>
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
            $limit = 0;
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
              $limit++;

              if ($limit === 8) {
                break;
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
<?php elseif (earena_2_current_page( 'games' ) && isset($_GET['toggles']) && $_GET['toggles'] === 'matches' ): ?>
  <?php
    global $games, $game_id, $ea_icons, $matches;

    $count_matches = count($matches ?? []);

    if (isset($_GET['login-status'])) {
      unset($_GET['login-status']);
    } else if (isset($_GET['action'])) {
      unset($_GET['action']);
    }
  ?>
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
        </div>
      </header>

      <?php
        get_template_part( 'template-parts/filters' );
      ?>

      <div class="section__content">
        <ul class="section__list" id="content-platform-matches">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
    </div>
  </section>
<?php elseif (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) : ?>
  <section class="section section--matches" id="matches">
    <header class="section__header">
      <h2 class="section__title section__title--matches section__title--page">
        <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
        <span class="section__amount">
          <?= $count_matches; ?>
        </span>
      </h2>

      <div class="section__header-right <?php if($is_tab_global) echo 'section__header-right--account-tabs'; ?>">
        <!-- Фильтры ( стр Аккаунта ) -->
        <?php get_template_part( 'template-parts/filters', 'account' ); ?>
      </div>
    </header>
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
  </section>
<?php elseif ( earena_2_current_page( 'matches' ) ) : ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right section__header-right--account-tabs">
          <!-- Табы платформ -->
          <?php get_template_part( 'template-parts/tabs/platform' ); ?>
        </div>
      </header>

      <?php
        get_template_part( 'template-parts/filters' );
      ?>

      <div class="section__content">
        <ul class="section__list" id="content-platform-matches">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
    </div>
  </section>
<?php else : ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="<?= bloginfo( 'url' ) . '/matches' ?>">
            <span>
              <?php _e( 'Все матчи', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </header>

      <ul class="section__list" id="content-platform-matches">
        <!-- Подстановка содержимого из шаблона -->
      </ul>
    </div>
  </section>
<?php endif; ?>
