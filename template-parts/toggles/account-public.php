<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;

  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_stat_public;
  $user_stat = $earena_2_user_stat_public;
  $user_stat_key = array_key_first($user_stat);

  // Страница Акаунта
  global $is_account_page;
?>

<div class="toggles toggles--account">
  <header class="toggles__header <?php if ($is_account_page) echo 'toggles__header--account'; ?>">
    <div class="toggles__list">
      <!-- Для переключения состояния - добавляется active класс  -->
      <a href="<?= ea_user_link($ea_user->ID); ?>" class="toggles__item toggles__item--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && !isset($_GET['toggles'])) ? 'active' : ''; ?>">
        <?php _e( 'Профиль', 'earena_2' ); ?>
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=matches'; ?>" class="toggles__item toggles__item--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'matches') ? 'active' : ''; ?>">
        <?php _e( 'Матчи', 'earena_2' ); ?> (<?= $user_stat[$user_stat_key]['m_wins'] + $user_stat[$user_stat_key]['m_loses']; ?>)
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=tournaments'; ?>" class="toggles__item toggles__item--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments') ? 'active' : ''; ?>">
        <?php _e( 'Турниры', 'earena_2' ); ?> (<?= $user_stat[$user_stat_key]['t_wins'] + $user_stat[$user_stat_key]['t_loses']; ?>)
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=friends'; ?>" class="toggles__item toggles__item--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'friends') ? 'active' : ''; ?>">
        <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count($ea_user->ID)>0?bp_get_total_friend_count($ea_user->ID):'0'; ?>)
      </a>
    </div>
  </header>

  <div class="toggles__content toggles__content--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && !isset($_GET['toggles'])) ? 'active' : ''; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Игры
          earena_2_get_section( 'games' );
        }

        if (is_user_logged_in()) {
          // Стрим
          get_template_part( 'template-parts/stream' );
        }
      ?>
    </div>

    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Статистика игр -->
      <?php
        get_template_part( 'template-parts/statistics/page', 'account-games' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Статистика друзей -->
      <?php
        get_template_part( 'template-parts/statistics/page', 'account-friends' );
      ?>
    </div>
  </div>
  <div class="toggles__content toggles__content--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'matches') ? 'active' : ''; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Матчи
          earena_2_get_section( 'matches-public', false, 'filters', 'matches' );
        }
      ?>
    </div>
  </div>
  <div class="toggles__content toggles__content--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments') ? 'active' : ''; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Турниры
          earena_2_get_section( 'tournaments-public', false, 'filters', 'tournaments' );
        }
      ?>
    </div>
  </div>
  <div class="toggles__content toggles__content--account <?= (earena_2_current_page(ea_user_link($ea_user->ID) . '/') && isset($_GET['toggles']) && $_GET['toggles'] === 'friends') ? 'active' : ''; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Друзья
          earena_2_get_section( 'friends-public' );
        }
      ?>
    </div>
  </div>
</div>
