<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  // Страница Акаунта
  global $is_account_page;
?>

<div class="toggles toggles--account">
  <header class="toggles__header <?php if ($is_account_page) echo 'toggles__header--account'; ?>">
    <div class="toggles__list">
      <!-- Для переключения состояния - добавляется active класс  -->
      <a href="<?php echo get_page_link(503); ?>" class="toggles__item toggles__item--account <?php if(is_page(503)) echo 'active'; ?>">
        <?php _e( 'Профиль', 'earena_2' ); ?>
      </a>
      <a href="<?php echo get_page_link(518); ?>" class="toggles__item toggles__item--account <?php if(is_page(518)) echo 'active'; ?>">
        <?php _e( 'Матчи', 'earena_2' ); ?> (<?=counter_matches();?>)
      </a>
      <a href="<?php echo get_page_link(521); ?>" class="toggles__item toggles__item--account <?php if(is_page(521)) echo 'active'; ?>">
        <?php _e( 'Турниры', 'earena_2' ); ?> (<?=counter_tournaments();?>)
      </a>
      <a href="<?php echo get_page_link(510); ?>" class="toggles__item toggles__item--account <?php if(is_page(510)) echo 'active'; ?>">
        <?php _e( 'Сообщения', 'earena_2' ); ?> (<?=!empty(messages_get_unread_count())?messages_get_unread_count():'0';?>)
      </a>
      <a href="<?php echo get_page_link(515); ?>" class="toggles__item toggles__item--account <?php if(is_page(515)) echo 'active'; ?>">
        <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count(get_current_user_id())>0?bp_get_total_friend_count(get_current_user_id()):'0'; ?>)
      </a>
      <a href="<?php echo get_page_link(527); ?>" class="toggles__item toggles__item--account <?php if(is_page(527)) echo 'active'; ?>">
        <?php _e( 'Приглашенные', 'earena_2' ); ?> (<?php $referrals = my_referrals(); echo !empty($referrals) ? count($referrals) : '0'; ?>)
      </a>
      <a href="<?php echo get_page_link(654); ?>" class="toggles__item toggles__item--account <?php if(is_page(654)) echo 'active'; ?>">
        <?php _e( 'Уведомления', 'earena_2' ); ?> (<?=counter_admin();?>)
      </a>
    </div>
  </header>
</div>
