<?php
  /*
    Template Name: Турниры (Кубок)
  */
?>
<?php
  $ea_user = is_user_logged_in() ? wp_get_current_user() : null;
  $cup_id = !empty($_REQUEST['cup']) ? sanitize_text_field($_REQUEST['cup']) : 0;
  $cup_name = EArena_DB::get_ea_tournament_field($cup_id, 'name') ?: 'Кубок';
  add_filter('document_title_parts', function ($title) {
      global $cup_name;
      $title['title'] = $cup_name;
      return $title;
  });
  if (!isset($ea_user)) {
      $ea_user = new stdClass();
      $ea_user->ID = 0;
  }
  $description = get_ea_tournament_meta($cup_id, 'description');
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры - Кубки', 'earena_2' ); ?>
  </h1>

  <div id="ajax-container-tournament">
    <?php
      earena_2_tournament_page_data($ea_user, $cup_id);
    ?>
  </div>

  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
