<?php
  global $ea_user;
  $ea_user = wp_get_current_user();

  if (!is_ea_admin()) {
    return;
  }
?>

<header class="account__header account__header--admin">
  <div class="user user--account">
    <div class="user__image-wrapper user__image-wrapper--admin">
      <div class="user__avatar user__avatar--account">
        <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-admin.svg" alt="Admin">
      </div>
    </div>

    <div class="user__info user__info--admin">
      <h1 class="user__name user__name--admin">
        <?= __('Administrator', 'earena_2'); ?>
      </h1>

      <?php if (is_online($ea_user->ID)): ?>
        <div class="user__status user__status--account user__status--online">
          Online
        </div>
      <?php else : ?>
        <div class="user__status user__status--account">
          <?php
            echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($ea_user->ID)) ).__(' назад', 'earena_2');
          ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>
