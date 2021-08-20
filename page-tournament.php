<?php
  /*
    Турнир
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- Секция турнира -->
  <?php
    get_template_part( 'template-parts/tournament/single' );
  ?>

  <!-- Партнеры -->
  <?php get_template_part( 'template-parts/partners' ); ?>
</main>

<?php
  get_footer(  );
?>
