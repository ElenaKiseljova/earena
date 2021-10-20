<template id="platform-all">
  <!-- <ul class="section__list"> -->
    <?php
      global $games;
      global $game_index;

      $game_index = 0;
      $row_index = 1;

      // Перебираем игры все
      foreach ($games as $game) {
        ?>
          <li class="section__item section__item--col-6">
            <?php get_template_part( 'template-parts/game/archive' ); ?>
          </li>
        <?php
        if ($row_index % 6 === 0) {
          $row_index = 1;
        } else {
          $row_index++;
        }

        $game_index++;
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
  <!-- </ul> -->
</template>
<template id="platform-desktop">
  <ul class="section__list">
    <?php
      global $games;
      global $game_index;

      $game_index = 0;
      $games = $games_desktop;

      $row_index = 1;

      // Перебираем игры десктопные
      foreach ($games as $game) {
        ?>
          <li class="section__item section__item--col-6">
            <?php get_template_part( 'template-parts/game/archive' ); ?>
          </li>
        <?php
        if ($row_index % 6 === 0) {
          $row_index = 1;
        } else {
          $row_index++;
        }

        $game_index++;
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
  <!-- </ul> -->
</template>
<template id="platform-mobile">
  <!-- <ul class="section__list"> -->
    <?php
      global $games;
      global $game_index;

      $game_index = 0;
      $games = $games_mobile;

      $row_index = 1;

      // Перебираем игры мобильные
      foreach ($games as $game) {
        ?>
          <li class="section__item section__item--col-6">
            <?php get_template_part( 'template-parts/game/archive' ); ?>
          </li>
        <?php
        if ($row_index % 6 === 0) {
          $row_index = 1;
        } else {
          $row_index++;
        }

        $game_index++;
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
  <!-- </ul> -->
</template>
<template id="platform-xbox">
  <!-- <ul class="section__list"> -->
    <?php
      global $games;
      global $game_index;

      $game_index = 0;
      $games = $games_xbox;

      $row_index = 1;

      // Перебираем игры xbox
      foreach ($games as $game) {
        ?>
          <li class="section__item section__item--col-6">
            <?php get_template_part( 'template-parts/game/archive' ); ?>
          </li>
        <?php
        if ($row_index % 6 === 0) {
          $row_index = 1;
        } else {
          $row_index++;
        }

        $game_index++;
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
  <!-- </ul> -->
</template>
<template id="platform-playstation">
  <!-- <ul class="section__list"> -->
    <?php
      global $games;
      global $game_index;

      $game_index = 0;
      $games = $games_playstation;

      $row_index = 1;

      // Перебираем игры playstation
      foreach ($games as $game) {
        ?>
          <li class="section__item section__item--col-6">
            <?php get_template_part( 'template-parts/game/archive' ); ?>
          </li>
        <?php
        if ($row_index % 6 === 0) {
          $row_index = 1;
        } else {
          $row_index++;
        }

        $game_index++;
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
  <!-- </ul> -->
</template>
