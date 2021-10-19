<?php
  /*
    Страница Игры
  */
?>
<?php
  global $games, $game_id, $ea_icons;

  $dataFilter = [
    'game' => [$game_id]
  ];

  // (array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID')
  $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, 0, 0, 'DESC', 'ID', $mode = 'new');
  $count_matches = $matches_db_collection ['total'] ?? 0;

  // ( array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID', $mode = 'old')
  $tournaments_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, 0, 0, 'DESC', 'ID', $mode = 'new');
  $count_tournaments = $tournaments_db_collection['total'] ?? 0;
?>

<section class="game game--page">
  <div class="game__wrapper">
    <header class="game__header">
      <div class="game__description">
        <h1 class="game__title">
          <?= $games[$game_id]['name']; ?>
        </h1>

        <ul class="variations variations--page">
          <?php foreach ($games[$game_id]['game_modes'] as $variation): ?>
            <li class="variations__item variations__item--page">
              <?= $variation; ?> vs <?= $variation; ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="game__text">
          <p class="game__text-item">
            <?php _e( 'Матчей на деньги', 'earena_2' ); ?>: <span class="game-matches-count"><?= $count_matches; ?></span>
          </p>
          <p class="game__text-item">
            <?php _e( 'Турниров', 'earena_2' ); ?>: <span class="game-tournaments-count"><?= $count_tournaments; ?></span>
          </p>
        </div>

        <ul class="game__platforms game__platforms--page">
          <?php
            $platforms = $games[$game_id]['platforms'];

            foreach ($platforms as $platform) {
              ?>
                <li class="platform platform--page">
                  <svg class="platform__icon" width="30" height="30">
                    <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$platform]; ?>"></use>
                  </svg>
                </li>
              <?php
            }
          ?>
        </ul>

        <a class="game__rules" href="<?= $games[$game_id]['rules_page']; ?>">
          <?php _e( 'Правила игры', 'earena_2' ); ?>
        </a>
      </div>
      <div class="game__image game__image--page" itemscope itemtype="http://schema.org/ImageObject">
        <picture class="game__picture">
          <img itemprop="contentUrl" src="<?php echo get_template_directory_uri(); ?>/assets/img/games/banners/<?= $ea_icons['game'][$games[$game_id]['key']]; ?>.png" alt="<?= $games[$game_id]['name']; ?>">
        </picture>

        <meta itemprop="name" content="<?= $games[$game_id]['name']; ?>">
      </div>
    </header>
  </div>
</section>
