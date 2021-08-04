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
                <div class="statistics">
                  <ul class="statistics__variation">
                    <li class="statistics__variation-item statistics__variation-item--one">
                      <?php _e( 'Играй один', 'earena_2' ); ?>
                    </li>
                    <li class="statistics__variation-item statistics__variation-item--two">
                      <?php _e( 'Вдвоем', 'earena_2' ); ?>
                    </li>
                    <li class="statistics__variation-item statistics__variation-item--team">
                      <?php _e( 'Командой', 'earena_2' ); ?>
                    </li>
                  </ul>

                  <dl class="statistics__achives">
                    <dt class="statistics__achives-termin">
                      167 086 942
                    </dt>
                    <dd class="statistics__achives-description">
                      <?php _e( 'Сыграно матчей', 'earena_2' ); ?>
                    </dd>

                    <dt class="statistics__achives-termin">
                      $802 760
                    </dt>
                    <dd class="statistics__achives-description">
                      <?php _e( 'Выплачено игрокам', 'earena_2' ); ?>
                    </dd>
                  </dl>
                </div>
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
