<?php
  // Игры
  global $games;

  $games = [
    0 => [
      'name' => 'WARZONE',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    1 => [
      'name' => 'Dota 2',
      'variations' => [1, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    2 => [
      'name' => 'CS:GO',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    3 => [
      'name' => 'Mortal Combat 11 Ultimate',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    4 => [
      'name' => 'League of Legends',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    5 => [
      'name' => 'Heroes III',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    6 => [
      'name' => 'Warcraft III',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    7 => [
      'name' => 'Starcraft II',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    8 => [
      'name' => 'Playerunknown\'s Battlegrounds',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    9 => [
      'name' => 'Heartstone',
      'variations' => [1, 2, 5],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    10 => [
      'name' => 'TEKKEN 7',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation' ]
    ],
    11 => [
      'name' => 'World Of Tanks',
      'variations' => [1, 3, 7],
      'platforms' => [ 'desktop', 'mobile' ]
    ],
    12 => [
      'name' => 'World Of Tanks Blitz',
      'variations' => [1, 3, 7],
      'platforms' => [ 'mobile' ]
    ],
    13 => [
      'name' => 'PES 21',
      'variations' => [1, 2, 3],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    14 => [
      'name' => 'FIFA 21',
      'variations' => [1, 2],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
    15 => [
      'name' => 'FIFA ONLINE 4',
      'variations' => [1],
      'platforms' => [ 'desktop', 'xbox', 'playstation', 'mobile' ]
    ],
  ];
  // Количество игр
  global $game_amounts;

  $game_amounts = count($games);
?>

<section class="section section--games" id="games">
  <div class="section__wrapper">
    <header class="section__header">
      <h2 class="section__title section__title--games">
        <?php _e( 'Игры', 'earena_2' ); ?>
        <span class="section__amount">
          <?= $game_amounts; ?>
        </span>
      </h2>

      <div class="section__header-right">
        <!-- Табы игровых платформ -->
        <?php get_template_part( 'template-parts/tabs' ); ?>
      </div>
    </header>

    <div class="section__content">
      <ul class="section__list">
        <?php
          global $game_index;

          for ($game_index=0; $game_index < 18; $game_index++) {
            ?>
              <li class="section__item section__item--col-6">
                <?php get_template_part( 'template-parts/game/game-archive' ); ?>
              </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</section>
