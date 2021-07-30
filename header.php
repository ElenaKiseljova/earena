<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title></title>
    <?php
      wp_head();
    ?>
  </head>
  <body>
    <!-- SVG sprite -->
    <div class="visually-hidden">
      <?php
        include('assets/img/sprite.svg');
      ?>
    </div>

    <!-- Header -->
    <header class="page-header">
      <div class="page-header__top">
        <div class="page-header__wrapper">
          <div class="logo logo--header">
            <a href="<?php echo bloginfo( 'url' ); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php echo bloginfo( 'name' ); ?>">
            </a>
          </div>

          <div class="languages">
            <?php
              // Для отображения нужной иконки текущего языка
              $current_lang_slug = 'ru';

              // Список с языками
              $language_slugs = ['en', 'es', 'it', 'ch', 'cn'];
            ?>
            <div class="languages__current">
              <svg class="languages__flag" width="28" height="20">
                <use xlink:href="#icon-flag-<?= $current_lang_slug; ?>"></use>
              </svg>
            </div>

            <ul class="languages__list">
              <?php foreach ($language_slugs as $language_slug): ?>
                <li class="languages__item">
                  <a class="languages__link" href="#">
                    <svg class="languages__flag" width="28" height="20">
                      <use xlink:href="#icon-flag-<?= $language_slug; ?>"></use>
                    </svg>

                    <span class="languages__slug">
                      <?= $language_slug; ?>
                    </span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div class="time">
            <time class="time__date">
              22:45
            </time>
            <span class="time__format">
              (UTC+0)
            </span>
          </div>

          <?php
            $loged = rand(0, 1);
          ?>
          <?php if ($loged): ?>
            <div class="page-header__right page-header__right--loged">
              <a class="button button--signout" href="#">
                <svg width="18" height="18">
                  <use xlink:href="#icon-signout"></use>
                </svg>
              </a>
            </div>
          <?php else : ?>
            <div class="page-header__right page-header__right--nologed">
              <button class="button button--green openpopup" data-popup="login" type="button" name="signin">
                <svg width="18" height="18">
                  <use xlink:href="#icon-signin"></use>
                </svg>

                <span>
                  <?php _e( 'Войти', 'earena_2' ); ?>
                </span>
              </button>

              <button class="button button--blue openpopup" data-popup="login" type="button" name="signup">
                <span>
                  <?php _e( 'Регистрация', 'earena_2' ); ?>
                </span>
              </button>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="page-header__bottom">
        <div class="page-header__wrapper">
          <nav class="navigation navigation--header" role="menu">
            <h5 class="visually-hidden">
              <?php _e( 'Меню', 'earena_2' ); ?>
            </h5>

            <?php
              $menu_items = [
                'Главная',
                'Матчи на деньги',
                'Турниры',
                'Команда Earena',
                'Кибершкола',
                'Магазин',
                'Сотрудничество',
                'Поддержка игроков',
                'Новости киберспорта',
                'Общий чат'
              ];
            ?>

            <ul class="navigation__list">
              <?php foreach ($menu_items as $menu_item): ?>
                <li class="navigation__item">
                  <a href="#">
                    <div>
                      <?php if ($menu_item === 'Главная'): ?>
                        <svg width="18" height="18">
                          <use xlink:href="#icon-home"></use>
                        </svg>
                      <?php elseif ($menu_item === 'Матчи на деньги') : ?>
                        <svg width="22" height="22">
                          <use xlink:href="#icon-gamepad"></use>
                        </svg>
                      <?php elseif ($menu_item === 'Турниры') : ?>
                        <svg width="22" height="22">
                          <use xlink:href="#icon-trophy"></use>
                        </svg>
                      <?php endif; ?>
                    </div>

                    <span>
                      <?= $menu_item; ?>
                    </span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          </nav>
        </div>
      </div>
    </header>
