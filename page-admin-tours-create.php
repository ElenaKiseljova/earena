<?php
  /*
    Template Name: Создание турнира
  */
?>

<?php
  if (!is_ea_admin()) {
    _e( 'Доступ запрещен!', 'earena_2' );

    exit;
  }

  $games = get_site_option('games');
  $platforms = get_site_option('platforms');
  $team_modes = get_site_option('team_modes');
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Админ - Турниры - Создание турнира', 'earena_2' ); ?>
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
