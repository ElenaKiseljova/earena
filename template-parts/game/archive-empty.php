<?php
  /*
    Архивная карточка игры (пустая)
  */
?>
<?php
  $is_profile = earena_2_current_page( 'profile' );
?>
<div class="game <?= $is_profile ? 'game--profile-empty' : ''; ?>">
  <span class="game__link game__link--disabled">
  </span>
</div>
