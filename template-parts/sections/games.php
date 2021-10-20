<?php
  global $games, $ea_icons, $profile;

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

  $ea_user = ($ea_user != false) ? $ea_user : wp_get_current_user();

  // Для страниц Профиля (публичного и приватного)
  if ($ea_user) {
    $nicknames = $ea_user->get('nicknames')? $ea_user->get('nicknames') : [];

    global $nicknames_by_platforms;
    $nicknames_by_platforms = [];
    foreach( $nicknames as $game=>$platforms ) {
        foreach( $platforms as $platform=>$nickname ) {
            $nicknames_by_platforms[$platform][$game] = $nickname;
        }
    }
  }

  global $games_by_platforms;
  $games_by_platforms = [];
  foreach( array_column($games,'platforms') as $game=>$platforms ) {
      foreach( $platforms as $platform ) {
          $games_by_platforms[$platform][] = $game;
      }
  }

  $platforms = get_site_option( 'platforms' );
?>

<?php if ( earena_2_current_page( 'profile' ) || earena_2_current_page( 'user' ) || ($profile === true) ): ?>
  <?php foreach ($platforms as $key => $platform): ?>
    <div class="section section--games" id="games-<?= mb_strtolower($platform); ?>">
      <header class="section__header">
        <h2 class="section__title section__title--games-account">
          <svg width="40" height="40">
            <use xlink:href="#icon-platform-<?= mb_strtolower($platform); ?>"></use>
          </svg>

          <?= $platform; ?>
        </h2>

        <div class="section__header-right">
          <?php if (earena_2_current_page('profile') || ($profile === true)): ?>
            <button class="section__add-game button button--gray openpopup" data-popup="game" type="button" name="add-<?= mb_strtolower($platform); ?>">
              <span>
                <?php _e( 'Добавить игру', 'earena_2' ); ?>
              </span>
            </button>
          <?php endif; ?>
        </div>
      </header>

      <?php if (!empty($nicknames_by_platforms[$key])) : ?>
          <ul class="section__list">
            <?php
              $row_index = 1;

              // Перебираем игры
              foreach ($nicknames_by_platforms[$key] as $game => $name) {
                // Для корректной работы шаблона
                global $game_id, $game_user_name;
                $game_id = $game;
                $game_user_name = $name;
                ?>
                  <li class="section__item section__item--col-6">
                    <?php get_template_part( 'template-parts/game/archive', 'account' ); ?>
                  </li>
                <?php
                if ($row_index % 6 === 0) {
                  $row_index = 1;
                } else {
                  $row_index++;
                }
              }

              // Оставшееся (до 6 шт) заполняется пустыми карточками
              while ( $row_index <= 6 && $row_index > 1 ) {
                ?>
                  <li class="section__item section__item--col-6">
                    <?php get_template_part( 'template-parts/game/archive', 'empty' ); ?>
                  </li>
                <?php
                $row_index++;
              }
            ?>
          </ul>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <section class="section section--games" id="games">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--games">
          <?php _e( 'Игры', 'earena_2' ); ?>
          <span class="section__amount">
            0
          </span>
        </h2>

        <div class="section__header-right">
          <!-- Табы игровых платформ -->
          <?php get_template_part( 'template-parts/tabs/platform' ); ?>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list" id="content-platform-games">
          <!-- Подстановка содержимого из шаблона -->
        </ul>
      </div>
    </div>
  </section>
<?php endif; ?>
