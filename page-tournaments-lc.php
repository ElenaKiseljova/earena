<?php
  /*
    Template Name: Турниры (Lucky CUP)
  */
?>
<?php
  $ea_user = is_user_logged_in() ? wp_get_current_user() : null;
  $lc_id = !empty($_REQUEST['lc']) ? sanitize_text_field($_REQUEST['lc']) : 0;
  $lc_name = EArena_DB::get_ea_tournament_field( $lc_id, 'name' )?:'Lucky Cup';
  add_filter( 'document_title_parts', function ( $title ){
    global $lc_name;
    $title['title'] = $lc_name;
    return $title;
  });

  if(!isset($ea_user)) {
    $ea_user = new stdClass();
    $ea_user->ID = 0;
  }
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <div id="ajax-container-tournament">
    <?php
      earena_2_tournament_page_data($ea_user, $tournament_id);
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
