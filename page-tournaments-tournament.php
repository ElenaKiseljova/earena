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

  $bg_header = get_ea_tournament_meta($tournament_id, 'bg_header');
  $bg_footer = get_ea_tournament_meta($tournament_id, 'bg_footer');
  $bg_color = get_ea_tournament_meta($tournament_id, 'bg_color');
?>

<?php
  get_header(  );
?>

<main class="page-main" <?= isset($bg_color) ? 'style="position: relative; background-color: ' . $bg_color . '!important;"' : ''; ?>>
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры - Турнир', 'earena_2' ); ?>
  </h1>

  <?php if(isset($bg_header)): ?>
    <div class="branding branding--header">
      <img src="<?php echo wp_get_attachment_url($bg_header) ?>" alt="alt">
    </div>
  <?php endif; ?>

  <div id="ajax-container-tournament">
    <?php
      earena_2_tournament_page_data($ea_user, $tournament_id);
    ?>
  </div>

  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>

  <?php if(isset($bg_footer )): ?>
    <div class="branding branding--footer">
      <img src="<?php echo wp_get_attachment_url($bg_footer) ?>" alt="">
    </div>
  <?php endif; ?>
</main>

<?php
  get_footer(  );
?>
