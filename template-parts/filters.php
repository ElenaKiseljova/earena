<?php
  /*
    Фильтры
  */
?>

<div class="filters">
  <div class="filters__item">
    <input class="filters__field" type="text" name="id-match" value="" placeholder="ID матча">
    <button class="filters__button filters__button--search" type="button" name="button">
      <svg class="filters__icon" width="20" height="20">
        <use xlink:href="#icon-search"></use>
      </svg>
    </button>
  </div>
  <div class="filters__checkbox filters__checkbox--right">
    <input class="visually-hidden" type="checkbox" name="privat" value="" id="privat">
    <label class="filters__label filters__label--right" for="privat">
      <?php _e( 'Приватный матч', 'earena_2' ); ?>
    </label>
  </div>
</div>
