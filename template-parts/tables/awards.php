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
      $awards = ['gold', 'silver', 'bronze', null];

      if ($is_tournament_lucky_cup) {
        $awards = ['gold', 'silver'];
      }
    ?>
    <?php if (!$tournament_schedule_complete && !$tournament_ended && !$tournament_cancel): ?>
      <?php foreach ($awards as $award_index => $award): ?>
        <tr class="table__row table__row--border">
          <td class="table__column table__column--td table__column--medal">
            <?php if (isset($award)): ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $award; ?>.svg" alt="Medal">
            <?php else: ?>
              4-6
            <?php endif; ?>
          </td>
          <td class="table__column table__column--td table__column--user">
          </td>
          <td class="table__column table__column--td table__column--award">
          </td>
        </tr>
      <?php endforeach; ?>
    <?php elseif ($tournament_schedule_complete): ?>
      <?php
        $prizes = json_decode($tournament->prizes, true) ?: [];
      ?>
      <?php foreach ($awards as $award_index => $award): ?>
        <tr class="table__row table__row--border">
          <td class="table__column table__column--td table__column--medal">
            <?php if (isset($award)): ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $award; ?>.svg" alt="Medal">
            <?php else: ?>
              4-6
            <?php endif; ?>
          </td>
          <td class="table__column table__column--td table__column--user">
          </td>
          <td class="table__column table__column--td table__column--award">
            <?php if (isset($prizes[$award_index])): ?>
              $<?= earena_2_nice_money( round(($prizes[$award_index] * $tournament->prize / 100), 2) ); ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php elseif ($tournament_ended || $tournament_cancel): ?>
      <?php
        $prizes = json_decode($tournament->prizes, true) ?: [];
        $winners = json_decode($tournament->winners, true) ?: [];
      ?>
      <?php foreach ($awards as $award_index => $award): ?>
        <tr class="table__row table__row--border">
          <td class="table__column table__column--td table__column--medal">
            <?php if (isset($award)): ?>
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/medal-<?= $award; ?>.svg" alt="Medal">
            <?php else: ?>
              4-6
            <?php endif; ?>
          </td>
          <td class="table__column table__column--td table__column--user">
            <?php if (isset($winners[$award_index]) && $award_index < 3): ?>
              <a class="table__user" href="<?= ea_user_link($winners[$award_index]); ?>">
                <div class="table__user-image <?= (is_online($winners[$award_index]) ? 'table__user-image--online' : ''); ?>">
                  <span>
                    <?= bp_core_fetch_avatar('item_id=' . $winners[$award_index]); ?>
                  </span>
                </div>
                <h5 class="table__user-name">
                  <?= ea_game_nick($tournament->game, $tournament->platform, $winners[$award_index]); ?>
                </h5>
              </a>
            <?php endif; ?>
          </td>
          <td class="table__column table__column--td table__column--award">
            <?php if (isset($prizes[$award_index])): ?>
              $<?= earena_2_nice_money( round(($prizes[$award_index] * $tournament->prize / 100), 2) ); ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php endif; ?>
  </tbody>
</table>
