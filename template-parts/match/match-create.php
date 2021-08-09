<?php
  /*
    Кнопка создания матча
  */
?>

<div class="match match--create">
  <div class="match__image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/games/matches/match-create.jpg" alt="Game">
  </div>

  <button class="match__create" type="button" name="button">
    <?php _e( 'Создать', 'earena_2' ); ?>
    <br>
    <?php _e( 'новый матч', 'earena_2' ); ?>
  </button>
</div>
