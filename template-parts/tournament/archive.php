<?php
  /*
    Архивная карточка турнира
  */
?>
<?php
  global $games, $icons, $ea_icons, $tournament, $is_profile;

  if (!isset($is_profile)) {
    $is_profile = (earena_2_current_page( 'profile' )) ? true : false;
  }

  $is_profile_admin = (earena_2_current_page( 'admin' ) && is_ea_admin()) ? true : false;
  if (!isset($games)) {
    $games = get_site_option('games');
  }

  $ea_user = wp_get_current_user() ?? false;

  if ($ea_user) {
    $ea_user_id = $ea_user->ID ?? null;
  }

  // Status
  $tournament_waiting = ($tournament->status < 2 ) ? true : false;
  $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  $tournament_present = ($tournament->status >= 4 && $tournament->status <= 101) ? true : false;
  $tournament_end = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  $tournament_my = in_array($ea_user_id, json_decode($tournament->players, true) ?: []) ? true : false;
?>
<div class="tournament">
  <?php
    if (((int)$tournament->type == 2) && !$is_profile) {
      $tournament_url = '/tournaments/lucky-cup/?lc=' . $tournament->ID;
    } elseif (((int)$tournament->type == 3) && !$is_profile) {
      $tournament_url = '/tournaments/cup/?cup=' . $tournament->ID;
    } elseif ($is_profile && !is_ea_admin()) {
      $tournament_url = '/profile/tours/tour/?tournament=' . $tournament->ID;
    } elseif ($is_profile && is_ea_admin()) {
      $tournament_url = '/admin/tours/tour/?tournament=' . $tournament->ID;
    } else {
      $tournament_url = '/tournaments/tournament/?tournament=' . $tournament->ID;
    }
  ?>
  <a class="tournament__link <?= ($tournament_end || $tournament_cancel) ? 'tournament__link--past' : ''; ?> <?= $tournament_my ? 'tournament__link--my' : ''; ?>"
     href="<?= $tournament_url; ?>">
     <?php
       if ($is_profile && !is_ea_admin()) {
         $matches = EArena_DB::get_ea_my_tournament_matches($tournament->ID) ?? [];
         if (!empty($matches)) {
           ?>
             <span class="tournament__matches">
               <span class="visually-hidden">
                 <?php _e( 'Кол-во матчей', 'earena_2' ); ?>
               </span>
               <?= count($matches); ?>
             </span>
           <?php
         }
       } else if ($is_profile_admin) {
         $matches_not_confirmed = EArena_DB::get_ea_admin_tournament_matches_not_confirmed($tournament->ID) ?? [];
         if (!empty($matches_not_confirmed)) {
           ?>
             <span class="tournament__matches">
               <span class="visually-hidden">
                 <?php _e( 'Кол-во не подтвержденных матчей', 'earena_2' ); ?>
               </span>
               <?= count($matches_not_confirmed); ?>
             </span>
           <?php
         }
       }
     ?>
    <div class="tournament__top">
      <div class="tournament__image">
        <img src="<?= wp_get_attachment_url($tournament->cover1); ?>" alt="<?= $games[$tournament->game]['name']; ?>">
      </div>
      <div class="tournament__labels tournament__labels--archive">
        <?php if ( $tournament->verification ): ?>
          <span class="verify verify--true verify--tournament"></span>
        <?php endif; ?>

        <?php if ( $tournament->vip ): ?>
          <span class="vip vip--tournament">
            vip
          </span>
        <?php endif; ?>
      </div>

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
          ---
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
      <div class="tournament__bottom-left tournament__bottom-left--archive">
        <h3 class="tournament__game">
          <?= $games[$tournament->game]['name']; ?>
        </h3>
        <ul class="variations <?php if ( $tournament->private ) echo 'variations--lock'; ?>">
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

      <div class="platform platform--tournament">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-<?= $ea_icons['platform'][(int)$tournament->platform]; ?>"></use>
        </svg>
      </div>

      <div class="tournament__id tournament__id--archive">
        ID <?= $tournament->ID; ?>
      </div>

      <div class="tournament__bet tournament__bet--archive">
        <?= !empty($tournament->price) ? '$' . earena_2_nice_money($tournament->price) : 'Free'; ?>
      </div>
    </div>
  </a>
</div>
