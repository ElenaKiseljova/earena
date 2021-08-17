<?php
  // Страница Акаунта
  global $is_account_page;

  // Приватный режим
  global $private;
?>

<div class="section section--friends" id="friends">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Друзья', 'earena_2' ); ?> (25)
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--friends">
    <li class="section__item section__item--col-2 section__item--friends section__item--new-request">
      <div class="user user--friends-page">
        <?php
          $avatar = rand(0, 1);
          $verified = rand(0, 1);
        ?>
        <div class="user__left">
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
        <div class="user__right user__right--new-request">
          <span class="user__request">
            <?php _e( 'Новая заявка', 'earena_2' ); ?>
          </span>
          <button class="user__button user__button--friends user__button--new-request button button--green" type="button" name="accept">
            <span>
              <?php _e( 'Добавить', 'earena_2' ); ?>
            </span>
          </button>
          <button class="user__button user__button--friends user__button--new-request button button--gray" type="button" name="delete">
            <span>
              <?php _e( 'Добавить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </div>
    </li>
    <?php
      for ($l=0; $l < 26; $l++) {
        ?>
          <li class="section__item section__item--col-2 section__item--friends">
            <div class="user user--friends-page">
              <?php
                $avatar = rand(0, 1);
                $verified = rand(0, 1);
              ?>
              <div class="user__left">
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
              <div class="user__right">
                <button class="user__button user__button--friends button button--blue" type="button" name="write">
                  <span>
                    <?php _e( 'Написать', 'earena_2' ); ?>
                  </span>
                </button>
                <button class="user__button user__button--friends button button--gray" type="button" name="delete">
                  <span>
                    <?php _e( 'Удалить', 'earena_2' ); ?>
                  </span>
                </button>
              </div>
            </div>
          </li>
        <?php
      }
    ?>
  </ul>
</div>
