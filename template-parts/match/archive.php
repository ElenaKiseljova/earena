<?php
  /*
    Архивная карточка матча
  */
?>
<?php
  global $games, $icons, $ea_icons, $match;

  if (!isset($games)) {
    $games = get_site_option('games');
  }

  if (is_page(518) || earena_2_current_page( 'profile' )) {
      $profile = true;
  }

  $username = get_query_var('username');
  if (empty($username) && is_user_logged_in()) {
    $ea_user = wp_get_current_user();
  } elseif ( $username == 1 ) {
    wp_redirect(home_url());exit;
  } elseif ( $username == 89 ) {
    wp_redirect(home_url('matches'));exit;
  } elseif ( $username == 88 || $username == 87 ) {
    wp_redirect(home_url('tournaments'));exit;
  } elseif (!empty($username)) {
    $ea_user = get_user_by('slug',$username);
  }

  $ea_user_id = $ea_user->ID ?? null;

  // Status
  $match_waiting = ($match->status == 1 ) ? true : false;
  $match_end = ($match->status > 100) ? true : false;
  $match_present = ($match->status > 1 && $match->status < 100) ? true : false;

  $match_my = ($match->player1 == $ea_user_id || $match->player2 == $ea_user_id) ? true : false;
?>

<div class="match <?php if ($match_my == true) echo 'match--my'; if ($match_end == true) echo 'match--past'; ?>" data-status="<?= $match->status; ?>">
  <div class="match__image">
    <img src="<?= get_template_directory_uri() . '/assets/img/games/matches/' . $ea_icons['game'][$match->game] . '.png'; ?>" alt="<?= $games[$match->game]['name']; ?>">
  </div>

  <div class="match__top">
    <div class="match__top-left">
      <h3 class="match__game">
        <?= $games[$match->game]['name']; ?>
      </h3>
      <ul class="variations <?php if ($match->private == '1') echo 'variations--lock'; ?>">
        <li class="variations__item">
          <?php if ($match->team_mode > 0): ?>
            <?= team_mode_to_string($match->team_mode); ?>
          <?php else : ?>
            <?= $match->game_mode; ?> vs <?= $match->game_mode; ?>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <div class="platform platform--match">
      <svg class="platform__icon" width="40" height="40">
        <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$match->platform]; ?>"></use>
      </svg>
    </div>
  </div>

  <div class="match__center">
    <div class="user user--match">
      <?php if ( $match->stream1 != '' ): ?>
        <a class="user__stream" href="<?= $match->stream1; ?>">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </a>
      <?php endif; ?>
      <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match->player1); ?>">
        <?= bp_core_fetch_avatar(['item_id' => $match->player1, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
      </a>
      <a class="user__name user__name--match" href="<?= ea_user_link($match->player1); ?>">
        <h5>
          <?= ea_game_nick($match->game, $match->platform, $match->player1); ?>
        </h5>
      </a>
    </div>
    <?php if (!$match_end): ?>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
    <?php else : ?>
      <div class="match__vs match__vs--end">
        <span>
          <?= isset($match->score1) ? $match->score1 : '0'; ?> : <?= isset($match->score2) ? $match->score2 : '0'; ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="user user--match">
      <?php if (!$match_waiting): ?>
        <?php if ( $match->stream2 != '' ): ?>
          <a class="user__stream" href="<?= $match->stream2; ?>">
            <svg class="user__stream-icon" width="16" height="13">
              <use xlink:href="#icon-play"></use>
            </svg>
          </a>
        <?php endif; ?>
        <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match->player2); ?>">
          <?= bp_core_fetch_avatar(['item_id' => $match->player2, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
        </a>
        <a class="user__name user__name--match" href="<?= ea_user_link($match->player2); ?>">
          <h5>
            <?= ea_game_nick($match->game, $match->platform, $match->player2); ?>
          </h5>
        </a>
      <?php else: ?>
        <div class="user__avatar user__avatar--match user__avatar--loader">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </div>
        <div class="user__name user__name--match">
          <h5>
            NULL
          </h5>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="match__bottom">
    <div class="match__bet">
      <?php
        if (!empty($match->bet)) {
          echo '$';
          if (function_exists( 'earena_2_nice_money' )) {
            echo earena_2_nice_money($match->bet);
          }
        } else {
          echo 'Free';
        }
      ?>
    </div>

    <div class="match__button-wrapper">
      <?php if ($match_waiting && ($match->player1 != $ea_user_id) && !is_ea_admin()): ?>
        <?php
          $join_popup = 'match';

          if (!is_user_logged_in()) {
              $join_popup = 'login';
              $join_name = 'signin';

              // $join_target = 'noLoggedIN';
          }
          elseif (is_user_logged_in() && !in_array($match->game, ea_my_games())) {
              $join_name = 'no-game-or-platform';
          } elseif (is_user_logged_in() && !in_array($match->platform, ea_my_platforms($match->game))) {
              $join_name = 'no-game-or-platform';
          } elseif (is_user_logged_in() && (int)$match->bet > 0 && isset($ea_user) && !ea_check_user_age($ea_user->ID)) {
              $join_name = 'no-old-enough';
          } else {
              $join_name = 'join';
          }
        ?>
        <button class="button button--blue openpopup"
                data-popup="<?= $join_popup; ?>"
                data-id="<?= $match->ID; ?>"
                data-private="<?= $match->private; ?>"
                data-game="<?= $games[$match->game]['shortname']; ?>"
                <?php if ($match->team_mode > 0): ?>
                  data-team="<?= $match->team_mode > 0 ? team_mode_to_string($match->team_mode) : ''; ?>"
                <?php else : ?>
                  data-mode="<?= $match->game_mode . ' vs ' . $match->game_mode ?>"
                <?php endif; ?>
                data-platform="<?= $ea_icons['platform'][$match->platform]; ?>"
                data-balance="<?= balance(); ?>"
                data-bet="<?= $match->bet; ?>"
                data-security="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>"
                type="button"
                name="<?= $join_name ;?>">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_waiting && (($match->player1 == $ea_user_id) || is_ea_admin())): ?>
        <button class="button button--red openpopup"
                data-popup="match"
                data-id="<?= $match->ID; ?>"
                type="button" name="delete">
          <span>
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_waiting): ?>
        <button class="button button--gray" disabled type="button" name="waiting">
          <span>
            <?php _e( 'Ожидает соперника', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_present && $match_my == false): ?>
        <?php if (is_ea_admin()): ?>
          <a class="button button--blue" href="<?= bloginfo( 'url' )?>/matches/match/?match=<?= $match->ID; ?>">
            <span>
              <?php _e( 'Проходит', 'earena_2' ); ?>
            </span>
          </a>
        <?php else: ?>
          <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
            <span>
              <?php _e( 'Проходит', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      <?php elseif ($match_present && $match_my == true): ?>
        <a class="button button--gray" href="<?= bloginfo( 'url' ); ?>/matches/match/?match=<?= $match->ID; ?>">
          <?php if (ea_count_unread($match->thread_id) > 0): ?>
            <span class="button__chat button__chat--left">
              <?=  ea_count_unread($match->thread_id); ?>
            </span>
          <?php endif; ?>
          <span>
            <?php _e( 'В чат', 'earena_2' ); ?>
          </span>
        </a>
      <?php elseif ($match_end): ?>
        <button class="button button--gray openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Завершен', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>

      <div class="match__id">
        ID <?= $match->ID; ?>
      </div>
    </div>
  </div>
</div>
