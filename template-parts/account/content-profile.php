<?php
  if (earena_2_current_page('user')) {
    // Эта переменная используется в шаблонах 'public'
    global $earena_2_user_public;
    $ea_user = $earena_2_user_public;
  }

  if (earena_2_current_page('profile')) {
    // Эта переменная используется в шаблонах 'private'
    global $earena_2_user_private;
    $ea_user = $earena_2_user_private;
  }
?>

<div class="account__content">
  <div class="account__content-item account__content-item--col-1">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Игры
        earena_2_get_section( 'games' );
      }

      if (earena_2_current_page('profile')) {
        // Стрим
        get_template_part( 'template-parts/stream' );
      }
    ?>
  </div>

  <div class="account__content-item account__content-item--col-2">
    <?php
      // Статистика игр
      get_template_part( 'template-parts/statistics/page-account', 'games' );
    ?>
  </div>
  <div class="account__content-item account__content-item--col-2">
    <?php
      // Статистика друзей
      get_template_part( 'template-parts/statistics/page-account', 'friends' );
    ?>
  </div>
</div>
