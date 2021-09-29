<?php
  /*
    Архивная карточка игры
  */
?>
<?php
  global $games, $game_id, $game_user_name, $ea_icons;
?>

<div class="game">
  <a class="game__link" href="<?= bloginfo( 'url' ) . '/games/?game=' . $game_id; ?>">
    <div class="game__image game__image--archive">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/archive/<?= $ea_icons['game'][$game_id]; ?>.jpg" alt="<?= $games[$game_id]['name']; ?>">
    </div>
    <?php
      // Варианты игры
      $variations = $games[$game_id]['game_modes'];
    ?>
    <ul class="variations">
      <?php foreach ($variations as $variation): ?>
        <li class="variations__item">
          <?= $variation; ?> vs <?= $variation; ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <h3 class="game__name">
      <?= $games[$game_id]['name']; ?>
    </h3>

    <?php
      // Платформы игры
      $platforms = $games[$game_id]['platforms'];
    ?>
    <ul class="game__platforms">
      <?php foreach ($platforms as $platform): ?>
        <li class="platform platform--game">
          <svg class="platform__icon" width="30" height="30">
            <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$platform]; ?>"></use>
          </svg>
        </li>
      <?php endforeach; ?>
    </ul>
  </a>
</div>
