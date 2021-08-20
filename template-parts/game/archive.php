<?php
  /*
    Архивная карточка игры
  */
?>
<?php
  // Для проверки на пустую игру и для получения картинки (может только на этапе локальной разработки пригодится)
  global $games;
  global $game_index;
?>

<div class="game">
  <a class="game__link" href="/game">
    <div class="game__image game__image--archive">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/archive/game-<?= $game_index; ?>.jpg" alt="<?= $games[$game_index]['name']; ?>">
    </div>
    <?php
      // Варианты игры
      $variations = $games[$game_index]['variations'];
    ?>
    <ul class="variations">
      <?php foreach ($variations as $variation): ?>
        <li class="variations__item">
          <?= $variation; ?> vs <?= $variation; ?>
        </li>
      <?php endforeach; ?>
    </ul>

    <h3 class="game__name">
      <?= $games[$game_index]['name']; ?>
    </h3>

    <?php
      // Платформы игры
      $platforms = $games[$game_index]['platforms'];
    ?>
    <ul class="game__platforms">
      <?php foreach ($platforms as $platform): ?>
        <li class="platform platform--game">
          <svg class="platform__icon" width="30" height="30">
            <use xlink:href="#icon-platform-<?= $platform; ?>"></use>
          </svg>
        </li>
      <?php endforeach; ?>
    </ul>
  </a>
</div>
