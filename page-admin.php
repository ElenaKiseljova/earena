<?php
  /*
    Админская разводная
  */
?>
<?php
  if (!is_ea_admin()) {
    wp_redirect(home_url());
    exit;
  }
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="content <?= is_checkout() ? 'content--checkout' : ''; ?>">
    <div class="content__wrapper">
      <?php if (has_post_thumbnail()): ?>
        <header class="content__header">
          <div class="content__description">
            <h1 class="content__title content__title--havethumbnail">
              <?php the_title(  ); ?>
            </h1>

            <?php if (get_field( 'page_text_subtitle' )): ?>
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
          <h1 class="content__title content__title--nothumbnail <?= is_checkout() ? 'content__title--checkout' : ''; ?>">
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
