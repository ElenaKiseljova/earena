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

  $tournaments_page = earena_2_current_page( 'tournaments' ) || (earena_2_current_page( 'games' ) && isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments');

  $is_admin_tournaments_list = is_page(555) ? true : false;

  $matches_page = earena_2_current_page( 'matches' ) || (earena_2_current_page( 'games' ) && isset($_GET['toggles']) && $_GET['toggles'] === 'matches');

  $game_id = $game_id_platforms = $game_id_game_modes = $game_id_team_modes = false;
  if (earena_2_current_page('games') && isset($_GET['game'])) {
    $game_id = $_GET['game'];
    $game_id_platforms = $games[$game_id]['platforms'];
    $game_id_game_modes = $games[$game_id]['game_modes'];
    $game_id_team_modes = $games[$game_id]['team_modes'];
  }
?>

<div class="filters">
  <form class="filters__form" action="" method="post" id="filters-<?= $tournaments_page ? 'tournaments' : ($matches_page ? 'matches' : ($is_admin_tournaments_list ? 'admin-tournaments' : 'main')); ?>">
    <div class="filters__container filters__container--top">
      <div class="filters__element filters__element--search">
        <input class="filters__field filters__field--input" type="text" name="id" placeholder="ID <?= ($tournaments_page || $is_admin_tournaments_list) ? _e( 'турнира', 'earena_2' ) : ($matches_page ? _e( 'матча', 'earena_2' ) : ''); ?>">
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

        <?php if ($tournaments_page || $is_admin_tournaments_list): ?>
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
        if ( ($tournaments_page || $is_admin_tournaments_list || $matches_page) && !earena_2_current_page( 'games' ) ) {
          ?>
            <!-- Выбор игры на стр Всех матчей/турниров -->
            <div class="filters__element filters__element--col-5 <?= earena_2_current_page( 'games' ) ? 'visually-hidden' : ''; ?>">

              <button class="filters__field filters__field--select" type="button" name="button">
                <?php _e( 'Игра', 'earena_2' ); ?>
              </button>


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

      <?php if ( earena_2_current_page( 'games' ) && isset($_GET['toggles']) ): ?>
        <div class="filters__element filters__element--col-5">
          <!-- Для переключения состояния - добавляется active класс -->
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Платформа', 'earena_2' ); ?>
          </button>


          <ul class="filters__list filters__list--checkbox">
            <?php
              foreach ($platforms as $platform_key => $platform) {
                if ( $game_id && $game_id_platforms ) {
                  if (in_array($platform_key, $game_id_platforms)) {
                    ?>
                      <li class="filters__item filters__item--checkbox">
                        <div class="checkbox checkbox--left">
                          <input class="visually-hidden" type="checkbox" name="platform" value="<?= $platform_key; ?>" id="platform-<?= mb_strtolower($platform); ?>">
                          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-<?= mb_strtolower($platform); ?>">
                            <?= $platform; ?>
                          </label>
                        </div>
                      </li>
                    <?php
                  }
                } else {
                  ?>
                    <li class="filters__item filters__item--checkbox">
                      <div class="checkbox checkbox--left">
                        <input class="visually-hidden" type="checkbox" name="platform" value="<?= $platform_key; ?>" id="platform-<?= mb_strtolower($platform); ?>">
                        <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="platform-<?= mb_strtolower($platform); ?>">
                          <?= $platform; ?>
                        </label>
                      </div>
                    </li>
                  <?php
                }
              }
            ?>
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

        <ul class="filters__list filters__list--checkbox">
          <?php
            foreach ($game_modes as $game_mode_key => $game_mode) {
              if ( $game_id && $game_id_game_modes ) {
                if (in_array($game_mode, $game_id_game_modes)) {
                  ?>
                    <li class="filters__item filters__item--checkbox">
                      <div class="checkbox checkbox--left">
                        <input class="visually-hidden" type="checkbox" name="game_mode" value="<?= $game_mode_key; ?>" id="game_mode_<?= $game_mode_key; ?>">
                        <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="game_mode_<?= $game_mode_key; ?>">
                          <?= $game_mode_key; ?> vs <?= $game_mode_key; ?>
                        </label>
                      </div>
                    </li>
                  <?php
                }
              } else {
                ?>
                  <li class="filters__item filters__item--checkbox">
                    <div class="checkbox checkbox--left">
                      <input class="visually-hidden" type="checkbox" name="game_mode" value="<?= $game_mode_key; ?>" id="game_mode_<?= $game_mode_key; ?>">
                      <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="game_mode_<?= $game_mode_key; ?>">
                        <?= $game_mode_key; ?> vs <?= $game_mode_key; ?>
                      </label>
                    </div>
                  </li>
                <?php
              }
            }
          ?>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
      </div>
      <?php if (($game_id_team_modes && !in_array(0, $game_id_team_modes)) || !$game_id_team_modes): ?>
        <div class="filters__element filters__element--col-5">
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Режим команды', 'earena_2' ); ?>
          </button>

          <ul class="filters__list filters__list--checkbox">
            <?php
              foreach ($team_modes as $team_mode_key => $team_mode) {
                if ( $game_id && $game_id_team_modes ) {
                  if (in_array($team_mode_key, $game_id_team_modes)) {
                    ?>
                      <li class="filters__item filters__item--checkbox">
                        <div class="checkbox checkbox--left">
                          <input class="visually-hidden" type="checkbox" name="team_mode" value="<?= $team_mode_key; ?>" id="team_mode_<?= $team_mode_key; ?>">
                          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="team_mode_<?= $team_mode_key; ?>">
                            <?= $team_mode !== null ? $team_mode : __('NULL', 'earena_2'); ?>
                          </label>
                        </div>
                      </li>
                    <?php
                  }
                } else if ($team_mode_key !== 0) {
                  ?>
                    <li class="filters__item filters__item--checkbox">
                      <div class="checkbox checkbox--left">
                        <input class="visually-hidden" type="checkbox" name="team_mode" value="<?= $team_mode_key; ?>" id="team_mode_<?= $team_mode_key; ?>">
                        <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="team_mode_<?= $team_mode_key; ?>">
                          <?= $team_mode; ?>
                        </label>
                      </div>
                    </li>
                  <?php
                }
              }
            ?>
          </ul>
          <ul class="filters__list filters__list--result">
            <!-- Шаблон пунктов списка результатов строится в filter.js -->
          </ul>
        </div>
      <?php endif; ?>
      <div class="filters__element filters__element--col-5">
        <button class="filters__field filters__field--select" type="button" name="button">
          <?php _e( 'Статус', 'earena_2' ); ?>
        </button>

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
          <?php if (is_ea_admin()): ?>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="status" value="4" id="status-4">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-4">
                  <?php _e('Запланирован', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="status" value="5" id="status-5">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-5">
                  <?php _e('Ожидает публикации', 'earena_2'); ?>
                </label>
              </div>
            </li>
            <li class="filters__item filters__item--checkbox">
              <div class="checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="status" value="6" id="status-6">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="status-6">
                  <?php _e('Отменен', 'earena_2'); ?>
                </label>
              </div>
            </li>
          <?php endif; ?>
        </ul>
        <ul class="filters__list filters__list--result">
          <!-- Шаблон пунктов списка результатов строится в filter.js -->
        </ul>
      </div>

      <?php if ($tournaments_page || $is_admin_tournaments_list): ?>
        <!-- Поля для стр турниров -->
        <div class="filters__element filters__element--col-5">
          <button class="filters__field filters__field--select" type="button" name="button">
            <?php _e( 'Тип турнира', 'earena_2' ); ?>
          </button>

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
        <?php if ($tournaments_page): ?>
          <div class="filters__element filters__element--col-5">
            <button class="filters__field filters__field--select" type="button" name="button">
              <?php _e( 'Дата начала', 'earena_2' ); ?>
            </button>

            <ul class="filters__list filters__list--checkbox">
              <li class="filters__item filters__item--checkbox">
                <div class="checkbox checkbox--left">
                  <input class="visually-hidden" type="radio" name="sort" value="desc" id="sort-1">
                  <label class="checkbox__label checkbox__label--radio checkbox__label--left" for="sort-1">
                    <?php _e('Позже', 'earena_2'); ?>
                  </label>
                </div>
              </li>
              <li class="filters__item filters__item--checkbox">
                <div class="checkbox checkbox--left">
                  <input class="visually-hidden" type="radio" name="sort" value="asc" id="sort-2">
                  <label class="checkbox__label checkbox__label--radio checkbox__label--left" for="sort-2">
                    <?php _e('Раньше', 'earena_2'); ?>
                  </label>
                </div>
              </li>
            </ul>
            <ul class="filters__list filters__list--result">
              <!-- Шаблон пунктов списка результатов строится в filter.js -->
            </ul>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    </div>

    <button class="filters__reset" type="reset" name="reset-filters">
      <?php _e( 'Сбросить фильтр', 'earena_2' ); ?>
    </button>
  </form>
</div>
