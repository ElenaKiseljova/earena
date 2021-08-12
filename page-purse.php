<?php
  /*
    Кошелёк
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      // Кошелёк
      earena_2_get_section( 'purse' );

      // VIP
      earena_2_get_section( 'vip' );

      // Партнеры
      earena_2_get_section( 'partners' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
