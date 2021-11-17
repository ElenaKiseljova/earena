<?php
  /*
    Слайдер с баннерами и статистикой
  */
?>
<?php
  $front_page_id = get_option( 'page_on_front' );
?>
<div class="promo__slider swiper-container">
  <div class="promo__slider-list swiper-wrapper">
    <?php
      $promo_count_slides_acf = 7;

      for ($i=1; $i <= $promo_count_slides_acf; $i++) {
        $promo_banner = get_field('promo_banner_' . $i, $front_page_id);
        $promo_link = get_field('promo_link_' . $i, $front_page_id);

        if (! empty($promo_banner) && is_array($promo_banner) ) {
          ?>
            <div class="promo__slider-item swiper-slide">
              <?php if ($i == 1): ?>
                <div class="promo__content promo__content--front">
                  <?php
                    // Статистика
                    get_template_part( 'template-parts/statistics/slider' );
                  ?>
                </div>
              <?php endif; ?>
              <?php if (!empty($promo_link)): ?>
                <a href="<?= $promo_link; ?>" class="promo__image <?php if ($i == 1) echo 'promo__image--first'; ?>" itemscope itemtype="http://schema.org/ImageObject">
                  <picture class="promo__picture">
                    <!-- <source media="(min-width: 1200px)" srcset="<?= $promo_banner['url']; ?>" type="image/jpg"> -->

                    <img itemprop="contentUrl" src="<?= $promo_banner['url']; ?>" alt="<?= $promo_banner['alt'] ? $promo_banner['alt'] : $promo_banner['title']; ?>">
                  </picture>

                  <meta itemprop="name" content="<?= $promo_banner['title'] ? $promo_banner['title'] : $promo_banner['alt']; ?>">
                </a>
              <?php elseif (empty($promo_link)): ?>
                <div class="promo__image <?php if ($i == 1) echo 'promo__image--first'; ?>" itemscope itemtype="http://schema.org/ImageObject">
                  <picture class="promo__picture">
                    <!-- <source media="(min-width: 1200px)" srcset="<?= $promo_banner['url']; ?>" type="image/jpg"> -->

                    <img itemprop="contentUrl" src="<?= $promo_banner['url']; ?>" alt="<?= $promo_banner['alt'] ? $promo_banner['alt'] : $promo_banner['title']; ?>">
                  </picture>

                  <meta itemprop="name" content="<?= $promo_banner['title'] ? $promo_banner['title'] : $promo_banner['alt']; ?>">
                </div>
              <?php endif; ?>
            </div>
          <?php
        }
      }
    ?>
  </div>

  <div class="promo__slider-pagination swiper-pagination"></div>
</div>
