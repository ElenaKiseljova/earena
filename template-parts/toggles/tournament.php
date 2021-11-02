<?php
  /*
    Шаблон переключателей на стр Турнира
  */
?>

<?php
  global $tournament, $tournament_id, $tournament_matches, $icons, $ea_icons, $ea_user;

  /* TYPE */
  $is_tournament_simple = ((int)$tournament->type === 1) ? true : false;
  $is_tournament_lucky_cup = ((int)$tournament->type === 2) ? true : false;
  $is_tournament_cup = ((int)$tournament->type === 3) ? true : false;

  $tours = json_decode($tournament->tours, true) ?: [];

  // Для Lucky Cup
  $tournament_matches = EArena_DB::get_ea_tournament_matches($tournament_id) ?? [];
?>

<div class="toggles toggles--tournament">
  <header class="toggles__header">
    <div class="toggles__list">
      <button class="toggles__item toggles__item--tournament active" type="button" name="toggle">
        <?php _e( 'Сведения', 'earena_2' ); ?>
      </button>
      <?php if (!empty($tours) || !empty($tournament_matches)): ?>
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

    <?php if ($is_tournament_simple || $is_tournament_lucky_cup): ?>
      <div class="toggles__content-item toggles__content-item--rating toggles__content-item--col-1">
        <?php
          // Таблица Рейтинга
          get_template_part( 'template-parts/tables/rating' );
        ?>
      </div>
      <?php if (is_ea_admin()): ?>
        <button class="tournament__button tournament__button--edit-table button button--blue"
          data-id="<?= $tournament->ID; ?>"
          type="button" name="edit-table">
          <span>
            <?php _e( 'Редактировать таблицу', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>
    <?php endif; ?>
  </div>
  <?php if (!empty($tours) || !empty($tournament_matches)): ?>
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
