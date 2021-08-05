<?php
  global $filter_section;
?>
<section class="section section--matches" id="matches">
  <div class="section__wrapper">
    <header class="section__header">
      <h2 class="section__title section__title--matches <?php if ( is_page(  ) && ! is_front_page() ) echo 'section__title--page'; ?>">
        <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
        <span class="section__amount">
          1 038
        </span>
      </h2>

      <div class="section__header-right">
        <a class="button button--more" href="?type=matches">
          <span>
            <?php _e( 'Все матчи', 'earena_2' ); ?>
          </span>
        </a>
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
          global $match_index;

          for ($match_index=0; $match_index < 8; $match_index++) {
            ?>
              <li class="section__item section__item--col-4">
                <?php get_template_part( 'template-parts/match/match-archive' ); ?>
              </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</section>
