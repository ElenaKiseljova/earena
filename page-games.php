<?php
  /*
    Template Name: Game template
  */
?>
<?php
  global $games, $game_id, $ea_icons;

  $game_id = isset($_GET['game']) ? $_GET['game'] : false;

  if ($game_id === false) {
    return;
  }

  $data = [
    'platform' => $games[$game_id]['platforms'] ? $games[$game_id]['platforms'] : [],
    'game' => [$game_id]
  ];

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
  <!-- Секция Игры -->
  <?php
    get_template_part( 'template-parts/game/single' );
  ?>

  <?php
    if ( isset($_GET['toggles']) && $_GET['toggles'] === 'matches' ) {
      // С блоком фильтров отображение Матчей
      earena_2_get_section( 'matches-public', true, false );
    } elseif ( isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments' ) {
      // С блоком фильтров отображение Турниров
      earena_2_get_section( 'tournaments-public', true, false );
    } else {
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Матчи
        earena_2_get_section( 'matches-public' );

        // Турниры
        earena_2_get_section( 'tournaments-public' );
      }

      // Партнеры
      get_template_part( 'template-parts/partners' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
