<?php
  /*
    Табы игроков на странице Чата
  */
?>

<?php
  global $match, $match_id, $ea_user;
?>

<div class="tabs tabs--matches-admin">
  <button class="tabs__button tabs__button--matches-admin active" type="button" name="tab-1">
    <?php _e( 'Жалобы', 'earena' ); ?>
    <span class="tabs__count"><?= count_admin_matches_moderate();?></span>
  </button>
  <button class="tabs__button tabs__button--matches-admin" type="button" name="tab-2">
    <?php _e( 'Неподтвержденные', 'earena' ); ?>
    <span class="tabs__count"><?= count_admin_matches_not_confirmed(); ?></span>
  </button>
</div>
