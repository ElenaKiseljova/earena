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
      earena_2_get_section( 'wallet' );

      // VIP
      earena_2_get_section( 'vip' );
    }
  ?>
  <!-- Партнеры -->
  <?php get_template_part( 'template-parts/partners' ); ?>
</main>

<?php
  get_footer(  );
?>
