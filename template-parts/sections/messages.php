<?php
  // Сообщения (вкладка)
?>

<div class="section section--message" id="message">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Сообщения', 'earena_2' ); ?> (<?= !empty(messages_get_unread_count()) ? messages_get_unread_count() : '0'; ?>)
    </h2>

    <div class="section__header-right">
    </div>
  </header>
  <?php
    //ea_message_box($thread_id);
    the_content();
  ?>
</div>
