<?php
  /*
    Блог. Но пока тут только кнопок шаблоны
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <div class="page-main__wrapper">
    <!-- Кнопки -->
    <button class="button button--blue openpopup" data-popup="add" type="button" name="add">
      <span>
        <?php _e( 'Принять', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--red openpopup" data-popup="delete" type="button" name="delete">
      <span>
        <?php _e( 'Удалить', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--orange openpopup" data-popup="vip" type="button" name="vip">
      <span>
        <?php _e( 'VIP статус', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--green openpopup" data-popup="pay" type="button" name="pay">
      <span>
        <?php _e( 'Пополнить', 'earena_2' ); ?>
      </span>
    </button>
    <button class="button button--gray" type="button" name="ended">
      <span>
        <?php _e( 'Завершен', 'earena_2' ); ?>
      </span>
    </button>
  </div>
</main>

<?php
  get_footer(  );
?>
