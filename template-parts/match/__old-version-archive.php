<?php
  // Индекс матча
  global $match_index;
?>

<?php if ($match_index === 0): ?>
  <!-- Future -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          WARZONE
        </h3>
        <ul class="variations">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img width="80" height="80" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.png" alt="Avatar">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/account">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $5
      </div>

      <div class="match__button-wrapper">
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 1) : ?>
  <!-- Present -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          WARZONE
        </h3>
        <ul class="variations">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <button class="user__stream" type="button" name="button">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </button>
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-1.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>

      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $5
      </div>

      <div class="match__button-wrapper">
        <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Проходит', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 2) : ?>
  <!-- Past -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          WARZONE
        </h3>
        <ul class="variations variations--lock">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-1.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--end">
        <span>
          1 : 0
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $5
      </div>

      <div class="match__button-wrapper">
        <button class="button button--gray openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Завершен', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 3) : ?>
  <!-- My . Chat -->
  <div class="match match--my">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          Dota 2
        </h3>
        <ul class="variations">
          <li class="variations__item">
            5 vs 5
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-desktop"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-3.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $100
      </div>

      <div class="match__button-wrapper">
        <a class="button button--gray" href="/chat?type=match">
          <span class="button__chat button__chat--left">
            24
          </span>
          <span>
            <?php _e( 'В чат', 'earena_2' ); ?>
          </span>
        </a>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 4): ?>
  <!-- Free -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          CS:GO
        </h3>
        <ul class="variations">
          <li class="variations__item">
            5 vs 5
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-playstation"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-3.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/account">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        Free
      </div>

      <div class="match__button-wrapper">
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 5): ?>
  <!-- My . Delete -->
  <div class="match match--my">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          Mortal Combat 11 Ultimate
        </h3>
        <ul class="variations variations--lock">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-desktop"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/account">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $3
      </div>

      <div class="match__button-wrapper">
        <button class="button button--red openpopup" data-popup="match" type="button" name="delete">
          <span>
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php elseif ($match_index === 6): ?>
  <!-- Ultimate Team -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          League of Legends
        </h3>
        <ul class="variations">
          <li class="variations__item">
            Ultimate Team
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-desktop"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/account">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        $25
      </div>

      <div class="match__button-wrapper">
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <!-- Free -->
  <div class="match">
    <div class="match__image">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/game-<?= $match_index; ?>.png" alt="Game">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          Heroes III
        </h3>
        <ul class="variations">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-mobile"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
      <div class="user user--match">
        <a class="user__avatar user__avatar--match" href="/account">
          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/match-user-2.png" alt="User">
        </a>
        <a class="user__name user__name--match" href="/account">
          <h5>
            AnnetteBlack
          </h5>
        </a>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        Free
      </div>

      <div class="match__button-wrapper">
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>

        <div class="match__id">
          ID 30204874239
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
