<?php
  // Стрим
?>
<?php
  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $ea_user = $earena_2_user_private;

  $stream = $ea_user->get('stream')?:'';
?>

<div class="stream">
  <div class="stream__header">
    <h2 class="stream__title">
      <?php _e( 'Моя трансляция', 'earena_2' ); ?>
    </h2>

    <a class="stream__link" href="<?= $stream; ?>"><?= $stream; ?></a>

    <button class="stream__button button button--gray openpopup" data-popup="stream" type="button" name="source">
      <span>
        <?= $stream ? __( 'Изменить источник', 'earena_2' ) : __( 'Указать источник', 'earena_2' ); ?>
      </span>
    </button>
  </div>
</div>
