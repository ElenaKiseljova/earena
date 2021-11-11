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

  $bg_header = get_ea_tournament_meta($cup_id, 'bg_header');
  $bg_footer = get_ea_tournament_meta($cup_id, 'bg_footer');
  $bg_color = get_ea_tournament_meta($cup_id, 'bg_color');
?>

<?php
  get_header(  );
?>

<main class="page-main" <?= isset($bg_color) ? 'style="position: relative; background-color: ' . $bg_color . '!important;"' : ''; ?>>
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры - Кубки', 'earena_2' ); ?>
  </h1>

  <?php if(isset($bg_header)): ?>
    <div class="branding branding--header">
      <img src="<?php echo wp_get_attachment_url($bg_header) ?>" alt="alt">
    </div>
  <?php endif; ?>

  <div id="ajax-container-tournament">
    <?php
      earena_2_tournament_page_data($ea_user, $cup_id);
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
