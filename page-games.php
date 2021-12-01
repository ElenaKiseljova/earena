<?php
  /*
    Template Name: Game template
  */
?>
<?php
  global $games, $game_id, $ea_icons;

  $game_id = isset($_REQUEST['game']) ? sanitize_text_field($_REQUEST['game']) : false;
  if ($game_id === false) {
    wp_redirect( home_url() );
    exit;
  }

  do_action( 'earena_2_page_game_hook' );
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Игра - ', 'earena_2' ) . $games[$game_id]['name']; ?>
  </h1>

  <!-- Секция Игры -->
  <?php
    get_template_part( 'template-parts/game/single' );
  ?>

  <?php
    if ( isset($_GET['toggles']) && $_GET['toggles'] === 'matches' ) {
      // С блоком фильтров отображение Матчей
      earena_2_get_section( 'matches', true, false );
    } elseif ( isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments' ) {
      // Турниры
      earena_2_get_section( 'tournaments' );
    } else {
      // Матчи
      earena_2_get_section( 'matches' );

      // Турниры
      earena_2_get_section( 'tournaments' );

      // Партнеры
      get_template_part( 'template-parts/partners' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
