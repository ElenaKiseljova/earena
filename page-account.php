<?php
  /*
    Аккаунт игрока
  */
?>

<?php
  get_header(  );
?>

<?php
  // Страница Акаунта
  global $is_account_page;

  $is_account_page = true;

  // Приватный / публичный (для теста)
  global $private;

  $private = rand(0, 1);
  $vip = rand(0, 1);
  $verified = rand(0, 1);
?>

<main class="page-main">
  <section class="account">
    <div class="account__wrapper">
      <header class="account__header <?php if ($vip && $private) echo 'account__header--vip'; ?>">
        <div class="account__left">
          <div class="user user--account">
            <div class="user__image-wrapper <?php if ($verified) { echo 'user__image-wrapper--verified'; } else { echo 'user__image-wrapper--not-verified'; } ?>">
              <?php if ($private): ?>
                <div class="user__avatar user__avatar--account">
                  <input class="user__avatar-input visually-hidden" type="file" name="account-image" id="account-image">
                  <label class="user__avatar-label" for="account-image">
                    <span class="visually-hidden">
                      <?php _e( 'Загрузить аватар', 'earena_2' ); ?>
                    </span>
                  </label>
                  <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>">
                </div>
              <?php else : ?>
                <div class="user__avatar user__avatar--account account__image--public">
                  <!-- <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>"> -->
                  <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
                </div>
              <?php endif; ?>
            </div>

            <div class="user__info user__info--account">
              <h1 class="user__name user__name--account">
                <?php the_title(  ); ?>
              </h1>

              <?php
                // Все флаги из макета загружены в папку flags. Для подстановки нужного - менятеся слаг
                $user_countries_slug = 'ru';
              ?>
              <div class="user__country user__country--account">
                <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $user_countries_slug; ?>.svg" alt="">
              </div>

              <?php
                $online = rand(0, 1);
              ?>
              <?php if ($online): ?>
                <div class="user__status user__status--account user__status--online">
                  Online
                </div>
              <?php else : ?>
                <div class="user__status user__status--account">
                  <?php
                    _e( 'Был(а) 1 час назад', 'earena_2' );
                  ?>
                </div>
              <?php endif; ?>

              <div class="user__money user__money--account">
                $2 714
              </div>

              <div class="user__rating user__rating--account">
                <span>
                  <?php _e( 'Рейтинг', 'earena_2' ); ?>
                </span>: 518
              </div>
            </div>
          </div>
        </div>
        <div class="account__right">
          <ul class="account__emoji">
            <li class="account__emoji-item">
              <input class="visually-hidden" id="account-emoji-relax" type="radio" name="account-emoji" value="relax" checked>
              <label class="account__emoji-label" for="account-emoji-relax">
                😌
              </label>
            </li>
            <li class="account__emoji-item">
              <input class="visually-hidden" id="account-emoji-angry" type="radio" name="account-emoji" value="angry">
              <label class="account__emoji-label" for="account-emoji-angry">
                😬
              </label>
            </li>
            <li class="account__emoji-item">
              <input class="visually-hidden" id="account-emoji-dizziness" type="radio" name="account-emoji" value="dizziness">
              <label class="account__emoji-label" for="account-emoji-dizziness">
                😵
              </label>
            </li>
          </ul>

          <div class="account__buttons">
            <?php if ($private): ?>
              <!-- Пополнить счет -->
              <a class="button button--green" href="purse">
                <span>
                  <?php _e( 'Пополнить счет', 'earena_2' ); ?>
                </span>
              </a>

              <button class="account__vip <?php if ($vip) echo 'account__vip--active'; ?> button button--orange openpopup" data-popup="vip" type="button" name="vip">
                <?php if ($vip): ?>
                  <span>
                    <?php _e( 'VIP статус до', 'earena_2' ); ?> <time>21.07.21</time>
                  </span>
                <?php else : ?>
                  <span>
                    <?php _e( 'VIP статус', 'earena_2' ); ?>
                  </span>
                <?php endif; ?>
              </button>
            <?php else : ?>
              <!-- Удалить из друзей / Добавить в друзья -->
              <button class="button button--gray" type="button" name="ended">
                <span>
                  <?php _e( 'Добавить в друзья', 'earena_2' ); ?>
                </span>
              </button>

              <button class="account__message button button--blue openpopup" data-popup="add" type="button" name="add">
                <span>
                  <?php _e( 'Сообщение', 'earena_2' ); ?>
                </span>
              </button>
            <?php endif; ?>
          </div>
        </div>
      </header>
      <!-- Переключатели -->
      <?php
        get_template_part( 'template-parts/toggles/toggles', 'account' );
      ?>
    </div>
  </section>
  <!-- Партнеры -->
  <?php
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
