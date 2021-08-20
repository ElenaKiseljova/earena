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
  <form class="filters__form" action="" method="post" id="filters-main">
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
          <div class="checkbox checkbox--top">
            <input class="visually-hidden" type="checkbox" name="privat-match" value="" id="privat-match">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="privat-match">
              <?php _e( 'Приватный матч', 'earena_2' ); ?>
            </label>
          </div>
        <?php endif; ?>

        <?php if ($tournaments_page): ?>
          <!-- Приватный турнир -->
          <div class="checkbox checkbox--top">
            <input class="visually-hidden" type="checkbox" name="privat-tournament" value="" id="privat-tournament">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="privat-tournament">
              <?php _e( 'Приватный турнир', 'earena_2' ); ?>
            </label>
          </div>

          <!-- VIP турнир -->
          <div class="checkbox checkbox--top">
            <input class="visually-hidden" type="checkbox" name="vip" value="" id="vip">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="vip">
              <?php _e( 'VIP', 'earena_2' ); ?>
            </label>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="filters__container filters__container--bottom">

      <?php
        // is_front_page() && !is_home() пункт выбора Игры присутствует на стр всех матчей / турниров,
        // но отсутствует на стр всех матчей / турниров конкретной Игры
        if (( $tournaments_page || $matches_page ) && is_front_page() && !is_home() ) {
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
                  <div class="checkbox checkbox--left">
                    <input class="visually-hidden" type="checkbox" name="game" value="Modern Warfare" id="modern-warfare">
                    <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="modern-warfare">
                      Modern Warfare
                    </label>
                  </div>
                </li>
                <li class="filters__item filters__item--checkbox">
                  <div class="checkbox checkbox--left">
                    <input class="visually-hidden" type="checkbox" name="game" value="Dota 2" id="dota-2">
                    <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="dota-2">
                      Dota 2
                    </label>
                  </div>
                </li>
              </ul>

              <ul class="filters__list filters__list--result">
                <!-- Шаблон пунктов списка результатов строится в filter.js. Тут приведен для наглядности -->
                <!-- <li class="filters__item filters__item--result">
                  <div class="checkbox checkbox--left">
                    <label class="checkbox__label checkbox__label--result checkbox__label--right" for="modern-warfare">
                      Modern Warfare
                    </label>
                  </div>
                </li> -->
              </ul>
            </div>
          <?php
        }
      ?>

      <?php
        // Этот фильтр не виден на стр Всех матчей /  турниров (модификация front-page.php), т.к. там есть табы
      ?>
      <?php if (! is_front_page() ): ?>
        <div class="filters__element filters__element--col-5">
          <!-- Для переключения состояния - добавляется active класс  -->
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Платформа', 'earena_2' ); ?>
          </button>

          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="filters__list filters__list--checkbox">
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="platform" value="xbox" id="platform-xbox">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-xbox">
                  XBOX
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="platform" value="pc" id="platform-pc">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-pc">
                  PC
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="platform" value="mobile" id="platform-mobile">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-mobile">
                  Mobile
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="platform" value="playstation" id="platform-playstation">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-playstation">
                  PlayStation
                </label>
              </div>
            </li>
          </ul>
          <ul class="filters__list filters__list--result">
            <!-- Шаблон пунктов списка результатов строится в filter.js -->
          </ul>
        </div>
      <?php endif; ?>

      <!-- Общие поля фильтров -->
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Сумма входа', 'earena_2' ); ?>
        </button>
        <!-- Для переключения состояния - добавляется active класс  -->
        <ul class="filters__list filters__list--checkbox">
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="money" value="free" id="money-free">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="money-free">
                Free
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="money" value="5" id="money-5">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="money-5">
                $5
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="money" value="100" id="money-100">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="money-100">
                $100
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="money" value="200" id="money-200">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="money-200">
                $200
              </label>
            </div>
          </li>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
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

    <button class="filters__reset" type="reset" name="reset-filters">
      <?php _e( 'Сбросить фильтр', 'earena_2' ); ?>
    </button>
  </form>
</div>
