<?php
  /*
    Страница Турнира
  */
?>
<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $description = get_ea_tournament_meta ($tournament_id, 'description');

  $games = get_site_option('games');
  $tournament_name = $tournament->name;
  add_filter('document_title_parts', function ($title) {
      global $tournament_name;
      $title['title'] .= ' ' . $tournament_name;
      return $title;
  });

  if (!isset($ea_user)) {
      $ea_user = new stdClass();
      $ea_user->ID = 0;
  }

  /* STATUS */
  $tournament_waiting = ($tournament->status < 2) ? true : false;
  $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  $tournament_present = ($tournament->status >= 4 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  /* TYPE */
  $is_tournament_simple = ((int)$tournament->type === 1) ? true : false;
  $is_tournament_lucky_cup = ((int)$tournament->type === 2) ? true : false;
  $is_tournament_cup = ((int)$tournament->type === 3) ? true : false;
?>

<section class="tournament tournament--page">
  <div class="tournament__wrapper">
    <div class="tournament__left">
      <div class="tournament__labels tournament__labels--tournament-page">
        <?php if ( $tournament->verification ): ?>
          <span class="verify verify--true verify--tournament-page"></span>
        <?php endif; ?>

        <?php if ( $tournament->vip ): ?>
          <span class="vip vip--tournament-page">
            vip
          </span>
        <?php endif; ?>
      </div>

      <div class="tournament__image tournament__image--page" itemscope itemtype="http://schema.org/ImageObject">
        <picture class="tournament__picture">
          <img itemprop="contentUrl" src="<?= wp_get_attachment_url($tournament->cover2); ?>" alt="<?= $tournament->name; ?>">
        </picture>

        <meta itemprop="name" content="<?= $tournament->name; ?>">
      </div>
    </div>
    <div class="tournament__right">
      <header class="tournament__header">
        <div class="platform platform--page">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-<?= $ea_icons['platform'][(int)$tournament->platform]; ?>"></use>
          </svg>
        </div>
        <div class="tournament__center tournament__center--page">
          <h3 class="tournament__game tournament__game--page">
            <?= $games[$tournament->game]['name']; ?>
          </h3>

          <ul class="variations <?= ($tournament->private) ? 'variations--lock' : '';?>">
            <li class="variations__item">
              <?= $tournament->game_mode; ?> vs <?= $tournament->game_mode; ?>
            </li>
            <?php if ($tournament->team_mode > 0): ?>
              <li class="variations__item">
                <?= team_mode_to_string($tournament->team_mode); ?>
              </li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="tournament__trophy tournament__trophy--page">
          $<?= earena_2_nice_money( max($tournament->prize, $tournament->garant) ); ?>
        </div>
      </header>

      <h1 class="tournament__name tournament__name--page">
        <?= $tournament->name; ?>
      </h1>
      <?php if ($tournament_registration): ?>
        <div class="tournament__status tournament__status--page tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?>
          <?php if (!empty($tournament->end_reg_time)): ?>
            <time><?= date('d.m.Y \в H:i', utc_to_usertime(strtotime($tournament->end_reg_time))); ?> (UTC<?= utc_value(); ?>)</time>
          <?php endif; ?>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начало', 'earena_2' ); ?>
          <?php if (!empty($tournament->start_time)): ?>
            <time><?= date('d.m.Y \в H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)</time>
          <?php endif; ?>
        </div>
      <?php elseif ($tournament_present) : ?>
        <div class="tournament__status tournament__status--page tournament__status--present">
          <?php _e( 'Проходит', 'earena_2' ); ?>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начался', 'earena_2' ); ?>
          <?php if (!empty($tournament->start_time)): ?>
            <time><?= date('d.m.Y \в H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)</time>
          <?php endif; ?>
        </div>
      <?php elseif ($tournament_ended) : ?>
        <div class="tournament__status tournament__status--page tournament__status--past">
          <?php _e( 'Завершился', 'earena_2' ); ?>
          <?php if (!empty($tournament->end_time)): ?>
            <time><?= date('d.m.Y \в H:i', utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)</time>
          <?php endif; ?>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начался', 'earena_2' ); ?>
          <?php if (!empty($tournament->start_time)): ?>
            <time><?= date('d.m.Y \в H:i', utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)</time>
          <?php endif; ?>
        </div>
      <?php elseif ($tournament_cancel) : ?>
        <div class="tournament__status tournament__status--page tournament__status--past">
          <?php _e( 'Отменен', 'earena_2' ); ?>
        </div>
        <div class="tournament__info tournament__info--page">
          ---
        </div>
      <?php elseif ($tournament_waiting): ?>
        <div class="tournament__status tournament__status--page tournament__status--future">
          <?php _e( 'Ожидает публикации', 'earena_2' ); ?>
        </div>
        <div class="tournament__info tournament__info--page">
          ---
        </div>
      <?php endif; ?>

      <div class="players players--page">
        <?php
          $counter_players = count( json_decode($tournament->players, true) ?: [] );
        ?>
        <div class="players__progress">
          <span class="players__progress-bar" data-width="<?= ($counter_players / (int)$tournament->max_players * 100); ?>"></span>
        </div>
        <div class="players__text">
          <?= $counter_players; ?>
          /
          <?= $tournament->max_players; ?>
        </div>
      </div>

      <div class="tournament__content">
        <table>
          <tbody>
            <tr>
              <td>
                <?php _e('Регламент турнира', 'earena'); ?>
              </td>
              <td>
                <?php if ($is_tournament_simple): ?>
                  <?php if ($tournament->reglament == 'r1'): ?>
                    <?= __('1 круг — матч с каждым игроком', 'earena'); ?>
                  <?php elseif ($tournament->reglament == 'r2') : ?>
                    <?= __('2 круга — матч с каждым игроком', 'earena'); ?>
                  <?php else: ?>
                    ???
                  <?php endif; ?>
                <?php elseif ($is_tournament_lucky_cup) : ?>
                  ВО-1
                <?php elseif ($is_tournament_cup) : ?>
                  <?= $tournament->reglament == 'bo1' ? 'BO-1' : ($tournament->reglament == 'bo3' ? 'BO-3' : '???'); ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <td>
                <?php _e('Длительность раунда', 'earena'); ?>
              </td>
              <td>
                <?php if ($is_tournament_simple): ?>
                  <?php if (texttotime($tournament->round_time) >= 86400): ?>
                    <?= pluralize(date('d', texttotime($tournament->round_time)) - 1/*$kostyl*/, __('день', 'earena'), __('дня', 'earena'), __('дней', 'earena')) . ', '; ?>
                  <?php elseif (texttotime($tournament->round_time) >= 3600): ?>
                    <?= pluralize(date('H', texttotime($tournament->round_time)), __('час', 'earena'), __('часа', 'earena'), __('часов', 'earena')) . ', '; ?>
                  <?php endif; ?>

                  <?= pluralize(date('i', texttotime($tournament->round_time)), __('минута', 'earena'), __('минуты', 'earena'), __('минут', 'earena')); ?>
                <?php elseif ($is_tournament_lucky_cup) : ?>
                  Fast
                <?php elseif ($is_tournament_cup) : ?>
                  <?= (texttotime($tournament->round_time) >= 86400 ? pluralize(date('d', texttotime($tournament->round_time)) - 1
                              /*$kostyl*/, __('день', 'earena'), __('дня', 'earena'), __('дней',
                                  'earena')) . ', ' : '') . (texttotime($tournament->round_time) >= 3600 ? pluralize(date('H',
                              texttotime($tournament->round_time)), __('час', 'earena'), __('часа', 'earena'),
                              __('часов', 'earena')) . ', ' : '') . pluralize(date('i', texttotime($tournament->round_time)),
                          __('минута', 'earena'), __('минуты', 'earena'), __('минут', 'earena')); ?>
                <?php endif; ?>
              </td>
            </tr>
          </tbody>
        </table>

        <?php if ($description): ?>
          <p>
            <?= $description; ?>
          </p>
        <?php endif; ?>
      </div>


      <footer class="tournament__bottom tournament__bottom--page">
        <div class="tournament__bottom-left tournament__bottom-left--page">
          <div class="tournament__bet tournament__bet--page">
            <?= !empty($tournament->price) ? ('$' . earena_2_nice_money( $tournament->price )) : 'Free'; ?>
          </div>

          <div class="tournament__id tournament__id--page">
            ID <?= $tournament->ID; ?>
          </div>
        </div>

        <?php
          $button_data_popup = 'tournament';
          if (!is_user_logged_in()) {
            $button_data_popup = 'login';
            $button_name = 'signin';
          } elseif (is_user_logged_in() && (!in_array($tournament->platform, ea_my_platforms($tournament->game)) || !in_array($tournament->game, ea_my_games()))) {
            $button_name = 'no-game-or-platform';
          } elseif (is_user_logged_in() && isset($ea_user) && ((int)$ea_user->get('vip') < (int)$tournament->vip)) {
            $button_name = 'no-vip';
          } elseif ((int)$tournament->price > 0 && is_user_logged_in() && isset($ea_user) && !ea_check_user_age($ea_user->ID)) {
            $button_name = 'no-old-enough';
          } elseif (is_user_logged_in() && isset($ea_user) && (int)$ea_user->get('bp_verified_member') < (int)$tournament->verification) {
            $button_name = 'no-verification-tour';
          } else {
            $button_name = 'join';
          }

          $players = json_decode($tournament->players, true) ?: [];

          if (!is_ea_admin()) {
            if ($tournament_waiting) {
              ?>
                <button class="tournament__button button button--blue"
                  type="button" name="cancel" disabled>
                  <span>
                    <?php _e( 'Ожидает публикации', 'earena_2' ); ?>
                  </span>
                </button>
              <?php
            } elseif ($tournament_registration && ((isset($ea_user) && !in_array($ea_user->ID, $players)) || !is_user_logged_in())) {
              ?>
                <button class="tournament__button button button--blue openpopup"
                  data-popup="<?= $button_data_popup; ?>"
                  data-id="<?= $tournament->ID; ?>"
                  data-title="<?= $tournament->name; ?>"
                  data-price="<?= $tournament->price; ?>"
                  data-private="<?= $tournament->private; ?>"
                  data-verification="<?= $tournament->verification; ?>"
                  data-vip="<?= $tournament->vip; ?>"
                  data-game="<?= $games[$tournament->game]['name']; ?>"
                  data-game-mode="<?= $tournament->game_mode; ?>"
                  data-team-mode="<?= $tournament->team_mode > 0 ? team_mode_to_string($tournament->team_mode) : ''; ?>"
                  data-game="<?= $tournament->game; ?>.svg"
                  data-platform="<?= $tournament->platform; ?>"
                  type="button" name="<?= $button_name; ?>">
                  <span>
                    <?php _e( 'Регистрация', 'earena_2' ); ?> (<?= !empty($tournament->price) ? ('$' . earena_2_nice_money( $tournament->price )) : 'Free'; ?>)
                  </span>
                </button>
              <?php
            } elseif ($tournament_registration && isset($ea_user) && in_array($ea_user->ID, $players)) {
              ?>
                <button class="tournament__button button button--blue openpopup"
                  data-popup="tournament"
                  data-id="<?= $tournament->ID; ?>"
                  data-price="<?= $tournament->price; ?>"
                  type="button" name="leave">
                  <span>
                    <?php _e( 'Отменить регистрацию', 'earena_2' ); ?>
                  </span>
                </button>
              <?php
            } elseif ($tournament_present) {
              ?>
                <button class="tournament__button button button--blue openpopup" data-popup="tournament" type="button" name="registration" disabled>
                  <span>
                    <?php _e( 'Проходит', 'earena_2' ); ?>
                  </span>
                </button>
              <?php
            } elseif ($tournament_ended) {
              ?>
                <button class="tournament__button button button--gray openpopup" data-popup="tournament" type="button" name="registration" disabled>
                  <span>
                    <?php _e( 'Завершен', 'earena_2' ); ?>
                  </span>
                </button>
              <?php
            } elseif ($tournament_cancel) {
              ?>
                <button class="tournament__button button button--gray openpopup" data-popup="tournament" type="button" name="registration" disabled>
                  <span>
                    <?php _e( 'Отменен', 'earena_2' ); ?>
                  </span>
                </button>
              <?php
            }
          } else if ($tournament_registration && is_ea_admin()) {
            ?>
              <button class="tournament__button tournament__button--add-player button button--green openpopup"
                data-popup="tournament"
                data-id="<?= $tournament->ID; ?>"
                type="button" name="add-player">
                <span>
                  <?php _e( 'Добавить игрока', 'earena_2' ); ?>
                </span>
              </button>
            <?php
          }
        ?>
      </footer>
    </div>

    <?php
      // Переключатели
      get_template_part( 'template-parts/toggles/tournament' );
    ?>
  </div>
</section>
