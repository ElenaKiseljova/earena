<?php
  /*
    Фильтры
  */
?>

<?php
  // Для теста
  $tournaments_page = false;

  if (isset($_GET['type']) && $_GET['type'] === 'tournaments') {
    $tournaments_page = true;
  }

  $matches_page = false;

  if (isset($_GET['type']) && $_GET['type'] === 'matches') {
    $matches_page = true;
  }
?>

<div class="filters">
  <div class="filters__container filters__container--top">
    <div class="filters__element filters__element--search">
      <input class="filters__field filters__field--input" type="text" name="id-match" value="" placeholder="ID матча">
      <button class="filters__button filters__button--search" type="button" name="button">
        <svg class="filters__icon" width="20" height="20">
          <use xlink:href="#icon-search"></use>
        </svg>
      </button>
    </div>
    <div class="filters__element filters__element--checkboxes">
      <?php if ($matches_page): ?>
        <!-- Приватный матч -->
        <div class="filters__checkbox filters__checkbox--top">
          <input class="visually-hidden" type="checkbox" name="privat-match" value="" id="privat-match">
          <label class="filters__label filters__label--checkbox filters__label--right" for="privat-match">
            <?php _e( 'Приватный матч', 'earena_2' ); ?>
          </label>
        </div>
      <?php endif; ?>

      <?php if ($tournaments_page): ?>
        <!-- Приватный турнир -->
        <div class="filters__checkbox filters__checkbox--top">
          <input class="visually-hidden" type="checkbox" name="privat-tournament" value="" id="privat-tournament">
          <label class="filters__label filters__label--checkbox filters__label--right" for="privat-tournament">
            <?php _e( 'Приватный турнир', 'earena_2' ); ?>
          </label>
        </div>

        <!-- VIP турнир -->
        <div class="filters__checkbox filters__checkbox--top">
          <input class="visually-hidden" type="checkbox" name="vip" value="" id="vip">
          <label class="filters__label filters__label--checkbox filters__label--right" for="vip">
            <?php _e( 'VIP', 'earena_2' ); ?>
          </label>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="filters__container filters__container--bottom">

    <?php
      // Для теста
      $all_turnaments_page = false;

      if ($all_turnaments_page) {
        ?>
          <!-- Выбор игры на стр Всех матчей/турниров -->
          <div class="filters__element filters__element--col-5">
            <!-- Для переключения состояния - добавляется active класс  -->
            <button class="filters__field filters__field--select" type="button" name="button">
              <?php _e( 'Игра', 'earena_2' ); ?>
            </button>

            <!-- Для переключения состояния - добавляется active класс  -->
            <ul class="filters__list filters__list--checkbox">
              <li class="filters__item filters__item--checkbox">
                <div class="filters__checkbox filters__checkbox--left">
                  <input class="visually-hidden" type="checkbox" name="game" value="Modern Warfare" id="modern-warfare">
                  <label class="filters__label filters__label--checkbox filters__label--left" for="modern-warfare">
                    Modern Warfare
                  </label>
                </div>
              </li>
              <li class="filters__item filters__item--checkbox">
                <div class="filters__checkbox filters__checkbox--left">
                  <input class="visually-hidden" type="checkbox" name="game" value="Dota 2" id="dota-2">
                  <label class="filters__label filters__label--checkbox filters__label--left" for="dota-2">
                    Dota 2
                  </label>
                </div>
              </li>
            </ul>

            <ul class="filters__list filters__list--result">
              <li class="filters__item filters__item--result">
                <div class="filters__checkbox filters__checkbox--left">
                  <label class="filters__label filters__label--result filters__label--right" for="modern-warfare">
                    Modern Warfare
                  </label>
                </div>
              </li>
              <li class="filters__item filters__item--result">
                <div class="filters__checkbox filters__checkbox--left">
                  <label class="filters__label filters__label--result filters__label--right" for="dota-2">
                    Dota 2
                  </label>
                </div>
              </li>
            </ul>
          </div>
        <?php
      }
    ?>

    <!-- Общие поля фильтров -->
    <div class="filters__element filters__element--col-5">
      <!-- Для переключения состояния - добавляется active класс  -->
      <button class="filters__field filters__field--select active" type="button" name="button">
        <?php _e( 'Платформа', 'earena_2' ); ?>
      </button>

      <!-- Для переключения состояния - добавляется active класс  -->
      <ul class="filters__list filters__list--checkbox active">
        <li class="filters__item filters__item--checkbox">
          <div class="filters__checkbox filters__checkbox--left">
            <input class="visually-hidden" type="checkbox" name="platform" value="xbox" id="platform-xbox">
            <label class="filters__label filters__label--checkbox filters__label--left" for="platform-xbox">
              XBOX
            </label>
          </div>
        </li>
        <li class="filters__item filters__item--checkbox">
          <div class="filters__checkbox filters__checkbox--left">
            <input class="visually-hidden" type="checkbox" name="platform" value="pc" id="platform-pc">
            <label class="filters__label filters__label--checkbox filters__label--left" for="platform-pc">
              PC
            </label>
          </div>
        </li>
        <li class="filters__item filters__item--checkbox">
          <div class="filters__checkbox filters__checkbox--left">
            <input class="visually-hidden" type="checkbox" name="platform" value="mobile" id="platform-mobile">
            <label class="filters__label filters__label--checkbox filters__label--left" for="platform-mobile">
              Mobile
            </label>
          </div>
        </li>
        <li class="filters__item filters__item--checkbox">
          <div class="filters__checkbox filters__checkbox--left">
            <input class="visually-hidden" type="checkbox" name="platform" value="playstation" id="platform-playstation">
            <label class="filters__label filters__label--checkbox filters__label--left" for="platform-playstation">
              PlayStation
            </label>
          </div>
        </li>
      </ul>
    </div>
    <div class="filters__element filters__element--col-5">
      <button class="filters__field filters__field--select" type="button" name="button">
        <?php _e( 'Сумма входа', 'earena_2' ); ?>
      </button>
    </div>
    <div class="filters__element filters__element--col-5">
      <button class="filters__field filters__field--select" type="button" name="button">
        <?php _e( 'Режим игры', 'earena_2' ); ?>
      </button>
    </div>
    <div class="filters__element filters__element--col-5">
      <button class="filters__field filters__field--select" type="button" name="button">
        <?php _e( 'Режим команды', 'earena_2' ); ?>
      </button>
    </div>
    <div class="filters__element filters__element--col-5">
      <button class="filters__field filters__field--select" type="button" name="button">
        <?php _e( 'Статус', 'earena_2' ); ?>
      </button>
    </div>

    <?php if ($tournaments_page): ?>
      <!-- Поля для стр турниров -->
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Тип турнира', 'earena_2' ); ?>
        </button>
      </div>
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Скорость', 'earena_2' ); ?>
        </button>
      </div>
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Дата начала', 'earena_2' ); ?>
        </button>
      </div>
    <?php endif; ?>
  </div>

  <button class="filters__reset" type="button" name="reset-filters">
    <?php _e( 'Сбросить фильтр', 'earena_2' ); ?>
  </button>
</div>
