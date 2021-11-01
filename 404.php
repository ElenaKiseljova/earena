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
            404
          </h1>

          <div class="content__subtitle">
            <p>
              <?php _e( 'Страница не найдена', 'earena_2' ); ?>
            </p>
          </div>
          <a class="button button--blue" href="<?= bloginfo( 'url' ); ?>">
            <?php _e( 'На главную', 'earena_2' ); ?>
          </a>
        </div>
        <div class="content__image" itemscope itemtype="http://schema.org/ImageObject">
          <picture class="content__picture">
            <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/page-banner.png" alt="404">
          </picture>

          <meta itemprop="name" content="404">
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
