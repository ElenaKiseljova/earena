<?php
  global $ea_user;
  $ea_user = wp_get_current_user();

  if (!is_ea_admin()) {
    return;
  }
?>

<header class="account__header account__header--admin">
  <div class="user user--account">
    <div class="user__image-wrapper user__image-wrapper--account user__image-wrapper--admin <?= $verified ? 'user__image-wrapper--verified' : ''; ?>">
      <?php earena_2_verification_html($verified, 'private'); ?>

      <div class="user__avatar user__avatar--account">
        <button class="user__avatar-change openpopup" data-popup="avatar" type="button" name="change">
          <span class="visually-hidden">
            <?php _e( 'Открыть попап для выбора аватара', 'earena_2' ); ?>
          </span>
        </button>
        <?= bp_core_fetch_avatar(['item_id' => $ea_user->ID, 'type' => 'full', 'width' => 100, 'height' => 100]); ?>
      </div>
    </div>

    <div class="user__info user__info--admin">
      <h1 class="user__name user__name--admin">
        <?= $ea_user->nickname; ?>
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
