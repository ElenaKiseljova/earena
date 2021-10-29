<?php
  /*
    Аккордеон (стр Тура)
  */
?>
<?php
  global $tournament, $tournament_id, $icons, $ea_icons, $ea_user;

  // $tournament_waiting = ($tournament->status < 2) ? true : false;
  // $tournament_registration = ($tournament->status >= 2 && $tournament->status < 4) ? true : false;
  // $tournament_present = ($tournament->status >= 4 && $tournament->status <= 101) ? true : false;
  // $tournament_ended = ($tournament->status > 101 && $tournament->status < 103) ? true : false;
  // $tournament_cancel = ($tournament->status == 103) ? true : false;
?>

<div class="accordeon accordeon--tournament">
  <!-- Future -->
  <ul class="accordeon__list">
    <!-- <?php
      for ($i=1; $i < 7; $i++) {
        ?>
          <li class="accordeon__item">
            <button class="accordeon__button accordeon__button--future" disabled type="button" name="accordeon">
              <span class="accordeon__round">
                1 <?php _e( 'тур', 'earena_2' ); ?>
              </span>
              <time class="accordeon__date">
                25.10.2012 – 26.10.2012
              </time>
            </button>
          </li>
        <?php
      }
    ?> -->

    <!-- Present -->
    <li class="accordeon__item">
      <button class="accordeon__button accordeon__button--present" type="button" name="accordeon">
        <span class="accordeon__round">
          1 <?php _e( 'тур', 'earena_2' ); ?>
        </span>
        <span class="accordeon__status">
          <?php _e( 'Завершен', 'earena_2' ); ?>
        </span>
        <time class="accordeon__date">
          25.10.2012 – 26.10.2012
        </time>
      </button>

      <ul class="accordeon__content">
        <li class="accordeon__content-item">
          <a class="accordeon__user accordeon__user--left" href="#">
            <div class="accordeon__user-image accordeon__user-image--online">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
            </div>
            <h5 class="accordeon__user-name">
              Cameronilliamson
            </h5>
          </a>

          <div class="accordeon__result">
            <span class="accordeon__result-text">
              vs
            </span>
          </div>

          <a class="accordeon__user accordeon__user--right" href="#">
            <div class="accordeon__user-image">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
            </div>
            <h5 class="accordeon__user-name">
              Cameronilliamson
            </h5>
          </a>

          <a class="accordeon__chat accordeon__chat--tournament button button--gray" href="/chat?type=tournament">
            <span class="button__chat button__chat--right">
              24
            </span>
            <span>
              <?php _e( 'В чат', 'earena_2' ); ?>
            </span>
          </a>
        </li>
      </ul>
    </li>
    <?php
      for ($i=2; $i < 6; $i++) {
        ?>
          <li class="accordeon__item">
            <button class="accordeon__button accordeon__button--present" type="button" name="accordeon">
              <span class="accordeon__round">
                <?= $i; ?> <?php _e( 'тур', 'earena_2' ); ?>
              </span>

              <time class="accordeon__date">
                25.10.2012 – 26.10.2012
              </time>
            </button>

            <ul class="accordeon__content">
              <?php
                for ($k=1; $k < 5; $k++) {
                  ?>
                    <li class="accordeon__content-item">
                      <a class="accordeon__user accordeon__user--left" href="#">
                        <div class="accordeon__user-image">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $k; ?>.png" alt="Avatar">
                        </div>
                        <h5 class="accordeon__user-name">
                          Cameronilliamson
                        </h5>
                      </a>

                      <div class="accordeon__result">
                        <span class="accordeon__result-text">
                          2 : 1
                        </span>
                      </div>

                      <a class="accordeon__user accordeon__user--right" href="#">
                        <div class="accordeon__user-image">
                          <img src="<?php echo get_template_directory_uri(); ?>/assets/img/rating/rating-<?= $i; ?>.png" alt="Avatar">
                        </div>
                        <h5 class="accordeon__user-name">
                          Cameronilliamson
                        </h5>
                      </a>
                    </li>
                  <?php
                }
              ?>
            </ul>
          </li>
        <?php
      }
    ?>
  </ul>
</div>
