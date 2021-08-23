<?php
  /*
    Архивная карточка игры на стр Аккаунта
  */
?>
<?php
  // Для проверки на пустую игру и для получения картинки (может только на этапе локальной разработки пригодится)
  global $games;
  global $game_index;

  // Сокрытие никнейма в попапе
  $no_nickname = true;
?>

<div class="game">
  <a class="game__link" href="<?php echo get_template_directory_uri(); ?>/game">
    <div class="game__image game__image--archive">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/archive/game-<?= $game_index; ?>.jpg" alt="<?= $games[$game_index]['name']; ?>">
    </div>

    <h3 class="game__name">
      <?= $games[$game_index]['name']; ?>
    </h3>

    <?php if (! $no_nickname): ?>
      <span class="game__nickname">
        Annetteblack
      </span>
    <?php endif; ?>
  </a>
</div>
