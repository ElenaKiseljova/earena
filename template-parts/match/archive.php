<?php
  /*
    Архивная карточка матча
  */
?>
<?php
  global $games, $ea_icons, $match;

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

  $ea_user_id = $ea_user->ID;

  // Status
  $match_end = ($match['status'] === '101' || $match['status'] === '102') ? true : false;
  $match_future = ($match['status'] === '2') ? true : false;
  $match_present = ($match['status'] === '3' || $match['status'] === '4') ? true : false;

  $match_my = ($match['player1'] === $ea_user_id || $match['player2'] === $ea_user_id) ? true : false;
?>

<div class="match <?php if ($match_my === true) echo 'match--my'; if ($match_end === true) echo 'match--past'; ?>">
  <div class="match__image">
    <img src="<?= get_template_directory_uri() . '/assets/img/games/matches/' . $ea_icons['game'][$match['game']] . '.png'; ?>" alt="<?= $games[$match['game']]['name']; ?>">
  </div>

  <div class="match__top">
    <div class="match__top-left">
      <h3 class="match__game">
        <?= $games[$match['game']]['name']; ?>
      </h3>
      <ul class="variations <?php if ($match['private'] === '1') echo 'variations--lock'; ?>">
        <li class="variations__item">
          <?php if ($match['team_mode'] === '1'): ?>
            Ultimate Team
          <?php else : ?>
            <?= $match['game_mode']; ?> vs <?= $match['game_mode']; ?>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <div class="platform platform--match">
      <svg class="platform__icon" width="40" height="40">
        <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$match['platform']]; ?>"></use>
      </svg>
    </div>
  </div>

  <div class="match__center">
    <div class="user user--match">
      <?php if ( $match['stream1'] !== '' ): ?>
        <a class="user__stream" href="<?= $match['stream1']; ?>">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </a>
      <?php endif; ?>
      <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match['player1']); ?>">
        <?= bp_core_fetch_avatar(['item_id' => $match['player1'], 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
      </a>
      <a class="user__name user__name--match" href="<?= ea_user_link($match['player1']); ?>">
        <h5>
          <?= get_user_meta($match['player1'], 'nickname', true); ?>
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
          <?= $match['result_user_1']; ?> : <?= $match['result_user_2']; ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="user user--match">
      <?php if ( $match['stream2'] !== '' ): ?>
        <a class="user__stream" href="<?= $match['stream2']; ?>">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </a>
      <?php endif; ?>
      <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match['player2']); ?>">
        <?= bp_core_fetch_avatar(['item_id' => $match['player2'], 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
      </a>
      <a class="user__name user__name--match" href="<?= ea_user_link($match['player2']); ?>">
        <h5>
          <?= get_user_meta($match['player2'], 'nickname', true); ?>
        </h5>
      </a>
    </div>
  </div>

  <div class="match__bottom">
    <div class="match__bet">
      <?php
        if ($match['bet'] !== 'Free') {
          echo '$';
          if (function_exists( 'earena_2_nice_money' )) {
            earena_2_nice_money($match['bet']);
          }
        } else {
          echo $match['bet'];
        }
      ?>
    </div>

    <div class="match__button-wrapper">
      <?php if ($match_future && $match_my === false): ?>
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_future && $match_my === true): ?>
        <button class="button button--red openpopup" data-popup="match" type="button" name="delete">
          <span>
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_present && $match_my === false): ?>
        <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Проходит', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($match_present && $match_my === true): ?>
        <a class="button button--gray" href="/chat?type=match">
          <span class="button__chat button__chat--left">
            24
          </span>
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
        ID <?= $match['ID']; ?>
      </div>
    </div>
  </div>
</div>
