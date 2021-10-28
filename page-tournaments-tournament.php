<?php
  /*
    Template Name: Турниры (Турнир)
  */
?>
<?php
  $ea_user = is_user_logged_in() ? wp_get_current_user() : null;
  $tournament_id = !empty($_GET['tournament']) ? sanitize_text_field($_GET['tournament']) : 0;
  $trn_name = EArena_DB::get_ea_tournament_field( $tournament_id, 'name' )?:'Турнир';

  add_filter( 'document_title_parts', function ( $title ){
    global $trn_name;
    $title['title'] = $trn_name;
    return $title;
  });

  if(!isset($ea_user)) {
    $ea_user = new stdClass();
    $ea_user->ID = 0;
  }

  var_dump($ea_user, $tournament_id);
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
