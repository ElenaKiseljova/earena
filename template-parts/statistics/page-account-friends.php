<?php
  /*
    Статистика друзей на странице аккаунта
  */
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (25)
    </h3>

    <a class="statistics__all" href="?type=friends">
      <?php _e( 'Все друзья', 'earena_2' ); ?>
    </a>
  </header>

  <div class="statistics__content statistics__content--account">
    <ul class="statistics__list">
      <?php
        for ($i=1; $i < 9; $i++) {
          ?>
            <li class="statistics__item">
              <div class="user user--account">
                <!-- --verified / --not-verified -->
                <div class="user__image-wrapper user__image-wrapper--verified user__image-wrapper--friends">
                  <div class="user__avatar user__avatar--account account__image--public">
                    <!-- <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>"> -->
                    <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
                  </div>
                </div>

                <div class="user__info user__info--friends">
                  <a class="user__name user__name--friends" href="#">
                    <h5>
                      KiaraHills
                    </h5>
                  </a>

                  <?php
                    // Все флаги из макета загружены в папку flags. Для подстановки нужного - менятеся слаг
                    $user_countries_slug = 'ru';
                  ?>
                  <div class="user__country user__country--friends">
                    <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $user_countries_slug; ?>.svg" alt="">
                  </div>

                  <?php
                    $online = rand(0, 1);
                  ?>
                  <?php if ($online): ?>
                    <div class="user__status user__status--online user__status--friends">
                      Online
                    </div>
                  <?php else : ?>
                    <div class="user__status user__status--friends">
                      <?php
                        _e( 'Был(а) 1 час назад', 'earena_2' );
                      ?>
                    </div>
                  <?php endif; ?>

                  <div class="user__rating user__rating--friends">
                    <span>
                      <?php _e( 'Рейтинг', 'earena_2' ); ?>
                    </span>: 518
                  </div>
                </div>
              </div>
            </li>
          <?php
        }
      ?>
    </ul>
  </div>
</div>
