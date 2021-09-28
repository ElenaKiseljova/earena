<?php
  // Сообщения (вкладка)
?>

<div class="section section--message <?php echo (!is_ea_admin()) ? 'section--message-no-admin' : ''; ?>" id="message">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Сообщения', 'earena_2' ); ?> (<?= !empty(messages_get_unread_count()) ? messages_get_unread_count() : '0'; ?>)
    </h2>

    <div class="section__header-right">
    </div>
  </header>
  <?php
    //ea_message_box($thread_id);
    the_content();
  ?>
</div>

<?php
  // global $is_account_page;
  //
  // $privat_chat = $_GET['messages'] ? true : false;
?>
<?php //if ($privat_chat): ?>
  <!-- <div class="section section--message" id="message">
    <header class="section__header">
      <h2 class="section__title section__title--games-account">
        <?php _e( 'Сообщения', 'earena_2' ); ?>
      </h2>

      <div class="section__header-right">
      </div>
    </header>

    <ul class="section__list section__list--messages">
      <li class="section__item section__item--col-2 section__item--messages">
        <div class="user user--friends">
          <?php
            $avatar = rand(0, 1);
            $verified = rand(0, 1);
          ?>
          <div class="user__left user__left--friends">
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
        </div>
      </li>
      <li class="section__item section__item--col-2 section__item--chat">
        <div class="section__item-top">
          <h2 class="section__item-title">
            <?php _e( 'Диалог с', 'earena_2' ); ?> StacyBloom
          </h2>

          <a class="section__close" href="<?php echo bloginfo( 'url' ); ?>/profile?messages">
            <span class="visually-hidden">
              <?php _e( 'Назад', 'earena_2' ); ?>
            </span>
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </a>
        </div>

        <?php
          // Чат
          get_template_part( 'template-parts/chat' );
        ?>
      </li>
    </ul>
  </div> -->
<?php //else : ?>
  <!-- <ul class="section__list">
    <?php
      for ($l=0; $l < 10; $l++) {
        $new = rand(0, 1);
        $my = rand(0, 1);
        ?>
          <li class="section__item section__item--col-1 section__item--messages <?php if ($new) echo 'section__item--messages-new'; ?>">
            <div class="user user--messages">
              <?php
                $avatar = rand(0, 1);
                $verified = rand(0, 1);
              ?>
              <div class="user__left user__left--messages">
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
                  <a class="user__name user__name--friends <?php if ($is_account_page || $is_chat_page) echo 'user__name--disabled'; ?>" href="#">
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
              <a class="user__center user__center--messages" href="<?php echo bloginfo( 'url' ); ?>/profile?messages=privat">
                <time class="user__time user__time--messages">
                  12.11.2020 в 15:50
                </time>
                <?php if ($my): ?>
                  <div class="user__image-wrapper user__image-wrapper--my">
                    <div class="user__avatar user__avatar--my">
                      <?php if ($avatar): ?>
                        <img width="40" height="40" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>">
                      <?php else : ?>
                        <img width="40" height="40" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
                      <?php endif; ?>
                    </div>
                  </div>
                <?php endif; ?>

                <div class="user__message user__message--messages <?php if ($my) {echo 'user__message--my';} else if ($new) {echo 'user__message--new';}; ?>">
                  <p>
                    Explore Boshra M's board "adobe color" on Pinterest. See more ideas about color pallets, colour schemes, colour pall ... 😀
                  </p>
                </div>
              </a>
              <div class="user__right user__right--messages">
                <button class="section__close openpopup" data-popup="history" type="button" name="close">
                  <span class="visually-hidden">
                    <?php _e( 'Удалить', 'earena_2' ); ?>
                  </span>
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>

                <?php if ($new): ?>
                  <span class="user__messages-count">
                    1
                  </span>
                <?php endif; ?>
              </div>
            </div>
          </li>
        <?php
      }
    ?>
  </ul> -->
<?php //endif; ?>
