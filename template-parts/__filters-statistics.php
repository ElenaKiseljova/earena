<?php
  /*
    Фильтры ( стр Аккаунта )
  */
?>
<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public ?? wp_get_current_user();

  $user_stat = ea_get_user_stat($ea_user->ID);
  $user_stat_key = array_key_first($user_stat);
?>

<div class="filters filters--statistics">
  <form class="filters__form" action="" method="post" id="filters-statistics">
    <div class="filters__container filters__container--statistics">
      <div class="filters__element filters__element--col-1 filters__element--statistics">

      </div>
    </div>
  </form>
</div>
