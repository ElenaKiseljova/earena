<div class="account__content">
  <div class="account__content-item account__content-item--col-1">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Игры
        earena_2_get_section( 'games' );
      }

      if (is_user_logged_in()) {
        // Стрим
        get_template_part( 'template-parts/stream' );
      }
    ?>
  </div>

  <div class="account__content-item account__content-item--col-2">
    <?php
      // Статистика игр
      get_template_part( 'template-parts/statistics/page', 'account-games' );
    ?>
  </div>
  <div class="account__content-item account__content-item--col-2">
    <?php
      // Статистика друзей
      get_template_part( 'template-parts/statistics/page', 'account-friends' );
    ?>
  </div>
</div>
