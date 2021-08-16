<?php
  /*
    Слайдер с баннерами и статистикой
  */
?>
<div class="promo__slider swiper-container">
  <div class="promo__slider-list swiper-wrapper">
    <?php
      for ($i=0; $i < 4; $i++) {
        ?>
          <div class="promo__slider-item swiper-slide">
            <?php if ($i == 0): ?>
              <!-- Слайд со статистикой -->
              <div class="promo__content">
                <!-- Статистика -->
                <?php
                  get_template_part( 'template-parts/statistics/page', 'front' );
                ?>
              </div>
            <?php endif; ?>
            <div class="promo__image <?php if ($i == 0) echo 'promo__image--first'; ?>" itemscope itemtype="http://schema.org/ImageObject">
              <picture class="promo__picture">
                <!-- <source media="(min-width: 1200px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/promo.png" type="image/jpg"> -->

                <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/promo.png" alt="Slide">
              </picture>

              <meta itemprop="name" content="Slide">
            </div>
          </div>
        <?php
      }
    ?>
  </div>

  <div class="promo__slider-pagination swiper-pagination"></div>
</div>
