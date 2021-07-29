
    <footer class="page-footer">
      <div class="page-footer__wrapper">
        <div class="logo logo--footer">
          <?php
            if ( function_exists( 'the_custom_logo' ) ) {
             the_custom_logo();
            }
          ?>
        </div>

        <div class="page-footer__center">
          <nav class="navigation navigation--footer" role="navigation">
            <?php
              wp_nav_menu(
                array(
                  'theme_location'  => 'bottom_menu',
                  'container'       => null,
                  'menu_class'      => 'navigation__list navigation__list--footer',
                  'depth'           => 0,
                )
              );
            ?>
          </nav>
        </div>

        <div class="page-footer__contact">
          <a class="page-footer__phone" href="tel:+380682692525">+38 068 269 25 25</a>
          <a class="button button--footer" href="<?php echo get_page_link( 12 ); ?>">Связаться с нами</a>
        </div>
      </div>
      <div class="page-footer__wrapper">
        <a class="subline subline--privacy" href="<?php echo get_privacy_policy_url(); ?>">
          Политика конфиденциальности
        </a>
        <p class="page-footer__creater">
          Сделано в <a href="https://webnauts.pro" target="_blank">Webnauts</a> c
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5.99994 1.6419C7.37019 0.411655 9.48769 0.452488 10.8078 1.77491C12.1273 3.09791 12.1728 5.20491 10.9454 6.57924L5.99877 11.5329L1.05327 6.57924C-0.174064 5.20491 -0.127981 3.09441 1.19094 1.77491C2.51219 0.454238 4.6256 0.409905 5.99994 1.6419Z" fill="white"/>
          </svg>
        </p>
      </div>
    </footer>

    <div class="popup">
      <div class="popup__wrapper">
        <h2 class="popup__title">

        </h2>
        <button class="popup__close" type="button" name="close">
          <span class="visually-hidden">Закрыть</span>
        </button>
      </div>
    </div>
    <div class="popup__overlay"></div>
    <?php
      wp_footer();
    ?>
  </body>
</html>
