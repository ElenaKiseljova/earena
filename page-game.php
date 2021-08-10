<?php
  get_header(  );
?>

<main class="page-main">
  <!-- Секция Игры -->
  <?php
    get_template_part( 'template-parts/game/game', 'single' );
  ?>

  <?php
    if ( isset($_GET['type']) && $_GET['type'] === 'matches' ) {
      // С блоком фильтров отображение Матчей
      earena_2_get_section( 'matches', true, false );
    } elseif ( isset($_GET['type']) && $_GET['type'] === 'tournaments' ) {
      // С блоком фильтров отображение Турниров
      earena_2_get_section( 'tournaments', true, false );
    } else {
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Матчи
        earena_2_get_section( 'matches' );

        // Турниры
        earena_2_get_section( 'tournaments' );

        // Партнеры
        earena_2_get_section( 'partners' );
      }
    }
  ?>
</main>

<?php
  get_footer(  );
?>
