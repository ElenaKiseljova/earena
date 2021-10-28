<?php
  /*
    Template Name: Профиль - Турниры - Single
  */
?>
<?php
  global $ea_user, $tournament_id, $tname, $matches;
  $ea_user = is_user_logged_in()?wp_get_current_user():null;
  $tournament_id = !empty($_REQUEST['tournament']) ? sanitize_text_field($_REQUEST['tournament']) : 0;
  if ( empty($tournament_id) ) {
    wp_redirect( home_url('profile/tours') );exit;
  }
  $tname = EArena_DB::get_ea_tournament_field( $tournament_id, 'name' );
  if ( empty($tname) ) {
    wp_redirect( home_url('profile/tours') );exit;
  }
  $matches = EArena_DB::get_ea_my_tournament_matches($tournament_id);
  if ( empty($matches) ) {
    wp_redirect( add_query_arg( 'tournament', $_REQUEST['tournament'], home_url('tournaments/tournament/') ) );exit;
  }
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="account">
    <div class="account__wrapper">
      <?php
        // Шапка Аккаунта
        get_template_part( 'template-parts/account/header', 'private' );
      ?>

      <?php
        // Переключатели
        get_template_part( 'template-parts/toggles/account', 'private' );
      ?>

      <?php
        // Контент Аккаунта
        get_template_part( 'template-parts/account/content-tournaments', 'private' );
      ?>
    </div>
  </section>

  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
