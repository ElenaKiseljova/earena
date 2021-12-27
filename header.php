<?php
  global $games, $ea_icons;
?>
<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php
      wp_head();
    ?>
  </head>
  <body>
    <script type="text/javascript">
      const currentUserId = <?= (is_user_logged_in()) ? get_current_user_id() : 'false'; ?>;
      const is_user_logged_in = <?= is_user_logged_in() ? 'true' : 'false'; ?>;
      const is_ea_admin = <?= is_ea_admin() ? 'true' : 'false'; ?>;
      const admin_ids = <?= json_encode( get_site_option( 'ea_admin_ids') ); ?>;

      const dataGames = <?= json_encode( $games ); ?>;
      const currentGameId = <?= isset($_GET['game']) ? $_GET['game'] : 'false'; ?>;

      const platformsArr = <?= json_encode( get_site_option( 'platforms' ) ) ?>;

      const isProfile = <?= (earena_2_current_page( 'user' ) || earena_2_current_page( 'profile' )) ? 'true' : 'false'; ?>;

      const siteURL = '<?= bloginfo( 'url' ); ?>';
      const siteThemeFolderURL = '<?= get_template_directory_uri(); ?>';

      const ea_icons = <?= json_encode( $ea_icons ) ?>;

      const isAdminTournamentsList = <?= is_page(555) ? 'true' : 'false'; ?>;
      const isAdminTournamentsCreate = <?= is_page(552) ? 'true' : 'false'; ?>;
    </script>
    <div class="container">
      <!-- SVG sprite -->
      <div class="visually-hidden">
        <?php
          require_once('assets/img/sprite.svg');
        ?>
      </div>

      <!-- Header -->
      <header class="page-header">
        <div class="page-header__top <?php echo is_ea_admin() ? 'page-header__top--admin' : ''; ?>">
          <div class="page-header__wrapper page-header__wrapper--top">
            <div class="logo logo--header">
              <a href="<?php echo bloginfo( 'url' ); ?>">
                <?php
                  $logo_header = get_theme_mod( 'header_logo_settings' );

                  $logo_header = $logo_header ? $logo_header : '';
                ?>

                <img width="179" height="37.39" src="<?= $logo_header; ?>" alt="<?php echo bloginfo( 'name' ); ?>">
              </a>
            </div>

            <!-- Для переключения состояния - добавляется active класс  -->
            <div class="page-header__center">
              <div class="languages">
                <?php
                  do_action('wpml_add_language_selector');
                ?>
              </div>

              <div class="time time--header">
                <span><?= ea_header_time(); ?></span>
              </div>
            </div>

            <?php if ( is_user_logged_in() ): ?>
              <?php
                $ea_user = wp_get_current_user();
              ?>
              <div class="page-header__right page-header__right--logged">
                <?php if ( is_ea_admin() ): ?>
                  <div class="user user--header">
                    <a class="user__avatar user__avatar--header-admin" href="<?php echo bloginfo( 'url' ); ?>/profile">
                      <?= bp_core_fetch_avatar(['item_id' => $ea_user->ID, 'type' => 'full', 'width' => 60, 'height' => 60]); ?>
                    </a>

                    <div class="user__info user__info--header">
                      <a class="user__name user__name--header-admin" href="<?php echo bloginfo( 'url' ); ?>/profile">
                        <h5>
                          <?= $ea_user->nickname; ?>
                        </h5>
                      </a>
                    </div>

                    <a class="page-header__signout page-header__signout--desktop" href="<?php echo wp_logout_url(home_url()); ?>">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12.75L15.75 9L12 5.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.75 9H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.75 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </a>
                  </div>
                <?php else: ?>
                  <div class="user user--header">
                    <a class="user__avatar user__avatar--header" href="<?php echo bloginfo( 'url' ); ?>/profile">
                      <?= bp_core_fetch_avatar(['item_id' => $ea_user->ID, 'type' => 'full', 'width' => 60, 'height' => 60]); ?>
                    </a>

                    <div class="user__info user__info--header">
                      <a class="user__name user__name--header" href="<?php echo bloginfo( 'url' ); ?>/profile">
                        <h5>
                          <?= $ea_user->nickname; ?>
                        </h5>
                      </a>

                      <div class="user__money">
                        <span class="user__money-amount user__money-amount--header">
                          $<span><?= earena_2_nice_money(balance()); ?></span>
                        </span>
                        <a class="page-header__money-add page-header__money-add--desktop" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
                          <?php _e( 'Пополнить', 'earena_2' ); ?>
                        </a>
                      </div>
                    </div>

                    <a class="page-header__signout page-header__signout--desktop" href="<?php echo wp_logout_url(home_url()); ?>">
                      <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12.75L15.75 9L12 5.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.75 9H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M6.75 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H6.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                    </a>
                  </div>
                <?php endif; ?>

                <?php
                  // Персональное меню
                  get_template_part( 'template-parts/personal' );
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

        <?php if ( is_ea_admin() ): ?>
          <div class="page-header__search">
            <div class="page-header__wrapper page-header__wrapper--search">
              <div class="search">
                <form class="search__form" action="" method="post" id="search-gamer">
                  <div class="search__row">
                    <input class="search__field" type="text" name="search-field" value="" placeholder="<?php _e( 'Поиск игрока (Имя или e-mail)', 'earena_2' ); ?>">
                    <button class="search__button" type="button" name="button">
                      <svg class="filters__icon" width="20" height="20">
                        <use xlink:href="#icon-search"></use>
                      </svg>
                    </button>
                  </div>
                  <div class="search__result"></div>
                </form>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <!-- Для переключения состояния - добавляется active класс  -->
        <div class="page-header__bottom">
          <div class="page-header__wrapper page-header__wrapper--bottom">
            <?php if (is_user_logged_in()): ?>
              <a class="page-header__money-add page-header__money-add--mobile" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
                <?php _e( 'Пополнить', 'earena_2' ); ?>
              </a>
            <?php endif; ?>

            <?php
              get_template_part( 'template-parts/menus/header' );
            ?>

            <div class="page-header__right page-header__right--chats">
              <?php
                /****** Кнопка вызова Общего чата закоммичена до лучших времен ******/
              ?>
              <!-- <button class="chats chats--header openpopup" data-popup="chats" type="button" name="chats">
                <svg class="chats__icon chats__icon--arrow" width="20" height="20">
                  <use xlink:href="#icon-arrow-left"></use>
                </svg>

                <svg class="chats__icon chats__icon--conversation" width="22" height="22">
                  <use xlink:href="#icon-chats"></use>
                </svg>

                <span>
                  <?php _e( 'Общий чат', 'earena_2' ); ?>
                </span>
              </button> -->

              <?php if (is_user_logged_in()): ?>
                <a class="page-header__signout page-header__signout--mobile" href="<?php echo wp_logout_url(home_url()); ?>">
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
