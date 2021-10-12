<?php
  /*
    Фильтры
  */
?>

<?php
  global $games;
  $games = $games ?? [];

  $platforms = get_site_option( 'platforms' ) ?? [];
  $game_modes = get_site_option( 'game_modes' ) ?? [];
  $team_modes = get_site_option( 'team_modes' ) ?? [];

  $tournaments_page = earena_2_current_page( 'tournaments' );

  $matches_page = earena_2_current_page( 'matches' );
?>

<div class="filters">
  <form class="filters__form" action="" method="post" id="filters-main">
    <div class="filters__container filters__container--top">
      <div class="filters__element filters__element--search">
        <input class="filters__field filters__field--input" type="text" name="id" placeholder="<?php _e( 'ID матча', 'earena_2' ); ?>">
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
            <input class="visually-hidden" type="checkbox" name="private" value="1" id="private-match">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="private-match">
              <?php _e( 'Приватный матч', 'earena_2' ); ?>
            </label>
          </div>
        <?php endif; ?>

        <?php if ($tournaments_page): ?>
          <!-- Приватный турнир -->
          <div class="checkbox checkbox--top">
            <input class="visually-hidden" type="checkbox" name="private" value="1" id="private-tournament">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="private-tournament">
              <?php _e( 'Приватный турнир', 'earena_2' ); ?>
            </label>
          </div>

          <!-- VIP турнир -->
          <div class="checkbox checkbox--top">
            <input class="visually-hidden" type="checkbox" name="vip" value="1" id="vip">
            <label class="checkbox__label checkbox__label--checkbox checkbox__label--right" for="vip">
              <?php _e( 'VIP', 'earena_2' ); ?>
            </label>
          </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="filters__container filters__container--bottom">
      <?php
        if ( $tournaments_page || $matches_page ) {
          ?>
            <!-- Выбор игры на стр Всех матчей/турниров -->
            <div class="filters__element filters__element--col-5">
              <!-- Для переключения состояния - добавляется active класс  -->
              <button class="filters__field filters__field--select" type="button" name="button">
                <?php _e( 'Игра', 'earena_2' ); ?>
              </button>

              <!-- Для переключения состояния - добавляется active класс  -->
              <ul class="filters__list filters__list--checkbox">
                <?php foreach ($games as $game): ?>
                  <li class="filters__item filters__item--checkbox">
                    <div class="checkbox checkbox--left">
                      <input class="visually-hidden" type="checkbox" name="game" value="<?= $game['key']; ?>" id="<?= $game['news-slug']; ?>">
                      <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="<?= $game['news-slug']; ?>">
                        <?= $game['name']; ?>
                      </label>
                    </div>
                  </li>
                <?php endforeach; ?>
              </ul>
              <ul class="filters__list filters__list--result">
                <!-- Шаблон пунктов списка результатов строится в filter.js -->
              </ul>
            </div>
          <?php
        }
      ?>

      <?php if ( earena_2_current_page( 'games' ) ): ?>
        <div class="filters__element filters__element--col-5">
          <!-- Для переключения состояния - добавляется active класс -->
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Платформа', 'earena_2' ); ?>
          </button>

          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="filters__list filters__list--checkbox">
            <?php foreach ($platforms as $platform_key => $platform): ?>
              <li class="filters__item filters__item--checkbox">
                <div class="checkbox checkbox--left">
                  <input class="visually-hidden" type="checkbox" name="platform" value="<?= $platform_key; ?>" id="platform-<?= mb_strtolower($platform); ?>">
                  <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-<?= mb_strtolower($platform); ?>">
                    <?= $platform; ?>
                  </label>
                </div>
              </li>
            <?php endforeach; ?>
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
              <input class="visually-hidden" type="checkbox" name="bet" value="0" id="bet-0">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="bet-0">
                <?php _e( 'Free', 'earena_2' ); ?>
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="bet" value="1" id="bet-1">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="bet-1">
                $1 – $10
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="bet" value="2" id="bet-2">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="bet-2">
                $10 – $100
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="bet" value="3" id="bet-3">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="bet-3">
                $100+
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
        <!-- Для переключения состояния - добавляется active класс  -->
        <ul class="filters__list filters__list--checkbox">
          <?php foreach ($game_modes as $game_mode_key => $game_mode): ?>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="game_mode" value="<?= $game_mode_key; ?>" id="game_mode_<?= $game_mode_key; ?>">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="game_mode_<?= $game_mode_key; ?>">
                  <?= $game_mode_key; ?> vs <?= $game_mode_key; ?>
                </label>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
      </div>
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Режим команды', 'earena_2' ); ?>
        </button>
        <!-- Для переключения состояния - добавляется active класс  -->
        <ul class="filters__list filters__list--checkbox">
          <?php foreach ($team_modes as $team_mode_key => $team_mode): ?>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="team_mode" value="<?= $team_mode_key; ?>" id="team_mode_<?= $team_mode_key; ?>">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="team_mode_<?= $team_mode_key; ?>">
                  <?= $team_mode !== null ? $team_mode : __('NULL', 'earena_2'); ?>
                </label>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
      </div>
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Статус', 'earena_2' ); ?>
        </button>
        <!-- Для переключения состояния - добавляется active класс  -->
        <ul class="filters__list filters__list--checkbox">
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="status" value="1" id="status-1">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-1">
                <?php _e('Регистрация', 'earena_2'); ?>
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="status" value="2" id="status-2">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-2">
                <?php _e('Проходит', 'earena_2'); ?>
              </label>
            </div>
          </li>
          <li class="filters__item filters__item--checkbox">
            <div class="checkbox checkbox--left">
              <input class="visually-hidden" type="checkbox" name="status" value="3" id="status-3">
              <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-3">
                <?php _e('Завершён', 'earena_2'); ?>
              </label>
            </div>
          </li>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
      </div>

      <?php if ($tournaments_page): ?>
        <!-- Поля для стр турниров -->
        <div class="filters__element filters__element--col-5">
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Тип турнира', 'earena_2' ); ?>
          </button>
          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="filters__list filters__list--checkbox">
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="type" value="1" id="type-1">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="type-1">
                  <?php _e('Турнир', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="type" value="2" id="type-2">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="type-2">
                  <?php _e('Lucky Cup', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="type" value="3" id="type-3">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="type-3">
                  <?php _e('Кубок', 'earena_2'); ?>
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
            <?php _e( 'Скорость', 'earena_2' ); ?>
          </button>
          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="filters__list filters__list--checkbox">
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="fast" value="1" id="fast-1">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="fast-1">
                  <?php _e('Обычная', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="fast" value="2" id="fast-2">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="fast-2">
                  <?php _e('Быстрая', 'earena_2'); ?>
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
            <?php _e( 'Дата начала', 'earena_2' ); ?>
          </button>
          <!-- Для переключения состояния - добавляется active класс  -->
          <ul class="filters__list filters__list--checkbox">
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="radio" name="date" value="desc" id="date-1">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="date-1">
                  <?php _e('Дальше', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="radio" name="date" value="asc" id="date-2">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="date-2">
                  <?php _e('Ближе', 'earena_2'); ?>
                </label>
              </div>
            </li>
          </ul>
          <ul class="filters__list filters__list--result">
            <!-- Шаблон пунктов списка результатов строится в filter.js -->
          </ul>
        </div>
      <?php endif; ?>
    </div>

    <button class="filters__reset" type="reset" name="reset-filters">
      <?php _e( 'Сбросить фильтр', 'earena_2' ); ?>
    </button>
  </form>
</div>
