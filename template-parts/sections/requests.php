<?php
  // Уведомления (вкладка)

  $admin_id = (int)get_site_option( 'ea_admin_id', 27);
?>
<div class="section section--requests" id="requests">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Уведомления', 'earena_2' ); ?>
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--messages">
    <li class="section__item section__item--col-2 section__item--messages">
      <div class="user user--friends">
        <div class="user__left user__left--friends">
          <div class="user__image-wrapper user__image-wrapper--friends user__image-wrapper--admin">
            <div class="user__avatar user__avatar--friends">
              <?= bp_core_fetch_avatar(['item_id' => $admin_id, 'type' => 'full', 'width' => 70, 'height' => 70]); ?>
            </div>
          </div>

          <div class="user__info user__info--friends">
            <div class="user__name user__name--friends user__name--admin">
              <h5>
                <?= __('Administrator', 'earena_2'); ?>
              </h5>
            </div>

            <?php if (is_online($admin_id)): ?>
              <div class="user__status user__status--friends user__status--online">
                Online
              </div>
            <?php else : ?>
              <div class="user__status user__status--friends">
                <?php
                  echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($admin_id)) ).__(' назад', 'earena_2');
                ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </li>
    <li class="section__item section__item--col-2 section__item--chat">
      <div class="section__item-top">
        <h2 class="section__item-title">
          <?php _e( 'Диалог с Администратором', 'earena_2' ); ?>
        </h2>
      </div>
      <?php
        $thread_id = ea_get_thread_id($admin_id);
        ea_message_box($thread_id);
      ?>
    </li>
  </ul>
</div>
