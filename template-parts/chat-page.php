<?php
  global $match, $match_id, $ea_user, $icons, $ea_icons;

  $games = get_site_option( 'games' );

  $is_matches_chat = earena_2_current_page( 'matches' );
  $is_tournaments_chat = earena_2_current_page( 'tournaments');

  $tournament = false;
  $tournament_id = ($match->tid) ?? false;
  if ($tournament_id) {
    $tournament = EArena_DB::get_ea_tournament($tournament_id) ?? [];

    if (!empty($tournament)) {
      /* TYPE */
      $is_tournament_simple = ((int)$tournament->type === 1) ? true : false;
      $is_tournament_lucky_cup = ((int)$tournament->type === 2) ? true : false;
      $is_tournament_cup = ((int)$tournament->type === 3) ? true : false;
    }
  }
?>
<section class="chat-page">
  <div class="chat-page__wrapper">
    <div class="chat-page__left">
      <header class="chat-page__header chat-page__header--left">
        <div class="platform platform--page">
          <svg class="platform__icon" width="40" height="40">
            <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$match->platform]; ?>"></use>
          </svg>
        </div>
        <div class="chat-page__center chat-page__center--header">
          <h3 class="chat-page__game">
            <?= $games[$match->game]['name']; ?> - <?= !empty($match->bet) ? ('$' . earena_2_nice_money($match->bet)) : 'Free'; ?>
          </h3>

          <ul class="variations variations--chat-page <?= ($match->private == '1') ? 'variations--lock' : ''; ?>">
            <li class="variations__item">
              <?= $match->game_mode; ?> vs <?= $match->game_mode; ?>
            </li>
            <?php if ($match->team_mode > 0): ?>
              <li class="variations__item">
                <?= team_mode_to_string($match->team_mode); ?>
              </li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="chat-page__right chat-page__right--header">
          <?php if ($is_matches_chat): ?>
            <a class="chat-page__rules" href="<?= get_page_link(1842); ?>">
              <?php _e( 'Правила игры', 'earena_2' ); ?>
            </a>
          <?php elseif ($is_tournaments_chat && !empty($tournament)) : ?>
            <?php if ( $tournament->verification ): ?>
              <span class="verify verify--true verify--tournament-page"></span>
            <?php endif; ?>

            <?php if ( $tournament->vip ): ?>
              <span class="vip vip--tournament-page">
                vip
              </span>
            <?php endif; ?>

            <?php if ((int)$tournament->type == 2): ?>
              <a class="chat-page__rules" href="<?= get_page_link(1835); ?>">
                <?php _e( 'Правила Lucky CUP', 'earena_2' ); ?>
              </a>
            <?php elseif ((int)$tournament->type == 3) : ?>
              <a class="chat-page__rules" href="<?= get_page_link(2214); ?>">
                <?php _e( 'Правила Кубка', 'earena_2' ); ?>
              </a>
            <?php else: ?>
              <a class="chat-page__rules" href="<?= get_page_link(1838); ?>">
                <?php _e( 'Правила Турнира', 'earena_2' ); ?>
              </a>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </header>
      <?php if (!empty($tournament)): ?>
        <div class="chat-page__top chat-page__top--tournament">
          <h2 class="chat-page__name">
            <?= $tournament->name; ?>
          </h2>

          <div class="chat-page__round">
            <?php if ((int)$match->type == 2): ?>
              <?= ((int)$match->tour == 2 ? __('Финал', 'earena') : '1/2'); ?>
            <?php elseif ((int)$match->type == 3): ?>
              <?= ($match->tour + 1); ?><?php _e('раунд', 'earena'); ?>
            <?php else : ?>
              <?= ($match->tour + 1); ?> <?php _e( 'тур', 'earena_2' ); ?>
            <?php endif; ?>
          </div>
          <div class="chat-page__type">
            <?php if ((int)$tournament->type == 2): ?>
              Lucky CUP
            <?php elseif ((int)$tournament->type == 3) : ?>
              <?php _e( 'Кубок', 'earena_2' ); ?>
            <?php else: ?>
              <?php _e( 'Турнир', 'earena_2' ); ?>
            <?php endif; ?>
          </div>
          <div class="chat-page__date">
            <?php if ((int)$match->type == 3): ?>
              <?php _e( 'Сыграть до', 'earena_2' ); ?>
              <time>
                <?= date('d.m.Y H:i', utc_to_usertime(strtotime($match->end_time))); ?>
              </time>
            <?php else : ?>
              <?php _e( 'Сыграть до', 'earena_2' ); ?>
              <time>
                <?= date('d.m.Y H:i', utc_to_usertime(strtotime($match->end_time))); ?>
              </time>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <div id="chat-page-form">
        <?php earena_2_match_page_data($ea_user, $match_id); ?>
      </div>
    </div>
    <div class="chat-page__right">
      <header class="chat-page__header chat-page__header--right">
        <h1 class="chat-page__chat">
          <?php _e( 'Чат матча ', 'earena_2' ); ?> ID<?= $match_id; ?>
        </h1>

        <?php if (!is_ea_admin()): ?>
          <button class="chat-page__complaint-openpopup button button--red openpopup" data-popup="complaint" type="button" name="complaint">
            <span>
              <?php _e( 'Жалоба судье', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
      </header>

      <div class="page-chat" id="chat">
        <?php ea_message_box($match->thread_id);?>
      </div>
    </div>
  </div>
</section>
