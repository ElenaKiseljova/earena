<?php
  $is_games = is_page( 4953 );

  $is_tournaments = (earena_2_current_page( 'tournaments' ) || earena_2_current_page( 'tours' ));

  $is_profile = earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' );
  $is_profile_tournaments = ((earena_2_current_page( 'tours') || (isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments')) && $is_profile) ? true : false;

  $is_profile_admin = (earena_2_current_page( 'admin' ) && is_ea_admin()) ? true : false;
  $is_profile_admin_tournaments = ((earena_2_current_page( 'tours' ) || earena_2_current_page( 'cup' ) || earena_2_current_page( 'lucky-cup' ) || is_page(640) || is_page(646) || is_page(643)) && $is_profile_admin) ? true : false;

  $is_admin_tournaments_list = is_page(555) ? true : false;
  $is_admin_tournaments_create = is_page(552) ? true : false;
?>
<?php if ($is_games && !isset($_GET['toggles'])): ?>
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
        <div class="section__header-right">
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
<?php elseif ($is_games && isset($_GET['toggles'])) : ?>
  <?php
    global $games, $game_id, $ea_icons, $tournaments;

    $count_tournaments = count($tournaments ?? []);
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
        <div class="section__header-right">
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
<?php elseif ($is_tournaments && !$is_profile && !$is_profile_admin) : ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            0
          </span>
        </h2>
        <?php if (is_ea_admin()): ?>
          <a class="section__tournaments-create button button--green" href="<?= get_permalink( 552 ); ?>">
            <?php _e( 'Создать', 'earena_2' ); ?>
          </a>
          <a class="section__tournaments-list button button--gray" href="<?= get_permalink( 555 ); ?>">
            <?php _e( 'Список', 'earena_2' ); ?>
          </a>
        <?php endif; ?>

        <div class="section__header-right">
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
      <div class="preloader preloader--tournaments">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php elseif ($is_profile_tournaments): ?>
  <section class="section section--tournaments section--tournaments-profile" id="tournaments">
    <?php if (isset($_GET['tournament'])): ?>
      <?php
        global $ea_user, $tournament, $tournament_id, $tname, $matches;
        $tournament = EArena_DB::get_ea_tournament($tournament_id);
      ?>
      <header class="section__header">
        <a class="section__back button button--gray" href="<?php echo bloginfo( 'url' ); ?>/profile/tours/">
          <span>
            <?php _e( 'Назад к турнирам', 'earena_2' ); ?>
          </span>
        </a>

        <div class="section__header-right section__header-right--tournaments-account-chat">
          <h3 class="section__title section__title--tournaments-account-chat">
            <?= $tournament->name; ?>
          </h3>
        </div>
      </header>
      <div class="section__content">
        <ul class="section__list section__list--tournaments-account-chat">
          <li class="section__item section__item--col-4">
            <?php get_template_part( 'template-parts/tournament/archive' ); ?>
          </li>
          <li class="section__item section__item--col-3-4">
            <?php
              get_template_part( 'template-parts/accordeon', 'tournaments-account-chat' );
            ?>
          </li>
        </ul>
      </div>
    <?php else: ?>
      <header class="section__header">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Турниры', 'earena_2'); ?>
          <span class="section__amount">
            0
          </span>
        </h2>
        <div class="section__header-right section__header-right--account-tabs">
          <?php
            // Фильтры ( стр Аккаунта )
            get_template_part( 'template-parts/filters', 'account' );
          ?>
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
      <div id="isInViewPort"></div>
    <?php endif; ?>
  </section>
<?php elseif ($is_profile_admin_tournaments) : ?>
  <?php
    global $tournament_type, $tab_active_index;
    $tournament_type = $tournament_type ?? 1;

    $is_profile = true;

    $tab_active_index = isset($_COOKIE['admin_tab_active_index']) ? $_COOKIE['admin_tab_active_index'] : 0;
  ?>
  <section class="section section--tournaments" id="tournaments">
    <header class="section__header section__header--tournaments-admin">
      <?php
        // Табы (типов Турниров + Жалоб и Неподтвержденных турниров)
        get_template_part( 'template-parts/tabs/admin-tournaments', 'moderate' );
      ?>
    </header>

    <?php if (isset($_GET['tournament'])): ?>
      <?php
        global $ea_user, $tournament, $tournament_id, $tournament_type, $matches;
      ?>
      <header class="section__header">
        <a class="section__back button button--gray" href="javascript:history.back()">
          <span>
            <?php _e( 'Назад к турнирам', 'earena_2' ); ?>
          </span>
        </a>

        <div class="section__header-right section__header-right--tournaments-account-chat">
          <h3 class="section__title section__title--tournaments-account-chat">
            <?= $tournament->name; ?>
          </h3>
        </div>
      </header>
      <div class="section__content">
        <ul class="section__list section__list--tournaments-account-chat">
          <li class="section__item section__item--col-4">
            <?php get_template_part( 'template-parts/tournament/archive' ); ?>
          </li>
          <li class="section__item section__item--col-3-4">
            <div class="section__content section__content--tournaments-admin <?= ($tab_active_index == '0') ? 'active' : ''; ?>">
              <?php
                $matches_moderate = EArena_DB::get_ea_admin_tournament_matches_moderate($tournament_id) ?? [];
                $matches = $matches_moderate;

                get_template_part( 'template-parts/accordeon', 'tournaments-account-chat' );
              ?>
            </div>
            <div class="section__content section__content--tournaments-admin <?= ($tab_active_index == '1') ? 'active' : ''; ?>">
              <?php
                $matches_not_confirmed = EArena_DB::get_ea_admin_tournament_matches_not_confirmed($tournament_id) ?? [];
                $matches = $matches_not_confirmed;

                get_template_part( 'template-parts/accordeon', 'tournaments-account-chat' );
              ?>
            </div>
          </li>
        </ul>
      </div>
    <?php else: ?>
      <div class="section__content section__content--tournaments-admin <?= ($tab_active_index == '0') ? 'active' : ''; ?>">
        <ul class="section__list">
          <?php earena_2_show_admin_tournaments_moderate($tournament_type, 0, 0, 'DESC', $is_profile); ?>
        </ul>
      </div>
      <div class="section__content section__content--tournaments-admin <?= ($tab_active_index == '1') ? 'active' : ''; ?>">
        <ul class="section__list">
          <?php earena_2_show_admin_tournaments_not_confirmed($tournament_type, 0, 0, 'DESC', $is_profile); ?>
        </ul>
      </div>
    <?php endif; ?>
  </section>
<?php elseif ($is_admin_tournaments_list) : ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header section__header--admin-tournaments-list">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Список турниров', 'earena_2'); ?>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="<?= get_permalink( 552 ); ?>">
            <span>
              <?php _e('К созданию турниров', 'earena_2'); ?>
            </span>
          </a>
        </div>
        <div class="section__header-bottom section__header-bottom--admin-tournaments-list">
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
        <ul class="section__list section__list--admin" id="content-platform-admin-tournaments">
          <?= earena_2_show_tournaments_admin_list(0); ?>
        </ul>
      </div>
    </div>
  </section>
<?php elseif ($is_admin_tournaments_create) : ?>
  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper" id="app_create_tournament">
      <header class="section__header section__header--admin-tournaments-create">
        <h2 class="section__title section__title--tournaments section__title--page">
          <?php _e('Создание турнира', 'earena_2'); ?>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="<?= get_permalink( 555 ); ?>">
            <span>
              <?php _e('К списку турниров', 'earena_2'); ?>
            </span>
          </a>
        </div>
        <div class="section__header-bottom section__header-bottom--admin-tournaments-create">
          <?php
            // Табы типов турниров
            get_template_part('template-parts/tabs/admin-tournaments', 'create');
          ?>
        </div>
      </header>

      <div class="section__content">
        <?php
          get_template_part( 'template-parts/tournament/create' );
        ?>
      </div>
    </div>
  </section>
<?php else: ?>
  <!-- Главная -->
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
      <div class="preloader preloader--tournaments">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </section>
<?php endif; ?>
