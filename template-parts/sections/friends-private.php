<?php
  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $ea_user = $earena_2_user_private;
?>

<div class="section section--friends" id="friends">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Друзья', 'earena_2' ); ?>
      (
      <span class="section__title-count section__title-count--friends-private">
        <?= bp_get_total_friend_count(get_current_user_id())>0?bp_get_total_friend_count(get_current_user_id()):'0'; ?>
      </span>
      )
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--friends" id="private-friend-list">
    <?php
      earena_2_page_profile_friends_data($ea_user->ID, 'private');
    ?>
  </ul>
</div>
