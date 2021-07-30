
    <footer class="page-footer">
      <div class="page-footer__wrapper">
        <div class="logo logo--footer">
          <a href="<?php echo bloginfo( 'url' ); ?>">
            <img width="179" height="37.39" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-footer.svg" alt="<?php echo bloginfo( 'name' ); ?>">
          </a>
        </div>

        <nav class="navigation navigation--footer" role="menu">
          <h5 class="visually-hidden">
            <?php _e( 'Меню', 'earena_2' ); ?>
          </h5>

          <?php
            $menu_items = [
              'Команда Earena',
              'Кибершкола',
              'Магазин',
              'Сотрудничество',
              'Поддержка игроков',
              'Новости киберспорта'
            ];
          ?>

          <ul class="navigation__list navigation__list--footer">
            <?php foreach ($menu_items as $menu_item): ?>
              <li class="navigation__item navigation__item--footer">
                <a href="#">
                  <span>
                    <?= $menu_item; ?>
                  </span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>

        <button class="button button--chats-footer openpopup" data-popup="chats" type="button" name="chats">
          <span>
            <?php _e( 'Общий чат', 'earena_2' ); ?>
          </span>
        </button>

        <div class="page-footer__bottom">
          <p class="page-footer__copyright">
            <span>
              © 2021 — EArena.
            </span>
            <span>
              <?php _e( 'Платформа киберспортивных игр', 'earena_2' ); ?>
            </span>
          </p>

          <?php
            $pay_methods = [
              'visa',
              'mastercard',
              'skrill',
              'payoneer'
            ];
          ?>
          <ul class="pay-methods">
            <?php foreach ($pay_methods as $pay_method): ?>
              <li class="pay-methods__item">
                <img width="90" height="40" src="<?php echo get_template_directory_uri(); ?>/assets/img/pay-methods-<?= $pay_method; ?>.svg" alt="<?= $pay_method; ?>">
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
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
