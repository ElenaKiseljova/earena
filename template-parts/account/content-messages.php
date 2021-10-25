<div class="account__content">
  <div class="account__content-item account__content-item--col-1 <?= (!is_ea_admin()) ? 'no-admin' : ''; ?>" id="chat">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Сообщения
        earena_2_get_section( 'messages' );
      }
    ?>
  </div>
</div>
