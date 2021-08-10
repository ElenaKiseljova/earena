<?php
  /*
    Страница Игры
  */
?>

<section class="game game--page">
  <div class="game__wrapper">
    <header class="game__header">
      <div class="game__description">
        <h1 class="game__title">
          <?php the_title(  ); ?>
        </h1>

        <ul class="variations variations--page">
          <li class="variations__item variations__item--page">
            1 vs 1
          </li>
          <li class="variations__item variations__item--page">
            2 vs 2
          </li>
        </ul>

        <div class="game__text">
          <p class="game__text-item">
            <?php _e( 'Матчей на деньги', 'earena_2' ); ?>: 185
          </p>
          <p class="game__text-item">
            <?php _e( 'Турниров', 'earena_2' ); ?>: 70
          </p>
        </div>

        <ul class="game__platforms game__platforms--page">
          <?php
            $platforms = ['desktop', 'xbox', 'playstation'];
          ?>
          <?php foreach ($platforms as $platform): ?>
            <li class="game__platform game__platform--page">
              <svg class="game__platform-icon" width="30" height="30">
                <use xlink:href="#icon-platform-<?= $platform; ?>"></use>
              </svg>
            </li>
          <?php endforeach; ?>
        </ul>

        <a class="game__rules" href="/text">
          <?php _e( 'Правила игры', 'earena_2' ); ?>
        </a>
      </div>
      <div class="game__image game__image--page" itemscope itemtype="http://schema.org/ImageObject">
        <picture class="game__picture">
          <!-- <source media="(min-width: 1200px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/games/banners/game_banner-0.png" type="image/jpg"> -->

          <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/games/banners/game_banner-0.png" alt="<?php the_title(  ); ?>">
        </picture>

        <meta itemprop="name" content="<?php the_title(  ); ?>">
      </div>
    </header>
  </div>
</section>
