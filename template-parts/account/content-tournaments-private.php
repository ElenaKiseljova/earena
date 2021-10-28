<div class="account__content">
  <div class="account__content-item account__content-item--col-1">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Турниры
        earena_2_get_section( 'tournaments' );
      }
    ?>
  </div>
</div>
