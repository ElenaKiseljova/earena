<?php
  /*
    Template Name: Профиль - Админ - Турниры - Турнир
  */
?>
<?php
  global $ea_user, $tournament, $tournament_id, $tournament_type;
  $tournament_id = !empty($_REQUEST['tournament']) ? sanitize_text_field($_REQUEST['tournament']) : 0;
  if ( empty($tournament_id) ) {
  	wp_redirect( home_url('admin/tours') );exit;
  }
  $tname = EArena_DB::get_ea_tournament_field( $tournament_id, 'name' );
  if ( empty($tname) ) {
  	wp_redirect( home_url('admin/tours') );exit;
  }

  $tournament = EArena_DB::get_ea_tournament($tournament_id);

  $tournament_type = $tournament->type ?? 1;
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Админ - Турниры - Турнир', 'earena_2' ); ?>
  </h1>

  <section class="account">
    <div class="account__wrapper">
      <?php
        // Шапка Аккаунта
        get_template_part( 'template-parts/account/header', 'admin' );
      ?>

      <?php
        // Переключатели
        get_template_part( 'template-parts/toggles/account', 'admin' );
      ?>

      <?php
        // Контент Аккаунта
        get_template_part( 'template-parts/account/content-tournaments', 'private' );
      ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
