<?php
  /*
    Таблица Сроков для игр
  */
?>

<table class="table table--timing">
  <caption class="table__caption">
    <?php _e( 'Сроки для игр', 'earena_2' ); ?>
  </caption>

  <tbody class="table__body">
    <?php
      for ($i=1; $i < 5; $i++) {
        ?>
          <tr class="table__row">
            <td class="table__column tables__column--td">
              6 игр
            </td>
            <td class="table__column tables__column--td">
              25.10.2012 – 30.10.2012
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>
