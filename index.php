<?php
  /*
    Блог. Но пока тут только кнопок шаблоны
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
        <div class="content__image" itemscope itemtype="http://schema.org/ImageObject">
          <picture class="content__picture">
            <!-- <source media="(min-width: 1200px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/page-banner.png" type="image/jpg"> -->

            <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-banner.png" alt="<?php the_title(  ); ?>">
          </picture>

          <meta itemprop="name" content="<?php the_title(  ); ?>">
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
