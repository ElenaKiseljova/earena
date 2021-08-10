<?php
  /*
    Страница Турнира
  */
?>
<?php
  $tournament_chat_page = false;

  if ($_GET['type'] && $_GET['type'] === 'chat') {
    $tournament_chat_page = true;
  }
?>

<section class="tournament tournament--page">
  <?php if ($tournament_chat_page): ?>
    <!-- Страница чата турнира -->
    <div class="tournament__wrapper tournament__wrapper--chat">
      <div class="tournament__left tournament__left--chat">
        <header class="tournament__header tournament__header--chat">
          <div class="tournament__platform tournament__platform--page">
            <svg class="tournament__platform-icon" width="40" height="40">
              <use xlink:href="#icon-platform-xbox"></use>
            </svg>
          </div>
          <div class="tournament__center tournament__center--page">
            <h3 class="tournament__game tournament__game--page">
              WARZONE - $100
            </h3>

            <ul class="variations variations--lock">
              <li class="variations__item">
                1 vs 1
              </li>
            </ul>
          </div>

          <a class="tournament__rules" href="#">
            <?php _e( 'Правила игры', 'earena_2' ); ?>
          </a>
        </header>
        <div class="tournament__inner">
          <div class="tournament__top tournament__top--chat">
            <h2 class="tournament__name tournament__name--chat">
              Championship 2020 Season 2 Premium
            </h2>

            <div class="tournament__round">
              3 <?php _e( 'тур', 'earena_2' ); ?>
            </div>
            <div class="tournament__type">
              <?php _e( 'Турнир', 'earena_2' ); ?>
            </div>
            <div class="tournament__date">
              <?php _e( 'Сыграть до', 'earena_2' ); ?> <time>15.11.2020</time>
            </div>
          </div>
        </div>
      </div>
      <div class="tournament__right tournament__right--chat">
        <header class="tournament__header tournament__header--chat">
          <h1 class="tournament__chat">
            <?php _e( 'Чат турнира ', 'earena_2' ); ?> ID0432545
          </h1>

          <button class="tournament__complaint button button--red openpopup" data-popup="complaint" type="button" name="complaint">
            <span>
              <?php _e( 'Жалоба судье', 'earena_2' ); ?>
            </span>
          </button>
        </header>

        <!-- Чат -->
        <?php
          get_template_part( 'template-parts/chat' );
        ?>
      </div>
    </div>
  <?php else : ?>
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
  <?php endif; ?>
</section>
