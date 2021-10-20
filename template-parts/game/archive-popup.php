<?php
  /*
    Архивная карточка игры в попапе добавления Игры
  */
?>
<?php
  global $games, $game_id, $platform_id, $ea_icons;
?>

<div class="game">
  <a class="game__link" data-platform="<?= $platform_id; ?>" data-game="<?= $game_id; ?>" href="<?= bloginfo( 'url' ) . '/games/?game=' . $game_id; ?>">
    <div class="game__image game__image--archive">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/archive/<?= $ea_icons['game'][$game_id]; ?>.jpg" alt="<?= $games[$game_id]['name']; ?>">
    </div>

    <h3 class="game__name">
      <?= $games[$game_id]['name']; ?>
    </h3>
  </a>
</div>
