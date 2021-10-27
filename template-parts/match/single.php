<?php
  global $match, $match_id, $ea_user;

  if (empty($match_id)) {
      wp_redirect(home_url('matches'));
      exit;
  }
  $match = EArena_DB::get_ea_match($match_id);
  if (!$match || empty($match->player1) || empty($match->player2)) {
      wp_redirect(home_url('matches'));
      exit;
  }
  if ($ea_user->ID !== (int)$match->player1 && $ea_user->ID !== (int)$match->player2 && !is_ea_admin()) {
      wp_redirect(home_url('matches'));
      exit;
  }
?>

<?php if (is_ea_admin()): ?>
  <div id="container-current-user">
    <!-- Контент из шаблона -->
  </div>

  <template id="user-0">
    <?php
      earena_2_chat_form_users_html( $match_id, $match->player1 );
    ?>
  </template>
  <template id="user-1">
    <?php
      earena_2_chat_form_users_html( $match_id, $match->player2 );
    ?>
  </template>

  <?php
    get_template_part( 'template-parts/tabs/users' );
  ?>
  <?php
    $complaint = json_decode($match->complaint, true) ? json_decode($match->complaint, true) : [];

    if (count($complaint) > 0) {
      ?>
        <div class="chat-page__complaint-container" id="complaint-container">
          <?php
            earena_2_complaint_html($complaint, $match_id);
          ?>
        </div>
      <?php
    }
  ?>
<?php else: ?>
  <?php
    earena_2_chat_form_users_html( $match_id, $ea_user->ID );
  ?>
<?php endif; ?>
