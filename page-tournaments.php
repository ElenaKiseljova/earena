<?php
  /*
    Template Name: Турниры
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры', 'earena_2' ); ?>
  </h1>

  <section class="promo">
    <div class="promo__wrapper">
      <?php
        // Слайдер с баннерами и статистикой
        get_template_part( 'template-parts/promo/slider' );
      ?>
    </div>
  </section>

  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      // Турниры
      earena_2_get_section( 'tournaments' );
    }
  ?>
  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
