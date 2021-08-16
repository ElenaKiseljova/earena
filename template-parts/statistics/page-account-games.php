<?php
  /*
    Статистика игр на странице аккаунта
  */
?>
<div class="statistics statistics--account">
  <header class="statistics__header">
    <h3 class="statistics__title statistics__title--account">
      <?php _e( 'Статистика игр', 'earena_2' ); ?>
    </h3>
  </header>

  <div class="statistics__content statistics__content--account">
    <div class="form">
      <div class="form__row">
        <input class="form__field form__field--popup" list="game-account-list" id="game-account" name="game" value="League of Legends" />
        <span class="form__arrow"></span>

        <datalist id="game-account-list">
            <option value="Mortal Combat 11 Ultimate">
            <option value="WARZONE">
            <option value="League of Legends">
            <option value="Dota 2">
        </datalist>
      </div>
    </div>

    <div class="players players--account">
      <h4 class="players__title players__title--account">
        <?php _e( 'Матчи', 'earena_2' ); ?>

        <span class="players__count">
          (1 500)
        </span>
      </h4>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--green" data-width="100"></span>
      </div>
      <div class="players__text players__text--account">
        734
      </div>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--red" data-width="50"></span>
      </div>
      <div class="players__text players__text--account">
        308
      </div>
    </div>

    <div class="players players--account">
      <h4 class="players__title players__title--account">
        <?php _e( 'Турниры', 'earena_2' ); ?>

        <span class="players__count">
          (563)
        </span>
      </h4>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--green" data-width="100"></span>
      </div>
      <div class="players__text players__text--account">
        673
      </div>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--gray" data-width="15"></span>
      </div>
      <div class="players__text players__text--account">
        50
      </div>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--red" data-width="50"></span>
      </div>
      <div class="players__text players__text--account">
        308
      </div>
    </div>

    <div class="players players--account">
      <h4 class="players__title players__title--account">
        <?php _e( 'Раунды', 'earena_2' ); ?>

        <span class="players__count">
          (451)
        </span>
      </h4>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--green" data-width="100"></span>
      </div>
      <div class="players__text players__text--account">
        451
      </div>

      <div class="players__progress players__progress--account">
        <span class="players__progress-bar players__progress-bar--red" data-width="20"></span>
      </div>
      <div class="players__text players__text--account">
        20
      </div>
    </div>
  </div>
</div>
