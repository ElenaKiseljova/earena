<?php
  /*
    Текстовая страница (post)
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="content">
    <div class="content__wrapper">
      <header class="content__header">
        <div class="content__description">
          <h1 class="content__title">
            <?php the_title(  ); ?>
          </h1>

          <div class="content__subtitle">
            <p>
              По вопросам сотрудничества, спонсорства,
              <br>
              франшизы и не только — <a href="mailto:info@earena.bet">info@earena.bet</a>
            </p>
          </div>
        </div>
        <div class="content__image">
          <picture class="content__picture">
            <?php if (has_post_thumbnail()): ?>
              <?php the_post_thumbnail(); ?>
            <?php endif; ?>
          </picture>
        </div>
      </header>

      <div class="content__inner">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
