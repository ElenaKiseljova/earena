<?php
  /*
    Архивная карточка матча
  */
?>
<?php
  global $matches;
  // Индекс матча
  global $match_index;
?>

<div class="match <?php if ($matches[$match_index]['my'] === true) echo 'match--my'; if ($matches[$match_index]['past'] === true) echo 'match--past'; ?>">
  <div class="match__image">
    <img src="<?= $matches[$match_index]['game_img']; ?>" alt="Game">
  </div>

  <div class="match__top">
    <div class="match__top-left">
      <h3 class="match__game">
        <?= $matches[$match_index]['game_name']; ?>
      </h3>
      <ul class="variations <?php if ($matches[$match_index]['lock'] === true) echo 'variations--lock'; ?>">
        <li class="variations__item">
          <?php if ($matches[$match_index]['variations'] === 'Ultimate Team'): ?>
            Ultimate Team
          <?php else : ?>
            <?= $matches[$match_index]['variations']; ?> vs <?= $matches[$match_index]['variations']; ?>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <div class="platform platform--match">
      <svg class="platform__icon" width="40" height="40">
        <use xlink:href="#icon-platform-<?= $matches[$match_index]['platforms'][0]; ?>"></use>
      </svg>
    </div>
  </div>

  <div class="match__center">
    <div class="user user--match">
      <?php if ( $matches[$match_index]['stream_1'] ): ?>
        <a class="user__stream" href="<?= $matches[$match_index]['stream_1']; ?>">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </a>
      <?php endif; ?>
      <?php if ($matches[$match_index]['user_avatar_1']): ?>
        <a class="user__avatar user__avatar--match" href="/profile">
          <img width="80" height="80" src="<?= $matches[$match_index]['user_avatar_1']; ?>" alt="Avatar">
        </a>
      <?php elseif ($matches[$match_index]['user_avatar_1'] === null) : ?>
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/profile">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
      <?php endif; ?>
      <a class="user__name user__name--match" href="/profile">
        <h5>
          AnnetteBlack
        </h5>
      </a>
    </div>
    <?php if ($matches[$match_index]['status'] !== 'past'): ?>
      <div class="match__vs match__vs--start">
        <span>
          vs
        </span>
      </div>
    <?php else : ?>
      <div class="match__vs match__vs--end">
        <span>
          <?= $matches[$match_index]['result_user_1']; ?> : <?= $matches[$match_index]['result_user_2']; ?>
        </span>
      </div>
    <?php endif; ?>

    <div class="user user--match">
      <?php if ( $matches[$match_index]['stream_2'] ): ?>
        <a class="user__stream" href="<?= $matches[$match_index]['stream_2']; ?>">
          <svg class="user__stream-icon" width="16" height="13">
            <use xlink:href="#icon-play"></use>
          </svg>
        </a>
      <?php endif; ?>
      <?php if ($matches[$match_index]['user_avatar_2']): ?>
        <a class="user__avatar user__avatar--match" href="/profile">
          <img width="80" height="80" src="<?= $matches[$match_index]['user_avatar_2']; ?>" alt="Avatar">
        </a>
      <?php elseif ($matches[$match_index]['user_avatar_2'] === null) : ?>
        <a class="user__avatar user__avatar--match user__avatar--loader" href="/profile">
          <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
        </a>
      <?php endif; ?>
      <a class="user__name user__name--match" href="/profile">
        <h5>
          AnnetteBlack
        </h5>
      </a>
    </div>
  </div>

  <div class="match__bottom">
    <div class="match__bet">
      <?php
        if ($matches[$match_index]['bet'] !== 'Free') {
          echo '$';
          if (function_exists( 'earena_2_nice_money' )) {
            earena_2_nice_money($matches[$match_index]['bet']);
          }
        } else {
          echo $matches[$match_index]['bet'];
        }
      ?>
    </div>

    <div class="match__button-wrapper">
      <?php if ($matches[$match_index]['status'] === 'future' && $matches[$match_index]['my'] === false): ?>
        <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Принять', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($matches[$match_index]['status'] === 'future' && $matches[$match_index]['my'] === true): ?>
        <button class="button button--red openpopup" data-popup="match" type="button" name="delete">
          <span>
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($matches[$match_index]['status'] === 'present' && $matches[$match_index]['my'] === false): ?>
        <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Проходит', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif ($matches[$match_index]['status'] === 'present' && $matches[$match_index]['my'] === true): ?>
        <a class="button button--gray" href="/chat?type=match">
          <span class="button__chat button__chat--left">
            24
          </span>
          <span>
            <?php _e( 'В чат', 'earena_2' ); ?>
          </span>
        </a>
      <?php elseif ($matches[$match_index]['status'] === 'past'): ?>
        <button class="button button--gray openpopup" disabled data-popup="match" type="button" name="accept">
          <span>
            <?php _e( 'Завершен', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>

      <div class="match__id">
        ID <?= $matches[$match_index]['id']; ?>
      </div>
    </div>
  </div>
</div>
