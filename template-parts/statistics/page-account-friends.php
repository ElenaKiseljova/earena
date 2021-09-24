<?php
  /*
    Статистика друзей на странице аккаунта
  */
?>
<?php
  if (earena_2_current_page('user')) {
    // Эта переменная используется в шаблонах 'public'
    global $earena_2_user_public;
    $ea_user = $earena_2_user_public;
  }

  if (earena_2_current_page('profile')) {
    // Эта переменная используется в шаблонах 'private'
    global $earena_2_user_private;
    $ea_user = $earena_2_user_private;
  }
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count($ea_user->ID)>0?bp_get_total_friend_count($ea_user->ID):'0'; ?>)
    </h3>

    <a class="statistics__all" href="<?= ea_user_link($ea_user->ID) . '/?toggles=friends'; ?>">
      <?php _e( 'Все друзья', 'earena_2' ); ?>
    </a>
  </header>

  <div class="statistics__content statistics__content--account">
    <ul class="statistics__list">
      <?php
        earena_2_page_profile_public_friends_data($ea_user->ID, 6);
      ?>
    </ul>
  </div>
</div>
