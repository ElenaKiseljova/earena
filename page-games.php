<?php
  /*
    Template Name: Game template
  */
?>
<?php
  global $games, $game_id, $ea_icons;

  $game_id = !empty($_REQUEST['game']) ? sanitize_text_field($_REQUEST['game']) : false;

  if ($game_id === false) {
    wp_redirect( home_url() );
    exit;
  }

  do_action( 'earena_2_page_game_hook' );

  // $data = [
  //   'platform' => $games[$game_id]['platforms'] ? $games[$game_id]['platforms'] : [],
  //   'game' => [$game_id]
  // ];

  // $postslist = get_posts(array('posts_per_page' => 10, 'order' => 'DESC', 'orderby' => 'date', 'cat' => 199));
  //
  // $platforms = get_site_option('platforms');
  // $team_modes = get_site_option('team_modes');
  // $min = (float)get_site_option('ea_min_match_price', 1);
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
