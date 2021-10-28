<?php
  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
  $is_profile_matches = ((earena_2_current_page( 'matches') || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile) ? true : false;
  $is_profile_tournaments = ((earena_2_current_page( 'tours') || (isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments')) && $is_profile) ? true : false;
  $is_profile_friends = ((earena_2_current_page( 'friends') || (isset($_GET['toggles']) && $_GET['toggles'] === 'friends')) && $is_profile) ? true : false;
?>
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
<?php elseif (earena_2_current_page( 'tournaments' ) && !$is_profile) : ?>
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
        <h2 class="section__title section__title--tournaments">
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
<?php else: ?>
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
