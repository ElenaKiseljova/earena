<?php
  /*
    Фильтры ( стр Аккаунта )
  */
?>

<?php
  // Стр Аккаунта (таб Турниров)
  global $is_tab_global;
  $sufix_input = '';
  if ($is_tab_global === 'tournaments') {
    $is_tournaments_tab = true;
    $sufix_input = 'tournaments';
  } else if ($is_tab_global === 'matches') {
    $is_matches_tab = true;
    $sufix_input = 'matches';
  }
?>

<div class="filters filters--account-tabs">
  <form class="filters__form" action="" method="post" id="filters-account">
    <div class="filters__container filters__container--account-tabs">
      <div class="filters__element filters__element--col-2 filters__element--account-tabs">
        <div class="select select--account-tabs">
          <!-- Для переключения состояния - добавляется active класс  -->
          <button class="select__button" type="button" name="button">
            <?php if ($is_matches_tab): ?>
              <?php _e( 'Статус матча', 'earena_2' ); ?>
            <?php elseif ($is_tournaments_tab): ?>
              <?php _e( 'Статус турнира', 'earena_2' ); ?>
            <?php else : ?>
              <?php _e( 'Статус', 'earena_2' ); ?>
            <?php endif; ?>
          </button>

          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="select__list">
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-status" value="future" id="select-<?= $sufix_input; ?>-status-future">
              <label class="select__label" for="select-<?= $sufix_input; ?>-status-future">
                <?php _e( 'Будет', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-status" value="past" id="select-<?= $sufix_input; ?>-status-past">
              <label class="select__label" for="select-<?= $sufix_input; ?>-status-past">
                <?php _e( 'Прошел', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-status" value="present" id="select-<?= $sufix_input; ?>-status-present">
              <label class="select__label" for="select-<?= $sufix_input; ?>-status-present">
                <?php _e( 'Проходит сейчас', 'earena_2' ); ?>
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="filters__element filters__element--col-2 filters__element--account-tabs">
        <div class="select select--account-tabs">
          <!-- Для переключения состояния - добавляется active класс  -->
          <button class="select__button" type="button" name="button">
            <?php _e( 'Период', 'earena_2' ); ?>
          </button>

          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="select__list">
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-period" value="month" id="select-<?= $sufix_input; ?>-period-month">
              <label class="select__label" for="select-<?= $sufix_input; ?>-period-month">
                <?php _e( 'За месяц', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-period" value="year" id="select-<?= $sufix_input; ?>-period-year">
              <label class="select__label" for="select-<?= $sufix_input; ?>-period-year">
                <?php _e( 'За год', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-<?= $sufix_input; ?>-period" value="day" id="select-<?= $sufix_input; ?>-period-day">
              <label class="select__label" for="select-<?= $sufix_input; ?>-period-day">
                <?php _e( 'За сегодня', 'earena_2' ); ?>
              </label>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>
