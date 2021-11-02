<?php
  /*
    Таблица Рейтинга
  */
?>
<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $tournament_schedule_complete = ($tournament->status >= 5 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;
?>

<table class="table table--rating">
  <caption class="table__caption visually-hidden">
    <?php _e( 'Рейтинг', 'earena_2' ); ?>
  </caption>
  <thead class="table__head table__head--rating">
    <tr class="table__row">
      <th class="table__column table__column--1 table__column--th">
        <?php _e( 'Место', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--2 table__column--th">
        <?php _e( 'Участник', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--3 table__column--th">
        <?php _e( 'Игр', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--4 table__column--th">
        <?php _e( 'Побед', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--5 table__column--th">
        <?php _e( 'Ничьих', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--6 table__column--th">
        <?php _e( 'Поражений', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--7 table__column--th">
        <?php _e( 'Голы', 'earena_2' ); ?>
      </th>
      <th class="table__column table__column--8 table__column--th">
        <?php _e( 'Очков', 'earena_2' ); ?>
      </th>
    </tr>
  </thead>
  <tbody class="table__body table__body--rating">
    <?php
      if (!$tournament_schedule_complete && !$tournament_ended && !$tournament_cancel) {
        $players = json_decode($tournament->players, true) ?: [];

        for ($i=0; $i < $tournament->max_players; $i++) {
          ?>
            <tr class="table__row table__row--rating <?= (!empty($players[$i]) && (int)$players[$i] == $ea_user->ID) ? 'table__row--your' : ''; ?>">
              <td class="table__column table__column--1 table__column--td table__column--small">
                <?= ($i + 1); ?>
              </td>
              <td class="table__column table__column--2 table__column--td table__column--small">
                <?php if (!empty($players[$i])): ?>
                  <a class="table__user" href="<?= ea_user_link($players[$i]); ?>">
                    <div class="table__user-image <?= (is_online($players[$i]) ? 'table__user-image--online' : ''); ?>">
                      <span>
                        <?= bp_core_fetch_avatar('item_id=' . $players[$i]); ?>
                      </span>
                    </div>
                    <h5 class="table__user-name">
                      <?= ea_game_nick($tournament->game, $tournament->platform, $players[$i]); ?>
                    </h5>
                  </a>
                <?php endif; ?>
              </td>
              <td class="table__column table__column--3 table__column--td table__column--small">
              </td>
              <td class="table__column table__column--4 table__column--td table__column--small">
              </td>
              <td class="table__column table__column--5 table__column--td table__column--small">
              </td>
              <td class="table__column table__column--6 table__column--td table__column--small">
              </td>
              <td class="table__column table__column--7 table__column--td table__column--small">
              </td>
              <td class="table__column table__column--8 table__column--td table__column--small">
                <?= (!empty($players[$i]) ? '0' : ''); ?>
              </td>
            </tr>
          <?php
        }
      } elseif ($tournament_schedule_complete || $tournament_ended || $tournament_cancel) {
        $score = json_decode($tournament->score, true) ?: [];

        array_multisort(
            array_column($score, 'score'), SORT_DESC,
            array_column($score, 'win'), SORT_DESC,
            array_column($score, 'lose'), SORT_ASC,
            array_column($score, 'goals_from'), SORT_DESC,
            array_column($score, 'goals_to'), SORT_ASC,
            $score);
        $players = array_keys($score);

        foreach ($players as $player_index => $player) {
          $player_id = (int)preg_replace('/\D/', '', $player) ?: 0;
          ?>
            <tr class="table__row table__row--rating <?= ($player_id == $ea_user->ID) ? 'table__row--your' : ''; ?>">
              <td class="table__column table__column--1 table__column--td table__column--small">
                <?= ++$player_index; ?>
              </td>
              <td class="table__column table__column--2 table__column--td table__column--small">
                <a class="table__user" href="<?= ea_user_link($player_id); ?>">
                  <div class="table__user-image <?= (is_online($player_id) ? 'table__user-image--online' : ''); ?>">
                    <span>
                      <?= bp_core_fetch_avatar('item_id=' . $player_id); ?>
                    </span>
                  </div>
                  <h5 class="table__user-name">
                    <?= ea_game_nick($tournament->game, $tournament->platform, $player_id); ?>
                  </h5>
                </a>
              </td>
              <td class="table__column table__column--3 table__column--td table__column--small">
                <?= $score['id' . $player_id]['matches']; ?>
              </td>
              <td class="table__column table__column--4 table__column--td table__column--small">
                <?= $score['id' . $player_id]['win']; ?>
              </td>
              <td class="table__column table__column--5 table__column--td table__column--small">
                <?= $score['id' . $player_id]['draw']; ?>
              </td>
              <td class="table__column table__column--6 table__column--td table__column--small">
                <?= $score['id' . $player_id]['lose']; ?>
              </td>
              <td class="table__column table__column--7 table__column--td table__column--small">
                <?= $score['id' . $player_id]['goals_from'] . ' : ' . $score['id' . $player_id]['goals_to']; ?>
              </td>
              <td class="table__column table__column--8 table__column--td table__column--small">
                <?= $score['id' . $player_id]['score']; ?>
              </td>
            </tr>
          <?php
        }
      }
    ?>
  </tbody>
</table>
