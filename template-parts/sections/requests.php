<?php
  // Уведомления (вкладка)
?>
<?php
  global $earena_2_user_private;
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
            <a class="user__avatar user__avatar--friends" href="<?php echo bloginfo( 'url' ); ?>/profile">
              <img width="70" height="70" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-admin.svg" alt="Admin">
            </a>
          </div>

          <div class="user__info user__info--friends">
            <a class="user__name user__name--friends user__name--admin" href="<?php echo bloginfo( 'url' ); ?>/profile">
              <h5>
                <?= __('Administrator', 'earena_2'); ?>
              </h5>
            </a>

            <?php if (is_online($earena_2_user_private->ID)): ?>
              <div class="user__status user__status--friends user__status--online">
                Online
              </div>
            <?php else : ?>
              <div class="user__status user__status--friends">
                <?php
                  echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($earena_2_user_private->ID)) ).__(' назад', 'earena_2');
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

        <!-- <a class="section__close"  href="<?php echo bloginfo( 'url' ); ?>/profile?requests">
          <span class="visually-hidden">
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a> -->
      </div>
      <?php
        $admin_id = (int)get_site_option( 'ea_admin_id', 27);
        $thread_id = ea_get_thread_id($admin_id);
        ea_message_box($thread_id);
      ?>
    </li>
  </ul>
</div>
