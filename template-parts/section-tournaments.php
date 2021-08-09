<?php
  global $filter_section;
  global $header_right_section;
?>
<section class="section section--tournaments" id="tournaments">
  <div class="section__wrapper">
    <header class="section__header">
      <h2 class="section__title section__title--tournaments <?php if ( is_page(  ) && ! is_front_page() ) echo 'section__title--page'; ?>">
        <?php _e( 'Турниры', 'earena_2' ); ?>

        <span class="section__amount">
          462
        </span>
      </h2>

      <div class="section__header-right">
        <?php if ($header_right_section === 'all_button'): ?>
          <a class="button button--more" href="?type=tournaments">
            <span>
              <?php _e( 'Все турниры', 'earena_2' ); ?>
            </span>
          </a>
        <?php elseif ($header_right_section === 'tabs') : ?>
          <!-- Табы игровых платформ -->
          <?php get_template_part( 'template-parts/tabs' ); ?>
        <?php endif; ?>
      </div>
    </header>

    <?php
      if ($filter_section) {
        get_template_part( 'template-parts/filters' );
      }
    ?>

    <div class="section__content">
      <ul class="section__list">
        <?php
          global $tournament_index;

          for ($tournament_index=0; $tournament_index < 8; $tournament_index++) {
            ?>
              <li class="section__item section__item--col-4">
                <?php get_template_part( 'template-parts/tournament/tournament-archive' ); ?>
              </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</section>
