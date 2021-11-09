<?php
  /*
    Табы типов Турниров на стр Создания Турнира
  */
?>
<?php
  global $tournament_type, $tab_active_index;
  $tournament_type = $tournament_type ?? 0;

  $tab_active_index = $tab_active_index ?? 0;
?>
<div class="tabs tabs--tournaments-button-admin">
  <button class="tabs__button tabs__button--tournaments-button-admin active" type="button" name="type-tournament">
    <?php _e( 'Кубок', 'earena' ); ?>
  </button>
  <button class="tabs__button tabs__button--tournaments-button-admin" type="button" name="type-tournament">
    <?php _e( 'Турнир', 'earena' ); ?>
  </button>
  <button class="tabs__button tabs__button--tournaments-button-admin" type="button" name="type-tournament">
    <?php _e( 'Lucky CUP', 'earena' ); ?>
  </button>
</div>
