<?php
  /*
    Таблица Наград
  */
?>

<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $tournament_schedule_complete = ($tournament->status >= 5 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;

  /* TYPE */
  $is_tournament_simple = ((int)$tournament->type === 1) ? true : false;
  $is_tournament_lucky_cup = ((int)$tournament->type === 2) ? true : false;
  $is_tournament_cup = ((int)$tournament->type === 3) ? true : false;
?>

<table class="table table--awards">
  <caption class="table__caption">
    <?php _e( 'Награды', 'earena_2' ); ?>
  </caption>

  <tbody class="table__body">
    <?php
      $awards = ['gold', 'silver', 'bronze'];

      if ($is_tournament_cup || $is_tournament_lucky_cup) {
        $awards = ['gold', 'silver'];
      }
    ?>
    <?php if (!$tournament_schedule_complete && !$tournament_ended && !$tournament_cancel): ?>
      <?php
        for ($i=0; $i <= 3; $i++) {
          if (!isset($awards[$i]) && !$is_tournament_simple) {
            break;
          }
          ?>
            <tr class="table__row table__row--border">
              <td class="table__column table__column--td table__column--medal">
                <?php if (isset($awards[$i])): ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $awards[$i]; ?>.svg" alt="Medal">
                <?php elseif ($is_tournament_simple): ?>
                  <span>-</span>
                <?php endif; ?>
              </td>
              <td class="table__column table__column--td table__column--user">
              </td>
              <td class="table__column table__column--td table__column--award">
              </td>
            </tr>
          <?php
        }
      ?>
    <?php elseif ($tournament_schedule_complete): ?>
      <?php
        $prizes = json_decode($tournament->prizes, true) ?: [];

        for ($i=0; $i < count($prizes); $i++) {
          ?>
            <tr class="table__row table__row--border">
              <td class="table__column table__column--td table__column--medal">
                <?php if (isset($awards[$i])): ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $awards[$i]; ?>.svg" alt="Medal">
                <?php else: ?>
                  <span><?= $i + 1; ?></span>
                <?php endif; ?>
              </td>
              <td class="table__column table__column--td table__column--user">
              </td>
              <td class="table__column table__column--td table__column--award">
                <?php if (isset($prizes[$i])): ?>
                  <?php if ($tournament->prize_type == 'prize'): ?>
                    <?= $prizes[$i]; ?>
                  <?php else: ?>
                    $<?= earena_2_nice_money( round(($prizes[$i] * $tournament->prize / 100), 2) ); ?>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php
        }
      ?>
    <?php elseif ($tournament_ended || $tournament_cancel): ?>
      <?php
        $prizes = json_decode($tournament->prizes, true) ?: [];
        $winners = json_decode($tournament->winners, true) ?: [];

        for ($i=0; $i < count($prizes); $i++) {
          ?>
            <tr class="table__row table__row--border">
              <td class="table__column table__column--td table__column--medal">
                <?php if (isset($awards[$i])): ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $awards[$i]; ?>.svg" alt="Medal">
                <?php else: ?>
                  <span><?= $i + 1; ?></span>
                <?php endif; ?>
              </td>
              <td class="table__column table__column--td table__column--user">
                <a class="table__user" href="<?= ea_user_link($winners[$i]); ?>">
                  <div class="table__user-image <?= (is_online($winners[$i]) ? 'table__user-image--online' : ''); ?>">
                    <span>
                      <?= bp_core_fetch_avatar('item_id=' . $winners[$i]); ?>
                    </span>
                  </div>
                  <h5 class="table__user-name">
                    <?= ea_game_nick($tournament->game, $tournament->platform, $winners[$i]); ?>
                  </h5>
                </a>
              </td>
              <td class="table__column table__column--td table__column--award">
                <?php if (isset($prizes[$i])): ?>
                  <?php if ($tournament->prize_type == 'prize'): ?>
                    <?= $prizes[$i]; ?>
                  <?php else: ?>
                    $<?= earena_2_nice_money( round(($prizes[$i] * $tournament->prize / 100), 2) ); ?>
                  <?php endif; ?>
                <?php endif; ?>
              </td>
            </tr>
          <?php
        }
      ?>
    <?php endif; ?>
  </tbody>
</table>
