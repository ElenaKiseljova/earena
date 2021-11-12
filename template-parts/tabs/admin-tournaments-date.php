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
<div class="tabs tabs--tournaments-date-admin">
  <button class="tabs__button tabs__button--tournaments-date-admin" type="button" name="type-tournament"
      @click.prevent="activeSubTab=1"
      :class="{'active':activeSubTab===1}">
    <?php _e( 'Точная дата тура', 'earena' ); ?>
  </button>
  <button class="tabs__button tabs__button--tournaments-date-admin" type="button" name="type-tournament"
      @click.prevent="activeSubTab=2"
      :class="{'active':activeSubTab===2}">
    <?php _e( 'Универсальная', 'earena' ); ?>
  </button>
</div>
