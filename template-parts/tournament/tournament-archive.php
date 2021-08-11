<?php
  /*
    Архивная карточка турнира
  */
?>
<?php
  // Индекс турнира
  global $tournament_index;
?>

<?php if ($tournament_index === 0) : ?>
  <!-- Future -->
  <div class="tournament">
    <a class="tournament__link" href="/tournament">
      <div class="tournament__top">
        <div class="tournament__image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/tournaments/game-<?= $tournament_index; ?>.jpg" alt="Game">
        </div>

        <div class="tournament__top-content">
          <div class="tournament__trophy">
            $5 000
          </div>
        </div>
      </div>

      <div class="tournament__center">
        <h4 class="tournament__name">
          Myanmar Championship 2020 Season 2 Premium
        </h4>

        <div class="tournament__status tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?> <time>25/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начало', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="players">
          <div class="players__progress">
            <span class="players__progress-bar" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>
      </div>

      <div class="tournament__bottom">
        <div class="tournament__bottom-left">
          <h3 class="tournament__game">
            WARZONE
          </h3>
          <ul class="variations">
            <li class="variations__item">
              1 vs 1
            </li>
          </ul>
        </div>

        <div class="platform">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-xbox"></use>
          </svg>
        </div>

        <div class="tournament__id">
          ID 30204874239
        </div>

        <div class="tournament__bet">
          Free
        </div>
      </div>
    </a>
  </div>
<?php elseif ($tournament_index === 1) : ?>
  <!-- Present . VIP -->
  <div class="tournament">
    <a class="tournament__link" href="/tournament">
      <div class="tournament__top">
        <div class="tournament__image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/tournaments/game-<?= $tournament_index; ?>.jpg" alt="Game">
        </div>

        <span class="vip">
          vip
        </span>

        <div class="tournament__top-content">
          <div class="tournament__trophy">
            $500
          </div>
        </div>
      </div>

      <div class="tournament__center">
        <h4 class="tournament__name">
          Championship 2020
        </h4>

        <div class="tournament__status tournament__status--present">
          <?php _e( 'Проходит', 'earena_2' ); ?>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="players">
          <div class="players__progress">
            <span class="players__progress-bar" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>
      </div>

      <div class="tournament__bottom">
        <div class="tournament__bottom-left">
          <h3 class="tournament__game">
            Dota 2
          </h3>
          <ul class="variations variations--lock">
            <li class="variations__item">
              5 vs 5
            </li>
          </ul>
        </div>

        <div class="platform">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-xbox"></use>
          </svg>
        </div>

        <div class="tournament__id">
          ID 30204874239
        </div>

        <div class="tournament__bet">
          $50
        </div>
      </div>
    </a>
  </div>
<?php elseif ($tournament_index === 2) : ?>
  <!-- Past -->
  <div class="tournament">
    <a class="tournament__link tournament__link--past" href="">
      <div class="tournament__top">
        <div class="tournament__image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/tournaments/game-<?= $tournament_index; ?>.jpg" alt="Game">
        </div>

        <div class="tournament__top-content">
          <div class="tournament__winner">
            <div class="tournament__winner-image-wrapper">
              <div class="tournament__winner-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-3.png" alt="User">
              </div>
            </div>

            <h5 class="tournament__winner-name">
              Bessie_Cooper
            </h5>
          </div>
          <div class="tournament__trophy">
            $5 000
          </div>
        </div>
      </div>

      <div class="tournament__center">
        <h4 class="tournament__name">
          Myanmar Championship 2020 Season 2 Premium
        </h4>

        <div class="tournament__status tournament__status--past">
          <?php _e( 'Завершился', 'earena_2' ); ?> <time>25/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="players">
          <div class="players__progress">
            <span class="players__progress-bar players__progress-bar--past" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>
      </div>

      <div class="tournament__bottom">
        <div class="tournament__bottom-left">
          <h3 class="tournament__game">
            CS:GO
          </h3>
          <ul class="variations">
            <li class="variations__item">
              1 vs 1
            </li>
          </ul>
        </div>

        <div class="platform">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-desktop"></use>
          </svg>
        </div>

        <div class="tournament__id">
          ID 30204874239
        </div>

        <div class="tournament__bet">
          $15
        </div>
      </div>
    </a>
  </div>
<?php elseif ($tournament_index === 3) : ?>
  <!-- My -->
  <div class="tournament">
    <a class="tournament__link tournament__link--my" href="">
      <div class="tournament__top">
        <div class="tournament__image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/tournaments/game-<?= $tournament_index; ?>.jpg" alt="Game">
        </div>

        <div class="tournament__top-content">
          <div class="tournament__trophy">
            $300
          </div>
        </div>
      </div>

      <div class="tournament__center">
        <h4 class="tournament__name">
          Championship 2020 Season 2 Premium
        </h4>

        <div class="tournament__status tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?> <time>25/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начало', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="players">
          <div class="players__progress">
            <span class="players__progress-bar" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>
      </div>

      <div class="tournament__bottom">
        <div class="tournament__bottom-left">
          <h3 class="tournament__game">
            Mortal Combat 11
            Ultimate
          </h3>
          <ul class="variations variations--lock">
            <li class="variations__item">
              1 vs 1
            </li>
          </ul>
        </div>

        <div class="platform">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-playstation"></use>
          </svg>
        </div>

        <div class="tournament__id">
          ID 30204874239
        </div>

        <div class="tournament__bet">
          $120
        </div>
      </div>
    </a>
  </div>
<?php else : ?>
  <div class="tournament">
    <a class="tournament__link" href="/tournament">
      <div class="tournament__top">
        <div class="tournament__image">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/tournaments/game-<?= $tournament_index; ?>.jpg" alt="Game">
        </div>

        <div class="tournament__top-content">
          <div class="tournament__trophy">
            $5 000
          </div>
        </div>
      </div>

      <div class="tournament__center">
        <h4 class="tournament__name">
          Myanmar Championship 2020 Season 2 Premium
        </h4>

        <div class="tournament__status tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?> <time>25/10/2021 (13:00)</time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начало', 'earena_2' ); ?> <time>30/10/2021 (13:00)</time>
        </div>
        <div class="players">
          <div class="players__progress">
            <span class="players__progress-bar" data-width="71"></span>
          </div>
          <div class="players__text">
            71/100
          </div>
        </div>
      </div>

      <div class="tournament__bottom">
        <div class="tournament__bottom-left">
          <h3 class="tournament__game">
            WARZONE
          </h3>
          <ul class="variations">
            <li class="variations__item">
              1 vs 1
            </li>
          </ul>
        </div>

        <div class="platform">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-xbox"></use>
          </svg>
        </div>

        <div class="tournament__id">
          ID 30204874239
        </div>

        <div class="tournament__bet">
          Free
        </div>
      </div>
    </a>
  </div>
<?php endif; ?>
