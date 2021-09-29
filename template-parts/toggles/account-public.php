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
?>

<div class="toggles toggles--account">
  <header class="toggles__header <?php if ( earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' ) ) echo 'toggles__header--account'; ?>">
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

  <?php
    // Контент Аккаунта
    get_template_part( 'template-parts/account/content-profile', 'public' );
  ?>

  <?php
    // Контент Аккаунта
    get_template_part( 'template-parts/account/content-matches', 'public' );
  ?>

  <?php
    // Контент Аккаунта
    get_template_part( 'template-parts/account/content-tournaments', 'public' );
  ?>

  <?php
    // Контент Аккаунта
    get_template_part( 'template-parts/account/content-friends', 'public' );
  ?>
</div>
