<?php
  /*
    Template Name: Кошелёк
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Кошелёк', 'earena_2' ); ?>
  </h1>

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
