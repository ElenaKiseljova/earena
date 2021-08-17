<?php
  /*
    Статистика друзей на странице аккаунта
  */
?>
<?php
  // Приватный режим
  global $private;
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (25)
    </h3>

    <button class="statistics__all togglechecker" data-toggle-index="<?php if ($private) echo '4'; else echo '3'; ?>" type="button" name="friends">
      <?php _e( 'Все друзья', 'earena_2' ); ?>
    </button>
  </header>

  <div class="statistics__content statistics__content--account">
    <ul class="statistics__list">
      <?php
        for ($i=1; $i < 9; $i++) {
          ?>
            <li class="statistics__item">
              <div class="user user--friends">
                <?php
                  $avatar = rand(0, 1);
                  $verified = rand(0, 1);
                ?>
                <div class="user__image-wrapper user__image-wrapper--friends <?php if ($verified) { echo 'user__image-wrapper--verified'; } else { echo 'user__image-wrapper--not-verified'; } ?>">
                  <div class="user__avatar user__avatar--friends account__image--public">
                    <?php if ($avatar): ?>
                      <img width="70" height="70" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>">
                    <?php else : ?>
                      <img width="70" height="70" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
                    <?php endif; ?>
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
