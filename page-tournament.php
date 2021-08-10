<?php
  get_header(  );
?>

<main class="page-main">
  <!-- Секция турнира -->
  <?php
    get_template_part( 'template-parts/tournament/tournament', 'single' );
  ?>

  <!-- Партнеры -->
  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      earena_2_get_section( 'partners' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
