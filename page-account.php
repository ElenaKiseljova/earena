<?php
  /*
    Аккаунт игрока
  */
?>

<?php
  get_header(  );
?>

<?php
  global $private;

  $private = rand(0, 1);
?>

<main class="page-main">
  <section class="account">
    <div class="account__wrapper">
      <header class="account__header">
        <div class="account__left">
          <div class="account__image-wrapper account__image-wrapper--verified">
            <?php if ($private): ?>
              <div class="account__image account__image--private">
                <input class="account__image-input visually-hidden" type="file" name="account-image" id="account-image">
                <label class="account__image-label" for="account-image">
                  <span class="visually-hidden">
                    <?php _e( 'Загрузить аватар', 'earena_2' ); ?>
                  </span>
                </label>
                <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>">
              </div>
            <?php else : ?>
              <div class="account__image account__image--public">
                <!-- <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>"> -->
                <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
              </div>
            <?php endif; ?>
          </div>

          <div class="account__information">
            <h1 class="account__title">
              <?php the_title(  ); ?>
            </h1>

            <?php
              // Все флаги из макета загружены в папку flags. Для подстановки нужного - менятеся слаг
              $user_countries_slug = 'ru';
            ?>
            <div class="account__country">
              <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $user_countries_slug; ?>.svg" alt="">
            </div>

            <?php
              $online = rand(0, 1);
            ?>
            <?php if ($online): ?>
              <div class="account__status account__status--online">
                Online
              </div>
            <?php else : ?>
              <div class="account__status">
                Offline
              </div>
            <?php endif; ?>

            <div class="account__money">
              $2 714
            </div>

            <div class="account__rating">
              <span>
                <?php _e( 'Рейтинг', 'earena_2' ); ?>
              </span>: 518
            </div>
          </div>
        <div>
      </header>
      <!-- Переключатели -->
      <?php
        get_template_part( 'template-parts/toggles/toggles', 'account' );
      ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
