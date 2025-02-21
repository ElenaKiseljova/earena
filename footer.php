<?php
  $is_messages = earena_2_current_page( 'message' );
?>
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
        <div class="page-footer__bottom <?= (is_user_logged_in()) ? 'page-footer__bottom--is-logged-in' : ''; ?>"><!-- && !$is_messages -->
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
            <ul class="pay-methods <?= (is_user_logged_in()) ? 'pay-methods--is-logged-in' : ''; ?>"><!-- && !$is_messages -->
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

          // Попап Матча
          earena_2_get_popup( 'match' );

          if ( is_user_logged_in() ) {
            if (isset($_GET['match'])) {
              // Попап с жалобой судье
              earena_2_get_popup( 'complaint' );
            }

            if ( earena_2_current_page('purse') || earena_2_current_page('wallet') || (is_ea_admin() && earena_2_current_page('user')) ) {
              // Попап Кошелёк
              earena_2_get_popup( 'purse' );

              // Попап VIP
              earena_2_get_popup( 'vip' );
            }

            if ( earena_2_current_page('profile') ) {
              // Выбор Аватара
              earena_2_get_popup( 'avatar' );

              // Попап Стрим
              earena_2_get_popup( 'stream' );

              // Попап Удалить историю переписки
              // earena_2_get_popup( 'history' );

              // Попап Игры
              earena_2_get_popup( 'game' );
            }

            if ( (earena_2_current_page('profile') || earena_2_current_page('user')) && !is_ea_admin() ) {
              // Попап управления Друзьями
              earena_2_get_popup( 'friends' );
            }

            if ( earena_2_current_page('profile') || earena_2_current_page('admin') ) {
              // Попап Верификация
              earena_2_get_popup( 'verification' );
            }
          }

          if ( earena_2_current_page('user') && is_ea_admin() ) {
            // Попап Блокировки
            earena_2_get_popup( 'block' );

            // Попап Баланса
            earena_2_get_popup( 'balance' );
          }

          if ( is_page(5724) || earena_2_current_page( 'nuzhna-pomoshh' ) ) {
            // Попап Обратнй связи
            earena_2_get_popup( 'contact' );
          }

          if ( (earena_2_current_page( 'match' ) && isset($_GET['match'])) || ( is_ea_admin() && earena_2_current_page( 'user' ) )) {
            // Попап Предупреждения
            earena_2_get_popup( 'warning' );
          }

          if ( is_page( 552 ) && is_ea_admin() ) {
            // Попап Создания турнира
            earena_2_get_popup( 'create' );
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
