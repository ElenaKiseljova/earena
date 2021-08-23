<?php
  /*
    Фильтры ( стр Аккаунта )
  */
?>

<div class="filters filters--statistics">
  <form class="filters__form" action="" method="post" id="filters-statistics">
    <div class="filters__container filters__container--statistics">
      <div class="filters__element filters__element--col-1 filters__element--statistics">
        <div class="select select--statistics">
          <!-- Для переключения состояния - добавляется active класс  -->
          <button class="select__button" type="button" name="button">
            <?php _e( 'Игра', 'earena_2' ); ?>
          </button>

          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="select__list">
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="1" id="select-game-1">
              <label class="select__label" for="select-game-1">
                Call of Duty: WARZONE
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="2" id="select-game-2">
              <label class="select__label" for="select-game-2">
                Dota 2
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="3" id="select-game-3">
              <label class="select__label" for="select-game-3">
                Mortal Combat 11Ultimate
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="4" id="select-game-4">
              <label class="select__label" for="select-game-4">
                League of Legends
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="5" id="select-game-5">
              <label class="select__label" for="select-game-5">
                Heroes III
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="6" id="select-game-6">
              <label class="select__label" for="select-game-6">
                Warcraft III
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="select-game" value="7" id="select-game-7">
              <label class="select__label" for="select-game-7">
                Starcraft II
              </label>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>
