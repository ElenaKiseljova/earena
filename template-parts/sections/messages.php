<?php
  // Сообщения (вкладка)

  $thread_id = isset($_GET['thread_id']) ? $_GET['thread_id'] : null;

  if ($thread_id) {
    $recipient_id = null;
    $thread = new BP_Messages_Thread( $thread_id ) ?? [];

    if (count($thread->recipients) < 3) {
      $recipients_keys = array_keys($thread->recipients);
      foreach ($recipients_keys as $recipients_key) {
        if ($recipients_key !== get_current_user_id()) {
          $recipient_id = $recipients_key;

          break;
        }
      }
    }
  }
?>

<div class="section section--message" id="message">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Сообщения', 'earena_2' ); ?>
      <?php if (!$thread_id): ?>
        (
          <span class="section__title-count section__title-count--message">
            <?= !empty(messages_get_unread_count()) ? messages_get_unread_count() : '0'; ?>
          </span>
        )
      <?php endif; ?>
    </h2>

    <div class="section__header-right">
    </div>
  </header>
  <?php if ($thread_id && $recipient_id): ?>
    <?php
      $recipient = get_user_by( 'id', $recipient_id );
      $verified = ($recipient->get('bp_verified_member') == 1) ? true : false;
    ?>
    <ul class="section__list section__list--messages">
      <li class="section__item section__item--col-2 section__item--messages">
        <div class="user user--friends">
          <div class="user__left user__left--friends">
            <div class="user__image-wrapper user__image-wrapper--friends <?= ($verified && !user_is_ea_admin($recipient_id)) ? 'user__image-wrapper--verified' : ''; ?> <?= user_is_ea_admin($recipient_id) ? 'user__image-wrapper--admin' : ''; ?>">
              <?php
                if (!user_is_ea_admin($recipient_id)) {
                  earena_2_verification_html($verified, 'public');
                }
              ?>

              <div class="user__avatar user__avatar--friends">
                <?= bp_core_fetch_avatar(['item_id' => $recipient_id, 'type' => 'full', 'width' => 70, 'height' => 70]); ?>
              </div>
            </div>

            <div class="user__info user__info--friends">
              <a class="user__name user__name--friends  <?= user_is_ea_admin($recipient_id) ? 'user__name--admin' : ''; ?>" href="<?= bloginfo( 'url' ) . '/user/' . $recipient_id; ?>">
                <h5>
                  <?=$recipient->nickname;?>
                </h5>
              </a>

              <?php if (is_online($recipient_id)): ?>
                <div class="user__status user__status--friends user__status--online">
                  Online
                </div>
              <?php else : ?>
                <div class="user__status user__status--friends">
                  <?php
                    echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($recipient_id)) ).__(' назад', 'earena_2');
                  ?>
                </div>
              <?php endif; ?>

              <?php if (!user_is_ea_admin($recipient_id)): ?>
                <div class="user__rating user__rating--account user__rating--account-message">
                  <span class="user__rating-text">
                    <?php _e( 'Рейтинг', 'earena_2' ); ?>
                  </span>:
                  <span class="user__rating-value">
                    <?= earena_2_rating($recipient->ID); ?>
                  </span>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </li>
      <li class="section__item section__item--col-2 section__item--chat">
        <div class="section__item-top">
          <h2 class="section__item-title">
            <?php _e( 'Диалог с ', 'earena_2' ); ?><?=$recipient->nickname;?>
          </h2>

          <a class="section__close"  href="<?= bloginfo( 'url' ) . '/profile/messages'; ?>">
            <span class="visually-hidden">
              <?php _e( 'Назад', 'earena_2' ); ?>
            </span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>
        <?php
          ea_message_box($thread_id);
        ?>
      </li>
    </ul>
  <?php else: ?>
    <?php
      //ea_message_box($thread_id);
      the_content();
    ?>
  <?php endif; ?>
</div>
