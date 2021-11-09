<?php
  /*
    Табы типов Турниров на стр Турниров Админа
  */
?>
<?php
  global $tournament_type, $tab_active_index;
  $tournament_type = $tournament_type ?? 0;

  $tab_active_index = $tab_active_index ?? 0;
?>
<div class="tabs tabs--tournaments-link-admin">
  <a class="tabs__button tabs__button--tournaments-link-admin <?= (is_page(640) || $tournament_type == 3) ? 'active' : ''; ?>" href="<?php echo get_page_link(640); ?>">
    <?php _e( 'Кубки', 'earena' ); ?>
    <span class="tabs__count">
      <?= count_admin_tournaments(3); ?>
    </span>
  </a>
  <a class="tabs__button tabs__button--tournaments-link-admin <?= (is_page(643) || $tournament_type == 1) ? 'active' : ''; ?>" href="<?php echo get_page_link(643); ?>">
    <?php _e( 'Турниры', 'earena' ); ?>
    <span class="tabs__count">
      <?= count_admin_tournaments(1); ?>
    </span>
  </a>
  <a class="tabs__button tabs__button--tournaments-link-admin <?= (is_page(646) || $tournament_type == 2) ? 'active' : ''; ?>" href="<?php echo get_page_link(646); ?>">
    <?php _e( 'Lucky CUP', 'earena' ); ?>
    <span class="tabs__count">
      <?= count_admin_tournaments(2); ?>
    </span>
  </a>
</div>

<div class="tabs tabs--tournaments-admin">
  <button class="tabs__button tabs__button--tournaments-admin <?= ($tab_active_index == '0') ? 'active' : ''; ?>" type="button" name="tab-1">
    <?php _e( 'Жалобы', 'earena' ); ?>
    <?php
      if (!isset($_GET['tournament']) && count_admin_tournaments_moderate($tournament_type) > 0) {
        ?>
          <span class="tabs__count">
            <?= count_admin_tournaments_moderate($tournament_type); ?>
          </span>
        <?php
      } else if (isset($_GET['tournament'])) {
        $matches_moderate = EArena_DB::get_ea_admin_tournament_matches_moderate($_GET['tournament']) ?? [];

        if (!empty($matches_moderate)) {
          ?>
            <span class="tabs__count">
              <?= count($matches_moderate); ?>
            </span>
          <?php
        }
      }
    ?>
  </button>
  <button class="tabs__button tabs__button--tournaments-admin <?= ($tab_active_index == '1') ? 'active' : ''; ?>" type="button" name="tab-2">
    <?php _e( 'Неподтвержденные', 'earena' ); ?>
    <?php
      if (!isset($_GET['tournament']) && count_admin_tournaments_not_confirmed($tournament_type) > 0) {
        ?>
          <span class="tabs__count">
            <?= count_admin_tournaments_not_confirmed($tournament_type); ?>
          </span>
        <?php
      } else if (isset($_GET['tournament'])) {
        $matches_not_confirmed = EArena_DB::get_ea_admin_tournament_matches_not_confirmed($_GET['tournament']) ?? [];

        if (!empty($matches_not_confirmed)) {
          ?>
            <span class="tabs__count">
              <?= count($matches_not_confirmed); ?>
            </span>
          <?php
        }
      }
    ?>
  </button>
</div>
