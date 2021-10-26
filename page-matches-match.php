<?php
  /*
    Template Name: Матч (single)
  */
?>

<?php
  get_header(  );
?>

<?php
  global $match_id, $ea_user;

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
  	global $icons, $ea_icons;
  	$games = get_site_option( 'games' );
  	$match_id = $match->ID;
  	add_filter( 'document_title_parts', function ( $title ){
  		global $match_id;
  		$title['title'] .= ' ID'.$match_id;
  		return $title;
  	});
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
  <section class="chat-page">
    <div class="chat-page__wrapper">
      <div class="chat-page__left">
        <header class="chat-page__header chat-page__header--left">
          <div class="platform platform--page">
            <svg class="platform__icon" width="40" height="40">
              <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$match->platform]; ?>"></use>
            </svg>
          </div>
          <div class="chat-page__center">
            <h3 class="chat-page__game">
              <?= $games[$match->game]['name']; ?> - <?= !empty($match->bet) ? ('$' . earena_2_nice_money($match->bet)) : 'Free'; ?>
            </h3>

            <ul class="variations <?= ($match->private == '1') ? 'variations--lock' : ''; ?>">
              <li class="variations__item">
                <?php if ($match->team_mode > 0): ?>
                  <?= team_mode_to_string($match->team_mode); ?>
                <?php else : ?>
                  <?= $match->game_mode; ?> vs <?= $match->game_mode; ?>
                <?php endif; ?>
              </li>
            </ul>
          </div>

          <a class="chat-page__rules" href="<?= get_page_link(1842); ?>">
            <?php _e( 'Правила игры', 'earena_2' ); ?>
          </a>
        </header>

        <div id="chat-page-form">
          <?php earena_2_match_page_data($ea_user, $match_id); ?>
        </div>
      </div>
      <div class="chat-page__right">
        <header class="chat-page__header chat-page__header--right">
          <h1 class="chat-page__chat">
            <?php _e( 'Чат матча ', 'earena_2' ); ?> ID<?= $match_id; ?>
          </h1>

          <?php if (!is_ea_admin()): ?>
            <button class="chat-page__complaint-openpopup button button--red openpopup" data-popup="complaint" type="button" name="complaint">
              <span>
                <?php _e( 'Жалоба судье', 'earena_2' ); ?>
              </span>
            </button>
          <?php endif; ?>
        </header>

        <div class="page-chat" id="chat">
          <?php ea_message_box($match->thread_id);?>
        </div>
      </div>
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
