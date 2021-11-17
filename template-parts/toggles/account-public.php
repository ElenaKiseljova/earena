<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public ?? wp_get_current_user();

  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
  $is_profile_matches = ((earena_2_current_page( 'matches') || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile) ? true : false;
  $is_profile_tournaments = ((earena_2_current_page( 'tours') || (isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments')) && $is_profile) ? true : false;
  $is_profile_friends = ((earena_2_current_page( 'friends') || (isset($_GET['toggles']) && $_GET['toggles'] === 'friends')) && $is_profile) ? true : false;
?>
<div class="toggles toggles--account">
  <header class="toggles__header toggles__header--account">
    <div class="toggles__list">
      <a href="<?= ea_user_link($ea_user->ID); ?>" class="toggles__item toggles__item--account <?= ($is_profile && !isset($_GET['toggles'])) ? 'active' : ''; ?>">
        <?php _e( 'Профиль', 'earena_2' ); ?>
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=matches'; ?>" class="toggles__item toggles__item--account <?= $is_profile_matches ? 'active' : ''; ?>">
        <?php _e( 'Матчи', 'earena_2' ); ?> (<?= counter_matches($ea_user->ID); ?>)
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=tournaments'; ?>" class="toggles__item toggles__item--account <?= $is_profile_tournaments ? 'active' : ''; ?>">
        <?php _e( 'Турниры', 'earena_2' ); ?> (<?= counter_tournaments($ea_user->ID); ?>)
      </a>
      <a href="<?= ea_user_link($ea_user->ID) . '/?toggles=friends'; ?>" class="toggles__item toggles__item--account <?= $is_profile_friends ? 'active' : ''; ?>">
        <?php _e( 'Друзья', 'earena_2' ); ?> (<span class="toggles__counter toggles__counter--friends-public"><?= bp_get_total_friend_count($ea_user->ID)>0?bp_get_total_friend_count($ea_user->ID):'0'; ?></span>)
      </a>
    </div>
  </header>

  <?php
    if ($is_profile_matches) {
      // Контент Аккаунта
      get_template_part( 'template-parts/account/content-matches', 'public' );
    } else if ($is_profile_tournaments) {
      // Контент Аккаунта
      get_template_part( 'template-parts/account/content-tournaments', 'public' );
    } else if ($is_profile_friends) {
      // Контент Аккаунта
      get_template_part( 'template-parts/account/content-friends', 'public' );
    } else {
      // Контент Аккаунта
      get_template_part( 'template-parts/account/content-profile', 'public' );
    }
  ?>
</div>
