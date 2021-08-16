<?php
  /*
    Главная
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?php echo bloginfo( 'name' ); ?>
  </h1>

  <section class="promo">
    <div class="promo__wrapper">
      <!-- Слайдер с баннерами и статистикой -->
      <?php get_template_part( 'template-parts/promo/slider' ); ?>
    </div>
  </section>

  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      if (!$_GET['type']) {
        earena_2_get_section( 'games' );

        earena_2_get_section( 'matches' );

        earena_2_get_section( 'tournaments' );
      } elseif (isset($_GET['type']) && $_GET['type'] === 'matches') {
        earena_2_get_section( 'matches', true, 'tabs' );
      } elseif (isset($_GET['type']) && $_GET['type'] === 'tournaments') {
        earena_2_get_section( 'tournaments', true, 'tabs' );
      }
    }
  ?>
  <!-- Партнеры -->
  <?php get_template_part( 'template-parts/partners' ); ?>
</main>

<?php
  get_footer(  );
?>
