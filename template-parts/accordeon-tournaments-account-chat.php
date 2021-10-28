<?php
  /*
    Аккордеон (стр Аккаунта. Вкладка Турниры. Чат)
  */
?>
<?php
  global $ea_user, $tournament, $tournament_id, $tname, $matches;
?>

<div class="accordeon accordeon--tournaments-account-chat">
  <ul class="accordeon__list">
    <?php foreach ($matches as $match): ?>
      <li class="accordeon__item accordeon__item--tournaments-account-chat">
        <div class="accordeon__item-left">
          <span class="accordeon__round accordeon__round--tournaments-account-chat">
            <?php
              if ((int)$match->type == 2) {
                echo ((int)$match->tour == 2 ? __( 'Финал', 'earena_2' ) : '1/2');
              } else {
                echo ($match->tour+1) . ' ' . (((int)$match->type == 1) ? __( 'тур', 'earena' ) : __( 'раунд', 'earena' ));
              }
            ?>
          </span>
          <time class="accordeon__date accordeon__date--tournaments-account-chat">
            <?= date('d.m.Y  H:i', utc_to_usertime(strtotime($match->start_time)));?>
            <?= $match->end_time ? (' – ' . date('d.m.Y  H:i', utc_to_usertime(strtotime($match->end_time)))) : ''; ?>
          </time>
        </div>

        <ul class="accordeon__content accordeon__content--tournaments-account-chat">
          <li class="accordeon__content-item">
            <a class="accordeon__user accordeon__user--left <?= ($ea_user->ID == $match->player1) ? 'accordeon__user--disabled' : ''; ?>" href="<?= ea_user_link($match->player1); ?>">
              <div class="accordeon__user-image <?= (is_online($match->player1) ? 'accordeon__user-image--online' : ''); ?>">
                <span><?= bp_core_fetch_avatar('item_id=' . $match->player1); ?></span>
              </div>
              <h5 class="accordeon__user-name">
                <?=ea_game_nick( $match->game, $match->platform, $match->player1); ?>
              </h5>
            </a>

            <div class="accordeon__result accordeon__result--tournaments-account-chat">
              <span class="accordeon__result-text">
                vs
              </span>
            </div>

            <a class="accordeon__user accordeon__user--right <?= ($ea_user->ID == $match->player2) ? 'accordeon__user--disabled' : ''; ?>" href="<?= ea_user_link($match->player2); ?>">
              <div class="accordeon__user-image <?= (is_online($match->player2) ? 'accordeon__user-image--online' : ''); ?>">
                <span><?= bp_core_fetch_avatar('item_id=' . $match->player2); ?></span>
              </div>
              <h5 class="accordeon__user-name">
                <?=ea_game_nick( $match->game, $match->platform, $match->player2); ?>
              </h5>
            </a>
          </li>
        </ul>

        <div class="accordeon__chat accordeon__chat--tournaments-account-chat ">
          <a class="button button--gray" href="<?= bloginfo( 'url' ) . '/tournaments/tournament/match/?match=' . $match->ID; ?>">
            <?php if (ea_count_unread($match->thread_id) > 0): ?>
              <span class="button__chat button__chat--right">
                <?= ea_count_unread($match->thread_id); ?>
              </span>
            <?php endif; ?>

            <span>
              <?php _e( 'В чат', 'earena_2' ); ?>
            </span>
          </a>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</div>
