<?php
  /*
    Статистика друзей на странице аккаунта
  */
?>
<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $earena_2_user_public = $earena_2_user_public ?? null;

  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;

  $earena_2_user_private = $earena_2_user_private ?? null;

  if (earena_2_current_page('user')) {
    $ea_user = $earena_2_user_public ?? wp_get_current_user();
  }

  if (earena_2_current_page('profile')) {
    $ea_user = $earena_2_user_private ?? wp_get_current_user();
  }
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Друзья', 'earena_2' ); ?>
      (
        <span class="statistics__count statistics__count--friends-<?= $earena_2_user_public ? 'public' : 'private'; ?>">
          <?= bp_get_total_friend_count($ea_user->ID)>0?bp_get_total_friend_count($ea_user->ID):'0'; ?>
        </span>
      )
    </h3>

    <a class="statistics__all" href="<?= ea_user_link($ea_user->ID) . '/?toggles=friends'; ?>">
      <?php _e( 'Все друзья', 'earena_2' ); ?>
    </a>
  </header>

  <div class="statistics__content statistics__content--account">
    <ul class="statistics__list statistics__list--friends-<?= $earena_2_user_public ? 'public' : 'private'; ?>">
      <?php
        earena_2_page_profile_public_friends_data($ea_user->ID, 8);
      ?>
    </ul>
  </div>
</div>
