<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  if (!is_ea_admin()) {
    return;
  }

  $is_profile_admin = (earena_2_current_page( 'admin' ) && is_ea_admin()) ? true : false;
  $is_profile_admin_tournaments = ((earena_2_current_page( 'tours' ) || earena_2_current_page( 'cup' ) || earena_2_current_page( 'lucky-cup' ) || is_page(640) || is_page(646) || is_page(643)) && $is_profile_admin) ? true : false;
?>

<div class="toggles toggles--admin">
  <header class="toggles__header toggles__header--admin">
    <div class="toggles__list toggles__list--profile">
      <a href="<?php echo get_page_link(649); ?>" class="toggles__item toggles__item--account <?php if(is_page(649)) echo 'active'; ?>">
        <?php _e( 'Матчи', 'earena_2' ); ?> (<?= count_admin_matches_moderate() + count_admin_matches_not_confirmed(); ?>)
      </a>
      <a href="<?php echo get_page_link(643); ?>" class="toggles__item toggles__item--account <?php if($is_profile_admin_tournaments) echo 'active'; ?>">
        <?php _e( 'Турниры', 'earena_2' ); ?> (<?= count_admin_tournaments(1) + count_admin_tournaments(2) + count_admin_tournaments(3); ?>)
      </a>
      <a href="<?php echo get_page_link(510); ?>" class="toggles__item toggles__item--account <?php if(is_page(510)) echo 'active'; ?>">
        <?php _e( 'Сообщения', 'earena_2' ); ?> (<?=!empty(messages_get_unread_count())?messages_get_unread_count():'0';?>)
      </a>
      <a href="<?php echo get_page_link(637); ?>" class="toggles__item toggles__item--account <?php if(is_page(637)) echo 'active'; ?>">
        <?php _e( 'Верификация', 'earena_2' ); ?> (<?=ea_count_verification_requests();?>)
      </a>
    </div>
  </header>
</div>
