<?php
  /*
    Архивная карточка игры на стр Аккаунта
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

    <h3 class="game__name">
      <?= $games[$game_id]['name']; ?>
    </h3>

    <span class="game__nickname">
      <?= $game_user_name; ?>
    </span>
  </a>
</div>
