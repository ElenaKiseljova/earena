<div class="account__content">
  <div class="account__content-item account__content-item--col-1">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Матчи
        earena_2_get_section( 'matches-private', false, 'filters', 'matches' );
      }
    ?>
  </div>
</div>
