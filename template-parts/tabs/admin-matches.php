<?php
  /*
    Табы Жалоб и Неподтвержденных Матчей на стр Матчей Админа
  */
?>

<?php
  global $match, $match_id, $ea_user, $tab_active_index;

  $tab_active_index = $tab_active_index ?? 0;
?>

<div class="tabs tabs--matches-admin">
  <button class="tabs__button tabs__button--matches-admin <?= ($tab_active_index == '0') ? 'active' : ''; ?>" type="button" name="tab-1">
    <?php _e( 'Жалобы', 'earena' ); ?>
    <span class="tabs__count">
      <?= count_admin_matches_moderate(); ?>
    </span>
  </button>
  <button class="tabs__button tabs__button--matches-admin <?= ($tab_active_index == '1') ? 'active' : ''; ?>" type="button" name="tab-2">
    <?php _e( 'Неподтвержденные', 'earena' ); ?>
    <span class="tabs__count">
      <?= count_admin_matches_not_confirmed(); ?>
    </span>
  </button>
</div>
