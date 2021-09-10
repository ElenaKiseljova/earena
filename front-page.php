<?php
  /*
  Template Name: Главная
  */
?>
<?php
  global $games;
  $platforms = get_site_option('platforms');
  if(isset($_COOKIE['ea_current_platform'])) {
      $cookiePlatforms = $_COOKIE['ea_current_platform'];
      $cookiePlatforms = array_map('intval', explode(',', $cookiePlatforms));
  } else {
      $cookiePlatforms = [];
      $cookiePlatforms = [-1];
  }
  if(count($cookiePlatforms) == count($platforms)) {
      $cookiePlatforms = [];
      $cookiePlatforms = [-1];
  }
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
      // Главная
      if (!$_GET['type']) {
        earena_2_get_section( 'games' );

        earena_2_get_section( 'matches' );

        earena_2_get_section( 'tournaments' );
      } elseif (isset($_GET['type']) && $_GET['type'] === 'matches') {

        // Старница всех матчей
        earena_2_get_section( 'matches', true, 'tabs' );
      } elseif (isset($_GET['type']) && $_GET['type'] === 'tournaments') {

        // Страница всех турниров
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
