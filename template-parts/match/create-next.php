<?php
  global $games, $game_create_match, $platform_create_match;

  $ea_user = wp_get_current_user();
  $min = (float)get_site_option( 'ea_min_match_price', 1 );
  $games = $games ?? [];
  $team_modes = get_site_option( 'team_modes' );
  $game_object = $games[$game_create_match];
  $game_modes = $game_object['game_modes'] ?? [];
  $game_team_modes = ($game_object['team_modes'][0] !== 0) ? $game_object['team_modes'] : [];
?>

<div class="popup__header popup__header--match">
  <h2 class="popup__title popup__title--match">
    <?= __( 'Новый матч', 'earena_2' ); ?>
  </h2>

  <div class="popup__information">
    <span>
      <?= __( 'Укажите сумму входа и режимы', 'earena_2' ); ?>
    </span>
  </div>
</div>
<div class="popup__content popup__content--match">
  <form class="form form--popup" data-prefix="add" id="form-match" action="/" method="post">
    <div class="form__checkbox form__checkbox--free checkbox checkbox--left">
      <input class="visually-hidden" data-control-field-id="bet" data-control-toggle="off" type="checkbox" name="free" value="1" id="free">
      <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="free">
        <?= __( 'Бесплатный матч', 'earena_2' ); ?>
      </label>
    </div>

    <div class="form__row <?= (!ea_check_user_age($ea_user->ID) ? 'no-old-enough' : ''); ?>">
      <input class="form__field form__field--popup" id="bet" type="number" name="bet" min="<?= $min; ?>" max="<?= ((balance() > $min) && ea_check_user_age($ea_user->ID)) ? balance() : (ea_check_user_age($ea_user->ID) ? balance() : 0); ?>" step="0.1" required placeholder="<?= __( 'Сумма входа ($)', 'earena_2' ); ?>" >
    </div>
    <span class="form__error form__error--popup">
      <?= (!ea_check_user_age($ea_user->ID) ?  __( 'Вам не доступны игры на деньги', 'earena_2' ) : (__( 'Минимальная сумма ставки $', 'earena_2' ) . $min . '<br>' . __( 'Доступный баланс: $', 'earena_2' ) . balance())); ?>
    </span>

    <div class="form__text form__text--match">
      <?= __( 'Это сумма, которую вносит каждый из участников перед матчем, формируя приз победителя.', 'earena_2' ); ?>
    </div>

    <div class="form__row">
      <div class="select select--game-mode">
        <button class="select__button select__button--game-mode" type="button" name="button">
           <?= __( 'Режим игры', 'earena_2' ); ?>
        </button>

        <ul class="select__list">
          <?php foreach ($game_modes as $game_mode): ?>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="game_mode" value="<?= $game_mode; ?>" id="select-game_mode-<?= $game_mode; ?>" required>
              <label class="select__label" for="select-game_mode-<?= $game_mode; ?>">
                <?= $game_mode; ?> vs <?= $game_mode; ?>
              </label>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <span class="form__error form__error--popup"> <?= __( 'Error', 'earena_2' ); ?> </span>

    <?php if (count($game_team_modes) > 0): ?>
      <div class="form__row">
        <div class="select select--team-mode">
          <button class="select__button select__button--team-mode" type="button" name="button">
             <?= __( 'Режим команды', 'earena_2' ); ?>
          </button>

          <ul class="select__list">
            <?php foreach ($game_team_modes as $game_team_mode): ?>
              <li class="select__item">
                <input class="visually-hidden" type="radio" name="team_mode" value="<?= $game_team_mode; ?>" id="select-team_mode-<?= $game_team_mode; ?>" required>
                <label class="select__label" for="select-team_mode-<?= $game_team_mode; ?>">
                  <?= $team_modes[$game_team_mode]; ?>
                </label>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <span class="form__error form__error--popup"> <?= __( 'Error', 'earena_2' ); ?> </span>
    <?php endif; ?>

    <div class="form__checkbox form__checkbox--private checkbox checkbox--left">
      <input class="visually-hidden" data-control-field-id="password" data-control-toggle="on" type="checkbox" name="private-match-create" value="1" id="private-match-create">
      <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="private-match-create">
         <?= __( 'Приватный матч', 'earena_2' ); ?>
      </label>
    </div>

    <div class="form__row">
      <input class="form__field form__field--popup" id="password" type="password" name="password" required disabled placeholder="<?= __( 'Пароль', 'earena_2' ); ?>">
    </div>
    <span class="form__error form__error--popup"><?= __( 'Error', 'earena_2' ); ?> </span>

    <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">
    <input type="hidden" name="game" value="<?= $game_create_match; ?>">
    <input type="hidden" name="platform" value="<?= $platform_create_match; ?>">

    <button class="form__submit button button--blue" type="submit" name="match-submit">
      <span>
        <?= __( 'Создать матч', 'earena_2' ); ?>
      </span>
    </button>
  </form>
</div>
