<?php if ( earena_2_current_page( 'games' ) && !isset($_GET['toggles']) ): ?>
  <?php
    global $games, $game_id, $ea_icons;
  ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments <?php if (is_page() && !is_front_page()) {echo 'section__title--page';} ?>">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            0
          </span>
        </h2>
        <div class="section__header-righ">
          <a class="button button--more" href="<?= bloginfo( 'url' ) . '/games?game=' . ($game_id ?? 0 ) . '&toggles=tournaments'; ?>">
            <span>
              <?php _e('Все турниры', 'earena_2'); ?>
            </span>
          </a>
        </div>
      </header>
      <div class="section__content">
        <ul class="section__list" id="content-platform-tournaments">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader preloader--tournaments">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </section>
<?php elseif ( earena_2_current_page( 'games' ) && isset($_GET['toggles']) ) : ?>
  <?php
    global $games, $game_id, $ea_icons, $tournaments;

    $count_tournaments = count($tournaments ?? []);

    if (isset($_GET['login-status'])) {
      unset($_GET['login-status']);
    } else if (isset($_GET['action'])) {
      unset($_GET['action']);
    }
  ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            <?= $count_tournaments; ?>
          </span>
        </h2>
        <div class="section__header-right section__header-right--account-tabs">
        </div>
      </header>

      <?php
        // Фильтры
        get_template_part('template-parts/filters');
      ?>
      <div class="section__content">
        <ul class="section__list" id="content-platform-tournaments">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader preloader--tournaments">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php elseif (is_front_page() && !is_home()): ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            0
          </span>
        </h2>
        <div class="section__header-right">
          <a class="button button--more" href="<?php echo bloginfo('url'); ?>/tournaments">
            <span>
              <?php _e('Все турниры', 'earena_2'); ?>
            </span>
          </a>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list" id="content-platform-tournaments">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
    </div>
  </section>
<?php elseif (earena_2_current_page( 'tournaments' )) : ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            0
          </span>
        </h2>
        <div class="section__header-right section__header-right--account-tabs">
          <?php
            // Табы игровых платформ
            get_template_part('template-parts/tabs/platform');
          ?>
        </div>
      </header>

      <?php
        // Фильтры
        get_template_part('template-parts/filters');
      ?>
      <div class="section__content">
        <ul class="section__list" id="content-platform-tournaments">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php else: ?>
  <!-- Тут пока дичь (переехало с верстки, где было вполне приличным, но на бою оказалось недееспособным) -->
  <section class="section section--tournaments" id="tournaments">
    <?php if (!earena_2_current_page('profile') && !earena_2_current_page('user')): ?>
    <div class="section__wrapper">
      <?php endif; ?>
      <?php if (($_GET['tournaments'] ?? '') === 'chat'): ?>
      <header class="section__header section__header--tournaments-account-chat">
        <a class="section__back button button--gray" href="<?php echo bloginfo('url'); ?>/profile?tournaments">
        <span>
        <?php _e('Назад к турнирам', 'earena_2'); ?>
        </span>
        </a>
        <div class="section__header-right section__header-right--tournaments-account-chat">
          <h3 class="section__title section__title--tournaments-account-chat">
            Myanmar Championship 2020 Season 2 Premium
          </h3>
        </div>
      </header>
      <?php else: ?>
      <header class="section__header">
        <h2 class="section__title section__title--tournaments <?php if (is_page() && !is_front_page()) {echo 'section__title--page';} ?>">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
          0
          </span>
        </h2>
        <div class="section__header-right <?php if ($is_tournaments_tab) {
          echo 'section__header-right--account-tabs';
          } ?>">
          <?php if ($header_right_section === 'all_button'): ?>
          <a class="button button--more" href="<?php echo bloginfo('url'); ?>/?type=tournaments">
          <span>
          <?php _e('Все турниры', 'earena_2'); ?>
          </span>
          </a>
          <?php elseif ($header_right_section === 'tabs') : ?>
          <!-- Табы игровых платформ -->
          <?php get_template_part('template-parts/tabs/platform'); ?>
          <?php elseif ($header_right_section === 'filters') : ?>
          <!-- Фильтры ( стр Аккаунта ) -->
          <?php get_template_part('template-parts/filters', 'account'); ?>
          <?php endif; ?>
        </div>
      </header>
      <?php endif; ?>
      <?php
        if ($filter_section) {
            get_template_part('template-parts/filters');

            if (is_front_page() && $header_right_section === 'tabs') {
                // Если front-page.php с показом Всех Турниров
                ?>
      <div class="section__content" id="content-platform">
        <!-- Подстановка содержимого из шаблона -->
      </div>
      <template id="platform-all">
        <ul class="section__list">
          <?php
            global $tournaments;
            global $tournament_index;

            // Записываю все турниры в глобальную переменную
            $tournaments = $tournaments_all;

            $tournament_index = 0;
            $row_index = 1;

            // Перебираем матчи все
            foreach ($tournaments as $tournament) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }

            $tournament_index++;
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
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
            global $tournaments;
            global $tournament_index;

            $tournament_index = 0;
            $tournaments = $tournaments_desktop;

            $row_index = 1;

            // Перебираем матчи десктопные
            foreach ($tournaments as $tournament) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }

            $tournament_index++;
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
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
            global $tournaments;
            global $tournament_index;

            $tournament_index = 0;
            $tournaments = $tournaments_mobile;

            $row_index = 1;

            // Перебираем матчи мобильные
            foreach ($tournaments as $tournament) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }

            $tournament_index++;
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
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
            global $tournaments;
            global $tournament_index;

            $tournament_index = 0;
            $tournaments = $tournaments_xbox;

            $row_index = 1;

            // Перебираем матчи xbox
            foreach ($tournaments as $tournament) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }

            $tournament_index++;
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
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
            global $tournaments;
            global $tournament_index;

            $tournament_index = 0;
            $tournaments = $tournaments_playstation;

            $row_index = 1;

            // Перебираем матчи playstation
            foreach ($tournaments as $tournament) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }

            $tournament_index++;
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
          </li>
          <?php
            $row_index++;
            }
            ?>
        </ul>
      </template>
      <?php
        } else {
            // Турниры на стр Игры (все Турниры).
            // 10 - тестовое число, которое показывает количество Турниров этой игровы
            // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
            ?>
      <div class="section__content">
        <ul class="section__list">
          <?php
            global $tournament_index;
            global $tournaments;

            // Записываю все Турниры в глобальную переменную
            $tournaments = $tournaments_all;

            $row_index = 1;

            for ($tournament_index = 0; $tournament_index < 10; $tournament_index++) {
                ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }
            }

            // Оставшееся (до 4 шт) заполняется пустыми карточками
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
          </li>
          <?php
            $row_index++;
            }
            ?>
        </ul>
      </div>
      <?php
        }
        } else {
        if (is_front_page() && $header_right_section !== 'tabs') {
            // Если front-page.php
            ?>
      <div class="section__content">
        <ul class="section__list" id="content-platform-tournaments">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <?php
        } else {
            // Если другие варианты есть
            // стр Игры (матчи + турниры)
            ?>
      <div class="section__content">
        <ul class="section__list">
          <?php
            global $tournaments;
            global $tournament_index;

            // Записываю все турниры в глобальную переменную
            $tournaments = $tournaments_all;

            $row_index = 1;

            // Таб с турнирами
            if ($is_tournaments_tab) {
                if ($_GET['tournaments'] === 'chat') {
                    $tournament_index = $_GET['tournament_index'];
                    ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <li class="section__item section__item--col-3-4">
            <?php
              get_template_part('template-parts/accordeon', 'tournaments-account-chat');
              ?>
          </li>
          <?php
            } else {
                for ($tournament_index = 0; $tournament_index < count($tournaments); $tournament_index++) {
                    if ($tournaments[$tournament_index]['my'] === true) {
                        ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
          </li>
          <?php
            if ($row_index % 4 === 0) {
                $row_index = 1;
            } else {
                $row_index++;
            }
            }
            }
            }
            } else {
            // Турниры на других страницах ( к примеру - стр Аккаунта)
            // 4 - тестовое число
            // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
            for ($tournament_index = 0; $tournament_index < 4; $tournament_index++) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive'); ?>
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
            while ($row_index <= 4 && $row_index > 1) {
            ?>
          <li class="section__item section__item--col-4">
            <?php get_template_part('template-parts/tournament/archive', 'empty'); ?>
          </li>
          <?php
            $row_index++;
            }
            ?>
        </ul>
      </div>
      <?php
        }
        }
        ?>
      <?php if (!earena_2_current_page('profile') && !earena_2_current_page('user')): ?>
    </div>
    <?php endif; ?>
  </section>
<?php endif; ?>
