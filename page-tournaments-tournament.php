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
<style media="screen">
  .page-main {
    position: relative;
    <?php if (isset($bg_color)): ?>
      background-color: <?= $bg_color; ?>!important;
    <?php endif; ?>
    <?php if (isset($bg_header) && isset($bg_footer)): ?>
      background-image: url(<?= wp_get_attachment_url($bg_header); ?>),
                        url(<?= wp_get_attachment_url($bg_footer); ?>);
      background-position: center top, center bottom;
      background-size: 100% auto;
      background-repeat: no-repeat;
    <?php elseif (isset($bg_header)): ?>
      background-image: url(<?= wp_get_attachment_url($bg_header); ?>);
      background-position: center top;
      background-size: 100% auto;
      background-repeat: no-repeat;
    <?php elseif (isset($bg_footer)): ?>
      background-image: url(<?= wp_get_attachment_url($bg_footer); ?>);
      background-position: center bottom;
      background-size: 100% auto;
      background-repeat: no-repeat;
    <?php endif; ?>
  }
</style>
<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Турниры - Турнир', 'earena_2' ); ?>
  </h1>

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
