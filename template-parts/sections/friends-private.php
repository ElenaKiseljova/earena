<?php
  // Страница Акаунта
  global $is_account_page;
?>

<div class="section section--friends" id="friends">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count(get_current_user_id())>0?bp_get_total_friend_count(get_current_user_id()):'0'; ?>)
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--friends" id="private-friend-list">
    <?php
      $ea_user = wp_get_current_user();
      earena_2_page_profile_friends_data($ea_user->ID, 'private');
    ?>
  </ul>
</div>
