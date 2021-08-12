<?php
  /*
    Табы действий с Кошельком
  */
?>
<div class="tabs tabs--purse">
  <!-- Для переключения состояния - добавляется active класс  -->
  <button class="tabs__button tabs__button--purse active" type="button" name="tab-all">
    <?php _e( 'Пополнить', 'earena_2' ); ?>
  </button>
  <button class="tabs__button tabs__button--purse" type="button" name="tab-desktop">
    <?php _e( 'Вывести', 'earena_2' ); ?>
  </button>
  <button class="tabs__button tabs__button--purse" type="button" name="tab-mobile">
    <?php _e( 'Перевод игроку', 'earena_2' ); ?>
  </button>
  <button class="tabs__button tabs__button--purse" type="button" name="tab-XBOX">
    <?php _e( 'История счета', 'earena_2' ); ?>
  </button>
</div>
