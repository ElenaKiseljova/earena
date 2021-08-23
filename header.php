<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Gray Arena</title>
    <?php
      wp_head();
    ?>
  </head>
  <body>
    <div class="container">

      <!-- SVG sprite -->
      <div class="visually-hidden">
        <?php
          require_once('assets/img/sprite.svg');
        ?>
      </div>


      <!-- Header -->
      <header class="page-header">
        <div class="page-header__top">
          <div class="page-header__wrapper page-header__wrapper--top">
            <div class="logo logo--header">
              <a href="<?php echo bloginfo( 'url' ); ?>">
                <img width="179" height="37.39" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.svg" alt="<?php echo bloginfo( 'name' ); ?>">
              </a>
            </div>

            <!-- Для переключения состояния - добавляется active класс  -->
            <div class="page-header__center">
              <div class="languages">
                <?php
                  // Для отображения нужной иконки текущего языка
                  $current_lang_slug = 'ru';

                  // Список с языками
                  $language_slugs = ['us', 'es', 'it', 'ch', 'cn'];
                ?>
                <button class="languages__select" type="button" name="languages">
                  <img class="languages__flag" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $current_lang_slug; ?>.svg" alt="<?= $current_lang_slug; ?>">

                  <span class="visually-hidden">
                    <?= $current_lang_slug; ?>
                  </span>

                  <svg class="languages__toggle" width="18" height="22">
                    <use xlink:href="#icon-chevron-bottom"></use>
                  </svg>
                </button>

                <!-- Для переключения состояния - добавляется active класс  -->
                <ul class="languages__list">
                  <?php foreach ($language_slugs as $language_slug): ?>
                    <li class="languages__item">
                      <a class="languages__link" href="#">
                        <img class="languages__flag" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $language_slug; ?>.svg" alt="<?= $language_slug; ?>">

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
            </div>

            <?php
              // Для теста
              $logged = rand(0, 1);
            ?>
            <?php if ($logged): ?>
              <div class="page-header__right page-header__right--logged">
                <div class="user user--header">
                  <a class="user__avatar user__avatar--header" href="<?php echo bloginfo( 'url' ); ?>/account">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.png" alt="Avatar">
                  </a>
                  <div class="user__info user__info--header">
                    <a class="user__name user__name--header" href="<?php echo bloginfo( 'url' ); ?>/account">
                      <h5>
                        AnnetteBlack
                      </h5>
                    </a>

                    <div class="user__money">
                      <span class="user__money-amount">
                        $2 714
                      </span>
                      <a class="page-header__money-add page-header__money-add--desktop" href="purse">
                        <?php _e( 'Пополнить', 'earena_2' ); ?>
                      </a>
                    </div>
                  </div>

                  <a class="page-header__signout page-header__signout--desktop" href="#">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 12.75L15.75 9L12 5.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M15.75 9H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M6.75 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </a>
                </div>
                <?php
                  if (function_exists( 'earena_2_menu_loged_user' )) {
                    // Ф-я вывода шаблона меню залогиненного пользовател
                    earena_2_menu_loged_user('header');
                  }
                ?>
              </div>
            <?php else : ?>
              <div class="page-header__right page-header__right--nologged">
                <button class="page-header__signin openpopup" data-popup="login" type="button" name="signin">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip-signin)">
                      <path d="M5.5 12.75L9.25 9L5.5 5.25" stroke="#80D600" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9.25 9H0.25" stroke="#80D600" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M11.25 2.25H14.25C14.6478 2.25 15.0294 2.40804 15.3107 2.68934C15.592 2.97064 15.75 3.35218 15.75 3.75V14.25C15.75 14.6478 15.592 15.0294 15.3107 15.3107C15.0294 15.592 14.6478 15.75 14.25 15.75H11.25" stroke="#80D600" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                      <clipPath id="clip-signin">
                      <rect width="18" height="18" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>

                  <span>
                    <?php _e( 'Войти', 'earena_2' ); ?>
                  </span>
                </button>

                <button class="page-header__signup button button--blue openpopup" data-popup="login" type="button" name="signup">
                  <span>
                    <?php _e( 'Регистрация', 'earena_2' ); ?>
                  </span>
                </button>
              </div>
            <?php endif; ?>

            <!-- Для переключения состояния - добавляется active класс  -->
            <button class="page-header__burger" type="button" name="menu-toggle">
              <span class="visually-hidden">
                <?php _e( 'Открыть/закрыть меню', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </div>

        <!-- Для переключения состояния - добавляется active класс  -->
        <div class="page-header__bottom">
          <div class="page-header__wrapper page-header__wrapper--bottom">
            <?php if ($logged): ?>
              <a class="page-header__money-add page-header__money-add--mobile" href="<?php echo bloginfo( 'url' ); ?>/purse">
                <?php _e( 'Пополнить', 'earena_2' ); ?>
              </a>
            <?php endif; ?>

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
                  'Новости киберспорта'
                ];
              ?>

              <ul class="navigation__list navigation__list--header">
                <?php foreach ($menu_items as $menu_item): ?>
                  <li class="navigation__item navigation__item--header">
                    <?php if ($menu_item === __('Главная', 'earena_2') ): ?>
                      <!-- Для переключения состояния - добавляется active класс  -->
                      <a class="navigation__link navigation__link--header navigation__link--blue-hover <?php if (is_front_page() && !$_GET) echo 'active'; ?>" href="<?php echo bloginfo( 'url' ); ?>">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2.25 6.75L9 1.5L15.75 6.75V15C15.75 15.3978 15.592 15.7794 15.3107 16.0607C15.0294 16.342 14.6478 16.5 14.25 16.5H3.75C3.35218 16.5 2.97064 16.342 2.68934 16.0607C2.40804 15.7794 2.25 15.3978 2.25 15V6.75Z" stroke="#CFD8E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M6.75 16.5V9H11.25V16.5" stroke="#CFD8E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($menu_item === __('Матчи на деньги', 'earena_2') ) : ?>
                      <!-- Для переключения состояния - добавляется active класс  -->
                      <a class="navigation__link navigation__link--header navigation__link--blue-hover  <?php if (is_front_page() && function_exists('earena_2_current_page')) earena_2_current_page('matches'); ?>" href="<?php echo bloginfo( 'url' ); ?>?type=matches">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.0625 9.28125H15.8125" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M6.1875 9.28125H8.9375" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M7.5625 7.90625V10.6562" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M14.7829 4.79004L7.2192 4.8124C6.16854 4.81248 5.15149 5.18264 4.34658 5.85791C3.54166 6.53317 3.00033 7.47038 2.8176 8.50503L2.81834 8.50516L1.41202 15.7379C1.32319 16.2419 1.39734 16.761 1.62369 17.22C1.85004 17.679 2.2168 18.0538 2.67072 18.2901C3.12463 18.5264 3.64206 18.6119 4.14784 18.534C4.65363 18.4562 5.12144 18.2192 5.48333 17.8574L5.48319 17.8572L9.19875 13.7499L14.7829 13.7275C15.9681 13.7275 17.1047 13.2567 17.9428 12.4187C18.7808 11.5806 19.2516 10.444 19.2516 9.25879C19.2516 8.0736 18.7808 6.93696 17.9428 6.09891C17.1047 5.26085 15.9681 4.79004 14.7829 4.79004V4.79004Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M19.1837 8.48291L20.5888 15.738C20.6777 16.242 20.6035 16.7612 20.3772 17.2201C20.1508 17.6791 19.7841 18.0539 19.3302 18.2902C18.8762 18.5265 18.3588 18.612 17.853 18.5342C17.3472 18.4563 16.8794 18.2193 16.5175 17.8575L16.5177 17.8573L12.8047 13.7356" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php elseif ($menu_item === __('Турниры', 'earena_2') ) : ?>
                      <!-- Для переключения состояния - добавляется active класс  -->
                      <a class="navigation__link navigation__link--header navigation__link--blue-hover  <?php if (function_exists('earena_2_current_page')) earena_2_current_page('tournaments'); ?>" href="<?php echo bloginfo( 'url' ); ?>?type=tournaments">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M4.8125 4.8125V9.54732C4.8125 12.9591 7.54141 15.787 10.9531 15.8123C11.7696 15.8185 12.5792 15.663 13.3353 15.3549C14.0914 15.0467 14.7791 14.5919 15.3586 14.0168C15.9381 13.4416 16.3981 12.7574 16.712 12.0037C17.0259 11.2499 17.1875 10.4415 17.1875 9.625V4.8125C17.1875 4.63016 17.1151 4.4553 16.9861 4.32636C16.8572 4.19743 16.6823 4.125 16.5 4.125H5.5C5.31766 4.125 5.1428 4.19743 5.01386 4.32636C4.88493 4.4553 4.8125 4.63016 4.8125 4.8125Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M8.25 19.25H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M11 15.8125V19.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M17.6695 10.7356H17.7639C18.4933 10.7356 19.1927 10.4459 19.7085 9.93014C20.2242 9.41441 20.5139 8.71494 20.5139 7.9856V6.6106C20.5139 6.42826 20.4415 6.25339 20.3125 6.12446C20.1836 5.99553 20.0087 5.9231 19.8264 5.9231H17.5" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M4.98122 11H4.11401C3.38467 11 2.6852 10.7103 2.16947 10.1945C1.65375 9.67882 1.36401 8.97935 1.36401 8.25V6.875C1.36401 6.69266 1.43645 6.5178 1.56538 6.38886C1.69431 6.25993 1.86918 6.1875 2.05151 6.1875H4.80151" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    <?php else : ?>
                      <!-- Для переключения состояния - добавляется active класс  -->
                      <a class="navigation__link navigation__link--header" href="#">
                    <?php endif; ?>
                      <span>
                        <?= $menu_item; ?>
                      </span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </nav>

            <div class="page-header__right page-header__right--chats">
              <button class="chats chats--header openpopup" data-popup="chats" type="button" name="chats">
                <svg class="chats__icon chats__icon--arrow" width="20" height="20">
                  <use xlink:href="#icon-arrow-left"></use>
                </svg>

                <svg class="chats__icon chats__icon--conversation" width="22" height="22">
                  <use xlink:href="#icon-chats"></use>
                </svg>

                <span>
                  <?php _e( 'Общий чат', 'earena_2' ); ?>
                </span>
              </button>

              <?php if ($logged): ?>
                <a class="page-header__signout page-header__signout--mobile" href="#">
                  <span>
                    <?php _e( 'Выйти', 'earena_2' ); ?>
                  </span>

                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12.75L15.75 9L12 5.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.75 9H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.75 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>
              <?php else : ?>
                <button class="page-header__signup-mobile  button button--blue openpopup" data-popup="login" type="button" name="signup">
                  <span>
                    <?php _e( 'Регистрация', 'earena_2' ); ?>
                  </span>
                </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </header>
