<?php
  /*
    Таблица Рейтинга
  */
?>

<table class="table table--rating">
  <caption class="table__caption visually-hidden">
    <?php _e( 'Рейтинг', 'earena_2' ); ?>
  </caption>
  <thead class="table__head">
    <tr class="tables__row">
      <th class="tables__column tables__column--th">
        <?php _e( 'Место', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Участник', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Игр', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Побед', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Ничьих', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Поражений', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Голы', 'earena_2' ); ?>
      </th>
      <th class="tables__column tables__column--th">
        <?php _e( 'Очков', 'earena_2' ); ?>
      </th>
    </tr>
  </thead>
  <tbody class="table__body">
    <?php
      for ($i=1; $i < 16; $i++) {
        ?>
          <tr class="table__row">
            <td class="table__column tables__column--td">
              <?= $i; ?>
            </td>
            <td class="table__column tables__column--td">
              <a class="table__user" href="#">
                <div class="table__user-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
                </div>
                <h5 class="table__user-name">
                  Cameronilliamson
                </h5>
              </a>
            </td>
            <td class="table__column tables__column--td">
              53
            </td>
            <td class="table__column tables__column--td">
              41
            </td>
            <td class="table__column tables__column--td">
              17
            </td>
            <td class="table__column tables__column--td">
              6
            </td>
            <td class="table__column tables__column--td">
              17:21
            </td>
            <td class="table__column tables__column--td">
              76
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>
