<?php
  $is_games = is_page( 4953 );

  $is_matches = is_page( 271 ) || earena_2_current_page( 'matches' );

  $is_profile = earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' );
  $is_profile_matches = ($is_matches || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile;

  $is_profile_admin = earena_2_current_page( 'admin' ) && is_ea_admin();
  $is_profile_admin_matches = $is_matches && $is_profile_admin;
?>
<?php if ($is_games && !isset($_GET['toggles'])): ?>
  <?php
    global $games, $game_id, $ea_icons;
  ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches section__title--page">
          <span class="section__title-text"><?php _e( 'Матчи на деньги', 'earena_2' ); ?></span>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right">
          <a class="section__more button button--more" href="<?= bloginfo( 'url' ) . '/games?game=' . ($game_id ?? 0) . '&toggles=matches'; ?>">
            <span>
              <?php _e( 'Все матчи', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </header>
      <div class="section__content">
        <ul class="section__list" id="content-platform-matches">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader preloader--matches">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </section>
<?php elseif ($is_games && isset($_GET['toggles']) && ($_GET['toggles'] === 'matches')): ?>
  <?php
    global $games, $game_id, $ea_icons, $matches;

    $count_matches = count($matches ?? []);
  ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header section__header--game-matches">
        <h2 class="section__title section__title--matches section__title--page">
          <span class="section__title-text"><?php _e( 'Матчи на деньги', 'earena_2' ); ?></span>
          <span class="section__amount">
            <?= $count_matches; ?>
          </span>
        </h2>

        <!-- <div class="section__header-right">
        </div> -->
      </header>

      <?php
        get_template_part( 'template-parts/filters' );
      ?>

      <div class="section__content">
        <ul class="section__list" id="content-platform-matches">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader preloader--matches">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php elseif ($is_matches && !$is_profile && !$is_profile_admin) : ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches">
          <span class="section__title-text"><?php _e( 'Матчи на деньги', 'earena_2' ); ?></span>
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
      <div class="preloader preloader--matches">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php elseif ($is_profile_matches) : ?>
  <section class="section section--matches section--matches-profile" id="matches">
    <header class="section__header">
      <h2 class="section__title section__title--matches section__title--page">
        <span class="section__title-text"><?php _e( 'Матчи', 'earena_2' ); ?></span>
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
      <ul class="section__list" id="content-platform-matches">
        <!-- Подстановка содержимого из шаблона -->
      </ul>
    </div>
    <div class="preloader preloader--matches">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div id="isInViewPort"></div>
  </section>
<?php elseif ($is_profile_admin_matches) : ?>
  <?php
    global $tab_active_index;
    $tab_active_index = isset($_COOKIE['admin_tab_active_index']) ? $_COOKIE['admin_tab_active_index'] : 0;
  ?>
  <section class="section section--matches" id="matches">
    <header class="section__header section__header--matches-admin">
      <?php
        // Табы (Жалоб и Неподтвержденных матчей)
        get_template_part( 'template-parts/tabs/admin', 'matches' );
      ?>
    </header>

    <div class="section__content section__content--matches-admin <?= ($tab_active_index == '0') ? 'active' : ''; ?>">
      <ul class="section__list">
        <?= earena_2_show_admin_matches_moderate(); ?>
      </ul>
    </div>
    <div class="section__content section__content--matches-admin <?= ($tab_active_index == '1') ? 'active' : ''; ?>">
      <ul class="section__list">
        <?= earena_2_show_admin_matches_not_confirmed(); ?>
      </ul>
    </div>
  </section>
<?php else : ?>
  <!-- Главная -->
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches">
          <span class="section__title-text"><?php _e( 'Матчи на деньги', 'earena_2' ); ?></span>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right">
          <a class="section__more button button--more" href="<?= bloginfo( 'url' ) . '/matches' ?>">
            <span>
              <?php _e( 'Все матчи', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list" id="content-platform-matches">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
      <div class="preloader preloader--matches">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </section>
<?php endif; ?>
