<?php
  /*
    Шаблон переключателей на стр Турнира
  */
?>

<section class="toggles toggles--tournament">
  <header class="toggles__header">
    <div class="toggles__list">
      <!-- Для переключения состояния - добавляется active класс  -->
      <button class="toggles__item active" type="button" name="toggle">
        <?php _e( 'Сведения', 'earena_2' ); ?>
      </button>
      <button class="toggles__item" type="button" name="toggle">
        <?php _e( 'Туры', 'earena_2' ); ?>
      </button>
    </div>

    <div class="toggles__right">
      <a class="toggles__rules" href="#">
        <?php _e( 'Правила и настройки игр', 'earena_2' ); ?>
      </a>
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
</section>
