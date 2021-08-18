
      <footer class="page-footer">
        <div class="page-footer__top">
          <div class="page-footer__wrapper page-footer__wrapper--top">
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
                    <a class="navigation__link navigation__link--footer" href="#">
                      <span>
                        <?= $menu_item; ?>
                      </span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </nav>

            <button class="chats chats--footer openpopup" data-popup="chats" type="button" name="chats">
              <span>
                <?php _e( 'Общий чат', 'earena_2' ); ?>
              </span>
            </button>
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

          <div class="personal personal--footer">
            <ul class="personal__list personal__list--footer">
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 19.25C15.5563 19.25 19.25 15.5563 19.25 11C19.25 6.44365 15.5563 2.75 11 2.75C6.44365 2.75 2.75 6.44365 2.75 11C2.75 15.5563 6.44365 19.25 11 19.25Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M11 13.75C12.8985 13.75 14.4375 12.211 14.4375 10.3125C14.4375 8.41402 12.8985 6.875 11 6.875C9.10152 6.875 7.5625 8.41402 7.5625 10.3125C7.5625 12.211 9.10152 13.75 11 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M5.48267 17.1337C6.00053 16.1155 6.79005 15.2605 7.76382 14.6633C8.73758 14.0661 9.85761 13.75 10.9999 13.75C12.1422 13.75 13.2623 14.0661 14.236 14.6633C15.2098 15.2605 15.9993 16.1155 16.5172 17.1337" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <span class="visually-hidden">
                    <?php _e( 'Аккаунт', 'earena_2' ); ?>
                  </span>
                </a>
              </li>
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.0625 9.28125H15.8125" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M6.1875 9.28125H8.9375" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7.5625 7.90625V10.6562" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.7829 4.79004L7.2192 4.8124C6.16854 4.81248 5.15149 5.18264 4.34658 5.85791C3.54166 6.53317 3.00033 7.47038 2.8176 8.50503L2.81834 8.50516L1.41202 15.7379C1.32319 16.2419 1.39734 16.761 1.62369 17.22C1.85004 17.679 2.2168 18.0538 2.67072 18.2901C3.12463 18.5264 3.64206 18.6119 4.14784 18.534C4.65363 18.4562 5.12144 18.2192 5.48333 17.8574L5.48319 17.8572L9.19875 13.7499L14.7829 13.7275C15.9681 13.7275 17.1047 13.2567 17.9428 12.4187C18.7808 11.5806 19.2516 10.444 19.2516 9.25879C19.2516 8.0736 18.7808 6.93696 17.9428 6.09891C17.1047 5.26085 15.9681 4.79004 14.7829 4.79004V4.79004Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M19.1837 8.48291L20.5888 15.738C20.6777 16.242 20.6035 16.7612 20.3772 17.2201C20.1508 17.6791 19.7841 18.0539 19.3302 18.2902C18.8762 18.5265 18.3588 18.612 17.853 18.5342C17.3472 18.4563 16.8794 18.2193 16.5175 17.8575L16.5177 17.8573L12.8047 13.7356" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <span class="visually-hidden">
                    <?php _e( 'Матчи', 'earena_2' ); ?>
                  </span>

                  <span class="personal__link-count">
                    14
                  </span>
                </a>
              </li>
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.8125 4.8125V9.54732C4.8125 12.9591 7.54141 15.787 10.9531 15.8123C11.7696 15.8185 12.5792 15.663 13.3353 15.3549C14.0914 15.0467 14.7791 14.5919 15.3586 14.0168C15.9381 13.4416 16.3981 12.7574 16.712 12.0037C17.0259 11.2499 17.1875 10.4415 17.1875 9.625V4.8125C17.1875 4.63016 17.1151 4.4553 16.9861 4.32636C16.8572 4.19743 16.6823 4.125 16.5 4.125H5.5C5.31766 4.125 5.1428 4.19743 5.01386 4.32636C4.88493 4.4553 4.8125 4.63016 4.8125 4.8125Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.25 19.25H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11 15.8125V19.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M17.6695 10.7356H17.7639C18.4933 10.7356 19.1927 10.4459 19.7085 9.93014C20.2242 9.41441 20.5139 8.71494 20.5139 7.9856V6.6106C20.5139 6.42826 20.4415 6.25339 20.3125 6.12446C20.1836 5.99553 20.0087 5.9231 19.8264 5.9231H17.5" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4.98122 11H4.11401C3.38467 11 2.6852 10.7103 2.16947 10.1945C1.65375 9.67882 1.36401 8.97935 1.36401 8.25V6.875C1.36401 6.69266 1.43645 6.5178 1.56538 6.38886C1.69431 6.25993 1.86918 6.1875 2.05151 6.1875H4.80151" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <span class="visually-hidden">
                    <?php _e( 'Трофеи', 'earena_2' ); ?>
                  </span>

                  <span class="personal__link-count">
                    8
                  </span>
                </a>
              </li>
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.90404 15.2107C2.87903 13.4828 2.52006 11.4401 2.89454 9.46627C3.26902 7.49241 4.35119 5.72316 5.93784 4.49073C7.52448 3.2583 9.50646 2.64747 11.5116 2.77294C13.5167 2.89842 15.4071 3.75157 16.8277 5.17219C18.2484 6.59281 19.1015 8.48317 19.227 10.4883C19.3525 12.4935 18.7417 14.4754 17.5093 16.0621C16.2768 17.6487 14.5076 18.7309 12.5337 19.1054C10.5599 19.4799 8.5172 19.1209 6.78928 18.0959L6.7893 18.0959L3.93991 18.91C3.82202 18.9436 3.69727 18.9452 3.57858 18.9144C3.45989 18.8837 3.35159 18.8217 3.26489 18.7351C3.1782 18.6484 3.11626 18.5401 3.08551 18.4214C3.05476 18.3027 3.0563 18.1779 3.08998 18.06L3.9041 15.2106L3.90404 15.2107Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.25 9.625H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.25 12.375H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>


                  <span class="visually-hidden">
                    <?php _e( 'Сообщения', 'earena_2' ); ?>
                  </span>

                  <span class="personal__link-count">
                    1
                  </span>
                </a>
              </li>
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.5625 13.75C10.0305 13.75 12.0312 11.7493 12.0312 9.28125C12.0312 6.81323 10.0305 4.8125 7.5625 4.8125C5.09448 4.8125 3.09375 6.81323 3.09375 9.28125C3.09375 11.7493 5.09448 13.75 7.5625 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
                    <path d="M13.3557 4.97901C13.9704 4.80583 14.615 4.76638 15.2461 4.86331C15.8773 4.96024 16.4804 5.19131 17.0147 5.54094C17.5491 5.89057 18.0023 6.35065 18.3439 6.89019C18.6855 7.42973 18.9074 8.0362 18.9949 8.66876C19.0823 9.30131 19.0332 9.94527 18.8508 10.5572C18.6685 11.1692 18.3571 11.735 17.9376 12.2165C17.5181 12.698 17.0004 13.084 16.4192 13.3485C15.838 13.6131 15.2068 13.75 14.5683 13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1.37476 16.9638C2.07268 15.971 2.99923 15.1608 4.07616 14.6014C5.15309 14.0421 6.3488 13.75 7.56233 13.75C8.77586 13.75 9.97159 14.0419 11.0486 14.6012C12.1255 15.1604 13.0521 15.9706 13.7501 16.9633" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.5684 13.75C15.782 13.7491 16.978 14.0407 18.055 14.6C19.1321 15.1594 20.0585 15.97 20.7559 16.9633" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>


                  <span class="visually-hidden">
                    <?php _e( 'Друзья', 'earena_2' ); ?>
                  </span>

                  <span class="personal__link-count">
                    1
                  </span>
                </a>
              </li>
              <li class="personal__item personal__item--footer">
                <a class="personal__link" href="#">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.9375 6.875L8.9375 17.5071C8.9375 17.6202 8.90956 17.7317 8.85615 17.8315C8.80274 17.9313 8.72553 18.0163 8.63136 18.0791L7.68672 18.7089C7.59505 18.77 7.49004 18.8082 7.38053 18.8202C7.27101 18.8322 7.16021 18.8178 7.05745 18.7781C6.95469 18.7383 6.86299 18.6745 6.79006 18.5919C6.71713 18.5093 6.66511 18.4104 6.63839 18.3036L5.5 13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M5.5 13.75C4.58832 13.75 3.71398 13.3878 3.06932 12.7432C2.42466 12.0985 2.0625 11.2242 2.0625 10.3125C2.0625 9.40081 2.42466 8.52647 3.06932 7.88181C3.71398 7.23716 4.58832 6.87499 5.5 6.87499L8.9375 6.87499C8.9375 6.87499 13.6169 6.87499 18.12 3.09825C18.2202 3.01395 18.3423 2.96001 18.4721 2.94276C18.6018 2.92551 18.7338 2.94567 18.8525 3.00087C18.9712 3.05608 19.0717 3.14402 19.1421 3.25437C19.2125 3.36471 19.2499 3.49287 19.25 3.62377L19.25 17.0012C19.2499 17.1321 19.2125 17.2603 19.1421 17.3706C19.0716 17.481 18.9712 17.5689 18.8525 17.6241C18.7338 17.6793 18.6018 17.6995 18.4721 17.6822C18.3423 17.665 18.2202 17.611 18.12 17.5267C13.6169 13.75 8.9375 13.75 8.9375 13.75L5.5 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  <span class="visually-hidden">
                    <?php _e( 'Уведомления', 'earena_2' ); ?>
                  </span>

                  <span class="personal__link-count">
                    3
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </footer>

      <?php
        // Попап с Чатом
        get_template_part( 'template-parts/popup/chat' );
      ?>

      <?php
        // Попап с Регистрацией/Входом
        get_template_part( 'template-parts/popup/login' );
      ?>

      <?php
        // Попап с формой управлеия Турниром
        get_template_part( 'template-parts/popup/tournament' );
      ?>

      <?php
        // Попап с жалобой судье
        get_template_part( 'template-parts/popup/complaint' );
      ?>

      <?php
        // Попап Матчем
        get_template_part( 'template-parts/popup/match' );
      ?>

      <?php
        // Попап Игры
        get_template_part( 'template-parts/popup/game' );
      ?>

      <?php
        // Попап Кошелёк
        get_template_part( 'template-parts/popup/purse' );
      ?>

      <?php
        // Попап Удалить друга
        get_template_part( 'template-parts/popup/friends' );
      ?>

      <?php
        // Попап Удалить историю переписки
        get_template_part( 'template-parts/popup/history' );
      ?>

      <?php
        // Попап Стрим
        get_template_part( 'template-parts/popup/stream' );
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
