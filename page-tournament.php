<?php
  get_header(  );
?>

<main class="page-main">
  <section class="tournament tournament--page">
    <div class="tournament__wrapper">
      <div class="tournament__left">
        <span class="vip vip--page">
          vip
        </span>

        <div class="tournament__image tournament__image--page" itemscope itemtype="http://schema.org/ImageObject">
          <picture class="tournament__picture">
            <!-- <source media="(min-width: 1200px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/img/tournament-page.jpg" type="image/jpg"> -->

            <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/tournament-page.jpg" alt="<?php the_title(  ); ?>">
          </picture>

          <meta itemprop="name" content="<?php the_title(  ); ?>">
        </div>
      </div>
      <div class="tournament__right">
        <header class="tournament__header">
          <div class="tournament__platform tournament__platform--page">
            <svg class="tournament__platform-icon" width="40" height="40">
              <use xlink:href="#icon-platform-xbox"></use>
            </svg>
          </div>
          <div class="tournament__center tournament__center--page">
            <h3 class="tournament__game tournament__game--page">
              WARZONE
            </h3>

            <ul class="variations variations--lock">
              <li class="variations__item">
                1 vs 1
              </li>
            </ul>
          </div>

          <div class="tournament__trophy tournament__trophy--page">
            $100 000
          </div>
        </header>

        <h1 class="tournament__name tournament__name--page">
          <?php the_title(  ); ?>
        </h1>

        <!-- Future -->
        <!-- <div class="tournament__status tournament__status--page tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?> <time>25/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начало', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div> -->
        <!-- Present -->
        <!-- <div class="tournament__status tournament__status--page tournament__status--present">
          <?php _e( 'Проходит', 'earena_2' ); ?>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начался', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div> -->
        <!-- Past -->
        <div class="tournament__status tournament__status--page tournament__status--past">
          <?php _e( 'Завершился', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info tournament__info--page">
          <?php _e( 'Начался', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>

        <div class="players players--page">
          <div class="players__progress">
            <span class="players__progress-bar" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>

        <div class="tournament__content">
          <?php the_content(  ); ?>
        </div>

        <footer class="tournament__bottom tournament__bottom--page">
          <div class="tournament__bottom-left tournament__bottom-left--page">
            <div class="tournament__bet tournament__bet--page">
              $1 500
            </div>

            <div class="tournament__id tournament__id--page">
              ID 30204874239
            </div>
          </div>
          <!-- Future -->
          <!-- <button class="tournament__button button button--blue openpopup" data-popup="registration" type="button" name="registration">
            <span>
              <?php _e( 'Регистрация', 'earena_2' ); ?> ($1 500)
            </span>
          </button> -->
          <!-- Present -->
          <!-- <button class="tournament__button button button--blue openpopup" data-popup="registration" type="button" name="registration" disabled>
            <span>
              <?php _e( 'Проходит', 'earena_2' ); ?>
            </span>
          </button> -->
          <!-- Past -->
          <button class="tournament__button button button--gray openpopup" data-popup="registration" type="button" name="registration" disabled>
            <span>
              <?php _e( 'Завершен', 'earena_2' ); ?>
            </span>
          </button>
        </footer>
      </div>

      <!-- Переключатели -->
      <?php
        get_template_part( 'template-parts/toggles/toggles', 'tournament' );
      ?>
    </div>
  </section>

  <!-- Партнеры -->
  <?php
    if ( function_exists( 'earena_2_get_section' ) ) {
      earena_2_get_section( 'partners' );
    }
  ?>
</main>

<?php
  get_footer(  );
?>
