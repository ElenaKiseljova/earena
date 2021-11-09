<?php
  /*
    Архивная карточка турнира (Админ)
  */
?>
<?php
  global $games, $icons, $ea_icons, $tournament;

  if (!isset($games)) {
    $games = get_site_option('games');
  }

  $ea_user = wp_get_current_user() ?? false;

  if ($ea_user) {
    $ea_user_id = $ea_user->ID ?? null;
  }

  // Status
  $tournament_planned = ($tournament->status == 0 ) ? true : false;
  $tournament_waiting = ($tournament->status == 1 ) ? true : false;
  $tournament_registration = ($tournament->status > 1 && $tournament->status < 4) ? true : false;
  $tournament_present = ($tournament->status >= 4 && $tournament->status <= 101) ? true : false;
  $tournament_end = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  $is_lucky_cup = (int)$tournament->type === 2;

  $id = uniqidReal();
  if ($tournament_planned) {
      $status_data = 4;
  } elseif ($tournament_waiting) {
      $status_data = 5;
  } elseif ($tournament_registration) {
      $status_data = 1;
  } elseif ($tournament_present) {
      $status_data = 2;
  } elseif ($tournament_end) {
      $status_data = 3;
  } elseif ($tournament_cancel) {
      $status_data = 6;
  }

  $game_data = $tournament->game;
  $platform_data = $tournament->platform;

  if ($tournament->price == 0) {
      $amount_data = 0;
  } elseif ($tournament->price > 0 && $tournament->price < 10) {
      $amount_data = 1;
  } elseif ($tournament->price >= 10 && $tournament->price < 100) {
      $amount_data = 2;
  } elseif ($tournament->price > 100) {
      $amount_data = 3;
  } else {
      $amount_data = 4;
  }
?>
<div class="tournament tournament--admin"
     id="<?= $id; ?>"
     data-id="<?= ($tournament->status > 0) ? $tournament->ID : 'null'; ?>"
     data-platform="<?= $platform_data; ?>"
     data-game="<?= $game_data; ?>"
     data-type="<?= $tournament->type; ?>"
     data-status="<?= $status_data; ?>"
     data-bet="<?= $amount_data; ?>"
     data-private="<?= $tournament->private ?: 0; ?>"
     data-vip="<?= $tournament->vip ?: 0; ?>"
     data-game_mode="<?= $tournament->game_mode; ?>"
     data-team_mode="<?= $tournament->team_mode; ?>"
     >
  <?php
    if (((int)$tournament->type == 2)) {
      $tournament_url = '/tournaments/lucky-cup/?lc=' . $tournament->ID;
    } elseif (((int)$tournament->type == 3)) {
      $tournament_url = '/tournaments/cup/?cup=' . $tournament->ID;
    } else {
      $tournament_url = '/tournaments/tournament/?tournament=' . $tournament->ID;
    }
  ?>
  <div class="tournament__top tournament__top--admin">
    <div class="tournament__top-left tournament__top-left--admin">
      <h4 class="tournament__name tournament__name--admin <?= $tournament->private ? 'tournament__name--lock' : ''; ?>">
        <a href="<?= $tournament_url; ?>">
          <?= $tournament->name; ?>
        </a>
      </h4>
      <span class="tournament__top-trophy">
        $<?= earena_2_nice_money( max($tournament->prize, $tournament->garant) ); ?>
      </span>
    </div>
    <div class="tournament__top-right tournament__top-right--admin">
      <div class="tournament__status tournament__status--admin">
        <?php if ($tournament_planned): ?>
          <span class="tournament__status-planned">
            <?php _e('Запланирован', 'earena'); ?>
          </span>
        <?php elseif ($tournament_waiting): ?>
          <span class="tournament__status-waiting">
            <?php _e('Ожидает публикации', 'earena'); ?>
          </span>
        <?php elseif ($tournament_registration): ?>
          <span class="tournament__status-registration">
            <?php _e('Регистрация', 'earena'); ?>
            (<?= count(json_decode($tournament->players, true) ?: []); ?>/<?= $tournament->max_players; ?>)
          </span>
        <?php elseif ($tournament_present): ?>
          <span class="tournament__status-present">
            <?php _e('Проходит', 'earena'); ?>
          </span>
        <?php elseif ($tournament_end): ?>
          <span class="tournament__status-end">
            <?php _e('Завершен', 'earena'); ?>
          </span>
        <?php elseif ($tournament_cancel): ?>
          <span class="tournament__status-cancel">
            <?php _e('Отменен', 'earena'); ?>
          </span>
        <?php endif; ?>

        <?php if ($tournament_planned && !$is_lucky_cup): ?>
          <span>
            <time>
              <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->start_reg_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->start_reg_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>
        <?php elseif ($tournament_waiting && !$is_lucky_cup): ?>
          <span>
            <time>
              <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->start_reg_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->start_reg_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>
        <?php elseif ($tournament_registration && !$is_lucky_cup): ?>
          <span>
            <?php _e('до', 'earena'); ?>
            <time>
               <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->end_reg_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->end_reg_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>

          <span>
            <?php _e('Начало турнира', 'earena'); ?>:
            <time>
              <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->start_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>
        <?php elseif ($tournament_present && !$is_lucky_cup): ?>
          <span>
            <?php _e('до', 'earena'); ?>
            <time>
              <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->end_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>
        <?php elseif ($tournament_end): ?>
          <span>
            <time>
              <?= date('d.m.Y',
                  utc_to_usertime(strtotime($tournament->end_time))); ?> – <?= date('H:i',
                  utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
            </time>
          </span>
        <?php endif; ?>
      </div>

      <?php
        if ($tournament_planned) {
          $cron_time = $tournament->cron_time;
          unset($tournament->cron_time);
          ?>
            <button class="tournament__cross openpopup"
              data-popup="tournament"
              data-parentid="<?= $id; ?>"
              data-crontime="<?= $cron_time; ?>"
              data-cron="<?= serialize((array)$tournament); ?>"
              type="button" name="delete-cron" title="<?php _e( 'Удалить CRON', 'earena_2' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Удалить CRON', 'earena_2' ); ?>
              </span>
            </button>
          <?php
        } elseif ($tournament_waiting) {
          ?>
            <button class="tournament__cross openpopup"
              data-popup="tournament"
              data-parentid="<?= $id; ?>"
              data-id="<?= $tournament->ID; ?>"
              type="button" name="delete-tournament" title="<?php _e( 'Удалить турнир', 'earena_2' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Удалить турнир', 'earena_2' ); ?>
              </span>
            </button>
          <?php
        } elseif ($tournament_registration) {
          ?>
            <button class="tournament__cross openpopup"
              data-popup="tournament"
              data-parentid="<?= $id; ?>"
              data-id="<?= $tournament->ID; ?>"
              type="button" name="cancel" title="<?php _e( 'Отменить турнир', 'earena_2' ); ?>">
              <span class="visually-hidden">
                <?php _e( 'Отменить турнир', 'earena_2' ); ?>
              </span>
            </button>
          <?php
        }
      ?>
    </div>
  </div>
  <div class="tournament__bottom tournament__bottom--admin">
    <div class="platform platform--admin">
      <svg class="platform__icon" width="44" height="44">
        <use xlink:href="#icon-platform-<?= $ea_icons['platform'][(int)$tournament->platform]; ?>"></use>
      </svg>
    </div>

    <div class="tournament__bottom-left tournament__bottom-left--admin">
      <h3 class="tournament__game tournament__game--admin">
        <?= $games[$tournament->game]['name']; ?>
      </h3>

      <div class="tournament__id tournament__id--admin">
        ID <?= $tournament->ID; ?>
      </div>

      <div class="tournament__bet tournament__bet--admin">
        <?= !empty($tournament->price) ? '$' . earena_2_nice_money($tournament->price) : 'Free'; ?>
      </div>
    </div>

    <div class="tournament__bottom-right tournament__bottom-right--admin">
      <div class="tournament__labels tournament__labels--admin">
        <?php if ( $tournament->verification ): ?>
          <span class="verify verify--true verify--tournament"></span>
        <?php endif; ?>

        <?php if ( $tournament->vip ): ?>
          <span class="vip vip--tournament">
            vip
          </span>
        <?php endif; ?>
      </div>
      <ul class="variations variations--admin">
        <li class="variations__item variations__item--admin">
          <?= $tournament->game_mode; ?> vs <?= $tournament->game_mode; ?>
        </li>
        <?php if ($tournament->team_mode > 0): ?>
          <li class="variations__item variations__item--admin">
            <?= team_mode_to_string($tournament->team_mode); ?>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>
