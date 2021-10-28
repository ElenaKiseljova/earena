<?php
  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
  $is_profile_matches = ((earena_2_current_page( 'matches') || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile) ? true : false;
  $is_profile_tournaments = ((earena_2_current_page( 'tours') || (isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments')) && $is_profile) ? true : false;
?>
<?php if (earena_2_current_page( 'games' ) && !isset($_GET['toggles']) ): ?>
  <?php
    global $games, $game_id, $ea_icons;
  ?>
  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches section__title--page">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="<?= bloginfo( 'url' ) . '/games?game=' . ($game_id ?? 0) . '&toggles=matches'; ?>">
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
<?php elseif (earena_2_current_page( 'games' ) && isset($_GET['toggles']) && ($_GET['toggles'] === 'matches') ): ?>
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
      <div class="preloader preloader--matches">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="isInViewPort"></div>
    </div>
  </section>
<?php elseif ( earena_2_current_page( 'matches' ) && !$is_profile ) : ?>
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
        <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
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
