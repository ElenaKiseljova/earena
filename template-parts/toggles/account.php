<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  // Страница Акаунта
  global $is_account_page;

  // Приватный режим
  global $private;
?>

<div class="toggles toggles--account">
  <header class="toggles__header <?php if ($is_account_page) echo 'toggles__header--account'; ?>">
    <div class="toggles__list">
      <!-- Для переключения состояния - добавляется active класс  -->
      <button class="toggles__item active" type="button" name="toggle">
        <?php _e( 'Профиль', 'earena_2' ); ?>
      </button>
      <button class="toggles__item" type="button" name="toggle">
        <?php _e( 'Матчи (14)', 'earena_2' ); ?>
      </button>
      <button class="toggles__item" type="button" name="toggle">
        <?php _e( 'Турниры (8)', 'earena_2' ); ?>
      </button>

      <?php if ($private): ?>
        <button class="toggles__item" type="button" name="toggle">
          <?php _e( 'Сообщения (1)', 'earena_2' ); ?>
        </button>
      <?php endif; ?>

      <button class="toggles__item" type="button" name="toggle">
        <?php _e( 'Друзья (25)', 'earena_2' ); ?>
      </button>

      <?php if ($private): ?>
        <button class="toggles__item" type="button" name="toggle">
          <?php _e( 'Приглашенные (4)', 'earena_2' ); ?>
        </button>
        <button class="toggles__item" type="button" name="toggle">
          <?php _e( 'Уведомления (3)', 'earena_2' ); ?>
        </button>
      <?php endif; ?>
    </div>
  </header>

  <!-- Профиль  -->
  <div class="toggles__content toggles__content--account active">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Игры
          earena_2_get_section( 'games' );
        }

        if ($private) {
          // Стрим
          get_template_part( 'template-parts/stream' );
        }
      ?>
    </div>

    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Статистика игр -->
      <?php
        get_template_part( 'template-parts/statistics/page', 'account-games' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Статистика друзей -->
      <?php
        get_template_part( 'template-parts/statistics/page', 'account-friends' );
      ?>
    </div>
  </div>
  <div class="toggles__content">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Матчи
          earena_2_get_section( 'matches', false, 'filters', 'matches' );
        }
      ?>
    </div>
  </div>
  <div class="toggles__content">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Турниры
          earena_2_get_section( 'tournaments', false, 'filters', 'tournaments' );
        }
      ?>
    </div>
  </div>

  <?php if ($private): ?>
    <div class="toggles__content">
      <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
        <?php
          if ( function_exists( 'earena_2_get_section' ) ) {
            // Сообщения
            earena_2_get_section( 'messages' );
          }
        ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="toggles__content">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Друзья
          earena_2_get_section( 'friends' );
        }
      ?>
    </div>
  </div>

  <?php if ($private): ?>
    <div class="toggles__content">
      <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
        <?php
          if ( function_exists( 'earena_2_get_section' ) ) {
            // Приглашенные
            earena_2_get_section( 'invited' );
          }
        ?>
      </div>
    </div>

    <div class="toggles__content">
      <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
        <?php
          if ( function_exists( 'earena_2_get_section' ) ) {
            // Уведомления
            earena_2_get_section( 'requests' );
          }
        ?>
      </div>
    </div>
  <?php endif; ?>
</div>
