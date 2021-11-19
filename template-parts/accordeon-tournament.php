<?php
  /*
    Аккордеон (стр Тура)
  */
?>
<?php
  global $tournament, $tournament_id, $tournament_matches, $icons, $ea_icons, $ea_user;

  $tournament_waiting = ($tournament->status < 2) ? true : false;
  $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  $tournament_schedule_complete = ($tournament->status >= 5 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  /* TYPE */
  $is_tournament_simple = ((int)$tournament->type === 1) ? true : false;
  $is_tournament_lucky_cup = ((int)$tournament->type === 2) ? true : false;
  $is_tournament_cup = ((int)$tournament->type === 3) ? true : false;

  $tournament_matches = $tournament_matches ?? [];
?>

<div class="accordeon accordeon--tournament">
  <ul class="accordeon__list">
    <?php
      if ($is_tournament_simple || $is_tournament_cup) {
        $tours = json_decode($tournament->tours, true) ?: [];
        foreach ($tours as $tour_index => $tour) {
          if ($tournament_waiting || $tournament_registration) {
            ?>
            <li class="accordeon__item ">
              <button class="accordeon__button accordeon__button--future" disabled type="button" name="accordeon">
                <span class="accordeon__round">
                  <?= ($tour_index + 1) . __( ' тур', 'earena_2' ); ?>
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
                  <?php if ($is_tournament_simple): ?>
                    <span class="accordeon__round">
                      <?= ($tour_index + 1) . __( ' тур', 'earena_2' ); ?>
                    </span>
                  <?php elseif ($is_tournament_cup) : ?>
                    <?php $fin = (2 ** (count($tours) - $tour_index - 1)); ?>
                    <span class="accordeon__round">
                      <?= ($tour_index + 1) . ' ' . __('раунд', 'earena') . ' (' . ($fin > 1 ? '1/' . $fin : __('Финал', 'earena')) . ')'; ?>
                    </span>
                  <?php endif; ?>

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
                          <?php if (isset($match->score1) && isset($match->score2)): ?>
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
      } else if ($is_tournament_lucky_cup) {
        // Максимум 4 игрока. 3 матча: 2 в полуфинале и 1 - финальный
        $tournament_1_2 = [];
        $tournament_final_matches = [];
        foreach ($tournament_matches as $tournament_match_index => $tournament_match) {
          if ($tournament_match_index < 2) {
            array_push($tournament_1_2, $tournament_match);
          } else {
            array_push($tournament_final_matches, $tournament_match);
          }
        }

        if (!empty($tournament_1_2)) {
          ?>
            <li class="accordeon__item">
              <button class="accordeon__button accordeon__button--present" type="button" name="accordeon">
                <span class="accordeon__round">
                  1/2
                </span>

                <?php if (($tournament_matches[0]->status > 100) && ($tournament_matches[1]->status > 100)): ?>
                  <span class="accordeon__status">
                    <?php _e( 'Завершен', 'earena_2' ); ?>
                  </span>
                <?php endif; ?>
                <time class="accordeon__date">
                  <?php
                    echo date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[0]->start_time))) . ' - ' . ((isset($tournament_matches[1]->end_time)) ? date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[1]->end_time))) : date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[1]->start_time))));
                  ?>
                </time>
              </button>
              <ul class="accordeon__content">
                <?php foreach ($tournament_1_2 as $match): ?>
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
                      <?php if (isset($match->score1) && isset($match->score2)): ?>
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
              </ul>
            </li>
          <?php
        }

        if (!empty($tournament_final_matches)) {
          ?>
            <li class="accordeon__item">
              <button class="accordeon__button accordeon__button--present" type="button" name="accordeon">
                <span class="accordeon__round">
                  <?php _e( 'Финал', 'earena_2' ); ?>
                </span>

                <?php if ($tournament_matches[2]->status > 100): ?>
                  <span class="accordeon__status">
                    <?php _e( 'Завершен', 'earena_2' ); ?>
                  </span>
                <?php endif; ?>
                <time class="accordeon__date">
                  <?php
                    echo date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[2]->start_time))) . ' - ' . ((isset($tournament_matches[2]->end_time)) ? date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[2]->end_time))) : date('d.m.Y', utc_to_usertime(strtotime($tournament_matches[2]->start_time))));
                  ?>
                </time>
              </button>
              <ul class="accordeon__content">
                <?php foreach ($tournament_final_matches as $match): ?>
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
                      <?php if (isset($match->score1) && isset($match->score2)): ?>
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
              </ul>
            </li>
          <?php
        }
      }
    ?>
  </ul>
</div>
