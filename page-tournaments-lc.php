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

  $bg_header = get_ea_tournament_meta($lc_id, 'bg_header');
  $bg_footer = get_ea_tournament_meta($lc_id, 'bg_footer');
  $bg_color = get_ea_tournament_meta($lc_id, 'bg_color');
?>

<?php
  get_header(  );
?>

<main class="page-main" <?= isset($bg_color) ? 'style="position: relative; background-color: ' . $bg_color . '!important;"' : ''; ?>>
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры - Lucky Cup', 'earena_2' ); ?>
  </h1>

  <?php if(isset($bg_header)): ?>
    <div class="branding branding--header">
      <img src="<?php echo wp_get_attachment_url($bg_header) ?>" alt="alt">
    </div>
  <?php endif; ?>

  <div id="ajax-container-tournament">
    <?php
      earena_2_tournament_page_data($ea_user, $lc_id);
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
