<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public ?? wp_get_current_user();

  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
  $is_profile_matches = ((earena_2_current_page( 'matches') || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile) ? true : false;
?>

<div class="toggles__content toggles__content--account <?= $is_profile_matches ? 'active' : ''; ?>">
  <div class="toggles__content-item toggles__content-item--col-1 toggles__content-item--account">
    <?php
      if ( function_exists( 'earena_2_get_section' ) ) {
        // Матчи
        earena_2_get_section( 'matches' );
      }
    ?>
  </div>
</div>
