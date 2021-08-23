<?php
  /*
    Аккордеон (стр Аккаунта. Вкладка Турниры. Чат)
  */
?>

<div class="accordeon accordeon--tournaments-account-chat">
  <ul class="accordeon__list">
    <?php
      for ($i=1; $i <= 4; $i++) {
        ?>
          <li class="accordeon__item accordeon__item--tournaments-account-chat">
            <div class="accordeon__item-left">
              <span class="accordeon__round accordeon__round--tournaments-account-chat">
                <?= $i; ?> <?php _e( 'тур', 'earena_2' ); ?>
              </span>
              <time class="accordeon__date accordeon__date--tournaments-account-chat">
                25.10.2012 – 26.10.2012
              </time>
            </div>

            <ul class="accordeon__content accordeon__content--tournaments-account-chat">
              <li class="accordeon__content-item">
                <a class="accordeon__user accordeon__user--left" href="#">
                  <div class="accordeon__user-image accordeon__user-image--online">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-1.png" alt="Avatar">
                  </div>
                  <h5 class="accordeon__user-name">
                    Cameronilliamson
                  </h5>
                </a>

                <div class="accordeon__result accordeon__result--tournaments-account-chat">
                  <span class="accordeon__result-text">
                    vs
                  </span>
                </div>

                <a class="accordeon__user accordeon__user--right accordeon__user--disabled" href="#">
                  <div class="accordeon__user-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-2.png" alt="Avatar">
                  </div>
                  <h5 class="accordeon__user-name">
                    Cameronilliamson
                  </h5>
                </a>
              </li>
            </ul>

            <a class="accordeon__chat accordeon__chat--tournaments-account-chat button button--gray" href="/chat?type=tournament">
              <span class="button__chat button__chat--right">
                24
              </span>
              <span>
                <?php _e( 'В чат', 'earena_2' ); ?>
              </span>
            </a>
          </li>
        <?php
      }
    ?>
  </ul>
</div>
