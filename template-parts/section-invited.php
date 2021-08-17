<?php
  // Приглашенные (вкладка)
?>

<div class="section section--invited" id="invited">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Приглашенные', 'earena_2' ); ?> (4)
    </h2>

    <div class="section__header-right">
      <button class="section__copy updateclipboard" type="button" name="copy">
        https://earena.bet/?hl=ru&tab=TT&sl=auto&tl
      </button>
    </div>
  </header>

  <ul class="section__list section__list--friends">
    <?php
      for ($l=0; $l < 10; $l++) {
        ?>
          <li class="section__item section__item--col-2 section__item--friends">
            <div class="user user--invited">
              <?php
                $avatar = rand(0, 1);
                $verified = rand(0, 1);
              ?>
              <div class="user__left">
                <div class="user__image-wrapper user__image-wrapper--friends <?php if ($verified) { echo 'user__image-wrapper--verified'; } else { echo 'user__image-wrapper--not-verified'; } ?>">
                  <div class="user__avatar user__avatar--friends">
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
              <div class="user__right">
                <div class="user__money user__money--invited">
                  $2.84
                </div>
              </div>
            </div>
          </li>
        <?php
      }
    ?>
  </ul>
</div>
