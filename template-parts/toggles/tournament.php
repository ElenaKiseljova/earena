<?php
  /*
    Шаблон переключателей на стр Турнира
  */
?>

<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  $tournament_have_tours = ($tournament->status >= 5) ? true : false;
?>

<div class="toggles toggles--tournament">
  <header class="toggles__header">
    <div class="toggles__list">
      <button class="toggles__item toggles__item--tournament active" type="button" name="toggle">
        <?php _e( 'Сведения', 'earena_2' ); ?>
      </button>
      <?php if ($tournament_have_tours): ?>
        <button class="toggles__item toggles__item--tournament" type="button" name="toggle">
          <?php _e( 'Туры', 'earena_2' ); ?>
        </button>
      <?php endif; ?>
    </div>

    <div class="toggles__right">
      <?php if ((int)$tournament->type == 2): ?>
        <a class="toggles__rules" href="<?= get_page_link(1835); ?>">
          <?php _e( 'Правила Lucky CUP', 'earena_2' ); ?>
        </a>
      <?php elseif ((int)$tournament->type == 3) : ?>
        <a class="toggles__rules" href="<?= get_page_link(2214); ?>">
          <?php _e( 'Правила Кубка', 'earena_2' ); ?>
        </a>
      <?php else: ?>
        <a class="toggles__rules" href="<?= get_page_link(1838); ?>">
          <?php _e( 'Правила Турнира', 'earena_2' ); ?>
        </a>
      <?php endif; ?>
    </div>
  </header>

  <div class="toggles__content toggles__content--tournament active">
    <div class="toggles__content-item toggles__content-item--col-2">
      <?php
        // Таблица Наград
        get_template_part( 'template-parts/tables/awards' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--col-2">
      <?php
        // Таблица Сроков для игр
        get_template_part( 'template-parts/tables/timing' );
      ?>
    </div>
    <div class="toggles__content-item toggles__content-item--rating toggles__content-item--col-1">
      <?php
        // Таблица Рейтинга
        get_template_part( 'template-parts/tables/rating' );
      ?>
    </div>
  </div>
  <?php if ($tournament_have_tours): ?>
    <div class="toggles__content toggles__content--tournament">
      <div class="toggles__content-item toggles__content-item--col-1">
        <?php
          // Аккордеон (туров)
          get_template_part( 'template-parts/accordeon', 'tournament' );
        ?>
      </div>
    </div>
  <?php endif; ?>
</div>
