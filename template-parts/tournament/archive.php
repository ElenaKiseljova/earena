<?php
  /*
    Архивная карточка турнира
  */
?>
<?php
  global $games, $icons, $ea_icons, $tournament;

  if (!isset($games)) {
    $games = get_site_option('games');
  }

  if (is_page(521) || earena_2_current_page( 'profile' )) {
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
  $tournament_waiting = ($tournament->status < 2 ) ? true : false;
  $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  $tournament_present = ($tournament->status >= 4 && $tournament->status <= 101) ? true : false;
  $tournament_end = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  $tournament_my = in_array($ea_user_id, json_decode($tournament->players, true) ?: []) ? true : false;
?>
<div class="tournament">
  <?php if ($tournament_present && ( earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' ) )): ?>
    <a class="tournament__gotochat" href="">
      <span class="visually-hidden">
        <?php _e( 'В чате турнира сообщений', 'earena_2' ); ?>
      </span>
      1
    </a>
  <?php endif; ?>

  <a class="tournament__link <?php if ($tournament_end || $tournament_cancel) echo 'tournament__link--past'; if ($tournament_my) echo 'tournament__link--my'; ?>"
     href="<?= earena_2_current_page( '/profile/tours/' ) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/tournament/?tournament=' . $tournament->ID; ?>">
    <div class="tournament__top">
      <div class="tournament__image">
        <img src="<?= wp_get_attachment_url($tournament->cover1); ?>" alt="<?= $games[$tournament->game]['name']; ?>">
      </div>

      <?php if ( $tournament->vip ): ?>
        <span class="vip">
          vip
        </span>
      <?php endif; ?>

      <div class="tournament__top-content">
        <?php if ( $tournament_end && !empty($tournament->winner ) ): ?>
          <div class="tournament__winner">
            <div class="tournament__winner-image-wrapper">
              <div class="tournament__winner-image">
                <?= bp_core_fetch_avatar('item_id=' . json_decode($tournament->winner)[0]); ?>
              </div>
            </div>

            <h5 class="tournament__winner-name">
              <?php
                earena_2_get_nickname_by_id(json_decode($tournament->winner)[0]);
              ?>
            </h5>
          </div>
        <?php endif; ?>
        <div class="tournament__trophy">
          $<?= earena_2_nice_money( max($tournament->prize, $tournament->garant) ); ?>
        </div>
      </div>
    </div>

    <div class="tournament__center">
      <h4 class="tournament__name">
        <?= $tournament->name; ?>
      </h4>

      <?php if ( $tournament_registration ): ?>
        <div class="tournament__status tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?>
          <time>
            <?= date('d.m.Y', utc_to_usertime(strtotime($tournament->end_reg_time))); ?>
            (<?= date('H:i', utc_to_usertime(strtotime($tournament->end_reg_time))); ?> UTC<?= utc_value(); ?>)
          </time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начало', 'earena_2' ); ?>
          <time>
            <?= date('d.m.Y', utc_to_usertime(strtotime($tournament->start_time))); ?>
            (<?= date('H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> UTC<?= utc_value(); ?>)
          </time>
        </div>
      <?php elseif ( $tournament_waiting ) : ?>
        <div class="tournament__status tournament__status--future">
          <?php _e( 'Ожидает публикации', 'earena_2' ); ?>
        </div>
      <?php elseif ( $tournament_present ) : ?>
        <div class="tournament__status tournament__status--present">
          <?php _e( 'Проходит', 'earena_2' ); ?>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?>
          <time>
            <?= date('d.m.Y', utc_to_usertime(strtotime($tournament->start_time))); ?>
            (<?= date('H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> UTC<?= utc_value(); ?>)
          </time>
        </div>
      <?php elseif ( $tournament_end ): ?>
        <div class="tournament__status tournament__status--past">
          <?php _e( 'Завершился', 'earena_2' ); ?>
          <time>
            <?= date('d.m.Y', utc_to_usertime(strtotime($tournament->end_time))); ?>
            (<?= date('H:i', utc_to_usertime(strtotime($tournament->end_time))); ?> UTC<?= utc_value(); ?>)
          </time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?>
          <time>
            <?= date('d.m.Y', utc_to_usertime(strtotime($tournament->start_time))); ?>
            (<?= date('H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> UTC<?= utc_value(); ?>)
          </time>
        </div>
      <?php elseif ( $tournament_cancel ): ?>
        <div class="tournament__status tournament__status--past">
          <?php _e( 'Отменён', 'earena_2' ); ?>
        </div>
        <div class="tournament__info">
          <?php _e( 'Не начался', 'earena_2' ); ?>
        </div>
      <?php endif; ?>

      <div class="players">
        <div class="players__progress">
          <?php
            $users_percent = round( count(json_decode($tournament->players, true) ?: []) / $tournament->max_players * 100 );
          ?>
          <span class="players__progress-bar" data-width="<?= $users_percent;  ?>"></span>
        </div>
        <div class="players__text">
          <?= count(json_decode($tournament->players, true) ?: []); ?>/<?= $tournament->max_players; ?>
        </div>
      </div>
    </div>

    <div class="tournament__bottom">
      <div class="tournament__bottom-left">
        <h3 class="tournament__game">
          <?= $games[$tournament->game]['name']; ?>
        </h3>
        <ul class="variations <?php if ( $tournament->private ) echo 'variations--lock'; ?>">
          <li class="variations__item">
            <?php if ( $tournament->team_mode > 0 ): ?>
              <?= team_mode_to_string($tournament->team_mode); ?>
            <?php else: ?>
              <?= $tournament->game_mode; ?> vs <?= $tournament->game_mode; ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>

      <div class="platform">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-<?= $ea_icons['platform'][(int)$tournament->platform]; ?>"></use>
        </svg>
      </div>

      <div class="tournament__id">
        ID <?= $tournament->ID; ?>
      </div>

      <div class="tournament__bet">
        <?= !empty($tournament->price) ? '$' . earena_2_nice_money($tournament->price) : 'Free'; ?>
      </div>
    </div>
  </a>
</div>
