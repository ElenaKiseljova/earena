<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?php echo bloginfo( 'name' ); ?>
  </h1>

  <section class="promo">
    <div class="promo__wrapper">
      <!-- Слайдер с баннерами и статистикой -->
      <?php get_template_part( 'template-parts/promo/slider' ); ?>
    </div>
  </section>

  <?php
    // Игры
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

  <section class="section section--matches" id="matches">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--matches">
          <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
          <span class="section__amount">
            1 038
          </span>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="#">
            <span>
              <?php _e( 'Все матчи', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list">
          <?php
            for ($match_index=0; $match_index < 8; $match_index++) {
              ?>
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/match-archive' ); ?>
                </li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </section>

  <section class="section section--tournaments" id="tournaments">
    <div class="section__wrapper">
      <header class="section__header">
        <h2 class="section__title section__title--tournaments">
          <?php _e( 'Турниры', 'earena_2' ); ?>

          <span class="section__amount">
            462
          </span>
        </h2>

        <div class="section__header-right">
          <a class="button button--more" href="#">
            <span>
              <?php _e( 'Все турниры', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </header>

      <div class="section__content">
        <ul class="section__list">
          <?php
            for ($i=0; $i < 8; $i++) {
              ?>
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/tournament/tournament-archive' ); ?>
                </li>
              <?php
            }
          ?>
        </ul>
      </div>
    </div>
  </section>

  <div class="page-main__wrapper">
    <!-- Кнопки -->
    <button class="button button--blue openpopup" data-popup="add" type="button" name="add">
      <span>
        <?php _e( 'Принять', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--red openpopup" data-popup="delete" type="button" name="delete">
      <span>
        <?php _e( 'Удалить', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--orange openpopup" data-popup="vip" type="button" name="vip">
      <span>
        <?php _e( 'VIP статус', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--green openpopup" data-popup="pay" type="button" name="pay">
      <span>
        <?php _e( 'Пополнить', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--gray" type="button" name="ended">
      <span>
        <?php _e( 'Завершен', 'earena_2' ); ?>
      </span>
    </button>
  </div>

  <section class="partners">
    <div class="partners__wrapper">
      <!-- Список партнёров -->
      <?php get_template_part( 'template-parts/partners/list' ); ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
