<?php
  // Страница Акаунта
  global $is_account_page;

  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;
?>

<div class="section section--friends" id="friends">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count($ea_user->ID)>0?bp_get_total_friend_count($ea_user->ID):'0'; ?>)
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--friends" id="public-friend-list">
    <?php
      earena_2_page_profile_friends_data($ea_user->ID, 'public');
    ?>
  </ul>
</div>
