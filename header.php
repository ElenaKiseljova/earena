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
      <div class="page-header__wrapper">
        <div class="logo logo--header">
          <?php
            if ( function_exists( 'the_custom_logo' ) ) {
             the_custom_logo();
            }
          ?>
        </div>

        <nav class="navigation navigation--header" role="menu">
          <h5 class="navigation__title">Меню</h5>
          <button class="navigation__close" type="button" name="close-menu">
            <span class="visually-hidden">Закрыть меню</span>
          </button>

          <?php
            wp_nav_menu(
              array(
                'theme_location'  => 'top_menu',
                'container'       => null,
                'menu_class'      => 'navigation__list navigation__list--header',
                'depth'           => 0,
              )
            );
          ?>
        </nav>
        <button class="navigation__toggle" type="button" name="open-menu" aria-label="Переключатель мобильного меню">
          <svg width="33" height="22">
            <use xlink:href="#icon-menu"></use>
          </svg>
          <span class="visually-hidden">Открыть меню</span>
        </button>

        <button class="button openpopup" data-popup="call" type="button" name="button">
          Бесплатная online-консультация
        </button>
      </div>
    </header>
