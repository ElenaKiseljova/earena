<?php
  /*
    Статистика игр на странице аккаунта
  */
?>
<?php
  if (earena_2_current_page('user')) {
    // Эта переменная используется в шаблонах 'public'
    global $earena_2_user_public;
    $ea_user = $earena_2_user_public ?? wp_get_current_user();
  }

  if (earena_2_current_page('profile')) {
    // Эта переменная используется в шаблонах 'private'
    global $earena_2_user_private;
    $ea_user = $earena_2_user_private ?? wp_get_current_user();
  }

  $user_stat = ea_get_user_stat($ea_user->ID);

  $m_wins = EArena_DB::get_ea_matches_win($ea_user->ID) ?? 0;
  $m_loses = EArena_DB::get_ea_matches_lose($ea_user->ID) ?? 0;

  $t_wins = EArena_DB::get_ea_tournament_matches_win($ea_user->ID) ?? 0;
  $t_loses = EArena_DB::get_ea_tournament_matches_lose($ea_user->ID) ?? 0;
  $t_draw = EArena_DB::get_ea_tournament_matches_draw($ea_user->ID) ?? 0;

  $gf = (EArena_DB::get_ea_matches_goals_from($ea_user->ID) ?? 0) + (EArena_DB::get_ea_tournament_matches_goals_from($ea_user->ID) ?? 0);
  $gt = (EArena_DB::get_ea_matches_goals_to($ea_user->ID) ?? 0) + (EArena_DB::get_ea_tournament_matches_goals_to($ea_user->ID) ?? 0);
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Статистика игр', 'earena_2' ); ?>
    </h3>
  </header>
  <div class="statistics__content statistics__content--account">
    <?php if ($user_stat): ?>
      <script>
        window.curUserStat = '<?= str_replace("'", "&apos;", json_encode($user_stat)); ?>';
      </script>
      <div class="select select--game-statistics">
        <button class="select__button" type="button" name="button">
          <?php _e( 'Игра', 'earena_2' ); ?>
        </button>

        <ul class="select__list select__list--game-statistics">
          <?php foreach ($user_stat as $index => $user_stat_value): ?>
            <li class="select__item">
              <input class="visually-hidden" type="radio" name="game-statistics" value="<?= $index ?>" data-val="<?= $user_stat_value['id'] ?>" id="game-statistics-<?= $index ?>">
              <label class="select__label" for="game-statistics-<?= $index ?>">
                <?= $user_stat_value['name'] ?? $user_stat_value['shortname']; ?>
              </label>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="players players--account">
        <h4 class="players__title players__title--account">
          <?php _e( 'Матчи', 'earena_2' ); ?>

          <span class="players__count">
            (
            <span id="statistics-matches-total"><?= $m_wins + $m_loses; ?></span>
            )
          </span>
        </h4>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--green" id="statistics-progress-bar-matches-win" data-width="<?= (($m_wins + $m_loses) > 0) ? (($m_wins / ($m_wins + $m_loses)) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-matches-win"><?= $m_wins; ?></span>
        </div>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--red" id="statistics-progress-bar-matches-loses" data-width="<?= (($m_wins + $m_loses) > 0) ? (($m_loses / ($m_wins + $m_loses)) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-matches-loses"><?= $m_loses; ?></span>
        </div>
      </div>

      <div class="players players--account">
        <h4 class="players__title players__title--account">
          <?php _e( 'Турниры', 'earena_2' ); ?>

          <span class="players__count">
            (
            <span id="statistics-tournaments-total"><?= $t_wins + $t_loses + $t_draw; ?></span>
            )
          </span>
        </h4>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--green" id="statistics-progress-bar-tournaments-win" data-width="<?= (($t_wins + $t_loses + $t_draw) > 0) ? (($t_wins / ($t_wins + $t_loses + $t_draw)) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-tournaments-win"><?= $t_wins; ?></span>
        </div>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--gray" id="statistics-progress-bar-tournaments-draw" data-width="<?= (($t_wins + $t_loses + $t_draw) > 0) ? (($t_draw / ($t_wins + $t_loses + $t_draw)) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-tournaments-draw"><?= $t_draw; ?></span>
        </div>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--red" id="statistics-progress-bar-tournaments-loses" data-width="<?= (($t_wins + $t_loses + $t_draw) > 0) ? (($t_loses / ($t_wins + $t_loses + $t_draw)) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-tournaments-loses"><?= $t_loses; ?></span>
        </div>
      </div>

      <div class="players players--account">
        <h4 class="players__title players__title--account">
          <?php _e( 'Раунды', 'earena_2' ); ?>

          <span class="players__count">
            (
            <span id="statistics-rounds-total"><?= $gf + $gt; ?></span>
            )
          </span>
        </h4>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--green" id="statistics-progress-bar-rounds-win" data-width="<?= (($gf + $gt) > 0) ? ($gf / ($gf + $gt) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-rounds-win"><?= $gf; ?></span>
        </div>

        <div class="players__progress players__progress--account">
          <span class="players__progress-bar players__progress-bar--red" id="statistics-progress-bar-rounds-loses" data-width="<?= (($gf + $gt) > 0) ? ($gt / ($gf + $gt) * 100) : 0; ?>"></span>
        </div>
        <div class="players__text players__text--account">
          <span id="statistics-rounds-loses"><?= $gt; ?></span>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
