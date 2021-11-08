<?php
  /*
    Template Name: Список турниров (админ)
  */
?>

<?php
  $games = get_site_option('games');
  $platforms = get_site_option('platforms');
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Админ - Турниры - Список турниров', 'earena_2' ); ?>
  </h1>

  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      // Турниры
      earena_2_get_section( 'tournaments' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
