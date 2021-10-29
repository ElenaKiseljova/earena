<?php
  /*
    Аккордеон (стр Тура)
  */
?>
<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $tournament_waiting = ($tournament->status < 2) ? true : false;
  $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  $tournament_schedule_complete = ($tournament->status >= 5 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  $tours = json_decode($tournament->tours, true) ?: [];
?>

<div class="accordeon accordeon--tournament">
  <ul class="accordeon__list">
    <?php
      foreach ($tours as $tour_index => $tour) {
        if ($tournament_waiting || $tournament_registration) {
          ?>
          <li class="accordeon__item <?= (in_range(time(), $tour['t1'], $tour['t2']) ? ' ea-tab-active' : ''); ?>">
            <button class="accordeon__button accordeon__button--future" disabled type="button" name="accordeon">
              <span class="accordeon__round">
                <?= ++$tour_index . __( ' тур', 'earena_2' ); ?>
              </span>
              <time class="accordeon__date">
                <?=
                  (date('d.m.Y',
                  utc_to_usertime($tour['t2'])) == date('d.m.Y',
                  utc_to_usertime($tour['t1'])) ? date('H:i',
                  utc_to_usertime($tour['t2'])) : date('d.m.Y  H:i',
                  utc_to_usertime($tour['t2'])));
                ?>
              </time>
            </button>
          <?php
        } elseif ($tournament_schedule_complete || $tournament_ended || $tournament_cancel) {
          $tour_matches = array_column(EArena_DB::get_ea_tournament_matches_for_tour($tournament_id, $tour_index), 'ID') ?? [];
          ?>
            <li class="accordeon__item <?= (in_range(time(), $tour['t1'], $tour['t2']) ? ' ea-tab-active' : ''); ?>">
              <button class="accordeon__button accordeon__button--present" type="button" name="accordeon">
                <span class="accordeon__round">
                  <?= ++$tour_index . __( ' тур', 'earena_2' ); ?>
                </span>

                <?php if ($tour['t2'] < time()): ?>
                  <span class="accordeon__status">
                    <?php _e( 'Завершен', 'earena_2' ); ?>
                  </span>
                <?php endif; ?>
                <time class="accordeon__date">
                  <?=
                    (date('d.m.Y',
                    utc_to_usertime($tour['t2'])) == date('d.m.Y',
                    utc_to_usertime($tour['t1'])) ? date('H:i',
                    utc_to_usertime($tour['t2'])) : date('d.m.Y  H:i',
                    utc_to_usertime($tour['t2'])));
                  ?>
                </time>
              </button>
              <ul class="accordeon__content">
                <?php if (!empty($tour_matches)): ?>
                  <?php foreach ($tour_matches as $tour_match_index => $tour_match): ?>
                    <?php
                      $match = EArena_DB::get_ea_tournament_match_score($tour_match);
                    ?>
                    <li class="accordeon__content-item">
                      <a class="accordeon__user accordeon__user--left" href="<?= ea_user_link($match->player1); ?>">
                        <div class="accordeon__user-image <?= is_online($match->player1) ? 'accordeon__user-image--online' : ''; ?>">
                          <span>
                            <?= bp_core_fetch_avatar('item_id=' . $match->player1); ?>
                          </span>
                        </div>
                        <h5 class="accordeon__user-name">
                          <?= ea_game_nick($tournament->game, $tournament->platform, $match->player1); ?>
                        </h5>
                      </a>

                      <div class="accordeon__result">
                        <?php if (isset($match->score1) && isset($match->score2) && ($tournament_ended || $tournament_cancel)): ?>
                          <span class="accordeon__result-text">
                            <?= $match->score1; ?> : <?= $match->score2; ?>
                          </span>
                        <?php else: ?>
                          <span class="accordeon__result-text">
                            vs
                          </span>
                        <?php endif; ?>
                      </div>

                      <a class="accordeon__user accordeon__user--right" href="<?= ea_user_link($match->player2); ?>">
                        <div class="accordeon__user-image <?= is_online($match->player1) ? 'accordeon__user-image--online' : ''; ?>">
                          <span>
                            <?= bp_core_fetch_avatar('item_id=' . $match->player2); ?>
                          </span>
                        </div>
                        <h5 class="accordeon__user-name">
                          <?= ea_game_nick($tournament->game, $tournament->platform, $match->player2); ?>
                        </h5>
                      </a>

                      <?php if ((isset($ea_user->ID) && ((int)$match->player1 == $ea_user->ID || (int)$match->player2 == $ea_user->ID) && strtotime($match->end_time) > time()) || is_ea_admin()): ?>
                        <a class="accordeon__chat accordeon__chat--tournament button button--gray" href="<?= bloginfo( 'url' ) . '/tournaments/tournament/match/?match=' . $match->ID; ?>">
                          <?php if (ea_count_unread($match->thread_id) > 0): ?>
                            <span class="button__chat button__chat--right">
                              <?= ea_count_unread($match->thread_id); ?>
                            </span>
                          <?php endif; ?>
                          <span>
                            <?php _e( 'В чат', 'earena_2' ); ?>
                          </span>
                        </a>
                      <?php endif; ?>
                    </li>
                  <?php endforeach; ?>
                <?php else: ?>
                  <?php
                    $schedules = json_decode($tournament->schedule, true) ?: [];
                  ?>
                  <?php foreach ($schedules[$tour_index] as $schedule_index => $schedule): ?>
                    <?php
                      $match = new stdClass();
                      $match->player1 = $schedule['Home'];
                      $match->player2 = $schedule['Away'];
                    ?>
                    <?php if ($match->player1 !== 'RELAX' && $match->player2 !== 'RELAX'): ?>
                      <li class="accordeon__content-item">
                        <a class="accordeon__user accordeon__user--left" href="<?= ea_user_link($match->player1); ?>">
                          <div class="accordeon__user-image <?= is_online($match->player1) ? 'accordeon__user-image--online' : ''; ?>">
                            <span>
                              <?= bp_core_fetch_avatar('item_id=' . $match->player1); ?>
                            </span>
                          </div>
                          <h5 class="accordeon__user-name">
                            <?= ea_game_nick($tournament->game, $tournament->platform, $match->player1); ?>
                          </h5>
                        </a>

                        <div class="accordeon__result">
                          <span class="accordeon__result-text">
                            vs
                          </span>
                        </div>

                        <a class="accordeon__user accordeon__user--right" href="<?= ea_user_link($match->player2); ?>">
                          <div class="accordeon__user-image <?= is_online($match->player1) ? 'accordeon__user-image--online' : ''; ?>">
                            <span>
                              <?= bp_core_fetch_avatar('item_id=' . $match->player2); ?>
                            </span>
                          </div>
                          <h5 class="accordeon__user-name">
                            <?= ea_game_nick($tournament->game, $tournament->platform, $match->player2); ?>
                          </h5>
                        </a>
                      </li>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php endif; ?>
              </ul>
            </li>
          <?php
        }
      }
    ?>
  </ul>
</div>
