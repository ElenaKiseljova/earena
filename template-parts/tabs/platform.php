<?php
  /*
    Табы игровых платформ
  */
?>

<?php
  global $games;
  $platforms = get_site_option('platforms');

  if(isset($_COOKIE['ea_current_platform'])) {
      $cookiePlatforms = $_COOKIE['ea_current_platform'];
      $cookiePlatforms = array_map('intval', explode(',', $cookiePlatforms));
  } else {
      $cookiePlatforms = [];
      $cookiePlatforms = [-1];
  }

  if(count($cookiePlatforms) == count($platforms)) {
      $cookiePlatforms = [];
      $cookiePlatforms = [-1];
  }

  $is_admin_tournaments_list = is_page(555) ? true : false;
?>

<div class="tabs tabs--platform <?= $is_admin_tournaments_list ? 'tabs--admin-tournaments-list' : ''; ?>">
  <button class="tabs__button tabs__button--platform <?= $is_admin_tournaments_list ? 'tabs__button--admin-tournaments-list' : ''; ?> <?= array_search(-1, $cookiePlatforms)!== false ? 'active' : '' ?>" data-tab-type="-1" type="button" name="tab-all">
    <?php _e( 'Все', 'earena_2' ); ?>
  </button>
  <?php foreach ($platforms as $platform_key => $platform_item) : ?>
    <button class="tabs__button tabs__button--platform <?= $is_admin_tournaments_list ? 'tabs__button--admin-tournaments-list' : ''; ?> <?= array_search($platform_key, $cookiePlatforms) !== false ? 'active' : '' ?>" data-tab-type="<?= $platform_key; ?>" type="button" name="tab-<?= mb_strtolower($platform_item); ?>">
      <svg class="tabs__icon" width="30" height="30">
        <use xlink:href="#icon-platform-<?= mb_strtolower($platform_item); ?>"></use>
      </svg>
      <span class="tabs__text">
        <?= $platform_item; ?>
      </span>
    </button>
  <?php endforeach; ?>
</div>
