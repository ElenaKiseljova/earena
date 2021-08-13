<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  global $private;
?>

<div class="toggles toggles--account">
  <header class="toggles__header">
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

  <div class="toggles__content active">
    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Таблица Наград -->
      <?php
        get_template_part( 'template-parts/tables/table', 'awards' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--col-2">
      <!-- Таблица Сроков для игр -->
      <?php
        get_template_part( 'template-parts/tables/table', 'timing' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--rating toggles__content-item--col-1">
      <!-- Таблица Рейтинга -->
      <?php
        get_template_part( 'template-parts/tables/table', 'rating' );
      ?>
    </div>
  </div>
  <div class="toggles__content">
    <div class="toggles__content-item toggles__content-item--col-1">
      <!-- Аккордеон -->
      <?php
        get_template_part( 'template-parts/accordeon' );
      ?>
    </div>
  </div>
  <div class="toggles__content">
    пусто
  </div>
  <div class="toggles__content">
    пусто
  </div>
</div>
