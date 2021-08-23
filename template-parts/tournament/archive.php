<?php
  /*
    Архивная карточка турнира
  */
?>
<?php
  global $tournaments;

  // Индекс турнира
  global $tournament_index;

  global $is_account_page;
?>

<div class="tournament ">
  <?php if ($tournaments[$tournament_index]['status'] === 'present' && $is_account_page): ?>
    <a class="tournament__gotochat" href="<?php echo bloginfo( 'url' ); ?>/account?tournaments=chat&tournament_index=<?= $tournament_index;?>">
      <span class="visually-hidden">
        <?php _e( 'В чате турнира сообщений', 'earena_2' ); ?>
      </span>
      1
    </a>
  <?php endif; ?>

  <a class="tournament__link <?php if ($tournaments[$tournament_index]['status'] === 'past') echo 'tournament__link--past'; if ($tournaments[$tournament_index]['my'] === true)  echo 'tournament__link--my'; ?>" href="/tournament">
    <div class="tournament__top">
      <div class="tournament__image">
        <img src="<?= $tournaments[$tournament_index]['tournament']['img']; ?>" alt="Game">
      </div>

      <?php if ( $tournaments[$tournament_index]['tournament']['vip'] === true ): ?>
        <span class="vip">
          vip
        </span>
      <?php endif; ?>

      <div class="tournament__top-content">
        <?php if (!empty($tournaments[$tournament_index]['tournament']['winner'])): ?>
          <div class="tournament__winner">
            <div class="tournament__winner-image-wrapper">
              <div class="tournament__winner-image">
                <img src="<?= $tournaments[$tournament_index]['tournament']['winner']['avatar']; ?>" alt="User">
              </div>
            </div>

            <h5 class="tournament__winner-name">
              <?= $tournaments[$tournament_index]['tournament']['winner']['name']; ?>
            </h5>
          </div>
        <?php endif; ?>
        <div class="tournament__trophy">
          <?php
            echo '$';
            if (function_exists( 'earena_2_nice_money' )) {
              earena_2_nice_money($tournaments[$tournament_index]['trophy']);
            }
          ?>
        </div>
      </div>
    </div>

    <div class="tournament__center">
      <h4 class="tournament__name">
        <?= $tournaments[$tournament_index]['tournament']['name']; ?>
      </h4>

      <?php if ( $tournaments[$tournament_index]['status'] === 'future' ): ?>
        <div class="tournament__status tournament__status--future">
          <?php _e( 'Регистрация до', 'earena_2' ); ?> <time><?= $tournaments[$tournament_index]['tournament']['date_registration']; ?></time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начало', 'earena_2' ); ?> <time><?= $tournaments[$tournament_index]['tournament']['date_start']; ?></time>
        </div>
      <?php elseif ($tournaments[$tournament_index]['status'] === 'present') : ?>
        <div class="tournament__status tournament__status--present">
          <?php _e( 'Проходит', 'earena_2' ); ?>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?> <time><?= $tournaments[$tournament_index]['tournament']['date_start']; ?></time>
        </div>
      <?php else : ?>
        <div class="tournament__status tournament__status--past">
          <?php _e( 'Завершился', 'earena_2' ); ?> <time><?= $tournaments[$tournament_index]['tournament']['date_end']; ?></time>
        </div>
        <div class="tournament__info">
          <?php _e( 'Начался', 'earena_2' ); ?> <time><?= $tournaments[$tournament_index]['tournament']['date_start']; ?></time>
        </div>
      <?php endif; ?>

      <div class="players">
        <div class="players__progress">
          <?php
            $users_percent = round($tournaments[$tournament_index]['tournament']['users_current'] / $tournaments[$tournament_index]['tournament']['users_total'] * 100);
          ?>
          <span class="players__progress-bar" data-width="<?= $users_percent;  ?>"></span>
        </div>
        <div class="players__text">
          <?= $tournaments[$tournament_index]['tournament']['users_current']; ?>/<?= $tournaments[$tournament_index]['tournament']['users_total']; ?>
        </div>
      </div>
    </div>

    <div class="tournament__bottom">
      <div class="tournament__bottom-left">
        <h3 class="tournament__game">
          <?= $tournaments[$tournament_index]['game_name']; ?>
        </h3>
        <ul class="variations <?php if ($tournaments[$tournament_index]['lock'] === true) echo 'variations--lock'; ?>">
          <li class="variations__item">
            <?php if ($tournaments[$tournament_index]['variations'] === 'Ultimate Team'): ?>
              Ultimate Team
            <?php else: ?>
              <?= $tournaments[$tournament_index]['variations']; ?> vs <?= $tournaments[$tournament_index]['variations']; ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>

      <div class="platform">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-<?= $tournaments[$tournament_index]['platforms'][0]; ?>"></use>
        </svg>
      </div>

      <div class="tournament__id">
        ID <?= $tournaments[$tournament_index]['id']; ?>
      </div>

      <div class="tournament__bet">
        <?php
          if ($tournaments[$tournament_index]['bet'] !== 'Free') {
            echo '$';
            if (function_exists( 'earena_2_nice_money' )) {
              earena_2_nice_money($tournaments[$tournament_index]['bet']);
            }
          } else {
            echo $tournaments[$tournament_index]['bet'];
          }
        ?>
      </div>
    </div>
  </a>
</div>
