<?php
  /*
    Чат
  */
?>

<?php
  get_header(  );
?>

<?php
  global $is_chat_page;
  $is_chat_page = true;

  $tournament_chat_page = false;
  $match_chat_page = false;

  if ($_GET['type'] && $_GET['type'] === 'tournament') {
    $tournament_chat_page = true;
  }

  if ($_GET['type'] && $_GET['type'] === 'match') {
    $match_chat_page = true;
  }
?>

<main class="page-main">
  <section class="chat-page">
    <!-- Страница чата турнира/матча -->
    <div class="chat-page__wrapper">
      <div class="chat-page__left">
        <header class="chat-page__header chat-page__header--left">
          <div class="platform platform--page">
            <svg class="platform__icon" width="40" height="40">
              <use xlink:href="#icon-platform-xbox"></use>
            </svg>
          </div>
          <div class="chat-page__center">
            <h3 class="chat-page__game">
              WARZONE - $100
            </h3>

            <ul class="variations variations--lock">
              <li class="variations__item">
                1 vs 1
              </li>
            </ul>
          </div>

          <a class="chat-page__rules" href="/text">
            <?php _e( 'Правила игры', 'earena_2' ); ?>
          </a>
        </header>
        <div class="chat-page__inner <?php echo $match_chat_page ? 'chat-page__inner--match' : '';  ?>">
          <?php if ($tournament_chat_page): ?>
            <div class="chat-page__top">
              <h2 class="chat-page__name">
                Championship 2020 Season 2 Premium
              </h2>

              <div class="chat-page__round">
                3 <?php _e( 'тур', 'earena_2' ); ?>
              </div>
              <div class="chat-page__type">
                <?php _e( 'Турнир', 'earena_2' ); ?>
              </div>
              <div class="chat-page__date">
                <?php _e( 'Сыграть до', 'earena_2' ); ?> <time>15.11.2020</time>
              </div>
            </div>
          <?php endif; ?>

          <form class="chat-page__form" id="form-chat-page" action="index.html" method="post">
            <div class="chat-page__form-left">
              <div class="user user--form">
                <a class="user__avatar user__avatar--form" href="#">
                  <img width="80" height="80" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-1.png" alt="Avatar">
                </a>
                <a class="user__name user__name--form" href="#">
                  <h5>
                    AnnetteBlack
                  </h5>
                </a>
              </div>

              <!-- Send -->
              <!-- <label class="visually-hidden" for="chat-page-result-user-1">
                <?php _e( 'Результат первого участника', 'earena_2' ) ?>
              </label>
              <input class="chat-page__form-input" readonly type="text" id="chat-page-result-user-1" name="chat-page-result-user-1" value="0">

              <div class="chat-page__broadcasting checkbox checkbox--left">
                <input class="visually-hidden" type="checkbox" name="broadcasting" id="broadcasting">
                <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="broadcasting">
                  <?php _e( 'Трансляция', 'earena_2' ); ?>
                </label>
              </div> -->
            </div>
            <div class="chat-page__form-center">
              <!-- Send -->
              <!-- <span class="chat-page__form-vs">
                vs
              </span>
              <div class="files files--chat-page">
                <label class="files__label files__label--chat-page" for="files-chat-page">
                  <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
                </label>
                <input class="files__input visually-hidden" type="file" id="files-chat-page" name="files" accept=".png, .jpg, .jpeg" multiple>


                <div class="files__preview">
                </div>
              </div>
              -->

              <!-- Change -->
              <!-- <span class="chat-page__form-vs chat-page__form-vs--change">
                1 : 5
              </span>
              <div class="preview preview--change">
                <ul>
                  <li>
                    <p>
                      about-medium
                    </p>
                  </li>
                  <li>
                    <p>
                      about-medium@2x
                    </p>
                  </li>
              </div> -->

              <!-- Accept -->
              <span class="chat-page__form-vs chat-page__form-vs--change">
                1 : 5
              </span>

              <div class="files files--chat-page">
                <label class="files__label files__label--chat-page" for="files-chat-page">
                  <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
                </label>
                <input class="files__input visually-hidden" type="file" id="files-chat-page" name="files" accept=".png, .jpg, .jpeg" multiple>

                <!-- Сюда попадают скрины, что загрузил игрок подтверждающий результат матча, что ввел его сопертник -->
                <div class="files__preview">
                </div>
                <!-- Сюда попадают скрины, что загрузил игрок, который отправил счет матча -->
                <div class="files__preview files__preview--change">
                  <ul>
                    <li>
                      <p>
                        <a href="#">about-medium</a>
                      </p>
                    </li>
                    <li>
                      <p>
                        <a href="#">about-medium@2x</a>
                      </p>
                    </li>
                </div>
              </div>
            </div>
            <div class="chat-page__form-right">
              <div class="user user--form">
                <a class="user__stream user__stream--right" href="https://youtube.com">
                  <svg class="user__stream-icon" width="16" height="13">
                    <use xlink:href="#icon-play"></use>
                  </svg>
                </a>
                <a class="user__avatar user__avatar--form" href="#">
                  <img width="80" height="80" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-2.png" alt="Avatar">
                </a>
                <a class="user__name user__name--form" href="#">
                  <h5>
                    StacyBloom
                  </h5>
                </a>
              </div>

              <!-- Send -->
              <!-- <label class="visually-hidden" for="chat-page-result-user-2">
                <?php _e( 'Результат второго участника', 'earena_2' ) ?>
              </label>
              <input class="chat-page__form-input" readonly type="text" id="chat-page-result-user-2" name="chat-page-result-user-2" value="0"> -->
            </div>

            <!-- Send -->
            <!-- <button class="chat-page__form-submit button button--blue" disabled type="submit" name="chat-page-result-submit">
              <span>
                <?php _e( 'Отправить результат', 'earena_2' ); ?>
              </span>
            </button> -->

            <!-- Change -->
            <!-- <button class="chat-page__form-submit button button--gray" type="submit" name="chat-page-result-submit">
              <span>
                <?php _e( 'Изменить результат', 'earena_2' ); ?>
              </span>
            </button> -->

            <!-- Accept -->
            <button class="chat-page__form-submit button button--blue" type="submit" name="chat-page-result-submit">
              <span>
                <?php _e( 'Подтвердить результат', 'earena_2' ); ?>
              </span>
            </button>
          </form>
        </div>
      </div>
      <div class="chat-page__right">
        <header class="chat-page__header chat-page__header--right">
          <?php if ($tournament_chat_page): ?>
            <h1 class="chat-page__chat">
              <?php _e( 'Чат турнира ', 'earena_2' ); ?> ID0432545
            </h1>
          <?php elseif ($match_chat_page) : ?>
            <h1 class="chat-page__chat">
              <?php _e( 'Чат матча ', 'earena_2' ); ?> ID0432545
            </h1>
          <?php endif; ?>


          <button class="chat-page__complaint button button--red openpopup" data-popup="complaint" type="button" name="complaint">
            <span>
              <?php _e( 'Жалоба судье', 'earena_2' ); ?>
            </span>
          </button>
        </header>

        <!-- Чат -->
        <?php
          get_template_part( 'template-parts/chat' );
        ?>
      </div>
    </div>
  </section>

  <!-- Партнеры -->
  <?php get_template_part( 'template-parts/partners' ); ?>
</main>

<?php
  get_footer(  );
?>
