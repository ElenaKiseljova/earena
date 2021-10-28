<?php
  /*
    Фильтры ( стр Аккаунта )
  */
?>

<?php
  $is_profile = (earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' )) ? true : false;
  $is_profile_matches = ((earena_2_current_page( 'matches') || (isset($_GET['toggles']) && $_GET['toggles'] === 'matches')) && $is_profile) ? true : false;
  $is_profile_tournaments = ((earena_2_current_page( 'tours') || (isset($_GET['toggles']) && $_GET['toggles'] === 'tournaments')) && $is_profile) ? true : false;

  $ea_user = false;

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

  $ea_user = ($ea_user instanceof WP_User) ? $ea_user : wp_get_current_user();
?>

<div class="filters filters--account-tabs">
  <form class="filters__form" data-player-id="<?= $ea_user->ID; ?>" action="" method="post" id="filters-<?= $is_profile_tournaments ? 'tournaments' : ($is_profile_matches ? 'matches' : 'main'); ?>">
    <div class="filters__container filters__container--account-tabs">
      <div class="filters__element filters__element--col-2 filters__element--account-tabs">
        <div class="select select--account-tabs">

          <button class="select__button" type="button" name="button">
            <?php if ($is_profile_matches): ?>
              <?php _e( 'Статус матча', 'earena_2' ); ?>
            <?php elseif ($is_profile_tournaments): ?>
              <?php _e( 'Статус турнира', 'earena_2' ); ?>
            <?php else : ?>
              <?php _e( 'Статус', 'earena_2' ); ?>
            <?php endif; ?>
          </button>

          <ul class="select__list">
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="status" value="1" id="status-1">
              <label class="select__label" for="status-1">
                <?php _e( 'Регистрация', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="status" value="2" id="status-2">
              <label class="select__label" for="status-2">
                <?php _e( 'Проходит', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="status" value="3" id="status-3">
              <label class="select__label" for="status-3">
                <?php _e( 'Завершён', 'earena_2' ); ?>
              </label>
            </li>
          </ul>
        </div>
      </div>
      <div class="filters__element filters__element--col-2 filters__element--account-tabs">
        <div class="select select--account-tabs">
          <button class="select__button" type="button" name="button">
            <?php _e( 'Дата начала', 'earena_2' ); ?>
          </button>

          <ul class="select__list">
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="sort" value="desc" id="sort-0">
              <label class="select__label" for="sort-0">
                <?php _e( 'Позже', 'earena_2' ); ?>
              </label>
            </li>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="sort" value="asc" id="sort-1">
              <label class="select__label" for="sort-1">
                <?php _e( 'Раньше', 'earena_2' ); ?>
              </label>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </form>
</div>
