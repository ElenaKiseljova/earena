<?php
  /*
    Таблица Сроков для игр
  */
?>

<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $tournament_schedule_complete = ($tournament->status >= 5 && $tournament->status <= 101) ? true : false;
  $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  $tournament_cancel = ($tournament->status == 103) ? true : false;
?>

<table class="table table--timing">
  <caption class="table__caption">
    <?php _e( 'Сроки для игр', 'earena_2' ); ?>
  </caption>

  <tbody class="table__body">
    <?php
      if (!$tournament_schedule_complete && !$tournament_ended && !$tournament_cancel) {
        for ($i=1; $i <= 4; $i++) {
          ?>
            <tr class="table__row table__row--border">
              <td class="table__column table__column--td table__column--black">

              </td>
              <td class="table__column table__column--td">

              </td>
            </tr>
          <?php
        }
      } elseif ($tournament_schedule_complete || $tournament_ended || $tournament_cancel) {
        $tours = json_decode($tournament->tours, true) ?: [];

        foreach ($tours as $tour_index => $tour) {
          ?>
            <tr class="table__row table__row--border">
              <td class="table__column table__column--td table__column--black">
                <?= pluralize($tournament->mpt, __('игра', 'earena'), __('игры', 'earena'), __('игр', 'earena')); ?>
              </td>
              <td class="table__column table__column--td">
                <?=
                date('d.m.Y  H:i', utc_to_usertime($tour['t1'])) . ' – ' .
                (date('d.m.Y', utc_to_usertime($tour['t2'])) == date('d.m.Y', utc_to_usertime($tour['t1']))
                ?
                date('H:i', utc_to_usertime($tour['t2']))
                :
                date('d.m.Y  H:i', utc_to_usertime($tour['t2'])));
                ?>
              </td>
            </tr>
          <?php
        }
      }
    ?>
  </tbody>
</table>
