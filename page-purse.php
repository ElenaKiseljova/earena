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
    }
  ?>
  <!-- Партнеры -->
  <?php get_template_part( 'template-parts/partners' ); ?>
  <?php
    the_content( $more_link_text = null, $strip_teaser = false );
  ?>
</main>

<?php
  get_footer(  );
?>
