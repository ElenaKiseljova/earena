<?php
  /*
    Template Name: Матч (single)
  */
?>

<?php
  get_header(  );
?>

<?php
  global $match, $match_id, $ea_user, $icons, $ea_icons;

  if (!is_user_logged_in()) {
  	wp_redirect( add_query_arg('action', 'login', home_url() ) );exit;
  } else {
  	$ea_user = wp_get_current_user();
  	$match_id = !empty($_REQUEST['match']) ? sanitize_text_field($_REQUEST['match']) : null;
    if ( empty($match_id) ) {
  		wp_redirect( home_url('matches') );exit;
  	}
  	$match = EArena_DB::get_ea_match($match_id);
  	if ( !$match || empty($match->player1) || empty($match->player2) ) {
  		wp_redirect( home_url('matches') );exit;
  	}
  	if ( $ea_user->ID !== (int)$match->player1 && $ea_user->ID !== (int)$match->player2 && !is_ea_admin() ) {
  		wp_redirect( home_url('matches') );exit;
  	}
  	$player1 = get_userdata($match->player1);
  	$player2 = get_userdata($match->player2);

  	$match_id = $match->ID;

    do_action( 'earena_2_page_match_hook' );

  	if (is_ea_admin()) {
  		global $wpdb;
  		$admin_id = (int)get_site_option( 'ea_admin_id', 27);
  		$table_name = $wpdb->get_blog_prefix() . 'bp_messages_recipients';
  		$tid = $match->thread_id;
  		if($wpdb->get_row($wpdb->prepare( "SELECT * FROM $table_name WHERE thread_id = %d AND user_id=%d", $tid, $admin_id ))==null){
  			$wpdb->insert($table_name,[ 'user_id'=>$admin_id, 'thread_id'=>$tid ]);
  		}
  	}
  }
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Матчи - Матч', 'earena_2' ); ?>
  </h1>

  <?php
    // Контент страницы Чата
    get_template_part( 'template-parts/chat-page' );
  ?>

  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
