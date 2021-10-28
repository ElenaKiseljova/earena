<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public ?? wp_get_current_user();

  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
?>

<div class="toggles__content toggles__content--account <?= ($is_profile && !isset($_GET['toggles'])) ? 'active' : ''; ?>">
  <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Игры
        earena_2_get_section( 'games' );
      }
    ?>
  </div>

  <div class="toggles__content-item toggles__content-item--col-2">
    <?php
      // Статистика игр
      get_template_part( 'template-parts/statistics/games' );
    ?>
  </div>
  <div class="toggles__content-item toggles__content-item--col-2">
    <?php
      // Статистика друзей
      get_template_part( 'template-parts/statistics/friends' );
    ?>
  </div>
</div>
