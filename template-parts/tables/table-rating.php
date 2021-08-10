<?php
  /*
    Таблица Рейтинга
  */
?>

<!-- Future -->
<!-- <table class="table table--rating">
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
      for ($i=1; $i < 16; $i++) {
        ?>
          <tr class="table__row">
            <td class="table__column table__column--1 table__column--td table__column--small">
              <?= $i; ?>
            </td>
            <td class="table__column table__column--2 table__column--td table__column--small">
              <a class="table__user" href="#">
                <div class="table__user-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
                </div>
                <h5 class="table__user-name">
                  Cameronilliamson
                </h5>
              </a>
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
              0
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table> -->

<!-- Present & Past -->
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
      for ($i=1; $i < 16; $i++) {
        ?>
          <tr class="table__row">
            <td class="table__column table__column--1 table__column--td table__column--small">
              <?= $i; ?>
            </td>
            <td class="table__column table__column--2 table__column--td table__column--small">
              <a class="table__user" href="#">
                <div class="table__user-image">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
                </div>
                <h5 class="table__user-name">
                  Cameronilliamson
                </h5>
              </a>
            </td>
            <td class="table__column table__column--3 table__column--td table__column--small">
              53
            </td>
            <td class="table__column table__column--4 table__column--td table__column--small">
              41
            </td>
            <td class="table__column table__column--5 table__column--td table__column--small">
              17
            </td>
            <td class="table__column table__column--6 table__column--td table__column--small">
              6
            </td>
            <td class="table__column table__column--7 table__column--td table__column--small">
              17:21
            </td>
            <td class="table__column table__column--8 table__column--td table__column--small">
              76
            </td>
          </tr>
        <?php
      }
    ?>
  </tbody>
</table>
