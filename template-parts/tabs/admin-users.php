<?php
  /*
    Табы игроков на странице Чата
  */
?>

<?php
  global $match, $match_id, $ea_user;
?>

<div class="tabs tabs--users">
  <button class="tabs__button tabs__button--users active" type="button" name="tab-1">
    <?= ea_game_nick($match->game, $match->platform, $match->player1); ?>
  </button>
  <button class="tabs__button tabs__button--users" type="button" name="tab-2">
    <?= ea_game_nick($match->game, $match->platform, $match->player2); ?>
  </button>
</div>
