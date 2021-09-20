<?php
  /*
    Шаблон переключателей на стр Аккаунта
  */
?>
<?php
  // Страница Акаунта
  global $is_account_page;

  // Приглашенные
  global $ref;
?>

<div class="toggles toggles--account">
  <header class="toggles__header <?php if ($is_account_page) echo 'toggles__header--account'; ?>">
    <div class="toggles__list">
      <?php if (!is_ea_admin()): ?>
        <!-- Для переключения состояния - добавляется active класс  -->
        <a href="<?php echo get_page_link(503); ?>" class="toggles__item toggles__item--account <?php if(is_page(503)) echo 'active'; ?>">
          <?php _e( 'Профиль', 'earena_2' ); ?>
        </a>
        <a href="<?php echo get_page_link(518); ?>" class="toggles__item toggles__item--account <?php if(is_page(518)) echo 'active'; ?>">
          <?php _e( 'Матчи', 'earena_2' ); ?> (<?=counter_matches();?>)
        </a>
        <a href="<?php echo get_page_link(521); ?>" class="toggles__item toggles__item--account <?php if(is_page(521)) echo 'active'; ?>">
          <?php _e( 'Турниры', 'earena_2' ); ?> (<?=counter_tournaments();?>)
        </a>

        <?php if (is_user_logged_in()): ?>
          <a href="<?php echo get_page_link(510); ?>" class="toggles__item toggles__item--account <?php if(is_page(510)) echo 'active'; ?>">
            <?php _e( 'Сообщения', 'earena_2' ); ?> (<?=!empty(messages_get_unread_count())?messages_get_unread_count():'0';?>)
          </a>
        <?php endif; ?>

        <a href="<?php echo get_page_link(515); ?>" class="toggles__item toggles__item--account <?php if(is_page(515)) echo 'active'; ?>">
          <?php _e( 'Друзья', 'earena_2' ); ?> (<?= bp_get_total_friend_count(get_current_user_id())>0?bp_get_total_friend_count(get_current_user_id()):'0'; ?>)
        </a>

        <?php if (is_user_logged_in()): ?>
          <a href="<?php echo get_page_link(527); ?>" class="toggles__item toggles__item--account <?php if(is_page(527)) echo 'active'; ?>">
            <?php _e( 'Приглашенные', 'earena_2' ); ?> (<?= $ref>0 ? $ref : '0'; ?>)
          </a>
          <a href="<?php echo get_page_link(654); ?>" class="toggles__item toggles__item--account <?php if(is_page(654)) echo 'active'; ?>">
            <?php _e( 'Уведомления', 'earena_2' ); ?> (<?=counter_admin();?>)
          </a>
        <?php endif; ?>
      <?php else: ?>
        <!-- Для переключения состояния - добавляется active класс  -->
        <a href="<?php echo get_page_link(649); ?>" class="toggles__item toggles__item--account <?php if(is_page(649)) echo 'active'; ?>">
          <?php _e( 'Матчи', 'earena_2' ); ?> (<?=count_admin_matches_moderate();?>)
        </a>
        <a href="<?php echo get_page_link(643); ?>" class="toggles__item toggles__item--account <?php if(is_page(643)) echo 'active'; ?>">
          <?php _e( 'Турниры', 'earena_2' ); ?> (<?=count_admin_tournaments(1);?>)
        </a>
        <a href="<?php echo get_page_link(510); ?>" class="toggles__item toggles__item--account <?php if(is_page(510)) echo 'active'; ?>">
          <?php _e( 'Сообщения', 'earena_2' ); ?> (<?=!empty(messages_get_unread_count())?messages_get_unread_count():'0';?>)
        </a>
        <a href="<?php echo get_page_link(646); ?>" class="toggles__item toggles__item--account <?php if(is_page(646)) echo 'active'; ?>">
          <?php _e( 'Lucky CUP', 'earena_2' ); ?> (<?=count_admin_tournaments(2);?>)
        </a>
        <a href="<?php echo get_page_link(640); ?>" class="toggles__item toggles__item--account <?php if(is_page(640)) echo 'active'; ?>">
          <?php _e( 'Кубки', 'earena_2' ); ?> (<?=count_admin_tournaments(3);?>)
        </a>
        <a href="<?php echo get_page_link(637); ?>" class="toggles__item toggles__item--account <?php if(is_page(637)) echo 'active'; ?>">
          <?php _e( 'Верификация', 'earena_2' ); ?> (<?=ea_count_verification_requests();?>)
        </a>
      <?php endif; ?>
    </div>
  </header>

  <!-- Профиль  -->

  <div class="toggles__content toggles__content--account <?php if(is_page(518)) echo 'active'; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Матчи
          earena_2_get_section( 'matches', false, 'filters', 'matches' );
        }
      ?>
    </div>
  </div>
  <div class="toggles__content toggles__content--account <?php if(is_page(521)) echo 'active'; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Турниры
          earena_2_get_section( 'tournaments', false, 'filters', 'tournaments' );
        }
      ?>
    </div>
  </div>

  <?php if (is_user_logged_in()): ?>
    <div class="toggles__content toggles__content--account <?php if(is_page(510)) echo 'active'; ?>">
      <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
        <?php
          if ( function_exists( 'earena_2_get_section' ) ) {
            // Сообщения
            earena_2_get_section( 'messages' );
          }
        ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="toggles__content toggles__content--account <?php if(is_page(515)) echo 'active'; ?>">
    <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
      <?php
        if ( function_exists( 'earena_2_get_section' ) ) {
          // Друзья
          earena_2_get_section( 'friends' );
        }
      ?>
    </div>
  </div>

  <?php if (is_user_logged_in()): ?>
    <div class="toggles__content toggles__content--account <?php if(is_page(654)) echo 'active'; ?>">
      <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
        <?php
          if ( function_exists( 'earena_2_get_section' ) ) {
            // Уведомления
            earena_2_get_section( 'requests' );
          }
        ?>
      </div>
    </div>
  <?php endif; ?>
</div>
