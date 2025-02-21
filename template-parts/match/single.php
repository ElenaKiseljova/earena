<?php
  global $match, $match_id, $match_type, $ea_user;

  $is_matches_chat = is_page(274) || $match_type < 1;
  $is_tournaments_chat = is_page(907) || $match_type > 0;

  if (empty($match_id)) {
    if ($is_matches_chat) {
      wp_redirect(home_url('matches'));
      exit;
    } else if ($is_tournaments_chat) {
      wp_redirect(home_url('tournaments'));
      exit;
    }
  }

  if ($is_matches_chat) {
    $match = EArena_DB::get_ea_match($match_id);
  } else if ($is_tournaments_chat) {
    $match = EArena_DB::get_ea_tournament_match($match_id);
  }

  if (!$match || empty($match->player1) || empty($match->player2)) {
    if ($is_matches_chat) {
      wp_redirect(home_url('matches'));
      exit;
    } else if ($is_tournaments_chat) {
      wp_redirect(home_url('tournaments'));
      exit;
    }
  }
  if ($ea_user->ID !== (int)$match->player1 && $ea_user->ID !== (int)$match->player2 && !is_ea_admin()) {
    if ($is_matches_chat) {
      wp_redirect(home_url('matches'));
      exit;
    } else if ($is_tournaments_chat) {
      wp_redirect(home_url('tournaments'));
      exit;
    }
  }

  if ($is_tournaments_chat && !empty($match->end_time) && strtotime($match->end_time) < time() && $match->type !== 2 && !is_ea_admin()) {
    wp_redirect(add_query_arg('tournament', $match->tid, home_url('/tournaments/tournament/')));
    exit;
  }
?>
<?php if (is_ea_admin()): ?>
  <div id="container-current-user">
    <!-- Контент из шаблона -->
  </div>

  <template id="user-0">
    <?php
      earena_2_chat_form_users_html( $match_id, $match->player1, $match_type );
    ?>
  </template>
  <template id="user-1">
    <?php
      earena_2_chat_form_users_html( $match_id, $match->player2, $match_type );
    ?>
  </template>

  <?php
    // Переключение пользователей
    get_template_part( 'template-parts/tabs/admin', 'users' );
  ?>
  <?php
    $complaint = json_decode($match->complaint, true) ? json_decode($match->complaint, true) : [];

    if (count($complaint) > 0) {
      ?>
        <div class="chat-page__complaint-container" id="complaint-container">
          <?php
            earena_2_complaint_html($complaint, $match_id, $match_type);
          ?>
        </div>
      <?php
    }
  ?>
<?php else: ?>
  <?php
    earena_2_chat_form_users_html( $match_id, $ea_user->ID, $match_type );
  ?>
<?php endif; ?>
