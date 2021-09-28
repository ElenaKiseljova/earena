
      <footer class="page-footer">
        <div class="page-footer__top">
          <div class="page-footer__wrapper page-footer__wrapper--top">
            <div class="logo logo--footer">
              <a href="<?php echo bloginfo( 'url' ); ?>">
                <?php
                  $logo_footer = get_theme_mod( 'footer_logo_settings' );

                  $logo_footer = $logo_footer ? $logo_footer : '';
                ?>

                <img width="179" height="37.39" src="<?= $logo_footer; ?>" alt="<?php echo bloginfo( 'name' ); ?>">
              </a>
            </div>

            <?php
              get_template_part( 'template-parts/menus/footer' );
            ?>
            <?php
              /****** Кнопка вызова Общего чата закоммичена до лучших времен ******/
            ?>
            <!-- <button class="chats chats--footer openpopup" data-popup="chats" type="button" name="chats">
              <span>
                <?php _e( 'Общий чат', 'earena_2' ); ?>
              </span>
            </button> -->
          </div>
        </div>
        <div class="page-footer__bottom">
          <div class="page-footer__wrapper page-footer__wrapper--bottom">
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

      <?php
        /*
          Ф-я подключает нужный шаблон popup
        */
        if ( function_exists( 'earena_2_get_popup' ) ) {
          /****** Попап Общего чата закоммичен до лучших времен ******/
          // Попап с Чатом
          //earena_2_get_popup( 'chat' );

          // Попап с Регистрацией/Входом
          earena_2_get_popup( 'login' );

          // Попап с формой управлеия Турниром
          earena_2_get_popup( 'tournament' );

          // Попап с жалобой судье
          earena_2_get_popup( 'complaint' );

          // Попап Матча
          earena_2_get_popup( 'match' );

          if ( earena_2_current_page('purse') || earena_2_current_page('wallet') ) {
            // Попап Кошелёк
            earena_2_get_popup( 'purse' );
          }

          if ( earena_2_current_page('profile') && is_user_logged_in() ) {
            // Выбор Аватара
            earena_2_get_popup( 'avatar' );

            // Попап Стрим
            earena_2_get_popup( 'stream' );

            // Попап Удалить историю переписки
            earena_2_get_popup( 'history' );

            // Попап Игры
            earena_2_get_popup( 'game' );
          }

          if ( (earena_2_current_page('profile') || earena_2_current_page('user')) && is_user_logged_in() && !is_ea_admin() ) {
            // Попап управления Друзьями
            earena_2_get_popup( 'friends' );
          }

          if ( (earena_2_current_page('profile') || earena_2_current_page('admin')) && is_user_logged_in() ) {
            // Попап Верификация
            earena_2_get_popup( 'verification' );
          }
        }
      ?>

      <!-- Для переключения состояния - добавляется active класс  -->
      <div class="overlay overlay--popup"></div>
      <div class="overlay overlay--navigation"></div>
      <div class="overlay overlay--purse"></div>
    </div>
    <?php
      wp_footer();
    ?>
  </body>
</html>
