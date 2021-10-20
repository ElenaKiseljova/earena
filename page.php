<?php
  /*
    Текстовая страница (page)
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="content">
    <div class="content__wrapper">
      <?php if (has_post_thumbnail()): ?>
        <header class="content__header">
          <div class="content__description">
            <h1 class="content__title content__title--havethumbnail">
              <?php the_title(  ); ?>
            </h1>

            <?php if (get_filed( 'page_text_subtitle' )): ?>
              <div class="content__subtitle">
                <?php the_field( 'page_text_subtitle' ); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="content__image">
            <picture class="content__picture">
              <?php the_post_thumbnail(); ?>
            </picture>
          </div>
        </header>
        <div class="content__inner">
          <?php the_content(); ?>
        </div>
      <?php else: ?>
        <div class="content__inner content__inner--nothumbnail">
          <h1 class="content__title content__title--nothumbnail">
            <?php the_title(  ); ?>
          </h1>

          <?php the_content(); ?>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
